<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RecipesController extends AbstractController
{
    #[Route('/recipes', name: 'app_recipes')]
    public function index(): Response
    {
        return $this->render('recipes/index.html.twig', [
            'controller_name' => 'RecipesController',
            'action' => 'index'
        ]);
    }

    #[Route('/recipes/{name}', name: 'app_filters')]
    public function filter(): Response
    {
        return $this->render('recipes/index.html.twig', [
            'controller_name' => 'RecipesController',
            'action' => 'filter'
        ]);
    }

    #[Route('/recipe/{name}', name: 'app_details')]
    public function details(string $name): Response
    {
        return $this->render('recipes/details.html.twig', [
            'controller_name' => 'RecipesController',
            'action' => 'details',
            'name' => $name
        ]);
    }
}
