<?php

namespace App\Controller;


use App\Entity\Commentaire;
use App\Entity\Matchs;
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
     */
    public function newRapport(Request $request): Response
    {
        $match = new Matchs();
        $form1 = $this->createForm(MatchType::class, $match);
        $form1->handleRequest($request);

        if ($form1->isSubmitted() && $form1->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($match);
            $entityManager->flush();
            return new Response('ok Match');
        }

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
            'match' => $match,
            'commentaire' => $commentaire,
            'form1' => $form1->createView(),
            'form2' => $form2->createView(),
        ]);
    }



}