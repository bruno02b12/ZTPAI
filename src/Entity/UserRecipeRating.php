<?php

namespace App\Entity;

use App\Repository\UserRecipeRatingRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: UserRecipeRatingRepository::class)]
#[ORM\UniqueConstraint(
    name: 'id_user_id_recipe',
    columns: ['id_user', 'id_recipe']
)]
class UserRecipeRating
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: "id_user", referencedColumnName: "id")]
    private ?int $id_user = null;

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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

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
}
