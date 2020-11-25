<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\Championnat;
use App\Entity\Club;
use App\Entity\Commentaire;
use App\Entity\Commente;
use App\Entity\Contrat;
use App\Entity\JoueDans;
use App\Entity\Joueur;
use App\Entity\JoueurPoste;
use App\Entity\Matchs;
use App\Entity\Participe;
use App\Entity\Poste;
use App\Entity\RapportSpecifique;
use App\Entity\Tactique;
use App\Entity\Tournoi;
use App\Entity\User;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        echo "chargement des fixtures pour l'entité championnat \n***\n\n";
        $this->load_championnats($manager);

        echo "chargement des fixtures pour l'entité club \n***\n\n";
        $this->load_clubs($manager);

        echo "chargement des fixtures pour l'entité tournoi \n***\n\n";
        $this->load_tournois($manager);

        echo "chargement des fixtures pour l'entité match \n***\n\n";
        $this->load_matchs($manager);

        echo "chargement des fixtures pour l'entité commentaire \n***\n\n";
        $this->load_commentaires($manager);

        echo "chargement des fixtures pour l'entité joueur \n***\n\n";
        $this->load_joueurs($manager);

        echo "chargement des fixtures pour l'entité contrat \n***\n\n";
        $this->load_contrats($manager);

        echo "chargement des fixtures pour l'entité tactique \n***\n\n";
        $this->load_tactiques($manager);

        echo "chargement des fixtures pour l'entité poste \n***\n\n";
        $this->load_poste($manager);

        echo "chargement des fixtures pour l'entité participe \n***\n\n";
        $this->load_participes($manager);

        echo "chargement des fixtures pour l'entité joue_dans \n***\n\n";
        $this->load_joue_dans($manager);

        echo "chargement des fixtures pour l'entité joueur poste \n***\n\n";
        $this->load_joueur_poste($manager);

        echo "chargement des fixtures pour l'entité users\n***\n\n";
        $this->load_users($manager);

        echo "chargement des fixtures pour l'entité rapport specifique\n***\n\n";
        $this->load_rapport_specifique($manager);

        echo "chargement des fixtures pour l'entité commente\n***\n\n";
        $this->load_commente($manager);

        $manager->flush();
    }

    public function load_championnats(ObjectManager $manager){
        $championnat=[
            [ 'nom' => 'nom1' , 'pays' => "pays1"],
            [ 'nom' => 'nom2' , 'pays' => "pays2"],
            [ 'nom' => 'nom3' , 'pays' => "pays3"],
            [ 'nom' => 'nom4' , 'pays' => "pays4"],
            [ 'nom' => 'nom5' , 'pays' => "pays5"],
        ];

        foreach ($championnat as $champ)
        {
            $new_champ = new Championnat();
            $new_champ->setNomChampionnat($champ['nom']);
            $new_champ->setPaysChampionnat($champ['pays']);

            $manager->persist($new_champ);
        }
        $manager->flush();
    }

    public function load_clubs(ObjectManager $manager){
        $club=[
            [ 'nom' => 'Atheltico Madrid' , 'pays' => "Espagne" , 'ville' => "Madrid" , 'championnat_id' => 1 ],
            [ 'nom' => 'Juventus Turin' , 'pays' => "Italie" , 'ville' => "Turin" , 'championnat_id' => 2 ],
            [ 'nom' => 'FC Barcelone' , 'pays' => "Espagne" , 'ville' => "Barcelone" , 'championnat_id' => 3 ],
            [ 'nom' => 'Paris St Germain' , 'pays' => "France" , 'ville' => "Paris" , 'championnat_id' => 4 ],
            [ 'nom' => 'Machester United' , 'pays' => "Anglettere" , 'ville' => "Manchester" , 'championnat_id' => 5 ],
        ];

        foreach ($club as $cl)
        {
            $new_club = new Club();
            $new_club->setNomClub($cl['nom']);
            $new_club->setPaysClub($cl['pays']);
            $new_club->setVilleClub($cl['ville']);
            $championnat = $manager->getRepository(Championnat::class)->findOneBy([
                'id' => $cl['championnat_id']],
                ['id' => 'ASC']);
            $new_club->setChampionnat($championnat);
            $manager->persist($new_club);
        }
        $manager->flush();
    }

    public function load_tournois(ObjectManager $manager){
        $tournoi=[
            [ 'nom' => 'nom_tournoi1'   ],
            [ 'nom' => 'nom_tournoi2'   ],
            [ 'nom' => 'nom_tournoi3'   ],
            [ 'nom' => 'nom_tournoi4'   ],
            [ 'nom' => 'nom_tournoi5'   ],
        ];

        foreach ($tournoi as $tr)
        {
            $new_tournoi = new Tournoi();
            $new_tournoi->setNomTournoi($tr['nom']);
            $manager->persist($new_tournoi);
        }

        $manager->flush();
    }

    public function load_matchs(ObjectManager $manager){
        $match =[
            [ 'lieux' => 'lieux_match1' , 'condition' => 'condition_match1' , 'date' => '0001-01-01' , 'tournoi_id' => 1 ],
            [ 'lieux' => 'lieux_match2' , 'condition' => 'condition_match2' , 'date' => '0001-01-02' , 'tournoi_id' => 2 ],
            [ 'lieux' => 'lieux_match3' , 'condition' => 'condition_match3' , 'date' => '0001-01-03' , 'tournoi_id' => 3 ],
            [ 'lieux' => 'lieux_match4' , 'condition' => 'condition_match4' , 'date' => '0001-01-04' , 'tournoi_id' => 4 ],
            [ 'lieux' => 'lieux_match5' , 'condition' => 'condition_match5' , 'date' => '0001-01-05' , 'tournoi_id' => 5 ],
        ];

        foreach ($match as $m)
        {
            $new_match = new Matchs();
            $new_match->setLieux($m['lieux']);
            $new_match->setConditions($m['condition']);
            $new_match->setDate(new \DateTime($m['date']));
            $tournoi = $manager->getRepository(Tournoi::class)->findOneBy([
                'id' => $m['tournoi_id']],
                ['id' => 'ASC']);
            $new_match->setTournoi($tournoi);

            $manager->persist($new_match);
        }
        $manager->flush();
    }

    public function load_commentaires(ObjectManager $manager){
        $commentaires =[
            [ 'texte' => 'texte_com1' , 'minute' => 1 , 'match_id' => 1 ],
            [ 'texte' => 'texte_com2' , 'minute' => 2 , 'match_id' => 2 ],
            [ 'texte' => 'texte_com3' , 'minute' => 3 , 'match_id' => 3 ],
            [ 'texte' => 'texte_com4' , 'minute' => 4 , 'match_id' => 4 ],
            [ 'texte' => 'texte_com5' , 'minute' => 5 , 'match_id' => 5 ],
        ];

        foreach ($commentaires as $com)
        {
            $new_com = new Commentaire();
            $new_com->setTexte($com['texte']);
            $new_com->setMinuteCommentaire($com['minute']);

            $match = $manager->getRepository(Matchs::class)->findOneBy([
                'id' => $com['match_id']],
                ['id' => 'ASC']);
            $new_com->setMatchs($match);

            $manager->persist($new_com);
        }
        $manager->flush();
    }

    public function load_joueurs(ObjectManager $manager){
        $joueurs=[
            [ 'nom' => 'Griezmann' , 'prenom' => "Antoine" , 'poids' => 80 , 'taille' => 160 , 'age' => 29
                , 'pro' => true , 'titulaire_nombre' => 4 , 'nb_passe_decissive' => 19 , 'nb_carton_rouges' => 0
                , 'nb_carton_jaunes' => 9 , 'date_naissance' => '0001-01-01' , 'telephone' => 0000000001 , 'numero' => 18
                , 'photo' => 'griezmann.jpeg' , 'nb_buts' => 19 , 'nationalite' => 'fr' ],

            [ 'nom' => 'Messi' , 'prenom' => "Lionel" , 'poids' => 89 , 'taille' => 140 , 'age' => 20
                , 'pro' => true , 'titulaire_nombre' => 2 , 'nb_passe_decissive' => 2 , 'nb_carton_rouges' => 90
                , 'nb_carton_jaunes' => 5 , 'date_naissance' => '0001-01-02' , 'telephone' => 0000000002 , 'numero' => 19
                , 'photo' => 'messi.jpeg' , 'nb_buts' => 4 , 'nationalite' => 'fr' ],

            [ 'nom' => 'Muller' , 'prenom' => "Emanule" , 'poids' => 76 , 'taille' => 189 , 'age' => 30
                , 'pro' => true , 'titulaire_nombre' => 9 , 'nb_passe_decissive' => 9 , 'nb_carton_rouges' => 2
                , 'nb_carton_jaunes' => 5 , 'date_naissance' => '0001-01-03' , 'telephone' => 0000000003 , 'numero' => 10
                , 'photo' => 'muller.jpeg' , 'nb_buts' => 30 , 'nationalite' => 'en' ],

            [ 'nom' => 'Neueu' , 'prenom' => "Emmanuelle" , 'poids' => 40 , 'taille' => 199 , 'age' => 40
                , 'pro' => false, 'titulaire_nombre' => 9 , 'nb_passe_decissive' => 0 , 'nb_carton_rouges' => 9
                , 'nb_carton_jaunes' => 1 , 'date_naissance' => '0001-01-04' , 'telephone' => 0000000004 , 'numero' => 1
                , 'photo' => 'neuer.jpeg' , 'nb_buts' => 0 , 'nationalite' => 'en' ],

            [ 'nom' => 'Ronaldo' , 'prenom' => "Christiano" , 'poids' => 90 , 'taille' => 190 , 'age' => 18
                , 'pro' => false, 'titulaire_nombre' => 5 , 'nb_passe_decissive' => 5 , 'nb_carton_rouges' => 2
                , 'nb_carton_jaunes' => 2 , 'date_naissance' => '0001-01-05' , 'telephone' => 0000000005 , 'numero' => 5
                , 'photo' => 'ronaldo.jpeg' , 'nb_buts' => 50 , 'nationalite' => 'en' ],
        ];
        foreach ($joueurs as $j)
        {
            $new_joueur = new Joueur();
            $new_joueur->setNom($j['nom']);
            $new_joueur->setPrenom($j['prenom']);
            $new_joueur->setPoids($j['poids']);
            $new_joueur->setTaille($j['taille']);
            $new_joueur->setAge($j['age']);
            $new_joueur->setPro($j['pro']);
            $new_joueur->setTitulaireNombre($j['titulaire_nombre']);
            $new_joueur->setNbPasseDecissive($j['nb_passe_decissive']);
            $new_joueur->setNbCartonJaune($j['nb_carton_jaunes']);
            $new_joueur->setNbCartonRouge($j['nb_carton_rouges']);
            $new_joueur->setDateNaissance(new \DateTime($j['date_naissance']));
            $new_joueur->setTelephone($j['telephone']);
            $new_joueur->setNumero($j['numero']);
            $new_joueur->setPhoto($j['photo']);
            $new_joueur->setNbBut($j['nb_buts']);
            $new_joueur->setNationalite($j['nationalite']);
            $manager->persist($new_joueur);
        }
        $manager->flush();
    }

    public function load_contrats(ObjectManager $manager){
        $contrats =[
            [ 'date_debut' => '0001-01-01' , 'date_fin' => '0001-01-06' , 'prix' => 200000 , 'joueur_id' => 1 , 'club_id' => 1 ],
            [ 'date_debut' => '0001-01-02' , 'date_fin' => '0001-01-07' , 'prix' => 100000 , 'joueur_id' => 2 , 'club_id' => 2 ],
            [ 'date_debut' => '0001-01-03' , 'date_fin' => '0001-01-08' , 'prix' => 345000 , 'joueur_id' => 3 , 'club_id' => 3 ],
            [ 'date_debut' => '0001-01-04' , 'date_fin' => '0001-01-09' , 'prix' => 24000 , 'joueur_id' => 4 , 'club_id' => 4 ],
            [ 'date_debut' => '0001-01-05' , 'date_fin' => '0001-01-1'  , 'prix' => 50000 , 'joueur_id' => 5 , 'club_id' => 5 ],
        ];

        foreach ($contrats as $c)
        {
            $new_contrat = new Contrat();
            $new_contrat->setDateDebut(new \DateTime($c['date_debut']));
            $new_contrat->setDateFin(new \DateTime($c['date_fin']));
            $new_contrat->setPrix($c['prix']);

            $joueur = $manager->getRepository(Joueur::class)->findOneBy([
                'id' => $c['joueur_id']],
                ['id' => 'ASC']);
            $new_contrat->setJoueur($joueur);

            $club = $manager->getRepository(Club::class)->findOneBy([
                'id' => $c['club_id']],
                ['id' => 'ASC']);
            $new_contrat->setClub($club);

            $manager->persist($new_contrat);
        }
        $manager->flush();
    }

    public function load_tactiques(ObjectManager $manager){
        $taciques=[
            [ 'nom' => 'nom_tactique1'  ],
            [ 'nom' => 'nom_tactique2'  ],
            [ 'nom' => 'nom_tactique3'  ],
            [ 'nom' => 'nom_tactique4'  ],
            [ 'nom' => 'nom_tactique5'  ],
        ];

        foreach ($taciques as $t)
        {
            $new_tactique = new Tactique();
            $new_tactique->setNomTactique($t['nom']);

            $manager->persist($new_tactique);
        }
        $manager->flush();
    }

    public function load_participes(ObjectManager $manager){
        $participe=[
            [ 'score' => 1 , 'club_id' => 1 , 'match_id' => 1 , 'tactique_id' => 1 ],
            [ 'score' => 2 , 'club_id' => 2 , 'match_id' => 2 , 'tactique_id' => 2 ],
            [ 'score' => 3 , 'club_id' => 3 , 'match_id' => 3 , 'tactique_id' => 3 ],
            [ 'score' => 4 , 'club_id' => 4 , 'match_id' => 4 , 'tactique_id' => 4 ],
            [ 'score' => 5 , 'club_id' => 5 , 'match_id' => 5 , 'tactique_id' => 5 ],
        ];

        foreach ($participe as $pa)
        {
            $new_participe = new Participe();
            $new_participe->setScore($pa['score']);

            $club = $manager->getRepository(Club::class)->findOneBy([
                'id' => $pa['club_id']],
                ['id' => 'ASC']);
            $new_participe->addClub($club);

            $match = $manager->getRepository(Matchs::class)->findOneBy([
                'id' => $pa['match_id']],
                ['id' => 'ASC']);
            $new_participe->addMatch($match);

            $tactique = $manager->getRepository(Tactique::class)->findOneBy([
                'id' => $pa['tactique_id']],
                ['id' => 'ASC']);
            $new_participe->addTactique($tactique);

            $manager->persist($new_participe);
        }
        $manager->flush();
    }

    public function load_poste(ObjectManager $manager){
        $poste=[
            [ 'nom' => 'nom_poste1' , 'tactique_id' => 1 ],
            [ 'nom' => 'nom_poste2' , 'tactique_id' => 2 ],
            [ 'nom' => 'nom_poste3' , 'tactique_id' => 3 ],
            [ 'nom' => 'nom_poste4' , 'tactique_id' => 4 ],
            [ 'nom' => 'nom_poste5' , 'tactique_id' => 5 ],
        ];

        foreach ($poste as $po)
        {
            $new_poste = new Poste();
            $new_poste->setNomPoste($po['nom']);

            $tactique = $manager->getRepository(Tactique::class)->findOneBy([
                'id' => $po['tactique_id']],
                ['id' => 'ASC']);
            $new_poste->setTactique($tactique);

            $manager->persist($new_poste);
        }
        $manager->flush();
    }

    public function load_joue_dans(ObjectManager $manager){
        $joue_dans =[
            [ 'nb_buts' => 1 , 'nb_passe_decissive' => 1 , 'nb_carton_rouges' => 0 , 'nb_carton_jaunes' => 0  , 'temps_joue' => 1 , 'note_attribuee' => 1 , 'video' => 'video1' , 'joueur_id' => 1 , 'match_id' => 1 , 'poste_id'=> 1 ],
            [ 'nb_buts' => 2 , 'nb_passe_decissive' => 2 , 'nb_carton_rouges' => 0 , 'nb_carton_jaunes' => 0  , 'temps_joue' => 2 , 'note_attribuee' => 2 , 'video' => 'video2' , 'joueur_id' => 2 , 'match_id' => 2 , 'poste_id'=> 2 ],
            [ 'nb_buts' => 3 , 'nb_passe_decissive' => 3 , 'nb_carton_rouges' => 1 , 'nb_carton_jaunes' => 0  , 'temps_joue' => 3 , 'note_attribuee' => 3 , 'video' => 'video3' , 'joueur_id' => 3 , 'match_id' => 3 , 'poste_id'=> 3 ],
            [ 'nb_buts' => 4 , 'nb_passe_decissive' => 4 , 'nb_carton_rouges' => 1 , 'nb_carton_jaunes' => 1  , 'temps_joue' => 4 , 'note_attribuee' => 4 , 'video' => 'video4' , 'joueur_id' => 4 , 'match_id' => 4 , 'poste_id'=> 4 ],
            [ 'nb_buts' => 5 , 'nb_passe_decissive' => 5 , 'nb_carton_rouges' => 2 , 'nb_carton_jaunes' => 1  , 'temps_joue' => 5 , 'note_attribuee' => 5 , 'video' => 'video5' , 'joueur_id' => 5 , 'match_id' => 5 , 'poste_id'=> 5 ],
        ];

        foreach ($joue_dans as $jd)
        {
            $joue_dans = new JoueDans();
            $joue_dans->setNbBut($jd['nb_buts']);
            $joue_dans->setNbPasseDecissive($jd['nb_passe_decissive']);
            $joue_dans->setNbCartonRouge($jd['nb_carton_rouges']);
            $joue_dans->setNbCartonJaune($jd['nb_carton_jaunes']);
            $joue_dans->setTempsJoue($jd['temps_joue']);
            $joue_dans->setNoteAttribue($jd['note_attribuee']);
            $joue_dans->setVideo($jd['video']);


            $joueur = $manager->getRepository(Joueur::class)->findOneBy([
                'id' => $jd['joueur_id']],
                ['id' => 'ASC']);
            $joue_dans->addJoueur($joueur);

            $match = $manager->getRepository(Matchs::class)->findOneBy([
                'id' => $jd['match_id']],
                ['id' => 'ASC']);
            $joue_dans->addMatch($match);

            $poste = $manager->getRepository(Poste::class)->findOneBy([
                'id' => $jd['poste_id']],
                ['id' => 'ASC']);
            $joue_dans->addPoste($poste);

            $manager->persist($joue_dans);
        }
        $manager->flush();
    }

    public function load_joueur_poste(ObjectManager $manager){
        $joueur_poste=[
            [ 'joueur_id' => 1 , 'poste_id'=> 1 ],
            [ 'joueur_id' => 2 , 'poste_id'=> 2 ],
            [ 'joueur_id' => 3 , 'poste_id'=> 3 ],
            [ 'joueur_id' => 4 , 'poste_id'=> 4 ],
            [ 'joueur_id' => 5 , 'poste_id'=> 5 ],
        ];

        foreach ($joueur_poste as $jr)
        {
            $newJr = new JoueurPoste();
            $joueur = $manager->getRepository(Joueur::class)->findOneBy([
                'id' => $jr['joueur_id']],
                ['id' => 'ASC']);
            $newJr->addJoueur($joueur);

            $poste = $manager->getRepository(Poste::class)->findOneBy([
                'id' => $jr['poste_id']],
                ['id' => 'ASC']);
            $newJr->addPoste($poste);

            $manager->persist($newJr);
        }
        $manager->flush();
    }

    public function load_rapport_specifique(ObjectManager $manager){
        $rapport_specifique=[
            [ 'qualite_technique' => 'qualite_technique1' , 'qualite_mentale' => 'qualite_mentale1' , 'qualite_physique' => 'qualite_physique1' , 'qualite_tactique' => 'qualite_tactique1' , 'nom_agent' => "nom_agent", 'joueur_id' => 1 , 'commente_id'  => 1 ],
            [ 'qualite_technique' => 'qualite_technique2' , 'qualite_mentale' => 'qualite_mentale2' , 'qualite_physique' => 'qualite_physique2' , 'qualite_tactique' => 'qualite_tactique2' , 'nom_agent' => "nom_agent", 'joueur_id' => 2 , 'commente_id'  => 2 ],
            [ 'qualite_technique' => 'qualite_technique3' , 'qualite_mentale' => 'qualite_mentale3' , 'qualite_physique' => 'qualite_physique3' , 'qualite_tactique' => 'qualite_tactique3' , 'nom_agent' => "nom_agent", 'joueur_id' => 3 , 'commente_id'  => 3 ],
            [ 'qualite_technique' => 'qualite_technique4' , 'qualite_mentale' => 'qualite_mentale4' , 'qualite_physique' => 'qualite_physique4' , 'qualite_tactique' => 'qualite_tactique4' , 'nom_agent' => "nom_agent", 'joueur_id' => 4 , 'commente_id'  => 4 ],
            [ 'qualite_technique' => 'qualite_technique5' , 'qualite_mentale' => 'qualite_mentale5' , 'qualite_physique' => 'qualite_physique5' , 'qualite_tactique' => 'qualite_tactique5' , 'nom_agent' => "nom_agent", 'joueur_id' => 5 , 'commente_id'  => 5 ],
        ];

        foreach ($rapport_specifique as $rp)
        {
            $new_rp = new RapportSpecifique();
            $new_rp->setQualiteTechnique($rp['qualite_technique']);
            $new_rp->setQualiteMentale($rp['qualite_mentale']);
            $new_rp->setQualitePhysique($rp['qualite_physique']);
            $new_rp->setQualiteTactique($rp['qualite_tactique']);
            $new_rp->setNomAgent($rp['nom_agent']);

            $joueur = $manager->getRepository(Joueur::class)->findOneBy([
                'id' => $rp['joueur_id']],
                ['id' => 'ASC']);
            $new_rp->setJoueur($joueur);
            $manager->persist($new_rp);
        }
        $manager->flush();
    }

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load_users(ObjectManager $manager){
        $users=[
            [ 'username' => 'exemple1@gmail.com' , 'email' => 'exemple1@gmail.com' , 'password' => 'password1' , 'role'=> ['ROLE_ADMIN']  , 'is_active' => true  ],
            [ 'username' => 'exemple2@gmail.com' , 'email' => 'exemple2@gmail.com' , 'password' => 'password2' , 'role'=> ['ROLE_CLIENT'] , 'is_active' => true  ],
            [ 'username' => 'exemple3@gmail.com' , 'email' => 'exemple3@gmail.com' , 'password' => 'password3' , 'role'=> ['ROLE_CLIENT'] , 'is_active' => true  ],
            [ 'username' => 'exemple4@gmail.com' , 'email' => 'exemple4@gmail.com' , 'password' => 'password4' , 'role'=> ['ROLE_CLIENT'] , 'is_active' => true  ],
            [ 'username' => 'exemple5@gmail.com' , 'email' => 'exemple5@gmail.com' , 'password' => 'password5' , 'role'=> ['ROLE_CLIENT'] , 'is_active' => true  ],
        ];

        foreach ($users as $usr)
        {
            $newUser = new User();
            $newUser->setUsername($usr['username']);
            $newUser->setEmail($usr['email']);
            $password = $this->passwordEncoder->encodePassword($newUser,$usr['password']);
            $newUser->setPassword($password);
            $newUser->setRoles($usr['role']);
            $newUser->setIsActive($usr['is_active']);

            $manager->persist($newUser);
        }
        $manager->flush();
    }

    public function load_commente(ObjectManager $manager)
    {
        $commente = [
            ['user_id' => 1, 'rapport_specifique_id' => 1],
            ['user_id' => 2, 'rapport_specifique_id' => 2],
            ['user_id' => 3, 'rapport_specifique_id' => 3],
            ['user_id' => 4, 'rapport_specifique_id' => 4],
            ['user_id' => 5, 'rapport_specifique_id' => 5],
        ];
        foreach ($commente as $cm) {
            $newCm = new Commente();

            $user = $manager->getRepository(User::class)->findOneBy([
                'id' => $cm['user_id']],
                ['id' => 'ASC']);
            $newCm->addUser($user);

            $rapport_specifique = $manager->getRepository(RapportSpecifique::class)->findOneBy([
                'id' => $cm['rapport_specifique_id']],
                ['id' => 'ASC']);
            $newCm->addRapportSpecifique($rapport_specifique);

            $manager->persist($newCm);
        }
        $manager->flush();
    }
}
