<?php

namespace App\Controller;


use App\Entity\Commentaire;
use App\Entity\Matchs;
use App\Form\CommentaireType;
use App\Form\MatchType;
use App\Repository\CommentaireRepository;
use App\Repository\MatchsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CommentaireController extends AbstractController
{

    /**
     * @Route("/commentaire" , name="commentaire_show", methods={"GET"})
     */
    public function index(CommentaireRepository $commentaireRepository): Response
    {
        return $this->render('commentaires/showCommentaires.html.twig', [
            'commentaires' => $commentaireRepository->findAll(),

        ]);
    }

    /**
     * @Route("/commentaire/{id}" , name="commentaire_show_match", methods={"GET"})
     */
    public function indexMatch(CommentaireRepository $commentaireRepository , Matchs $matchs): Response
    {
        return $this->render('rapportMatch/commentaire/showCommentaire.html.twig', [
            'commentaires' => $commentaireRepository->findBy($matchs),

        ]);
    }




}