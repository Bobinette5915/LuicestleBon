<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $idUtilisateur = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateCommande = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateLivraison = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $heureLivraison = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\Column(length: 255)]
    private ?string $AdresseLivraison = null;

    #[ORM\Column(length: 255)]
    private ?string $idCommande = null;

    #[ORM\OneToMany(targetEntity: CommandeDetails::class, mappedBy: 'Commande')]
    private Collection $commandeDetails;

    #[ORM\Column]
    private ?bool $isPaid = null;

    #[ORM\Column(length: 255)]
    private ?string $NomUtilisateur = null;

    #[ORM\Column(length: 255)]
    private ?string $PrenomUtilisateur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Telephone = null;

    #[ORM\Column(length: 255)]
    private ?string $Statue = null;

    public function __construct()
    {
        $this->commandeDetails = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUtilisateur(): ?int
    {
        return $this->idUtilisateur;
    }

    public function setIdUtilisateur(int $idUtilisateur): static
    {
        $this->idUtilisateur = $idUtilisateur;

        return $this;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->dateCommande;
    }

    public function setDateCommande(\DateTimeInterface $dateCommande): static
    {
        $this->dateCommande = $dateCommande;

        return $this;
    }

    public function getDateLivraison(): ?\DateTimeInterface
    {
        return $this->dateLivraison;
    }

    public function setDateLivraison(\DateTimeInterface $dateLivraison): static
    {
        $this->dateLivraison = $dateLivraison;

        return $this;
    }

    public function getHeureLivraison(): ?\DateTimeInterface
    {
        return $this->heureLivraison;
    }

    public function setHeureLivraison(\DateTimeInterface $heureLivraison): static
    {
        $this->heureLivraison = $heureLivraison;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getAdresseLivraison(): ?string
    {
        return $this->AdresseLivraison;
    }

    public function setAdresseLivraison(string $AdresseLivraison): static
    {
        $this->AdresseLivraison = $AdresseLivraison;

        return $this;
    }

    public function getIdCommande(): ?string
    {
        return $this->idCommande;
    }

    public function setIdCommande(string $idCommande): static
    {
        $this->idCommande = $idCommande;

        return $this;
    }

    /**
     * @return Collection<int, CommandeDetails>
     */
    public function getCommandeDetails(): Collection
    {
        return $this->commandeDetails;
    }

    public function addCommandeDetail(CommandeDetails $commandeDetail): static
    {
        if (!$this->commandeDetails->contains($commandeDetail)) {
            $this->commandeDetails->add($commandeDetail);
            $commandeDetail->setCommande($this);
        }

        return $this;
    }

    public function removeCommandeDetail(CommandeDetails $commandeDetail): static
    {
        if ($this->commandeDetails->removeElement($commandeDetail)) {
            // set the owning side to null (unless already changed)
            if ($commandeDetail->getCommande() === $this) {
                $commandeDetail->setCommande(null);
            }
        }

        return $this;
    }

    public function isIsPaid(): ?bool
    {
        return $this->isPaid;
    }

    public function setIsPaid(bool $isPaid): static
    {
        $this->isPaid = $isPaid;

        return $this;
    }

    public function getNomUtilisateur(): ?string
    {
        return $this->NomUtilisateur;
    }

    public function setNomUtilisateur(string $NomUtilisateur): static
    {
        $this->NomUtilisateur = $NomUtilisateur;

        return $this;
    }

    public function getPrenomUtilisateur(): ?string
    {
        return $this->PrenomUtilisateur;
    }

    public function setPrenomUtilisateur(string $PrenomUtilisateur): static
    {
        $this->PrenomUtilisateur = $PrenomUtilisateur;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->Telephone;
    }

    public function setTelephone(?string $Telephone): static
    {
        $this->Telephone = $Telephone;

        return $this;
    }

    public function getStatue(): ?string
    {
        return $this->Statue;
    }

    public function setStatue(string $Statue): static
    {
        $this->Statue = $Statue;

        return $this;
    }
}
