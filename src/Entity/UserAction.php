<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\UserActionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UserActionRepository::class)]
#[ORM\Table(name: 'user_action')]
class UserAction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['user:read', 'user:write'])]
    private ?int $id = null;

    #[ORM\Column(length: 25, unique: true)]
    #[Groups(['user:read', 'user:write'])]
    private ?string $userAction = null;

    public function __construct(?string $userAction)
    {
        $this->userAction = $userAction;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserAction(): ?string
    {
        return $this->userAction;
    }

    public function setUserAction(string $userAction): static
    {
        $this->userAction = $userAction;
        return $this;
    }
}