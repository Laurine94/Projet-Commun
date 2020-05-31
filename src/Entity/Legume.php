<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LegumeRepository")
 */
class Legume
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
    private $nomLeg;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categorie", inversedBy="legumes")
     */
    private $categorie;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Association", mappedBy="legume1")
     */
    private $asso1;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Association", mappedBy="legume2")
     */
    private $asso2;

    /**
     * @ORM\Column(type="string", length=5000, nullable=true)
     */
    private $description;

 
   
   

    public function __construct()
    {
        $this->asso1 = new ArrayCollection();
        $this->asso2 = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomLeg(): ?string
    {
        return $this->nomLeg;
    }

    public function setNomLeg(string $nomLeg): self
    {
        $this->nomLeg = $nomLeg;

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

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection|Association[]
     */
    public function getAsso1(): Collection
    {
        return $this->asso1;
    }

    public function addAsso1(Association $asso1): self
    {
        if (!$this->asso1->contains($asso1)) {
            $this->asso1[] = $asso1;
            $asso1->setLegume1($this);
        }

        return $this;
    }

    public function removeAsso1(Association $asso1): self
    {
        if ($this->asso1->contains($asso1)) {
            $this->asso1->removeElement($asso1);
            // set the owning side to null (unless already changed)
            if ($asso1->getLegume1() === $this) {
                $asso1->setLegume1(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Association[]
     */
    public function getAsso2(): Collection
    {
        return $this->asso2;
    }

    public function addAsso2(Association $asso2): self
    {
        if (!$this->asso2->contains($asso2)) {
            $this->asso2[] = $asso2;
            $asso2->setLegume2($this);
        }

        return $this;
    }

    public function removeAsso2(Association $asso2): self
    {
        if ($this->asso2->contains($asso2)) {
            $this->asso2->removeElement($asso2);
            // set the owning side to null (unless already changed)
            if ($asso2->getLegume2() === $this) {
                $asso2->setLegume2(null);
            }
        }

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
