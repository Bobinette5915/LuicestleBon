<?php

namespace App\Entity;

use App\Repository\CreneauxRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CreneauxRepository::class)]
class Creneaux
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'creneauxes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $IdUtilisateur = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $Date = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $DateLivraison = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $CreneauxLivrables = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUtilisateur(): ?User
    {
        return $this->IdUtilisateur;
    }

    public function setIdUtilisateur(?User $IdUtilisateur): static
    {
        $this->IdUtilisateur = $IdUtilisateur;

        return $this;
    }

    public function getDate(): ?\DateTimeImmutable
    {
        return $this->Date;
    }

    public function setDate(\DateTimeImmutable $Date): static
    {
        $this->Date = $Date;

        return $this;
    }

    public function getDateLivraison(): ?\DateTimeImmutable
    {
        return $this->DateLivraison;
    }

    public function setDateLivraison(\DateTimeImmutable $DateLivraison): static
    {
        $this->DateLivraison = $DateLivraison;

        return $this;
    }

    public function getCreneauxLivrables(): ?\DateTimeInterface
    {
        return $this->CreneauxLivrables;
    }

    public function setCreneauxLivrables(\DateTimeInterface $CreneauxLivrables): static
    {
        $this->CreneauxLivrables = $CreneauxLivrables;

        return $this;
    }
}
