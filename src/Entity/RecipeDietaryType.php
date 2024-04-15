<?php

namespace App\Entity;

use App\Repository\RecipeDietaryTypeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecipeDietaryTypeRepository::class)]
class RecipeDietaryType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[ORM\ManyToOne(targetEntity: Recipe::class)]
    #[ORM\JoinColumn(name: "id_recipe", referencedColumnName: "id")]
    private ?int $id_recipe = null;

    #[ORM\Column]
    #[ORM\ManyToOne(targetEntity: DietaryType::class)]
    #[ORM\JoinColumn(name: "id_dietary_type", referencedColumnName: "id")]
    private ?int $id_dietary_type = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdRecipe(): ?int
    {
        return $this->id_recipe;
    }

    public function setIdRecipe(int $id_recipe): static
    {
        $this->id_recipe = $id_recipe;

        return $this;
    }

    public function getIdDietaryType(): ?int
    {
        return $this->id_dietary_type;
    }

    public function setIdDietaryType(int $id_dietary_type): static
    {
        $this->id_dietary_type = $id_dietary_type;

        return $this;
    }
}
