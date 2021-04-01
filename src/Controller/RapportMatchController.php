<?php

namespace App\Controller;


use App\Entity\Commentaire;
use App\Entity\Joueur;
use App\Entity\Matchs;
use App\Entity\Participe;
use App\Entity\Tournoi;
use App\Form\CommentaireType;
use App\Form\MatchType;
use App\Form\MatchTypeTournoi;
use App\Form\ParticipeType;
use App\Form\TactiqueType;
use App\Form\TournoiType;
use App\Repository\CommentaireRepository;
use App\Repository\JoueurRepository;
use App\Repository\MatchsRepository;
use App\Repository\ParticipeRepository;
use App\Repository\TournoiRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;


class RapportMatchController extends AbstractController
{
    /**
     * @Route("/matchs/genereRapportPDF/{id}" , name="match_genereRapportPDF", methods={"GET","POST"})
     */
    public function generePDF(MatchsRepository $matchsRepository,Request $request,JoueurRepository $joueurRepository){
        define("FPDF_FONTPATH","fpdf/font/");
        require("../fpdf/fpdf.php");
        $entityManager = $this->getDoctrine()->getManager();
        $match = $matchsRepository->find($request->get('id'));

        $postes = ["ligne1E1","ligne2E1","ligne3E1","ligne4E1","gardienE1","ligne1E2","ligne2E2","ligne3E2","ligne4E2","gardienE2"];
        foreach ($postes as $poste){
            if($_POST[$poste]!="") $donnees[$poste] =  explode(',',$_POST[$poste]);
        }

        foreach ($donnees as $index=>$tab){

            if (sizeof($tab) > 0){

                for($i = 0;$i<sizeof($tab);$i++){

                    if($tab[$i] != ""){
                        $joueur = $joueurRepository->find($tab[$i]);

                        $donnees[$index] = $joueur;
                    }
                }
            }else{
                $donnees[$index] = null;
            }
        }



        if(isset($donnees["gardienE1"])) $match->addGardienE1($donnees["gardienE1"]);
        if(isset($donnees["ligne1E1"])) $match->addLigne1E1($donnees["ligne1E1"]);
        if(isset($donnees["ligne2E1"])) $match->addLigne2E1($donnees["ligne2E1"]);
        if(isset($donnees["ligne3E1"])) $match->addLigne3E1($donnees["ligne3E1"]);
        if(isset($donnees["ligne4E1"])) $match->addLigne4E1($donnees["ligne4E1"]);
        if(isset($donnees["gardienE2"])) $match->addGardienE2($donnees["gardienE2"]);
        if(isset($donnees["ligne1E2"])) $match->addLigne1E2($donnees["ligne1E2"]);
        if(isset($donnees["ligne2E2"])) $match->addLigne2E2($donnees["ligne2E2"]);
        if(isset($donnees["ligne3E2"])) $match->addLigne3E2($donnees["ligne3E2"]);
        if(isset($donnees["ligne4E2"])) $match->addLigne4E2($donnees["ligne4E2"]);
        // dd($match->getLigne2E1()->get(0));

        $matchID = $match;

        $entityManager->persist($match);
        $entityManager->flush();

        // dd($match);
        $pdf = new \FPDF("P","pt","A4");
        $pdf ->Open(); //indique que l'on crée un fichier PDF
        $pdf ->AddPage(); //permet d'ajouter une page
        $pdf ->SetFont('Helvetica','B',11); //choix de la police
        $pdf ->SetXY(330, 25); // indique des coordonnées pour
        $terrain1 = "../public/images/terrain.png";
        $slot = "../public/images/slot.jpg";
        $terrain2 = "../public/images/terrain.png";

        $participes = $match->getParticipes();
        foreach ($participes as $participe){
            $nomEquipe1 = $participe->getClubFirst();
            $nomEquipe2 = $participe->getClubSecond();
            $tactique1 = $participe->getTactiqueFirstClub();
            $tactique2 = $participe->getTactiqueSecondClub();
        }
        $image1 = "../public/images/logo_fc_sochaux.jpg";
        $pdf->SetFont('Arial','',12);


        $pdf->Cell( 100, 100, $pdf->Image($terrain1, 350, 150, 150), 0, 0, 'L', false );

        switch ($tactique1->getNomTactique()){
            case "4 4 2":
                include("../public/tactiques/442-1.php");
                break;
            case "4 3 3":
                include("../public/tactiques/433-1.php");
                break;
            case "5 4 1":
                include("../public/tactiques/541-1.php");
                break;
            case "4 4 1 1":
                include("../public/tactiques/4411-1.php");
                break;
            case "5 3 2":
                include("../public/tactiques/532-1.php");
                break;
        }

        $pdf->Cell( 100, 100, $pdf->Image($terrain2, 350, 450, 150), 0, 0, 'L', false );
        switch ($tactique2->getNomTactique()){
            case "4 4 2":
                include("../public/tactiques/442-2.php");
                break;
            case "4 3 3":
                include("../public/tactiques/433-2.php");
                break;
            case "5 4 1":
                include("../public/tactiques/541-2.php");
                break;
            case "4 4 1 1":
                include("../public/tactiques/4411-2.php");
                break;
            case "5 3 2":
                include("../public/tactiques/532-2.php");
                break;
        }

        $pdf->Cell( 100, 100, $pdf->Image($image1, -10, 10, 150), 0, 0, 'L', false );
        $pdf->SetX(170);
        $pdf->SetFillColor(230,230,0);
        $pdf->Cell(240,45,"Rapport de match",1,1,'C',1);


        $pdf->SetX(230);

        $pdf->SetY(220);
        $pdf->Cell(200,45,"Equipe 1 : ".$nomEquipe1,1,1,'C',0);
        $pdf->SetX(230);
        $pdf->SetY(520);
        $pdf->Cell(200,45,"Equipe 2 : ".$nomEquipe2,1,1,'C',0);


        $pdf->SetY(1210);
        $pdf->SetTopMargin(80);
        $pdf->SetFillColor(109,152,206);
        $pdf->SetFont('Arial','B',13);
        $pdf->Cell(535,15,"INFORMATIONS",1,1,'C',1);
        $pdf->Ln();
        $pdf->SetX(30);
        $pdf->SetFont('Arial','',11);
        $pdf->Cell(200,15,"Conditions : ",1,0,'C',0);
        $pdf->Cell(335,15,$match->getConditions(),1,1,'C',0);;
        $pdf->SetX(30);
        $pdf->Cell(200,15,"Lieu : ",1,0,'C',0);
        $pdf->Cell(335,15,$match->getLieux(),1,1,'C',0);
        $pdf->SetX(30);
        $pdf->Cell(200,15,"Pays : ",1,0,'C',0);
        $pdf->Cell(335,15,$match->getPaysMatch(),1,1,'C',0);
        $pdf->SetX(30);
        $pdf->Cell(200,15,"Tournoi : ",1,0,'C',0);
        $pdf->Cell(335,15,$match->getTournoi(),1,1,'C',0);
        $pdf->SetFillColor(109,152,206);
        $pdf->setX(130);
        $pdf->SetY(200);
        $pdf->SetFont('Arial','B',13);
        $pdf->Cell(535,15,"COMMENTAIRES",1,1,'C',1);
        $pdf->Ln();
        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(200,15,"Texte",1,0,'C',0);
        $pdf->Cell(335,15,"Minutes comentaire",1,1,'C',0);
        foreach ($match->getCommentaires() as $commentaire){
            $pdf->SetFont('Arial','',11);
            $pdf->Cell(200,15,$commentaire,1,0,'C',0);
            $pdf->Cell(335,15,$commentaire->getMinuteCommentaire(),1,1,'C',0);
        }

        $equipe1 = $joueurRepository->findJoinClub($nomEquipe1);
        $equipe2 = $joueurRepository->findJoinClub($nomEquipe2);
        $pdf->Ln();
        $pdf->Ln();



        $pdf->SetFillColor(230,230,0);
        $pdf->Cell(535,15,"JOUEURS EQUIPE 1",1,1,'C',1);
        $pdf->SetFont('Arial','B',11);
        foreach ($equipe1 as $joueur){
            $pdf->SetFont('Arial','',11);
            $pdf->Cell(535,15,$joueur["nom"]." ".$joueur["prenom"],1,0,'C',0);
        }
        $pdf->Ln();
        $pdf->Ln();

        $pdf->SetTopMargin(100);
        $pdf->SetFillColor(230,230,0);
        $pdf->Cell(535,15,"JOUEURS EQUIPE 2",1,1,'C',1);
        $pdf->SetFont('Arial','B',11);
        foreach ($equipe2 as $joueur){
            $pdf->SetFont('Arial','',11);
            $pdf->Cell(535,15,$joueur["nom"]." ".$joueur["prenom"],1,0,'C',0);
        }




        $pdf->SetFont('Arial','B',15);
        $pdf->SetX(450);
        $pdf ->Output(); //génère le PDF et l'affiche
        die("");
    }
    /**
     * @Route("/matchs/rapport", name="match_rapport_create", methods={"GET","POST"})
     * @Route("/matchs/showMatchs/{id}", name="match_show", methods={"GET" ,"POST"})
     */
    public function newRapport(Request $request , Matchs $match , MatchsRepository $matchsRepository ,JoueurRepository $joueurRepository, CommentaireRepository $commentaireRepository): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $id = $match->getId();
        $matchID = $matchsRepository->find($id);
        //$matchs->setTournoi(null);

