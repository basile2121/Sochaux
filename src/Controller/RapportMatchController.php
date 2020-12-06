<?php

namespace App\Controller;


use App\Entity\Commentaire;
use App\Entity\Matchs;
use App\Entity\Participe;
use App\Form\CommentaireType;
use App\Form\MatchType;
use App\Repository\MatchsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class RapportMatchController extends AbstractController
{

    /**
     * @Route("/matchs" , name="matchs_show", methods={"GET"})
     */
    public function index(MatchsRepository $matchsRepository): Response
    {
        return $this->render('joueurs/showJoueurs.html.twig', [
            'matchs' => $matchsRepository->findAll(),

        ]);
    }


    /**
     * @Route("/matchs/rapport", name="match_rapport_create", methods={"GET","POST"})
     * @Route("/matchs/showMatchs/{id}", name="match_show", methods={"GET"})
     */
    public function newRapport(Request $request , Matchs $matchs , MatchsRepository $matchsRepository): Response
    {

        $id = $matchs->getId();
        $matchID = $matchsRepository->find($id);
        $participe = new Participe();
        $participe->s;


        $commentaire = new Commentaire();
        $form2 = $this->createForm(CommentaireType::class, $commentaire);
        $form2->handleRequest($request);

        if ($form2->isSubmitted() && $form2->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commentaire);
            $entityManager->flush();
            return new Response('ok commentaire');
        }

        return $this->render('rapportMatch/addRapportMatch.html.twig', [
            'match' => $matchID,
            'commentaire' => $commentaire,
            'form2' => $form2->createView(),
        ]);
    }



}