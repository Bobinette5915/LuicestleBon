<?php

namespace App\Entity;

use App\Repository\HeuresRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HeuresRepository::class)]
class Heures
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $HeuresLivrables = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    

    public function getHeuresLivrables(): ?\DateTimeInterface
    {
        return $this->HeuresLivrables;
    }

    public function setHeuresLivrables(\DateTimeInterface $HeuresLivrables): static
    {
        $this->HeuresLivrables = $HeuresLivrables;

        return $this;
    }
    
    public function __toString()
    {
        return $this->HeuresLivrables->format('H:i');
    }
}
