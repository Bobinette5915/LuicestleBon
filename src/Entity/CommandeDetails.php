<?php

namespace App\Entity;

use App\Repository\CommandeDetailsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeDetailsRepository::class)]
class CommandeDetails
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'commandeDetails')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Commande $Commande = null;

    #[ORM\Column(length: 255)]
    private ?string $idFormuleUnique = null;

    #[ORM\Column]
    private ?int $idFormule = null;

    #[ORM\Column(length: 255)]
    private ?string $NomFormule = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $IngredientSupp1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $IngredientSupp2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $IngredientSupp3 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $IngredientSupp4 = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommande(): ?Commande
    {
        return $this->Commande;
    }

    public function setCommande(?Commande $Commande): static
    {
        $this->Commande = $Commande;

        return $this;
    }

    public function getIdFormuleUnique(): ?string
    {
        return $this->idFormuleUnique;
    }

    public function setIdFormuleUnique(string $idFormuleUnique): static
    {
        $this->idFormuleUnique = $idFormuleUnique;

        return $this;
    }

    public function getIdFormule(): ?int
    {
        return $this->idFormule;
    }

    public function setIdFormule(int $idFormule): static
    {
        $this->idFormule = $idFormule;

        return $this;
    }

    public function getNomFormule(): ?string
    {
        return $this->NomFormule;
    }

    public function setNomFormule(string $NomFormule): static
    {
        $this->NomFormule = $NomFormule;

        return $this;
    }

    public function getIngredientSupp1(): ?string
    {
        return $this->IngredientSupp1;
    }

    public function setIngredientSupp1(string $IngredientSupp1): static
    {
        $this->IngredientSupp1 = $IngredientSupp1;

        return $this;
    }

    public function getIngredientSupp2(): ?string
    {
        return $this->IngredientSupp2;
    }

    public function setIngredientSupp2(string $IngredientSupp2): static
    {
        $this->IngredientSupp2 = $IngredientSupp2;

        return $this;
    }

    public function getIngredientSupp3(): ?string
    {
        return $this->IngredientSupp3;
    }

    public function setIngredientSupp3(string $IngredientSupp3): static
    {
        $this->IngredientSupp3 = $IngredientSupp3;

        return $this;
    }

    public function getIngredientSupp4(): ?string
    {
        return $this->IngredientSupp4;
    }

    public function setIngredientSupp4(string $IngredientSupp4): static
    {
        $this->IngredientSupp4 = $IngredientSupp4;

        return $this;
    }
}
