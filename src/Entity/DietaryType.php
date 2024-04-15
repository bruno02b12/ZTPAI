<?php

namespace App\Entity;

use App\Repository\DietaryTypeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DietaryTypeRepository::class)]
class DietaryType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25, unique: true)]
    private ?string $dietary_type = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getDietaryType(): ?string
    {
        return $this->dietary_type;
    }

    public function setDietaryType(string $dietary_type): static
    {
        $this->dietary_type = $dietary_type;

        return $this;
    }
}
