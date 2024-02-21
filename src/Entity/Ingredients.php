<?php

namespace App\Entity;

use App\Repository\IngredientsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IngredientsRepository::class)]
class Ingredients
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Ingredient = null;

    #[ORM\ManyToMany(targetEntity: Boxs::class, mappedBy: 'Ingredients')]
    private Collection $boxs;

    public function __construct()
    {
        $this->boxs = new ArrayCollection();
    }
    public function __toString()
    {
        return $this->getingredient();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIngredient(): ?string
    {
        return $this->Ingredient;
    }

    public function setIngredient(string $Ingredient): static
    {
        $this->Ingredient = $Ingredient;

        return $this;
    }

    /**
     * @return Collection<int, Boxs>
     */
    public function getBoxs(): Collection
    {
        return $this->boxs;
    }

    public function addBox(Boxs $box): static
    {
        if (!$this->boxs->contains($box)) {
            $this->boxs->add($box);
            $box->addIngredient($this);
        }

        return $this;
    }

    public function removeBox(Boxs $box): static
    {
        if ($this->boxs->removeElement($box)) {
            $box->removeIngredient($this);
        }

        return $this;
    }
}