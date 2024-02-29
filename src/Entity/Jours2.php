<?php

namespace App\Entity;

use App\Repository\Jours2Repository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: Jours2Repository::class)]
class Jours2
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Jours = null;

    #[ORM\Column]
    private ?bool $Disponible = null;

    public function __toString()
    {
        $jour = $this->getJours();
        $nomJour = '';
    
        switch ($jour->format('l')) {
            case 'Monday':
                $nomJour = 'Lundi';
                break;
            case 'Tuesday':
                $nomJour = 'Mardi';
                break;
            case 'Wednesday':
                $nomJour = 'Mercredi';
                break;
            case 'Thursday':
                $nomJour = 'Jeudi';
                break;
            case 'Friday':
                $nomJour = 'Vendredi';
                break;
            case 'Saturday':
                $nomJour = 'Samedi';
                break;
            case 'Sunday':
                $nomJour = 'Dimanche';
                break;
        }
    
        $dateChiffre = $jour->format('d');
        $MoisChiffre = $jour->format('m');
    
        return $nomJour . ' ' . $dateChiffre.'/'.$MoisChiffre;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJours(): ?\DateTimeInterface
    {
        return $this->Jours;
    }

    public function setJours(\DateTimeInterface $Jours): static
    {
        $this->Jours = $Jours;

        return $this;
    }

    public function isDisponible(): ?bool
    {
        return $this->Disponible;
    }

    public function setDisponible(bool $Disponible): static
    {
        $this->Disponible = $Disponible;

        return $this;
    }
}
