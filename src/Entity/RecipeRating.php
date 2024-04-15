<?php

namespace App\Entity;

use App\Repository\RecipeRatingRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: RecipeRatingRepository::class)]
class RecipeRating
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[ORM\ManyToOne(targetEntity: Recipe::class)]
    #[ORM\JoinColumn(name: "id_recipe", referencedColumnName: "id")]

    private ?int $id_recipe = null;

    #[ORM\Column(type: Types::SMALLINT)]
    #[Assert\Range(
        min: 1,
        max: 5
    )]
    private ?int $rating = null;

    #[ORM\Column]
    #[Assert\GreaterThan(0)]
    private ?int $no_rating = null;

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

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): static
    {
        $this->rating = $rating;

        return $this;
    }

    public function getNoRating(): ?int
    {
        return $this->no_rating;
    }

    public function setNoRating(int $no_rating): static
    {
        $this->no_rating = $no_rating;

        return $this;
    }
}
