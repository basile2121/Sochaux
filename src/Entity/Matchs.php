<?php

namespace App\Entity;

use App\Repository\MatchsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\Column(type="date" , nullable=false)
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

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $paysMatch;

    /**
     * @ORM\OneToMany (targetEntity=Joueur::class,mappedBy="poste1")
     */
    private $ligne1E1;

    /**
     * @ORM\OneToMany (targetEntity=Joueur::class,mappedBy="poste2")
     */
    private $ligne2E1;

    /**
     * @ORM\OneToMany (targetEntity=Joueur::class,mappedBy="poste3")
     */
    private $ligne3E1;

    /**
     * @ORM\OneToMany (targetEntity=Joueur::class,mappedBy="poste4")
     */
    private $ligne4E1;

    /**
     * @ORM\oneToMany (targetEntity=Joueur::class,mappedBy="poste5")
     */
    private $gardienE1;

    /**
     * @ORM\oneToMany  (targetEntity=Joueur::class,mappedBy="poste6")
     */
    private $ligne1E2;

    /**
     * @ORM\oneToMany (targetEntity=Joueur::class,mappedBy="poste7")
     */
    private $ligne2E2;

    /**
     * @ORM\oneToMany (targetEntity=Joueur::class,mappedBy="poste8")
     */
    private $ligne3E2;

    /**
     * @ORM\oneToMany (targetEntity=Joueur::class,mappedBy="poste9")
     */
    private $ligne4E2;

    /**
     * @ORM\oneToMany  (targetEntity=Joueur::class,mappedBy="poste10")
     */
    private $gardienE2;


    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
        $this->participes = new ArrayCollection();
        $this->joueDans = new ArrayCollection();
        $this->ligne1E1 = new ArrayCollection();
        $this->ligne2E1 = new ArrayCollection();
        $this->ligne3E1 = new ArrayCollection();
        $this->ligne4E1 = new ArrayCollection();
        $this->gardienE1 = new ArrayCollection();
        $this->ligne1E2 = new ArrayCollection();
        $this->ligne2E2 = new ArrayCollection();
        $this->ligne3E2 = new ArrayCollection();
        $this->ligne4E2 = new ArrayCollection();
        $this->gardienE2 = new ArrayCollection();
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

    public function getParticipeMatch(int $index){
        return $this->participes->get($index);
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

    public function getPaysMatch(): ?string
    {
        return $this->paysMatch;
    }

    public function setPaysMatch(string $paysMatch): self
    {
        $this->paysMatch = $paysMatch;

        return $this;
    }

    /**
     * @return Collection|Joueur[]
     */
    public function getLigne1E1(): Collection
    {
        return $this->ligne1E1;
    }

    public function addLigne1E1(Joueur $ligne1E1): self
    {
        $this->ligne1E1[] = $ligne1E1;

        return $this;
    }

    public function removeLigne1E1(Joueur $ligne1E1): self
    {
        if ($this->ligne1E1->removeElement($ligne1E1)) {
            // set the owning side to null (unless already changed)
            if ($ligne1E1->getJoueur() === $this) {
                $ligne1E1->setJoueur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Joueur[]
     */
    public function getLigne2E1(): Collection
    {
        return $this->ligne2E1;
    }

    public function addLigne2E1(Joueur $ligne2E1): self
    {
        $this->ligne2E1[] = $ligne2E1;
        return $this;
    }

    public function removeLigne2E1(Joueur $ligne2E1): self
    {
        if ($this->ligne2E1->removeElement($ligne2E1)) {
            // set the owning side to null (unless already changed)
            if ($ligne2E1->getJoueur() === $this) {
                $ligne2E1->setJoueur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Joueur[]
     */
    public function getLigne3E1(): Collection
    {
        return $this->ligne3E1;
    }

    public function addLigne3E1(Joueur $ligne3E1): self
    {
        $this->ligne3E1[] = $ligne3E1;
        return $this;
    }

    public function removeLigne3E1(Joueur $ligne3E1): self
    {
        if ($this->ligne3E1->removeElement($ligne3E1)) {
            // set the owning side to null (unless already changed)
            if ($ligne3E1->getJoueur() === $this) {
                $ligne3E1->setJoueur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Joueur[]
     */
    public function getLigne4E1(): Collection
    {
        return $this->ligne4E1;
    }

    public function addLigne4E1(Joueur $ligne4E1): self
    {
        $this->ligne4E1[] = $ligne4E1;

        return $this;
    }

    public function removeLigne4E1(Joueur $ligne4E1): self
    {
        if ($this->ligne4E1->removeElement($ligne4E1)) {
            // set the owning side to null (unless already changed)
            if ($ligne4E1->getJoueur() === $this) {
                $ligne4E1->setJoueur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Joueur[]
     */
    public function getGardienE1()
    {
        return $this->gardienE1;
    }

    public function addGardienE1(Joueur $gardienE1): self
    {

        $this->gardienE1[] = $gardienE1;
        return $this;
    }

    public function removeGardienE1(Joueur $gardienE1): self
    {
        if ($this->gardienE1->removeElement($gardienE1)) {
            // set the owning side to null (unless already changed)
            if ($gardienE1->getJoueur() === $this) {
                $gardienE1->setJoueur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Joueur[]
     */
    public function getLigne1E2(): Collection
    {
        return $this->ligne1E2;
    }

    public function addLigne1E2(Joueur $ligne1E2): self
    {
        $this->ligne1E2[] = $ligne1E2;

        return $this;
    }

    public function removeLigne1E2(Joueur $ligne1E2): self
    {
        if ($this->ligne1E2->removeElement($ligne1E2)) {
            // set the owning side to null (unless already changed)
            if ($ligne1E2->getJoueur() === $this) {
                $ligne1E2->setJoueur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Joueur[]
     */
    public function getLigne2E2(): Collection
    {
        return $this->ligne2E2;
    }

    public function addLigne2E2(Joueur $ligne2E2): self
    {
        $this->ligne2E2[] = $ligne2E2;

        return $this;
    }

    public function removeLigne2E2(Joueur $ligne2E2): self
    {
        if ($this->ligne2E2->removeElement($ligne2E2)) {
            // set the owning side to null (unless already changed)
            if ($ligne2E2->getJoueur() === $this) {
                $ligne2E2->setJoueur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Joueur[]
     */
    public function getLigne3E2(): Collection
    {
        return $this->ligne3E2;
    }

    public function addLigne3E2(Joueur $ligne3E2): self
    {
        $this->ligne3E2[] = $ligne3E2;

        return $this;
    }

    public function removeLigne3E2(Joueur $ligne3E2): self
    {
        if ($this->ligne3E2->removeElement($ligne3E2)) {
            // set the owning side to null (unless already changed)
            if ($ligne3E2->getJoueur() === $this) {
                $ligne3E2->setJoueur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Joueur[]
     */
    public function getLigne4E2(): Collection
    {
        return $this->ligne4E2;
    }

    public function addLigne4E2(Joueur $ligne4E2): self
    {
        $this->ligne4E2[] = $ligne4E2;

        return $this;
    }

    public function removeLigne4E2(Joueur $ligne4E2): self
    {
        if ($this->ligne4E2->removeElement($ligne4E2)) {
            // set the owning side to null (unless already changed)
            if ($ligne4E2->getJoueur() === $this) {
                $ligne4E2->setJoueur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Joueur[]
     */
    public function getGardienE2(): Collection
    {
        return $this->gardienE2;
    }

    public function addGardienE2(Joueur $gardienE2): self
    {
        $this->gardienE2[] = $gardienE2;

        return $this;
    }

    public function removeGardienE2(Joueur $gardienE2): self
    {
        if ($this->gardienE2->removeElement($gardienE2)) {
            // set the owning side to null (unless already changed)
            if ($gardienE2->getJoueur() === $this) {
                $gardienE2->setJoueur(null);
            }
        }

        return $this;
    }
}
