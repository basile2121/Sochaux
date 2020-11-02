<?php

namespace App\Entity;

use App\Repository\CommentaireRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentaireRepository::class)
 */
class Commentaire
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
    private $texte;

    /**
     * @ORM\Column(type="integer")
     */
    private $minute_commentaire;

    /**
     * @ORM\ManyToOne(targetEntity=Matchs::class, inversedBy="commentaires")
     */
    private $matchs;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTexte(): ?string
    {
        return $this->texte;
    }

    public function setTexte(string $texte): self
    {
        $this->texte = $texte;

        return $this;
    }

    public function getMinuteCommentaire(): ?int
    {
        return $this->minute_commentaire;
    }

    public function setMinuteCommentaire(int $minute_commentaire): self
    {
        $this->minute_commentaire = $minute_commentaire;

        return $this;
    }

    public function getMatchs(): ?Matchs
    {
        return $this->matchs;
    }

    public function setMatchs(?Matchs $matchs): self
    {
        $this->matchs = $matchs;

        return $this;
    }
    public function __toString()
    {
        return $this->getTexte();
    }
}