        $participes = $match->getParticipes();
        $nomEquipe2 = null;
        $nomEquipe1 = null;
        $tactique1 = null;
        $tactique2 = null;



        foreach ($participes as $participe){
            $nomEquipe1 = $participe->getClubFirst();
            $nomEquipe2 = $participe->getClubSecond();
            $tactique1 = $participe->getTactiqueFirstClub();
            $tactique2 = $participe->getTactiqueSecondClub();
        }


        $equipe1 = $joueurRepository->findJoinClub($nomEquipe1);
        $equipe2 = $joueurRepository->findJoinClub($nomEquipe2);

        $commentaire = new Commentaire();
        $commentaire->setMatchs($match);
        $form2 = $this->createForm(CommentaireType::class, $commentaire);
        $form2->handleRequest($request);

        $form = $this->createForm(MatchType::class, $match);
        $form->handleRequest($request);
        if ($form2->isSubmitted() && $form2->isValid()) {
            $entityManager->persist($commentaire);
            $entityManager->flush();
            $this->redirect('/matchs/showMatchs/' . $matchID);
        }

        if(isset($_POST["validForm"])){

            $postes = ["ligne1E1","ligne2E1","ligne3E1","ligne4E1","gardienE1","ligne1E2","ligne2E2","ligne3E2","ligne4E2","gardienE2"];
            foreach ($postes as $poste){
                if($_POST[$poste]!="") $donnees[$poste] =  explode(',',$_POST[$poste]);
            }

            foreach ($donnees as $index=>$tab){

                if (sizeof($tab) > 0){

                    for($i = 0;$i<sizeof($tab);$i++){

                        if($tab[$i] != ""){
                            $joueur = $joueurRepository->find($tab[$i]);

                            $donnees[$index] = $joueur;
                        }
                    }
                }else{
                    $donnees[$index] = null;
                }
            }



            if(isset($donnees["gardienE1"])) $match->addGardienE1($donnees["gardienE1"]);
            if(isset($donnees["ligne1E1"])) $match->addLigne1E1($donnees["ligne1E1"]);
            if(isset($donnees["ligne2E1"])) $match->addLigne2E1($donnees["ligne2E1"]);
            if(isset($donnees["ligne3E1"])) $match->addLigne3E1($donnees["ligne3E1"]);
            if(isset($donnees["ligne4E1"])) $match->addLigne4E1($donnees["ligne4E1"]);
            if(isset($donnees["gardienE2"])) $match->addGardienE2($donnees["gardienE2"]);
            if(isset($donnees["ligne1E2"])) $match->addLigne1E2($donnees["ligne1E2"]);
            if(isset($donnees["ligne2E2"])) $match->addLigne2E2($donnees["ligne2E2"]);
            if(isset($donnees["ligne3E2"])) $match->addLigne3E2($donnees["ligne3E2"]);
            if(isset($donnees["ligne4E2"])) $match->addLigne4E2($donnees["ligne4E2"]);
            // dd($match->getLigne2E1()->get(0));

            $matchID = $match;

            $entityManager->persist($match);
            $entityManager->flush();
            // dd($matchsRepository->find(4));

            // dd($matchsRepository->find(4));
        }



