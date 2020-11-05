<?php

namespace App\Entity;

use App\Repository\CommenteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommenteRepository::class)
 */
class Commente
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=RapportSpecifique::class, inversedBy="commentes")
     */
    private $rapport_specifique;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="commentes")
     */
    private $user;

    public function __construct()
    {
        $this->rapport_specifique = new ArrayCollection();
        $this->user = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|rapportSpecifique[]
     */
    public function getRapportSpecifique(): Collection
    {
        return $this->rapport_specifique;
    }

    public function addRapportSpecifique(rapportSpecifique $rapportSpecifique): self
    {
        if (!$this->rapport_specifique->contains($rapportSpecifique)) {
            $this->rapport_specifique[] = $rapportSpecifique;
        }

        return $this;
    }

    public function removeRapportSpecifique(rapportSpecifique $rapportSpecifique): self
    {
        if ($this->rapport_specifique->contains($rapportSpecifique)) {
            $this->rapport_specifique->removeElement($rapportSpecifique);
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->user->contains($user)) {
            $this->user->removeElement($user);
        }

        return $this;
    }
}
