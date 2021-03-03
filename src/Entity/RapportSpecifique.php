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
     * @ORM\Column(type="string", length=2000 , nullable=true)
     */
    private $qualite_technique;

    /**
     * @ORM\Column(type="string", length=2000 , nullable=true)
     */
    private $qualite_mentale;

    /**
     * @ORM\Column(type="string", length=2000 , nullable=true)
     */
    private $qualite_physique;

    /**
     * @ORM\Column(type="string", length=2000 , nullable=true)
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

    /**
     * @ORM\Column(type="date" , nullable=true )
     */
    private $dateRapport;

    /**
     * @ORM\Column(type="string", length=180, unique=true , nullable=true)
     */
    private $mailAgent;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telephoneAgent;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresseAgent;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $equipe1;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $equipe2;

    /**
     * @ORM\Column(type="integer")
     */
    private $noteJoueur;

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

    public function getDateRapport(): ?\DateTimeInterface
    {
        return $this->dateRapport;
    }

    public function setDateRapport(\DateTimeInterface $dateRapport): self
    {
        $this->dateRapport = $dateRapport;

        return $this;
    }

    public function getMailAgent(): ?string
    {
        return $this->mailAgent;
    }

    public function setMailAgent(?string $mailAgent): self
    {
        $this->mailAgent = $mailAgent;

        return $this;
    }

    public function getTelephoneAgent(): ?string
    {
        return $this->telephoneAgent;
    }

    public function setTelephoneAgent(?string $telephoneAgent): self
    {
        $this->telephoneAgent = $telephoneAgent;

        return $this;
    }

    public function getAdresseAgent(): ?string
    {
        return $this->adresseAgent;
    }

    public function setAdresseAgent(?string $adresseAgent): self
    {
        $this->adresseAgent = $adresseAgent;

        return $this;
    }

    public function getEquipe1(): ?string
    {
        return $this->equipe1;
    }

    public function setEquipe1(string $equipe1): self
    {
        $this->equipe1 = $equipe1;

        return $this;
    }

    public function getEquipe2(): ?string
    {
        return $this->equipe2;
    }

    public function setEquipe2(string $equipe2): self
    {
        $this->equipe2 = $equipe2;

        return $this;
    }

    public function getNoteJoueur(): ?int
    {
        return $this->noteJoueur;
    }

    public function setNoteJoueur(int $noteJoueur): self
    {
        $this->noteJoueur = $noteJoueur;

        return $this;
    }
}
