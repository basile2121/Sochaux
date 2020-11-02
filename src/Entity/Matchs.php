<?php

namespace App\Entity;

use App\Repository\MatchsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MatchsRepository::class)
 */
class Matchs
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
    private $lieux;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $conditions;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=Tournoi::class, inversedBy="matchs")
     */
    private $tournoi;

    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="matchs")
     */
    private $commentaires;

    /**
     * @ORM\ManyToMany(targetEntity=Participe::class, mappedBy="matchs")
     */
    private $participes;

    /**
     * @ORM\ManyToMany(targetEntity=JoueDans::class, mappedBy="matchs")
     */
    private $joueDans;

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
        $this->participes = new ArrayCollection();
        $this->joueDans = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLieux(): ?string
    {
        return $this->lieux;
    }

    public function setLieux(string $lieux): self
    {
        $this->lieux = $lieux;

        return $this;
    }

    public function getConditions(): ?string
    {
        return $this->conditions;
    }

    public function setConditions(string $conditions): self
    {
        $this->conditions = $conditions;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getTournoi(): ?Tournoi
    {
        return $this->tournoi;
    }

    public function setTournoi(?Tournoi $tournoi): self
    {
        $this->tournoi = $tournoi;

        return $this;
    }

    /**
     * @return Collection|Commentaire[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setMatchs($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->contains($commentaire)) {
            $this->commentaires->removeElement($commentaire);
            // set the owning side to null (unless already changed)
            if ($commentaire->getMatchs() === $this) {
                $commentaire->setMatchs(null);
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
            $participe->addMatch($this);
        }

        return $this;
    }

    public function removeParticipe(Participe $participe): self
    {
        if ($this->participes->contains($participe)) {
            $this->participes->removeElement($participe);
            $participe->removeMatch($this);
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
            $joueDan->addMatch($this);
        }

        return $this;
    }

    public function removeJoueDan(JoueDans $joueDan): self
    {
        if ($this->joueDans->contains($joueDan)) {
            $this->joueDans->removeElement($joueDan);
            $joueDan->removeMatch($this);
        }

        return $this;
    }
    public function __toString()
    {
        return $this->getLieux();
    }
}
