<?php

namespace App\Entity;

use App\Repository\FractionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FractionRepository::class)]
class Fraction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 4, unique: true)]
    private ?string $fraction = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getFraction(): ?string
    {
        return $this->fraction;
    }

    public function setFraction(string $fraction): static
    {
        $this->fraction = $fraction;

        return $this;
    }
}
