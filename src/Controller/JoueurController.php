<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Entity\Contrat;
use App\Entity\Joueur;
use App\Form\ContratType;
use App\Form\JoueursSearchType;
use App\Form\JoueurType;
use App\Repository\ContratRepository;
use App\Repository\JoueurRepository;
use Doctrine\ORM\EntityManagerInterface;
use http\Client\Curl\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class JoueurController extends AbstractController
{

    /**
     * @Route("/joueurs" , name="joueurs_show", methods={"GET"})
     */
    public function index(JoueurRepository $joueurRepository , Request $request): Response
    {

        $data = new SearchData();
        $data->page = $request->get('page' , 1);
        $form= $this->createForm(JoueursSearchType::class , $data);
        $form->handleRequest($request);
        $joueurs = $joueurRepository->findSearch($data);

        //$joueurs = $joueurRepository->findBy([],['nom' => 'DESC']);
        return $this->render('joueurs/showJoueurs.html.twig', [
            'joueurs' => $joueurs,
            'formSearch' => $form->createView()
        ]);
    }

    /**
     * @Route("/joueurs/showJoueur/{id}", name="joueur_show", methods={"GET"})
     */
    public function show(Joueur $joueur): Response
    {

        return $this->render('joueurs/showJoueur.html.twig', [
            'joueur' => $joueur,
        ]);
    }

    /**
     * @Route("/joueurs/showRapportSpecifique/{id}", name="joueur_rapportSpecifique_show", methods={"GET"})
     */
    public function showRapport(Joueur $joueur): Response
    {
        $rapports = $joueur->getRapportSpecifiques();


        return $this->render('joueurs/showRapportsJoueurs.html.twig', [
            'rapportSpecifiques' => $rapports,
        ]);
    }

    /**
     * @Route("/joueurs/createJoueur", name="joueurs_add", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $joueur = new Joueur();
        $form = $this->createForm(JoueurType::class, $joueur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $joueur->getPhoto();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('images_directory'),
                $fileName
            );
            $entityManager = $this->getDoctrine()->getManager();
            $joueur->setPhoto($fileName);
            $entityManager->persist($joueur);
            $entityManager->flush();
            $this->addFlash('info','Le joueur ' .$joueur->getNom() . ' vien d etre ajouter !');

            return $this->redirectToRoute('joueurs_show');
        }

        return $this->render('joueurs/addJoueur.html.twig', [
            'joueur' => $joueur,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/joueurs/edit/{id}", name="joueur_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Joueur $joueur): Response
    {

        $joueur->setPhoto(
            new File($this->getParameter('images_directory').'/'.$joueur->getPhoto()
            ));
        $form = $this->createForm(JoueurType::class, $joueur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $joueur->getPhoto();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('images_directory'),
                $fileName
            );
            $joueur->setPhoto($fileName);

            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('info','Le joueur ' .$joueur->getNom() . ' vien d etre modfifier !');
            return $this->redirectToRoute('joueurs_show');
        }

        return $this->render('joueurs/editJoueur.html.twig', [
            'joueur' => $joueur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/joueurs/delete/{id}", name="joueur_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Joueur $joueur): Response
    {
        $rapport = $joueur->getRapportSpecifiques();
        $contrat = $joueur->getContrats();
        if ($this->isCsrfTokenValid('delete'.$joueur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            foreach ($contrat as $c){
                $entityManager->remove($c);
                $entityManager->flush();
            }
            foreach ($rapport as $r){
                $entityManager->remove($r);
                $entityManager->flush();
            }
            $entityManager->remove($joueur);
            $entityManager->flush();
            $this->addFlash('info','Le joueur vien d etre Supprimer !');
        }

        return $this->redirectToRoute('joueurs_show');
    }

    /**
     * @Route("/joueurs/contrats/createContrat/{id}", name="joueurs_contrats_add", methods={"GET","POST"})
     */
    public function addContratJoueur(Request $request , Joueur $joueur): Response
    {
        $contrat = new Contrat();
        $contrat->setJoueur($joueur);
        $form = $this->createForm(ContratType::class, $contrat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contrat);
            $entityManager->flush();
            $this->addFlash('info','Le contrat du joueur ' .$contrat->getJoueur()->getNom() . ' vien d etre ajouter !');

            return $this->redirectToRoute('contrats_show');
        }

        return $this->render('contrats/addContrat.html.twig', [
            'contrat' => $contrat,
            'form' => $form->createView(),
        ]);
    }
}