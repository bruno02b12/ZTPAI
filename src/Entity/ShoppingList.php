<?php

namespace App\Entity;

use App\Repository\ShoppingListRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShoppingListRepository::class)]
class ShoppingList
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: "id_user", referencedColumnName: "id")]
    private ?int $id_user = null;

    #[ORM\Column(length: 50)]
    private ?string $title = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $add_time = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $edit_time = null;

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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

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

    public function getEditTime(): ?\DateTimeInterface
    {
        return $this->edit_time;
    }

    public function setEditTime(\DateTimeInterface $edit_time): static
    {
        $this->edit_time = $edit_time;

        return $this;
    }
}
