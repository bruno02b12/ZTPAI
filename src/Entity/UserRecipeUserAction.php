<?php

namespace App\Entity;

use App\Repository\UserRecipeUserActionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRecipeUserActionRepository::class)]
class UserRecipeUserAction
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

    #[ORM\Column]
    #[ORM\ManyToOne(targetEntity: UserAction::class)]
    #[ORM\JoinColumn(name: "id_user_action", referencedColumnName: "id")]
    private ?int $id_user_action = null;

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

    public function getIdUserAction(): ?int
    {
        return $this->id_user_action;
    }

    public function setIdUserAction(int $id_user_action): static
    {
        $this->id_user_action = $id_user_action;

        return $this;
    }
}
