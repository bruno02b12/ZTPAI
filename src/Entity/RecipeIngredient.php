<?php

namespace App\Entity;

use App\Repository\RecipeIngredientRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: RecipeIngredientRepository::class)]
class RecipeIngredient
{
    #[ORM\Id]
    #[ORM\Column]
    #[ORM\ManyToOne(targetEntity: Recipe::class)]
    #[ORM\JoinColumn(name: "id_recipe", referencedColumnName: "id")]
    private ?int $id_recipe = null;

    #[ORM\Column(type: Types::SMALLINT)]
    #[Assert\GreaterThan(0)]
    private ?int $quantity = null;

    #[ORM\Column]
    #[ORM\ManyToOne(targetEntity: Fraction::class)]
    #[ORM\JoinColumn(name: "id_fraction", referencedColumnName: "id")]
    private ?int $id_fraction = null;

    #[ORM\Column]
    #[ORM\ManyToOne(targetEntity: Unit::class)]
    #[ORM\JoinColumn(name: "id_unit", referencedColumnName: "id")]
    private ?int $id_unit = null;

    #[ORM\Column]
    #[ORM\ManyToOne(targetEntity: Ingredient::class)]
    #[ORM\JoinColumn(name: "id_ingredient", referencedColumnName: "id")]
    private ?int $id_ingredient = null;

    #[ORM\Column(length: 25, nullable: true)]
    private ?string $note = null;

    public function getIdRecipe(): ?int
    {
        return $this->id_recipe;
    }

    public function setIdRecipe(int $id_recipe): static
    {
        $this->id_recipe = $id_recipe;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getIdFraction(): ?int
    {
        return $this->id_fraction;
    }

    public function setIdFraction(int $id_fraction): static
    {
        $this->id_fraction = $id_fraction;

        return $this;
    }

    public function getIdUnit(): ?int
    {
        return $this->id_unit;
    }

    public function setIdUnit(int $id_unit): static
    {
        $this->id_unit = $id_unit;

        return $this;
    }

    public function getIdIngredient(): ?int
    {
        return $this->id_ingredient;
    }

    public function setIdIngredient(int $id_ingredient): static
    {
        $this->id_ingredient = $id_ingredient;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(string $note): static
    {
        $this->note = $note;

        return $this;
    }
}
