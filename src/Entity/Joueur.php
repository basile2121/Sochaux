<?php

namespace App\Entity;

use App\Repository\JoueurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\Column(type="string", length=255 )
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255 )
     */
    private $prenom;

    /**
     * @ORM\Column(type="integer" , nullable=true)
     */
    private $poids;

    /**
     * @ORM\Column(type="integer" , nullable=true)
     */
    private $taille;

    /**
     * @ORM\Column(type="integer" , nullable=true)
     */
    private $age;

    /**
     * @ORM\Column(type="string", length=255555,nullable=true)
     *
     * @Assert\File(
     *     maxSize = "1024M",
     *     mimeTypes = {"video/mp4"}
     * )
     */
    private $video;

    /**
     * @ORM\Column(type="boolean" , nullable=true)
     */
    private $pro;

    /**
     * @ORM\Column(type="integer" , nullable=true)
     */
    private $titulaire_nombre;

    /**
     * @ORM\Column(type="integer" , nullable=true)
     */
    private $nb_passe_decissive;

    /**
     * @ORM\Column(type="integer" , nullable=true)
     */
    private $nb_carton_rouge;

    /**
     * @ORM\Column(type="integer" , nullable=true)
     */
    private $nb_carton_jaune;

    /**
     * @ORM\Column(type="date" , nullable=true)
     */
    private $date_naissance;

    /**
     * @ORM\Column(type="integer" , nullable=true)
     */
    private $telephone;

    /**
     * @ORM\Column(type="integer" , nullable=true)
     */
    private $numero;

    /**
     * @ORM\Column(type="string", length=255 , nullable=true)
     */
    private $photo;

    /**
     * @ORM\Column(type="integer" , nullable=true)
     */
    private $nb_but;

    /**
     * @ORM\Column(type="string", length=255 , nullable=true)
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

    /**
     * @ORM\ManyToOne(targetEntity=Matchs::class, inversedBy="ligne1E1")
     */
    private $poste1;

    /**
     * @ORM\ManyToOne(targetEntity=Matchs::class, inversedBy="ligne2E1")
     */
    private $poste2;

    /**
     * @ORM\ManyToOne(targetEntity=Matchs::class, inversedBy="ligne3E1")
     */
    private $poste3;

    /**
     * @ORM\ManyToOne(targetEntity=Matchs::class, inversedBy="ligne4E1")
     */
    private $poste4;

    /**
     * @ORM\ManyToOne(targetEntity=Matchs::class, inversedBy="gardienE1")
     */
    private $poste5;

    /**
     * @ORM\ManyToOne(targetEntity=Matchs::class, inversedBy="ligne1E2")
     */
    private $poste6;

    /**
     * @ORM\ManyToOne(targetEntity=Matchs::class, inversedBy="ligne2E2")
     */
    private $poste7;

    /**
     * @ORM\ManyToOne(targetEntity=Matchs::class, inversedBy="ligne3E2")
     */
    private $poste8;

    /**
     * @ORM\ManyToOne(targetEntity=Matchs::class, inversedBy="ligne4E2")
     */
    private $poste9;

    /**
     * @ORM\ManyToOne(targetEntity=Matchs::class, inversedBy="gardienE2")
     */
    private $poste10;

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

    public function setVideo(string $video): ?self
    {
        $this->video = $video;
        return $this;
    }
    public function getVideo()
    {
        return $this->video;
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

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto($photo)
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

    public function getRoles(): ?string
    {
        return $this->roles;
    }

    public function setRoles(?string $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getPoste(): ?Matchs
    {
        return $this->poste;
    }

    public function setPoste(?Matchs $poste): self
    {
        $this->poste = $poste;

        return $this;
    }

    public function getPoste1(): ?Matchs
    {
        return $this->poste1;
    }

    public function setPoste1(?Matchs $poste1): self
    {
        $this->poste1 = $poste1;

        return $this;
    }

    public function getPoste2(): ?Matchs
    {
        return $this->poste2;
    }

    public function setPoste2(?Matchs $poste2): self
    {
        $this->poste2 = $poste2;

        return $this;
    }

    public function getPoste3(): ?Matchs
    {
        return $this->poste3;
    }

    public function setPoste3(?Matchs $poste3): self
    {
        $this->poste3 = $poste3;

        return $this;
    }

    public function getPoste4(): ?Matchs
    {
        return $this->poste4;
    }

    public function setPoste4(?Matchs $poste4): self
    {
        $this->poste4 = $poste4;

        return $this;
    }

    public function getPoste5(): ?Matchs
    {
        return $this->poste5;
    }

    public function setPoste5(?Matchs $poste5): self
    {
        $this->poste5 = $poste5;

        return $this;
    }

    public function getPoste6(): ?Matchs
    {
        return $this->poste6;
    }

    public function setPoste6(?Matchs $poste6): self
    {
        $this->poste6 = $poste6;

        return $this;
    }

    public function getPoste7(): ?Matchs
    {
        return $this->poste7;
    }

    public function setPoste7(?Matchs $poste7): self
    {
        $this->poste7 = $poste7;

        return $this;
    }

    public function getPoste8(): ?Matchs
    {
        return $this->poste8;
    }

    public function setPoste8(?Matchs $poste8): self
    {
        $this->poste8 = $poste8;

        return $this;
    }

    public function getPoste9(): ?Matchs
    {
        return $this->poste9;
    }

    public function setPoste9(?Matchs $poste9): self
    {
        $this->poste9 = $poste9;

        return $this;
    }

    public function getPoste10(): ?Matchs
    {
        return $this->poste10;
    }

    public function setPoste10(?Matchs $poste10): self
    {
        $this->poste10 = $poste10;

        return $this;
    }
    public function __toString()
    {
        if(is_null($this->nom)) {
            return 'NULL';
        }
        return $this->nom;
    }
}
