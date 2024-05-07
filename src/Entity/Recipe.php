<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: RecipeRepository::class)]
class Recipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $title = null;

    #[ORM\Column]
    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: "id_user", referencedColumnName: "id")]
    private ?int $id_user = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $add_time = null;

    #[ORM\Column(length: 50)]
    private ?string $image = null;

    #[ORM\Column(type: Types::SMALLINT)]
    #[Assert\GreaterThan(0)]
    private ?\DateTimeInterface $prep_time = null;

    #[ORM\Column(type: Types::SMALLINT)]
    #[Assert\GreaterThan(0)]
    private ?int $no_serving = null;

    #[ORM\Column(type: Types::SMALLINT)]
    #[Assert\GreaterThan(0)]
    private ?int $no_ingredient = null;

    #[ORM\Column]
    #[ORM\ManyToOne(targetEntity: RecipeType::class)]
    #[ORM\JoinColumn(name: "id_recipe_type", referencedColumnName: "id")]
    private ?int $id_recipe_type = null;

    #[ORM\Column]
    #[ORM\ManyToOne(targetEntity: Cuisine::class)]
    #[ORM\JoinColumn(name: "id_cuisine", referencedColumnName: "id")]
    private ?int $id_cuisine = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 2000)]
    private ?string $preparation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getIdUser(): ?int
    {
        return $this->id_user;
    }

    public function setIdUser(int $id_user): static
    {
        $this->id_user = $id_user;

        return $this;
    }

    public function getAddTime(): ?\DateTimeInterface
    {
        return $this->add_time;
    }

    public function setAddTime(\DateTimeInterface $add_time): static
    {
        $this->add_time = $add_time;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getPrepTime(): ?\DateTimeInterface
    {
        return $this->prep_time;
    }

    public function setPrepTime(\DateTimeInterface $prep_time): static
    {
        $this->prep_time = $prep_time;

        return $this;
    }

    public function getNoServing(): ?int
    {
        return $this->no_serving;
    }

    public function setNoServing(int $no_serving): static
    {
        $this->no_serving = $no_serving;

        return $this;
    }

    public function getNoIngredient(): ?int
    {
        return $this->no_ingredient;
    }

    public function setNoIngredient(int $no_ingredient): static
    {
        $this->no_ingredient = $no_ingredient;

        return $this;
    }

    public function getIdRecipeType(): ?int
    {
        return $this->id_recipe_type;
    }

    public function setIdRecipeType(int $id_recipe_type): static
    {
        $this->id_recipe_type = $id_recipe_type;

        return $this;
    }

    public function getIdCuisine(): ?int
    {
        return $this->id_cuisine;
    }

    public function setIdCuisine(int $id_cuisine): static
    {
        $this->id_cuisine = $id_cuisine;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPreparation(): ?string
    {
        return $this->preparation;
    }

    public function setPreparation(string $preparation): static
    {
        $this->preparation = $preparation;

        return $this;
    }
}
