<?php

namespace App\Entity;

use App\Repository\BatimentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BatimentRepository::class)
 */
class Batiment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $numbatiment;

    /**
     * @ORM\OneToMany(targetEntity=Chambre::class, mappedBy="batiment")
     */
    private $relation;

    public function __construct()
    {
        $this->relation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumbatiment(): ?string
    {
        return $this->numbatiment;
    }

    public function setNumbatiment(string $numbatiment): self
    {
        $this->numbatiment = $numbatiment;

        return $this;
    }

    /**
     * @return Collection|Chambre[]
     */
    public function getRelation(): Collection
    {
        return $this->relation;
    }

    public function addRelation(Chambre $relation): self
    {
        if (!$this->relation->contains($relation)) {
            $this->relation[] = $relation;
            $relation->setBatiment($this);
        }

        return $this;
    }

    public function removeRelation(Chambre $relation): self
    {
        if ($this->relation->contains($relation)) {
            $this->relation->removeElement($relation);
            // set the owning side to null (unless already changed)
            if ($relation->getBatiment() === $this) {
                $relation->setBatiment(null);
            }
        }

        return $this;
    }
}
