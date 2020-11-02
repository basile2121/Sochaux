<?php

namespace App\Entity;

use App\Repository\PosteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PosteRepository::class)
 */
class Poste
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
    private $nom_poste;

    /**
     * @ORM\ManyToOne(targetEntity=Tactique::class, inversedBy="postes")
     */
    private $tactique;

    /**
     * @ORM\ManyToMany(targetEntity=JoueurPoste::class, mappedBy="poste")
     */
    private $joueurPostes;

    /**
     * @ORM\ManyToMany(targetEntity=JoueDans::class, mappedBy="poste")
     */
    private $joueDans;

    public function __construct()
    {
        $this->joueurPostes = new ArrayCollection();
        $this->joueDans = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPoste(): ?string
    {
        return $this->nom_poste;
    }

    public function setNomPoste(string $nom_poste): self
    {
        $this->nom_poste = $nom_poste;

        return $this;
    }

    public function getTactique(): ?Tactique
    {
        return $this->tactique;
    }

    public function setTactique(?Tactique $tactique): self
    {
        $this->tactique = $tactique;

        return $this;
    }

    /**
     * @return Collection|JoueurPoste[]
     */
    public function getJoueurPostes(): Collection
    {
        return $this->joueurPostes;
    }

    public function addJoueurPoste(JoueurPoste $joueurPoste): self
    {
        if (!$this->joueurPostes->contains($joueurPoste)) {
            $this->joueurPostes[] = $joueurPoste;
            $joueurPoste->addPoste($this);
        }

        return $this;
    }

    public function removeJoueurPoste(JoueurPoste $joueurPoste): self
    {
        if ($this->joueurPostes->contains($joueurPoste)) {
            $this->joueurPostes->removeElement($joueurPoste);
            $joueurPoste->removePoste($this);
        }

        return $this;
    }

    /**
     * @return Collection|JoueDans[]
     */
    public function getJoueDans(): Collection
    {
        return $this->joueDans;
    }

    public function addJoueDan(JoueDans $joueDan): self
    {
        if (!$this->joueDans->contains($joueDan)) {
            $this->joueDans[] = $joueDan;
            $joueDan->addPoste($this);
        }

        return $this;
    }

    public function removeJoueDan(JoueDans $joueDan): self
    {
        if ($this->joueDans->contains($joueDan)) {
            $this->joueDans->removeElement($joueDan);
            $joueDan->removePoste($this);
        }

        return $this;
    }
    public function __toString()
    {
        return $this->getNomPoste();
    }
}
