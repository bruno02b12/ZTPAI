<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    private ?string $name = null;

    #[ORM\Column(length: 50)]
    private ?string $surname = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column]
    #[ORM\ManyToOne(targetEntity: UserType::class)]
    #[ORM\JoinColumn(name: "id_user_type", referencedColumnName: "id")]
    private ?int $id_user_type = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $is_active = 1;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): static
    {
        $this->surname = $surname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getIdUserType(): ?int
    {
        return $this->id_user_type;
    }

    public function setIdUserType(int $id_user_type): static
    {
        $this->id_user_type = $id_user_type;

        return $this;
    }

    public function isActive(): ?int
    {
        return $this->is_active;
    }

    public function setActive(int $is_active): static
    {
        $this->is_active = $is_active;

        return $this;
    }
}
