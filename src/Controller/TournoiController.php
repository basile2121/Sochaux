<?php

namespace App\Controller;

use App\Entity\Club;
use App\Entity\Tournoi;
use App\Form\ClubType;
use App\Form\TournoiType;
use App\Repository\ClubRepository;
use App\Repository\TournoiRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class TournoiController extends AbstractController
{

    /**
     * @Route("/tournois" , name="tournois_show", methods={"GET"})
     */
    public function index(TournoiRepository $tournoiRepository): Response
    {
        return $this->render('tournois/showTournois.html.twig', [
            'tournois' => $tournoiRepository->findAll(),
        ]);
    }

    /**
     * @Route("/tournois/showTournoi/{id}", name="tournoi_show", methods={"GET"})
     */
    public function show(Tournoi $tournoi): Response
    {

        return $this->render('tournois/showTournoi.html.twig', [
            'tournoi' => $tournoi,
        ]);
    }
    /**
     * @Route("/tournois/createTournoi", name="tournois_add", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tournoi = new Tournoi();
        $form = $this->createForm(TournoiType::class, $tournoi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tournoi);
            $entityManager->flush();
            $this->addFlash('info','Le tournoi ' .$tournoi->getNomTournoi() . ' vien d etre ajouter !');

            return $this->redirectToRoute('tournois_show');
        }

        return $this->render('tournois/addTournoi.html.twig', [
            'tournoi' => $tournoi,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/tournois/edit/{id}", name="tournois_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Tournoi $tournoi): Response
    {
        $form = $this->createForm(TournoiType::class, $tournoi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('info','Le tournoi ' .$tournoi->getNomTournoi() . ' vien d etre modfifier !');
            return $this->redirectToRoute('tournois_show');
        }

        return $this->render('tournois/editTournoi.html.twig', [
            'tournoi' => $tournoi,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/tournois/delete/{id}", name="tournois_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Tournoi $tournoi): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tournoi->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tournoi);
            $entityManager->flush();
            $this->addFlash('info','Le tournoi vien d etre Supprimer !');
        }

        return $this->redirectToRoute('tournois_show');
    }
}
