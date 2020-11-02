<?php

namespace App\Entity;

use App\Repository\TactiqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TactiqueRepository::class)
 */
class Tactique
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
    private $nom_tactique;

    /**
     * @ORM\OneToMany(targetEntity=Poste::class, mappedBy="tactique")
     */
    private $postes;

    /**
     * @ORM\ManyToMany(targetEntity=Participe::class, mappedBy="tactique")
     */
    private $participes;

    public function __construct()
    {
        $this->postes = new ArrayCollection();
        $this->participes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomTactique(): ?string
    {
        return $this->nom_tactique;
    }

    public function setNomTactique(string $nom_tactique): self
    {
        $this->nom_tactique = $nom_tactique;

        return $this;
    }

    /**
     * @return Collection|Poste[]
     */
    public function getPostes(): Collection
    {
        return $this->postes;
    }

    public function addPoste(Poste $poste): self
    {
        if (!$this->postes->contains($poste)) {
            $this->postes[] = $poste;
            $poste->setTactique($this);
        }

        return $this;
    }

    public function removePoste(Poste $poste): self
    {
        if ($this->postes->contains($poste)) {
            $this->postes->removeElement($poste);
            // set the owning side to null (unless already changed)
            if ($poste->getTactique() === $this) {
                $poste->setTactique(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Participe[]
     */
    public function getParticipes(): Collection
    {
        return $this->participes;
    }

    public function addParticipe(Participe $participe): self
    {
        if (!$this->participes->contains($participe)) {
            $this->participes[] = $participe;
            $participe->addTactique($this);
        }

        return $this;
    }

    public function removeParticipe(Participe $participe): self
    {
        if ($this->participes->contains($participe)) {
            $this->participes->removeElement($participe);
            $participe->removeTactique($this);
        }

        return $this;
    }
    public function __toString()
    {
        return $this->getNomTactique();
    }
}
