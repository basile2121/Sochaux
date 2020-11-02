<?php

namespace App\Entity;

use App\Repository\JoueurPosteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JoueurPosteRepository::class)
 */
class JoueurPoste
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Poste::class, inversedBy="joueurPostes")
     */
    private $poste;

    /**
     * @ORM\ManyToMany(targetEntity=Joueur::class, inversedBy="joueurPostes")
     */
    private $joueur;

    public function __construct()
    {
        $this->poste = new ArrayCollection();
        $this->joueur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Poste[]
     */
    public function getPoste(): Collection
    {
        return $this->poste;
    }

    public function addPoste(Poste $poste): self
    {
        if (!$this->poste->contains($poste)) {
            $this->poste[] = $poste;
        }

        return $this;
    }

    public function removePoste(Poste $poste): self
    {
        if ($this->poste->contains($poste)) {
            $this->poste->removeElement($poste);
        }

        return $this;
    }

    /**
     * @return Collection|Joueur[]
     */
    public function getJoueur(): Collection
    {
        return $this->joueur;
    }

    public function addJoueur(Joueur $joueur): self
    {
        if (!$this->joueur->contains($joueur)) {
            $this->joueur[] = $joueur;
        }

        return $this;
    }

    public function removeJoueur(Joueur $joueur): self
    {
        if ($this->joueur->contains($joueur)) {
            $this->joueur->removeElement($joueur);
        }

        return $this;
    }

}
