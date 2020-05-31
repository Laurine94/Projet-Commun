<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AssociationRepository")
 */
class Association
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Legume", inversedBy="asso1")
     */
    private $legume1;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Legume", inversedBy="asso2")
     */
    private $legume2;

    /**
     * @ORM\Column(type="boolean")
     */
    private $estBon;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLegume1(): ?Legume
    {
        return $this->legume1;
    }

    public function setLegume1(?Legume $legume1): self
    {
        $this->legume1 = $legume1;

        return $this;
    }

    public function getLegume2(): ?Legume
    {
        return $this->legume2;
    }

    public function setLegume2(?Legume $legume2): self
    {
        $this->legume2 = $legume2;

        return $this;
    }

    public function getEstBon(): ?bool
    {
        return $this->estBon;
    }

    public function setEstBon(bool $estBon): self
    {
        $this->estBon = $estBon;

        return $this;
    }
}
