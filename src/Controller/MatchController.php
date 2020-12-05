<?php


namespace App\Controller;


use App\Entity\RapportSpecifique;
use App\Form\RapportSpecifiqueType;
use App\Repository\RapportSpecifiqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MatchController extends AbstractController
{

    /**
     * @Route("/rapportSpecifiques" , name="rapportSpecifiques_show", methods={"GET"})
     */
    public function index(RapportSpecifiqueRepository $rapportSpecifiqueRepository): Response
    {
        return $this->render('rapportSpecifiques/showRapportSpecifiques.html.twig', [
            'rapportSpecifiques' => $rapportSpecifiqueRepository->findAll(),
        ]);
    }

    /**
     * @Route("/rapportSpecifiques/showRapportSpecifique/{id}", name="rapportSpecifique_show", methods={"GET"})
     */
    public function show(RapportSpecifique $rapportSpecifique): Response
    {

        return $this->render('rapportSpecifiques/showRapportSpecifique.html.twig', [
            'rapportSpecifique' => $rapportSpecifique,
        ]);
    }
    /**
     * @Route("/rapportSpecifiques/createRapportSpecifique", name="rapportSpecifiques_add", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $rapportSpecifique = new RapportSpecifique();
        $form = $this->createForm(RapportSpecifiqueType::class, $rapportSpecifique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($rapportSpecifique);
            $entityManager->flush();
            $this->addFlash('info','Le rapport specifique ' .$rapportSpecifique->getJoueur() . ' vien d etre ajouter !');

            return $this->redirectToRoute('rapportSpecifiques_show');
        }

        return $this->render('rapportSpecifiques/addRapportSpecifique.html.twig', [
            'rapportSpecifique' => $rapportSpecifique,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/rapportSpecifiques/edit/{id}", name="rapportSpecifiques_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, RapportSpecifique $rapportSpecifique): Response
    {
        $form = $this->createForm(RapportSpecifiqueType::class, $rapportSpecifique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('info','Le rapport specifique ' .$rapportSpecifique->getJoueur() . ' vien d etre modfifier !');
            return $this->redirectToRoute('rapportSpecifiques_show');
        }

        return $this->render('rapportSpecifiques/editRapportSpecifique.html.twig', [
            'rapportSpecifique' => $rapportSpecifique,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/rapportSpecifiques/delete/{id}", name="rapportSpecifiques_delete", methods={"DELETE"})
     */
    public function delete(Request $request, RapportSpecifique $rapportSpecifique): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rapportSpecifique->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($rapportSpecifique);
            $entityManager->flush();
            $this->addFlash('info','Le rapport specifique vien d etre Supprimer !');
        }

        return $this->redirectToRoute('rapportSpecifiques_show');
    }
}