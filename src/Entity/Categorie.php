<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategorieRepository")
 */
class Categorie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomCat;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Legume", mappedBy="categorie")
     */
    private $legumes;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=5000, nullable=true)
     */
    private $description;


    public function __construct()
    {
        $this->legumes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCat(): ?string
    {
        return $this->nomCat;
    }

    public function setNomCat(string $nomCat): self
    {
        $this->nomCat = $nomCat;

        return $this;
    }

    /**
     * @return Collection|Legume[]
     */
    public function getLegumes(): Collection
    {
        return $this->legumes;
    }

    public function addLegume(Legume $legume): self
    {
        if (!$this->legumes->contains($legume)) {
            $this->legumes[] = $legume;
            $legume->setCategorie($this);
        }

        return $this;
    }

    public function removeLegume(Legume $legume): self
    {
        if ($this->legumes->contains($legume)) {
            $this->legumes->removeElement($legume);
            // set the owning side to null (unless already changed)
            if ($legume->getCategorie() === $this) {
                $legume->setCategorie(null);
            }
        }

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

  
}
