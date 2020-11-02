<?php

namespace App\Entity;

use App\Repository\ChampionnatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChampionnatRepository::class)
 */
class Championnat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_championnat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pays_championnat;

    /**
     * @ORM\OneToMany(targetEntity=Club::class, mappedBy="championnat")
     */
    private $clubs;

    public function __construct()
    {
        $this->clubs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomChampionnat(): ?string
    {
        return $this->nom_championnat;
    }

    public function setNomChampionnat(string $nom_championnat): self
    {
        $this->nom_championnat = $nom_championnat;

        return $this;
    }

    public function getPaysChampionnat(): ?string
    {
        return $this->pays_championnat;
    }

    public function setPaysChampionnat(string $pays_championnat): self
    {
        $this->pays_championnat = $pays_championnat;

        return $this;
    }

    /**
     * @return Collection|Club[]
     */
    public function getClubs(): Collection
    {
        return $this->clubs;
    }

    public function addClub(Club $club): self
    {
        if (!$this->clubs->contains($club)) {
            $this->clubs[] = $club;
            $club->setChampionnat($this);
        }

        return $this;
    }

    public function removeClub(Club $club): self
    {
        if ($this->clubs->contains($club)) {
            $this->clubs->removeElement($club);
            // set the owning side to null (unless already changed)
            if ($club->getChampionnat() === $this) {
                $club->setChampionnat(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->getNomChampionnat();
    }
}
