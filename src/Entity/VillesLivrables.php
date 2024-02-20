<?php

namespace App\Entity;

use App\Repository\VillesLivrablesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VillesLivrablesRepository::class)]
class VillesLivrables
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Ville = null;

    #[ORM\Column(length: 255)]
    private ?string $CodePostale = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVille(): ?string
    {
        return $this->Ville;
    }

    public function setVille(string $Ville): static
    {
        $this->Ville = $Ville;

        return $this;
    }

    public function getCodePostale(): ?string
    {
        return $this->CodePostale;
    }

    public function setCodePostale(string $CodePostale): static
    {
        $this->CodePostale = $CodePostale;

        return $this;
    }
}
