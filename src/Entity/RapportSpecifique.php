<?php

namespace App\Entity;

use App\Repository\RapportSpecifiqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RapportSpecifiqueRepository::class)
 */
class RapportSpecifique
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
    private $qualite_technique;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $qualite_mentale;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $qualite_physique;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $qualite_tactique;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_agent;

    /**
     * @ORM\ManyToOne(targetEntity=Joueur::class, inversedBy="rapportSpecifiques")
     */
    private $joueur;

    /**
     * @ORM\ManyToMany(targetEntity=Commente::class, mappedBy="rapport_specifique")
     */
    private $commentes;

    public function __construct()
    {
        $this->commentes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQualiteTechnique(): ?string
    {
        return $this->qualite_technique;
    }

    public function setQualiteTechnique(string $qualite_technique): self
    {
        $this->qualite_technique = $qualite_technique;

        return $this;
    }

    public function getQualiteMentale(): ?string
    {
        return $this->qualite_mentale;
    }

    public function setQualiteMentale(string $qualite_mentale): self
    {
        $this->qualite_mentale = $qualite_mentale;

        return $this;
    }

    public function getQualitePhysique(): ?string
    {
        return $this->qualite_physique;
    }

    public function setQualitePhysique(string $qualite_physique): self
    {
        $this->qualite_physique = $qualite_physique;

        return $this;
    }

    public function getQualiteTactique(): ?string
    {
        return $this->qualite_tactique;
    }

    public function setQualiteTactique(string $qualite_tactique): self
    {
        $this->qualite_tactique = $qualite_tactique;

        return $this;
    }

    public function getNomAgent(): ?string
    {
        return $this->nom_agent;
    }

    public function setNomAgent(string $nom_agent): self
    {
        $this->nom_agent = $nom_agent;

        return $this;
    }

    public function getJoueur(): ?Joueur
    {
        return $this->joueur;
    }

    public function setJoueur(?Joueur $joueur): self
    {
        $this->joueur = $joueur;

        return $this;
    }
    public function __toString()
    {
        return $this->getNomAgent();
    }

    /**
     * @return Collection|Commente[]
     */
    public function getCommentes(): Collection
    {
        return $this->commentes;
    }

    public function addCommente(Commente $commente): self
    {
        if (!$this->commentes->contains($commente)) {
            $this->commentes[] = $commente;
            $commente->addRapportSpecifique($this);
        }

        return $this;
    }

    public function removeCommente(Commente $commente): self
    {
        if ($this->commentes->contains($commente)) {
            $this->commentes->removeElement($commente);
            $commente->removeRapportSpecifique($this);
        }

        return $this;
    }
}
