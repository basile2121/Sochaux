<?php

namespace App\Entity;

use App\Repository\ClubRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClubRepository::class)
 */
class Club
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
    private $nom_club;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pays_club;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville_club;

    /**
     * @ORM\OneToMany(targetEntity=Contrat::class, mappedBy="club")
     */
    private $contrats;

    /**
     * @ORM\ManyToMany(targetEntity=Participe::class, mappedBy="club")
     */
    private $participes;

    public function __construct()
    {
        $this->contrats = new ArrayCollection();
        $this->participes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomClub(): ?string
    {
        return $this->nom_club;
    }

    public function setNomClub(string $nom_club): self
    {
        $this->nom_club = $nom_club;

        return $this;
    }

    public function getPaysClub(): ?string
    {
        return $this->pays_club;
    }

    public function setPaysClub(string $pays_club): self
    {
        $this->pays_club = $pays_club;

        return $this;
    }

    public function getVilleClub(): ?string
    {
        return $this->ville_club;
    }

    public function setVilleClub(string $ville_club): self
    {
        $this->ville_club = $ville_club;

        return $this;
    }


    /**
     * @return Collection|Contrat[]
     */
    public function getContrats(): Collection
    {
        return $this->contrats;
    }

    public function addContrat(Contrat $contrat): self
    {
        if (!$this->contrats->contains($contrat)) {
            $this->contrats[] = $contrat;
            $contrat->setClub($this);
        }

        return $this;
    }

    public function removeContrat(Contrat $contrat): self
    {
        if ($this->contrats->contains($contrat)) {
            $this->contrats->removeElement($contrat);
            // set the owning side to null (unless already changed)
            if ($contrat->getClub() === $this) {
                $contrat->setClub(null);
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
            $participe->addClub($this);
        }

        return $this;
    }

    public function removeParticipe(Participe $participe): self
    {
        if ($this->participes->contains($participe)) {
            $this->participes->removeElement($participe);
            $participe->removeClub($this);
        }

        return $this;
    }
    public function __toString()
    {
        return $this->getNomClub();
    }
}