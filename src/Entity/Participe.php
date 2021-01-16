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
     * @ORM\ManyToMany(targetEntity=Tactique::class, inversedBy="participes")
     */
    private $tactique;

    public function __construct()
    {
        $this->matchs = new ArrayCollection();
        $this->tactique = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    /**
     * @return Collection|Club[]
     */
    public function getClub(): Collection
    {
        return $this->club;
    }

    public function addClub(Club $club): self
    {
        if (!$this->club->contains($club)) {
            $this->club[] = $club;
        }

        return $this;
    }

    public function removeClub(Club $club): self
    {
        if ($this->club->contains($club)) {
            $this->club->removeElement($club);
        }

        return $this;
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
     * @return Collection|Tactique[]
     */
    public function getTactique(): Collection
    {
        return $this->tactique;
    }

    public function addTactique(Tactique $tactique): self
    {
        if (!$this->tactique->contains($tactique)) {
            $this->tactique[] = $tactique;
        }

        return $this;
    }

    public function removeTactique(Tactique $tactique): self
    {
        if ($this->tactique->contains($tactique)) {
            $this->tactique->removeElement($tactique);
        }

        return $this;
    }
}