        $commentaires = $commentaireRepository->findBy(['matchs' => $match],['minute_commentaire' => 'ASC']);
        //dd($matchID->getGardienE2()->unwrap()->toArray());

        return $this->render('rapportMatch/addRapportMatch.html.twig', [
            'match' => $matchID,
            'commentaire' => $commentaire,
            'commentaires' => $commentaires,
            'nomEquipe1' => $nomEquipe1,
            'nomEquipe2' => $nomEquipe2,
            'equipe1'=> $equipe1,
            'equipe2'=> $equipe2,
            'tactique1' => $tactique1,
            'tactique2' => $tactique2,
            'form' => $form->createView(),
            'form2' => $form2->createView()
        ]);

    }




    public function addCommentaire(Request $request , EntityManagerInterface $em  )
    {
        if(!$this->isCsrfTokenValid('commentaire_add', $request->get('token'))) {
            throw new  InvalidCsrfTokenException('Invalid CSRF token Creation commentaire');
        }
        $donnees['texte']=$request->request->get('texte');
        $donnees['minute_commentaire']=$request->request->get('minute_commentaire');
        $donnees['matchs_id']=$request->request->get('matchs_id');

        $erreurs= null;
        if( empty($erreurs))
        {
            $matchs = $em->getRepository(Matchs::class)->find($donnees['matchs_id']);
            $commentaire = new Commentaire();
            $commentaire->setMinuteCommentaire($donnees['minute_commentaire'])
                ->setTexte($donnees['texte'])
                ->setMatchs($matchs);
            $em->persist($commentaire);
            $em->flush();

            return $this->redirectToRoute('redirect');
        }
        return $this->render('route.html.twig', ['donnees'=>$donnees]);
    }

    /**
     * @Route("/tactiques/addTactiques/{id}", name="tactique_add_matchs", methods={"GET","POST"})
     */
    public function addTactiquesMatchs(Request $request , MatchsRepository $matchsRepository ): Response
    {

        $participe = $matchsRepository->find($request->get('id'))->getParticipeMatch(0);


        $form = $this->createForm(TactiqueType::class, $participe);
        $form->handleRequest($request);
        $match = $matchsRepository->find($request->get('id'));

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirect('/matchs/showMatchs/'.$match->getId());
        }

        return $this->render('rapportMatch/tactique/addTactique.html.twig', [
            '$match' =>  $match,
            'formTactique' => $form->createView(),
        ]);
    }


    /**
     * @Route("/clubs/addClubs/{id}", name="club_add_matchs", methods={"GET","POST"})
     */
    public function addClubsMatch(Request $request , Matchs $matchs): Response
    {
        $participe = new Participe();
        $participe->addMatch($matchs);
        $form = $this->createForm(ParticipeType::class, $participe);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($participe);
            $entityManager->flush();
            $this->addFlash('info','Les clubs sont ajoutés !');

            return $this->redirect('/matchs/showMatchs/'.$matchs->getId());
        }

        return $this->render('rapportMatch/club/addClub.html.twig', [
            '$match' => $matchs,
            'formClub' => $form->createView(),
        ]);
    }


    /**
     * @Route("/tournois/addTournoi/{id}", name="tournoi_add_matchs", methods={"GET","POST"})
     */
    public function chooseTournoiMatch(Request $request, Matchs $matchs): Response
    {
        $form = $this->createForm(MatchTypeTournoi::class, $matchs );
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirect('/matchs/showMatchs/'.$matchs->getId());
        }

        return $this->render('rapportMatch/match/editMatchTournoi.html.twig', [
            'matchs' => $matchs,
            'formMatchTournoi' => $form->createView(),
        ]);
    }


}