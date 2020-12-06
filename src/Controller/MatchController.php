<?php


namespace App\Controller;


use App\Entity\Matchs;
use App\Entity\RapportSpecifique;
use App\Form\MatchType;
use App\Form\RapportSpecifiqueType;
use App\Repository\MatchsRepository;
use App\Repository\RapportSpecifiqueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MatchController extends AbstractController
{

    /**
     * @Route("/matchs" , name="matchs_show", methods={"GET"})
     */
    public function index(MatchsRepository $matchsRepository): Response
    {
        return $this->render('matchs/showMatchs.html.twig', [
            'matchs' => $matchsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/matchs/showMatchs/{id}", name="match_show", methods={"GET"})
     */
    public function show(Matchs $matchs , MatchsRepository $matchsRepository): Response
    {
        $id = $matchs->getId();
        $match = $matchsRepository->find($id);
        return $this->render('rapportMatch/addRapportMatch.html.twig', [
            'match' => $match,
        ]);
    }

    /**
     * @Route("/matchs/createMatchs", name="matchs_add", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $matchs = new Matchs();
        $form = $this->createForm(MatchType::class, $matchs);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($matchs);
            $entityManager->flush();
            $this->addFlash('info','Le maths a  ' .$matchs->getLieux() . ' vien d etre ajouter !');

            return $this->redirect('/matchs/showMatchs/'.$matchs->getId());
        }

        return $this->render('rapportMatch/match/addMatch.html.twig', [
            '$match' => $matchs,
            'formMatch' => $form->createView(),
        ]);
    }

    /**
     * @Route("/matchs/edit/{id}", name="matchs_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Matchs $matchs): Response
    {
        $form = $this->createForm(MatchType::class, $matchs);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('info','Le rapport mathc du ' .$matchs->getDate() . ' vien d etre modfifier !');
            return $this->redirectToRoute('match_show');
        }

        return $this->render('matchs/editMatch.html.twig', [
            'matchs' => $matchs,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/matchs/delete/{id}", name="matchs_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Matchs $matchs): Response
    {
        if ($this->isCsrfTokenValid('delete'.$matchs->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($matchs);
            $entityManager->flush();
            $this->addFlash('info','Le matchs vien d etre Supprimer !');
        }

        return $this->redirectToRoute('matchs_show');
    }
}