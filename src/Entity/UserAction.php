<?php

namespace App\Entity;

use App\Repository\UserActionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserActionRepository::class)]
class UserAction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25, unique: true)]
    private ?string $user_action = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getUserAction(): ?string
    {
        return $this->user_action;
    }

    public function setUserAction(string $user_action): static
    {
        $this->user_action = $user_action;

        return $this;
    }
}
