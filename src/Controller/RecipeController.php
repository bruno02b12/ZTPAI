<?php

namespace App\Controller;

use App\Entity\Cuisine;
use App\Entity\DietaryType;
use App\Entity\Recipe;
use App\Entity\RecipeDietaryType;
use App\Entity\RecipeIngredient;
use App\Entity\RecipeType;
use App\Entity\ShoppingList;
use App\Entity\ShoppingListIngredient;
use App\Repository\CuisineRepository;
use App\Repository\DietaryTypeRepository;
use App\Repository\FractionRepository;
use App\Repository\IngredientRepository;
use App\Repository\RecipeDietaryTypeRepository;
use App\Repository\RecipeIngredientRepository;
use App\Repository\RecipeRepository;
use App\Repository\RecipeTypeRepository;
use App\Repository\UnitRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class RecipeController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(): Response
    {
        return $this->redirectToRoute('app_recipes_all');
    }

    #[Route('/recipes', name: 'app_recipes_all')]
    public function show(RecipeRepository $recipeRepository, EntityManagerInterface $entityManager): Response
    {
        $cuisineRepository = $entityManager->getRepository(Cuisine::class);
        $dietaryTypeRepository = $entityManager->getRepository(DietaryType::class);
        $recipeTypeRepository = $entityManager->getRepository(RecipeType::class);

        $cuisines = $cuisineRepository->findAll();
        $dietaryTypes = $dietaryTypeRepository->findAll();
        $recipeTypes = $recipeTypeRepository->findAll();

        $recipes = $recipeRepository->findRecipeSummaries();
        return $this->render('recipes/recipes.html.twig', [
            'recipes' => $recipes,
            'cuisines' => $cuisines,
            'dietaryTypes' => $dietaryTypes,
            'recipeTypes' => $recipeTypes
        ]);
    }

    #[Route('/recipe/{id}', name: 'app_recipe_details', requirements: ['id' => '\d+'])]
    public function details(int $id, RecipeRepository $recipeRepository, RecipeIngredientRepository $ri, RecipeDietaryTypeRepository $rd): Response
    {
        $user = $recipeRepository->findUserEmailByRecipeId($id);

        $dietaryTypes = $rd->findRecipeDietaryTypes($id);

        $ingredients = $ri->findRecipeIngredients($id);

        $recipe = $recipeRepository->findRecipeDetails($id);

        if (!$recipe) {
            throw $this->createNotFoundException('Recipe not found');
        }

        return $this->render('recipes/recipe.html.twig', [
            'user' => $user,
            'dietaryTypes' => $dietaryTypes,
            'ingredients' => $ingredients,
            'recipe' => $recipe
        ]);
    }

    #[Route('/recipes/add_recipe', name: 'app_recipe_add', methods: ['POST'])]
    public function addRecipe(Request               $request, EntityManagerInterface $entityManager,
                              UserRepository        $userRepository, FractionRepository $fractionRepository,
                              UnitRepository        $unitRepository, IngredientRepository $ingredientRepository,
                              DietaryTypeRepository $dietaryTypeRepository, SluggerInterface $slugger,
    RecipeTypeRepository $recipeTypeRepository, CuisineRepository $cuisineRepository, LoggerInterface $logger): Response
    {
        $data = $request->request->all();
        $file = $request->files->get('file');

        if ($file && $file->isValid()) {
            $mimeType = $file->getMimeType();
            if (!in_array($mimeType, ['image/jpeg', 'image/png', 'image/gif', 'image/bmp', 'image/webp', 'image/tiff'])) {
                return new JsonResponse(['status' => 'error', 'message' => 'Invalid file type. Only images are allowed.'], 400);
            }

            $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $slugger->slug($originalFilename, '_');
            $newFilename = $safeFilename . '_' . uniqid() . '.' . $file->guessExtension();

            $i = 1;
            while ($entityManager->getRepository(Recipe::class)->findOneBy(['image' => $newFilename])) {
                $newFilename = $safeFilename . '_' . $i . '.' . $file->guessExtension();
                $i++;
            }

            try {
                $file->move($this->getParameter('images_directory'), $newFilename);
            } catch (FileException $e) {
                return new JsonResponse(['status' => 'error', 'message' => 'Failed to upload image'], 500);
            }

            $data['image'] = $newFilename;
        } else {
            return new JsonResponse(['status' => 'error', 'message' => 'File is invalid'], 400);
        }

        $userId = $data['id_user'] ?? null;
        $title = $data['name'] ?? null;
        $prepTime = $data['prep_time'] ?? null;
        $noServings = $data['no_servings'] ?? null;
        $recipeTypeName = $data['type'] ?? null;
        $cuisineName = $data['cuisine'] ?? null;
        $description = $data['description'] ?? null;
        $preparation = $data['preparation'] ?? null;

        $ingredientsData = json_decode($data['ingredients'], true);
        if ($ingredientsData === null && json_last_error() !== JSON_ERROR_NONE) {
            $logger->error('Invalid JSON for ingredients: ' . json_last_error_msg());
            return new JsonResponse(['status' => 'error', 'message' => 'Invalid JSON for ingredients'], 400);
        }

        $dietData = json_decode($data['diet'], true);
        if ($dietData === null && json_last_error() !== JSON_ERROR_NONE) {
            $logger->error('Invalid JSON for diet: ' . json_last_error_msg());
            return new JsonResponse(['status' => 'error', 'message' => 'Invalid JSON for diet'], 400);
        }

        $noIngredients = count($ingredientsData);

        $user = $userRepository->find($userId);
        $recipeType = $recipeTypeRepository->findOneBy(['name' => $recipeTypeName]);
        $cuisine = $cuisineRepository->findOneBy(['name' => $cuisineName]);

        if (!$recipeType) {
            return new JsonResponse(['status' => 'error', 'message' => 'Recipe type not found.'], 400);
        }

        if (!$cuisine) {
            return new JsonResponse(['status' => 'error', 'message' => 'Cuisine not found.'], 400);
        }

        $recipe = new Recipe($title, $user, new \DateTime(), $newFilename, $prepTime, $noServings, $noIngredients, $recipeType, $cuisine, $description, $preparation);

        $entityManager->persist($recipe);
        $entityManager->flush();

        foreach ($ingredientsData as $ingredientData) {
            $quantity = $ingredientData['quantity'];
            $fraction = $fractionRepository->findByName($ingredientData['fraction']);
            $unit = $unitRepository->findByNameOrAbbr($ingredientData['unit']);
            $ingredient = $ingredientRepository->findByName($ingredientData['ingredient']);
            $note = $ingredientData['note'];

            $recipeIngredient = new RecipeIngredient(
                $recipe,
                $quantity,
                $fraction,
                $unit,
                $ingredient,
                $note
            );

            $entityManager->persist($recipeIngredient);
        }

        foreach ($dietData as $dietName) {
            $dietaryType = $dietaryTypeRepository->findOneBy(['name' => $dietName]);

            $recipeDietaryType = new RecipeDietaryType($recipe, $dietaryType);
            $entityManager->persist($recipeDietaryType);
        }

        $entityManager->flush();

        sleep(2);

        return new JsonResponse(['status' => 'success'], 200);
    }


    #[Route('/recipes/search', name: 'recipe_search', methods: ['GET'])]
    public function search(Request $request, RecipeRepository $recipeRepository): JsonResponse
    {
        $searchTerm = $request->query->get('term');
        if (!$searchTerm || strlen($searchTerm) < 5) {
            return new JsonResponse([]);
        }

        $recipes = $recipeRepository->createQueryBuilder('r')
            ->where('LOWER(r.title) LIKE :term')
            ->setParameter('term', '%' . strtolower($searchTerm) . '%')
            ->getQuery()
            ->getResult();

        $results = array_map(fn($recipe) => ['id' => $recipe->getId(), 'title' => $recipe->getTitle()], $recipes);

        return new JsonResponse($results);
    }


    #[Route('/recipes/{name}', name: 'app_filters')]
    public function filter(): Response
    {
        return $this->render('recipes/recipes.html.twig', [
            'controller_name' => 'RecipesController',
            'action' => 'filter'
        ]);
    }
}
