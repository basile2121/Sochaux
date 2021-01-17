<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Entity\Club;
use App\Form\ClubsSearchType;
use App\Form\ClubType;
use App\Form\JoueursSearchType;
use App\Repository\ClubRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\VarDumper\Cloner\Data;


class ClubController extends AbstractController
{

    /**
     * @Route("/clubs" , name="clubs_show", methods={"GET"})
     */
    public function index(ClubRepository $clubRepository , Request $request): Response
    {
        $data = new SearchData();
        $data->page = $request->get('page' , 1);
        $form = $this->createForm(ClubsSearchType::class , $data);
        $form->handleRequest($request);
        $clubs = $clubRepository->findSearch($data);

        return $this->render('clubs/showClubs.html.twig', [
            'clubs' => $clubs,
            'formSearch' => $form->createView()
        ]);
    }

    /**
     * @Route("/clubs/showClub/{id}", name="club_show", methods={"GET"})
     */
    public function show(Club $club): Response
    {

        return $this->render('clubs/showClub.html.twig', [
            'club' => $club,
        ]);
    }
    /**
     * @Route("/clubs/createClub", name="clubs_add", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $club = new Club();
        $form = $this->createForm(ClubType::class, $club);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($club);
            $entityManager->flush();
            $this->addFlash('info','Le club ' .$club->getNomClub() . ' vien d etre ajouter !');

            return $this->redirectToRoute('clubs_show');
        }

        return $this->render('clubs/addClub.html.twig', [
            'club' => $club,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/clubs/edit/{id}", name="clubs_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Club $club): Response
    {
        $form = $this->createForm(ClubType::class, $club);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('info','Le club ' .$club->getNomClub() . ' vien d etre modfifier !');
            return $this->redirectToRoute('clubs_show');
        }

        return $this->render('clubs/editClub.html.twig', [
            'club' => $club,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/clubs/delete/{id}", name="clubs_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Club $club): Response
    {
        if ($this->isCsrfTokenValid('delete'.$club->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($club);
            $entityManager->flush();
            $this->addFlash('info','Le club vien d etre Supprimer !');
        }

        return $this->redirectToRoute('clubs_show');
    }
}
