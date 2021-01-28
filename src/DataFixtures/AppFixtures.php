<?php

namespace App\DataFixtures;

use Cassandra\Date;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
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



    public function load_clubs(ObjectManager $manager){
        $club=[
            [ 'nom' => 'Atheltico Madrid' , 'pays' => "Espagne" , 'ville' => "Madrid"  ],
            [ 'nom' => 'Juventus Turin' , 'pays' => "Italie" , 'ville' => "Turin" ],
            [ 'nom' => 'FC Barcelone' , 'pays' => "Espagne" , 'ville' => "Barcelone"  ],
            [ 'nom' => 'Paris St Germain' , 'pays' => "France" , 'ville' => "Paris"],
            [ 'nom' => 'Machester United' , 'pays' => "Anglettere" , 'ville' => "Manchester"  ],
        ];

        foreach ($club as $cl)
        {
            $new_club = new Club();
            $new_club->setNomClub($cl['nom']);
            $new_club->setPaysClub($cl['pays']);
            $new_club->setVilleClub($cl['ville']);
            $manager->persist($new_club);
        }
        $manager->flush();
    }

    public function load_tournois(ObjectManager $manager){
        $tournoi=[
            [ 'nom' => 'Ligue 1' , 'paysTournoi' => 'France'  ],
            [ 'nom' => 'Coupe de France' , 'paysTournoi' => 'France'  ],
            [ 'nom' => 'Championne League' , 'paysTournoi' => 'Europe'  ],
            [ 'nom' => 'Premiere Ligue', 'paysTournoi' => 'Angleterre'  ],
            [ 'nom' => 'Ligue 2' , 'paysTournoi' => 'France'  ],
        ];

        foreach ($tournoi as $tr)
        {
            $new_tournoi = new Tournoi();
            $new_tournoi->setNomTournoi($tr['nom']);
            $new_tournoi->setPaysTournoi($tr['paysTournoi']);
            $manager->persist($new_tournoi);
        }

        $manager->flush();
    }

    public function load_matchs(ObjectManager $manager){
        $match =[
            [ 'lieux' => 'Paris' , 'condition' => 'Pluie' , 'date' => '2020-09-01' , 'paysMatch' => 'France' , 'tournoi_id' => 1 ],
            [ 'lieux' => 'Belfort' , 'condition' => 'Orage' , 'date' => '2018-07-02' , 'paysMatch' => 'France' , 'tournoi_id' => 2 ],
            [ 'lieux' => 'Marseille' , 'condition' => 'Bonne' , 'date' => '2016-03-03' , 'paysMatch' => 'France' , 'tournoi_id' => 3 ],
            [ 'lieux' => 'Milan' , 'condition' => 'Forte Chaleur' , 'date' => '2020-08-04' , 'paysMatch' => 'Italie' , 'tournoi_id' => 4 ],
            [ 'lieux' => 'Madrid' , 'condition' => 'Bonne' , 'date' => '2019-11-05' , 'paysMatch' => 'Espagne' , 'tournoi_id' => 5 ],
            [ 'lieux' => 'Londre' , 'condition' => 'Bonne' , 'date' => '2019-11-05' , 'paysMatch' => 'Angleterre' , 'tournoi_id' => 4 ],
        ];

        foreach ($match as $m)
        {
            $new_match = new Matchs();
            $new_match->setLieux($m['lieux']);
            $new_match->setConditions($m['condition']);
            $new_match->setDate(new \DateTime($m['date']));
            $new_match->setPaysMatch($m['paysMatch']);
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
            [ 'texte' => 'Premier but du match' , 'minute' => 10 , 'match_id' => 1 ],
            [ 'texte' => 'Tres bon jeux de passe ' , 'minute' => 22 , 'match_id' => 2 ],
            [ 'texte' => 'Carton rouge' , 'minute' => 78 , 'match_id' => 3 ],
            [ 'texte' => 'Tres bonne occasion ' , 'minute' => 44 , 'match_id' => 4 ],
            [ 'texte' => 'Occasion pour la premier equipe' , 'minute' => 89 , 'match_id' => 5 ],
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
            [ 'date_debut' => '2020-12-12' , 'date_fin' => '2022-01-06' , 'prix' => 200000 , 'joueur_id' => 1 , 'club_id' => 1 ],
            [ 'date_debut' => '2018-08-24' , 'date_fin' => '2023-12-07' , 'prix' => 100000 , 'joueur_id' => 2 , 'club_id' => 2 ],
            [ 'date_debut' => '2018-09-03' , 'date_fin' => '2022-08-08' , 'prix' => 345000 , 'joueur_id' => 3 , 'club_id' => 3 ],
            [ 'date_debut' => '2019-04-12' , 'date_fin' => '2020-04-09' , 'prix' => 24000 , 'joueur_id' => 4 , 'club_id' => 4 ],
            [ 'date_debut' => '2020-02-18' , 'date_fin' => '2029-03-01'  , 'prix' => 50000 , 'joueur_id' => 5 , 'club_id' => 5 ],
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
            [ 'nom' => '4 4 2'  ],
            [ 'nom' => '4 3 3'  ],
            [ 'nom' => '5 4 1'  ],
            [ 'nom' => '5 3 2'  ],
            [ 'nom' => '4 4 1 1'  ],
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
            [ 'score' => 1 , 'club_first' => 1 , 'club_second' => 2 , 'match_id' => 1 , 'tactique_first_club' => 1  , 'tactique_second_club' => 2 ],
            [ 'score' => 2 , 'club_first' => 1 , 'club_second' => 2, 'match_id' => 2 , 'tactique_first_club' => 1  , 'tactique_second_club' => 2 ],
            [ 'score' => 3 , 'club_first' => 1 , 'club_second' => 2 , 'match_id' => 3 , 'tactique_first_club' => 1  , 'tactique_second_club' => 2 ],
            [ 'score' => 4 , 'club_first' => 1 , 'club_second' => 2 , 'match_id' => 4 , 'tactique_first_club' => 1  , 'tactique_second_club' => 2 ],
            [ 'score' => 5 , 'club_first' => 1 , 'club_second' => 2 , 'match_id' => 5 , 'tactique_first_club' => 1  , 'tactique_second_club' => 2 ],
        ];

        foreach ($participe as $pa)
        {
            $new_participe = new Participe();
            $new_participe->setScore($pa['score']);

            $clubFirst = $manager->getRepository(Club::class)->findOneBy([
                'id' => $pa['club_first']],
                ['id' => 'ASC']);
            $new_participe->setClubFirst($clubFirst);

            $clubSecond = $manager->getRepository(Club::class)->findOneBy([
                'id' => $pa['club_second']],
                ['id' => 'ASC']);
            $new_participe->setClubSecond($clubSecond);

            $match = $manager->getRepository(Matchs::class)->findOneBy([
                'id' => $pa['match_id']],
                ['id' => 'ASC']);
            $new_participe->addMatch($match);

            $tactiqueFirstClub = $manager->getRepository(Tactique::class)->findOneBy([
                'id' => $pa['tactique_first_club']],
                ['id' => 'ASC']);
            $new_participe->setTactiqueFirst($tactiqueFirstClub);

            $tactiqueSecondClub = $manager->getRepository(Tactique::class)->findOneBy([
                'id' => $pa['tactique_second_club']],
                ['id' => 'ASC']);
            $new_participe->setTactiqueSecond($tactiqueSecondClub);



            $manager->persist($new_participe);
        }
        $manager->flush();
    }

    public function load_poste(ObjectManager $manager){
        $poste=[
            [ 'nom' => 'attaquant' , 'tactique_id' => 1 ],
            [ 'nom' => 'milieu offensif' , 'tactique_id' => 2 ],
            [ 'nom' => 'milieu defensif' , 'tactique_id' => 3 ],
            [ 'nom' => 'defenseur centre' , 'tactique_id' => 4 ],
            [ 'nom' => 'defenseur latérale gauche' , 'tactique_id' => 5 ],
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
            [ 'qualite_technique' => 'bon jeux de passe' , 'qualite_mentale' => 'abondonne vite ' , 'qualite_physique' => 'Tres bons physique mais petit'
                , 'qualite_tactique' => 'bonne vision de jeux' , 'nom_agent' => "Fabrice Dieux" , 'date_rapport ' => '2020-12-12', 'joueur_id' => 1
                , 'commente_id'  => 1 , 'mailAgent' => 'agent1@example.com ', 'telephone_agent' => '0623457687',  'adresse_agent' => '23000 Paris'
                , 'equipe1' => 'Lyon' , 'equipe2' => 'Marseille' , 'noteJoueur' => 12 ],
            [ 'qualite_technique' => 'tres bon des les coups francs' , 'qualite_mentale' => 'joueur trop agresif' , 'qualite_physique' => 'grand et costaud'
                , 'qualite_tactique' => 'bon appel de balle' , 'nom_agent' => "David Gishirico", 'date_rapport ' => '2019-12-12', 'joueur_id' => 2 ,
                'commente_id'  => 2 , 'mailAgent' => 'agent2@example.com ', 'telephone_agent' => '0623457687',  'adresse_agent' => '23000 Paris' ,
                'equipe1' => 'Lyon' , 'equipe2' => 'Marseille' , 'noteJoueur' => 17 ],
            [ 'qualite_technique' => 'defenseur aggresif' , 'qualite_mentale' => 'un mental dacier' , 'qualite_physique' => 'faible et grand'
                , 'qualite_tactique' => 'libere de bons espace' , 'nom_agent' => "Pierre Marie", 'date_rapport ' => '2020-09-12', 'joueur_id' => 3 ,
                'commente_id'  => 3 , 'mailAgent' => 'agent3@example.com ', 'telephone_agent' => '0623457687',  'adresse_agent' => '23000 Paris' ,
                'equipe1' => 'Lyon' , 'equipe2' => 'Marseille' , 'noteJoueur' => 13 ],
            [ 'qualite_technique' => 'dribbleur hors pair' , 'qualite_mentale' => 'ne lache pas la partie ' , 'qualite_physique' => 'carrure normal mais jambes muscler' ,
                'qualite_tactique' => 'cree des actions efficace' , 'nom_agent' => "Jean Lapres", 'date_rapport ' => '2020-12-03', 'joueur_id' => 4 ,
                'commente_id'  => 4 , 'mailAgent' => 'agent4@example.com ', 'telephone_agent' => '0623457687',  'adresse_agent' => '23000 Paris' ,
                'equipe1' => 'Lyon' , 'equipe2' => 'Marseille' , 'noteJoueur' => 15 ],
            [ 'qualite_technique' => 'Tres solide sur les appuies et rapide' , 'qualite_mentale' => 'difficile' , 'qualite_physique' => 'grande taille' ,
                'qualite_tactique' => 'a toujours un oeil sur son joueur ' , 'nom_agent' => "Guillaume Acier", 'date_rapport ' => '2018-12-09', 'joueur_id' => 5 ,
                'commente_id'  => 5 , 'mailAgent' => 'agent5@example.com ', 'telephone_agent' => '0623457687',  'adresse_agent' => '23000 Paris' ,
                'equipe1' => 'Lyon' , 'equipe2' => 'Marseille' , 'noteJoueur' => 19 ],
        ];

        foreach ($rapport_specifique as $rp)
        {
            $new_rp = new RapportSpecifique();
            $new_rp->setQualiteTechnique($rp['qualite_technique']);
            $new_rp->setQualiteMentale($rp['qualite_mentale']);
            $new_rp->setQualitePhysique($rp['qualite_physique']);
            $new_rp->setQualiteTactique($rp['qualite_tactique']);
            $new_rp->setNomAgent($rp['nom_agent']);
            try {
                $new_rp->setDateRapport(new \DateTime($rp['date_rapport']));
            } catch (\Exception $e) {
            }

            $joueur = $manager->getRepository(Joueur::class)->findOneBy([
                'id' => $rp['joueur_id']],
                ['id' => 'ASC']);
            $new_rp->setJoueur($joueur);
            $new_rp->setMailAgent($rp['mailAgent']);
            $new_rp->setTelephoneAgent($rp['telephone_agent']);
            $new_rp->setAdresseAgent($rp['adresse_agent']);
            $new_rp->setEquipe1($rp['equipe1']);
            $new_rp->setEquipe2($rp['equipe2']);
            $new_rp->setNoteJoueur($rp['noteJoueur']);
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
            [ 'username' => 'admin' , 'email' => 'exemple1@gmail.com' , 'password' => 'password1' , 'role'=> ['ROLE_ADMIN']  , 'is_active' => true  ],
            [ 'username' => 'client1' , 'email' => 'exemple2@gmail.com' , 'password' => 'password2' , 'role'=> ['ROLE_CLIENT'] , 'is_active' => true  ],
            [ 'username' => 'client2' , 'email' => 'exemple3@gmail.com' , 'password' => 'password3' , 'role'=> ['ROLE_CLIENT'] , 'is_active' => true  ],
            [ 'username' => 'client3' , 'email' => 'exemple4@gmail.com' , 'password' => 'password4' , 'role'=> ['ROLE_CLIENT'] , 'is_active' => true  ],
            [ 'username' => 'client4' , 'email' => 'exemple5@gmail.com' , 'password' => 'password5' , 'role'=> ['ROLE_CLIENT'] , 'is_active' => true  ],
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
