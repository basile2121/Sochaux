<?php

namespace App\Controller;

use App\Entity\Contrat;
use App\Form\ContratType;
use App\Repository\ContratRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ContratController extends AbstractController
{

    /**
     * @Route("/contrats" , name="contrats_show", methods={"GET"})
     */
    public function index(ContratRepository $contratRepository): Response
    {
        $contrats = $contratRepository->findAll();
        return $this->render('contrats/showContrats.html.twig', [
            'contrats' => $contrats,
        ]);
    }

    /**
     * @Route("/contrats/showContrat/{id}", name="contrat_show", methods={"GET"})
     */
    public function show(Contrat $contrat): Response
    {

        return $this->render('contrats/showContrat.html.twig', [
            'contrat' => $contrat,
        ]);
    }
    /**
     * @Route("/contrats/createContrat", name="contrats_add", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $contrat = new Contrat();
        $form = $this->createForm(ContratType::class, $contrat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contrat);
            $entityManager->flush();
            $this->addFlash('info','Le contrat du joueur ' .$contrat->getJoueur()->getNom() . ' vien d etre ajouter !');

            return $this->redirectToRoute('joueurs_show');
        }

        return $this->render('contrats/addContrat.html.twig', [
            'contrat' => $contrat,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/contrats/edit/{id}", name="contrats_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Contrat $contrat): Response
    {
        $form = $this->createForm(ContratType::class, $contrat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('info','Le contrat du joueur ' .$contrat->getJoueur()->getNom() . ' vien d etre modifier !');
            return $this->redirectToRoute('contrats_show');
        }

        return $this->render('contrats/editContrat.html.twig', [
            'contrat' => $contrat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/contrats/delete/{id}", name="contrats_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Contrat $contrat): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contrat->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($contrat);
            $entityManager->flush();
            $this->addFlash('info','Le contrat vien d etre Supprimer !');
        }

        return $this->redirectToRoute('contrats_show');
    }
}
