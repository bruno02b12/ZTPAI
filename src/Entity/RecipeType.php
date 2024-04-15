<?php

namespace App\Entity;

use App\Repository\RecipeTypeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecipeTypeRepository::class)]
class RecipeType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25, unique: true)]
    private ?string $recipe_type = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getRecipeType(): ?string
    {
        return $this->recipe_type;
    }

    public function setRecipeType(string $recipe_type): static
    {
        $this->recipe_type = $recipe_type;

        return $this;
    }
}
