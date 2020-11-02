<?php

namespace App\Entity;

use App\Repository\JoueDansRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JoueDansRepository::class)
 */
class JoueDans
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_but;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_passe_decissive;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_carton_jaune;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_carton_rouge;

    /**
     * @ORM\Column(type="integer")
     */
    private $temps_joue;

    /**
     * @ORM\Column(type="integer")
     */
    private $note_attribue;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $video;

    /**
     * @ORM\ManyToMany(targetEntity=Joueur::class, inversedBy="joueDans")
     */
    private $joueur;

    /**
     * @ORM\ManyToMany(targetEntity=Matchs::class, inversedBy="joueDans")
     */
    private $matchs;

    /**
     * @ORM\ManyToMany(targetEntity=Poste::class, inversedBy="joueDans")
     */
    private $poste;

    public function __construct()
    {
        $this->joueur = new ArrayCollection();
        $this->matchs = new ArrayCollection();
        $this->poste = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbBut(): ?int
    {
        return $this->nb_but;
    }

    public function setNbBut(int $nb_but): self
    {
        $this->nb_but = $nb_but;

        return $this;
    }

    public function getNbPasseDecissive(): ?int
    {
        return $this->nb_passe_decissive;
    }

    public function setNbPasseDecissive(int $nb_passe_decissive): self
    {
        $this->nb_passe_decissive = $nb_passe_decissive;

        return $this;
    }

    public function getNbCartonJaune(): ?int
    {
        return $this->nb_carton_jaune;
    }

    public function setNbCartonJaune(int $nb_carton_jaune): self
    {
        $this->nb_carton_jaune = $nb_carton_jaune;

        return $this;
    }

    public function getNbCartonRouge(): ?int
    {
        return $this->nb_carton_rouge;
    }

    public function setNbCartonRouge(int $nb_carton_rouge): self
    {
        $this->nb_carton_rouge = $nb_carton_rouge;

        return $this;
    }

    public function getTempsJoue(): ?int
    {
        return $this->temps_joue;
    }

    public function setTempsJoue(int $temps_joue): self
    {
        $this->temps_joue = $temps_joue;

        return $this;
    }

    public function getNoteAttribue(): ?int
    {
        return $this->note_attribue;
    }

    public function setNoteAttribue(int $note_attribue): self
    {
        $this->note_attribue = $note_attribue;

        return $this;
    }

    public function getVideo(): ?string
    {
        return $this->video;
    }

    public function setVideo(string $video): self
    {
        $this->video = $video;

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

    /**
     * @return Collection|Matchs[]
     */
    public function getMatchs(): Collection
    {
        return $this->matchs;
    }

    public function addMatch(Matchs $match): self
    {
        if (!$this->matchs->contains($match)) {
            $this->matchs[] = $match;
        }

        return $this;
    }

    public function removeMatch(Matchs $match): self
    {
        if ($this->matchs->contains($match)) {
            $this->matchs->removeElement($match);
        }

        return $this;
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
}
