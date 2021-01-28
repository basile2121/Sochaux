<?php

namespace App\Entity;

use App\Repository\ParticipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParticipeRepository::class)
 */
class Participe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer" , nullable=true)
     */
    private $score;

    /**
     * @ORM\ManyToOne(targetEntity=Club::class , inversedBy="participes"  )
     */
    private $clubfirst;

    /**
     * @ORM\ManyToOne(targetEntity=Club::class, inversedBy="participes"  )
     */
    private $clubsecond;

    /**
     * @ORM\ManyToMany(targetEntity=Matchs::class, inversedBy="participes" )
     */
    private $matchs;

    /**
     * @ORM\ManyToOne(targetEntity=Tactique::class, inversedBy="participes")
     */
    private $tactique_first_club;

    /**
     * @ORM\ManyToOne(targetEntity=Tactique::class, inversedBy="participes")
     */
    private $tactique_second_club;

    public function __construct()
    {
        $this->matchs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getClubFirst(): ?Club
    {
        return $this->clubfirst;
    }

    public function setClubFirst(?Club $club): self
    {
        $this->clubfirst = $club;

        return $this;
    }

    public function getClubSecond(): ?Club
    {
        return $this->clubsecond;
    }

    public function setClubSecond(?Club $club): self
    {
        $this->clubsecond = $club;

        return $this;
    }

    public function getTactiqueFirstClub(): ?Tactique
    {
        return $this->tactique_first_club;
    }

    public function setTactiqueFirstClub(?Tactique $tactique): self
    {
        $this->tactique_first_club = $tactique;

        return $this;
    }

    public function getTactiqueSecondClub(): ?Tactique
    {
        return $this->tactique_second_club;
    }

    public function setTactiqueSecondClub(?Tactique $tactique): self
    {
        $this->tactique_second_club = $tactique;

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


}
