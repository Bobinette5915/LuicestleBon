<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Boxs;

#[ORM\Entity(repositoryClass: CategoriesRepository::class)]
class Categories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Categories = null;

    #[ORM\OneToMany(targetEntity: Boxs::class, mappedBy: 'Categorie')]
    private Collection $boxs;

    public function __construct()
    {
        $this->boxs = new ArrayCollection();
    }

    public function __toString()
    { 
        return $this->getcategories();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategories(): ?string
    {
        return $this->Categories;
    }

    public function setCategories(string $Categories): static
    {
        $this->Categories = $Categories;

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
            $box->setCategorie($this);
        }

        return $this;
    }

    public function removeBox(Boxs $box): static
    {
        if ($this->boxs->removeElement($box)) {
            // set the owning side to null (unless already changed)
            if ($box->getCategorie() === $this) {
                $box->setCategorie(null);
            }
        }

        return $this;
    }
}
