<?php

namespace App\Controller;


use App\Entity\Commentaire;
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
     * @Route("/matchs/rapport", name="match_rapport_create", methods={"GET","POST"})
     * @Route("/matchs/showMatchs/{id}", name="match_show", methods={"GET" ,"POST"})
     */
    public function newRapport(Request $request , Matchs $matchs , MatchsRepository $matchsRepository ,ParticipeRepository $participeRepository, CommentaireRepository $commentaireRepository): Response
    {
        $id = $matchs->getId();
        $matchID = $matchsRepository->find($id);
        //$matchs->setTournoi(null);


        $participes = $matchs->getParticipes();
        $equipe2 = null;
        $equipe1 = null;
        $tactique1 = null;
        $tactique2 = null;

        foreach ($participes as $participe){
            $equipe1 = $participe->getClubFirst();
            $equipe2 = $participe->getClubSecond();
            $tactique1 = $participe->getTactiqueFirstClub();
            $tactique2 = $participe->getTactiqueSecondClub();
        }


        $commentaire = new Commentaire();
        $commentaire->setMatchs($matchs);
        $form2 = $this->createForm(CommentaireType::class, $commentaire);
        $form2->handleRequest($request);

        if ($form2->isSubmitted() && $form2->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commentaire);
            $entityManager->flush();
            $this->redirect('/matchs/showMatchs/' . $matchID);
        }

        $commentaires = $commentaireRepository->findBy(['matchs' => $matchs],['minute_commentaire' => 'ASC']);


        return $this->render('rapportMatch/addRapportMatch.html.twig', [
            'match' => $matchID,
            'commentaire' => $commentaire,
            'commentaires' => $commentaires,
            'equipe1' => $equipe1,
            'equipe2' => $equipe2,
            'tactique1' => $tactique1,
            'tactique2' => $tactique2,
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
    public function addTactiquesMatchs(Request $request , Matchs $matchs ): Response
    {

        $participe = $matchs->getParticipeMatch(0);


        $form = $this->createForm(TactiqueType::class, $participe);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirect('/matchs/showMatchs/'.$matchs->getId());
        }

        return $this->render('rapportMatch/tactique/addTactique.html.twig', [
            '$match' => $matchs,
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