<?php

namespace App\Entity;

use App\Repository\JoueurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JoueurRepository::class)
 */
class Joueur
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="integer")
     */
    private $poids;

    /**
     * @ORM\Column(type="integer")
     */
    private $taille;

    /**
     * @ORM\Column(type="integer")
     */
    private $age;

    /**
     * @ORM\Column(type="boolean")
     */
    private $pro;

    /**
     * @ORM\Column(type="integer")
     */
    private $titulaire_nombre;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_passe_decissive;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_carton_rouge;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_carton_jaune;

    /**
     * @ORM\Column(type="date")
     */
    private $date_naissance;

    /**
     * @ORM\Column(type="integer")
     */
    private $telephone;

    /**
     * @ORM\Column(type="integer")
     */
    private $numero;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photo;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_but;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nationalite;

    /**
     * @ORM\OneToMany(targetEntity=RapportSpecifique::class, mappedBy="joueur")
     */
    private $rapportSpecifiques;

    /**
     * @ORM\OneToMany(targetEntity=Contrat::class, mappedBy="joueur")
     */
    private $contrats;

    /**
     * @ORM\ManyToMany(targetEntity=JoueurPoste::class, mappedBy="joueur")
     */
    private $joueurPostes;

    /**
     * @ORM\ManyToMany(targetEntity=JoueDans::class, mappedBy="joueur")
     */
    private $joueDans;

    public function __construct()
    {
        $this->rapportSpecifiques = new ArrayCollection();
        $this->contrats = new ArrayCollection();
        $this->joueurPostes = new ArrayCollection();
        $this->joueDans = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getPoids(): ?int
    {
        return $this->poids;
    }

    public function setPoids(int $poids): self
    {
        $this->poids = $poids;

        return $this;
    }

    public function getTaille(): ?int
    {
        return $this->taille;
    }

    public function setTaille(int $taille): self
    {
        $this->taille = $taille;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getPro(): ?bool
    {
        return $this->pro;
    }

    public function setPro(bool $pro): self
    {
        $this->pro = $pro;

        return $this;
    }

    public function getTitulaireNombre(): ?int
    {
        return $this->titulaire_nombre;
    }

    public function setTitulaireNombre(int $titulaire_nombre): self
    {
        $this->titulaire_nombre = $titulaire_nombre;

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

    public function getNbCartonRouge(): ?int
    {
        return $this->nb_carton_rouge;
    }

    public function setNbCartonRouge(int $nb_carton_rouge): self
    {
        $this->nb_carton_rouge = $nb_carton_rouge;

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

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(\DateTimeInterface $date_naissance): self
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
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

    public function getNationalite(): ?string
    {
        return $this->nationalite;
    }

    public function setNationalite(string $nationalite): self
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    public function __toString()
    {
        return $this->getNom();
    }

    /**
     * @return Collection|RapportSpecifique[]
     */
    public function getRapportSpecifiques(): Collection
    {
        return $this->rapportSpecifiques;
    }

    public function addRapportSpecifique(RapportSpecifique $rapportSpecifique): self
    {
        if (!$this->rapportSpecifiques->contains($rapportSpecifique)) {
            $this->rapportSpecifiques[] = $rapportSpecifique;
            $rapportSpecifique->setJoueur($this);
        }

        return $this;
    }

    public function removeRapportSpecifique(RapportSpecifique $rapportSpecifique): self
    {
        if ($this->rapportSpecifiques->contains($rapportSpecifique)) {
            $this->rapportSpecifiques->removeElement($rapportSpecifique);
            // set the owning side to null (unless already changed)
            if ($rapportSpecifique->getJoueur() === $this) {
                $rapportSpecifique->setJoueur(null);
            }
        }

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
            $contrat->setJoueur($this);
        }

        return $this;
    }

    public function removeContrat(Contrat $contrat): self
    {
        if ($this->contrats->contains($contrat)) {
            $this->contrats->removeElement($contrat);
            // set the owning side to null (unless already changed)
            if ($contrat->getJoueur() === $this) {
                $contrat->setJoueur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|JoueurPoste[]
     */
    public function getJoueurPostes(): Collection
    {
        return $this->joueurPostes;
    }

    public function addJoueurPoste(JoueurPoste $joueurPoste): self
    {
        if (!$this->joueurPostes->contains($joueurPoste)) {
            $this->joueurPostes[] = $joueurPoste;
            $joueurPoste->addJoueur($this);
        }

        return $this;
    }

    public function removeJoueurPoste(JoueurPoste $joueurPoste): self
    {
        if ($this->joueurPostes->contains($joueurPoste)) {
            $this->joueurPostes->removeElement($joueurPoste);
            $joueurPoste->removeJoueur($this);
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
            $joueDan->addJoueur($this);
        }

        return $this;
    }

    public function removeJoueDan(JoueDans $joueDan): self
    {
        if ($this->joueDans->contains($joueDan)) {
            $this->joueDans->removeElement($joueDan);
            $joueDan->removeJoueur($this);
        }

        return $this;
    }
}
