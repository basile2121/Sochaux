<?php


namespace App\Controller;


use App\Data\SearchData;
use App\Entity\Notification;
use App\Entity\RapportSpecifique;
use App\Form\RapportSpecifiqueType;
use App\Form\RapportsSearchType;
use App\Repository\NotificationRepository;
use App\Repository\RapportSpecifiqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RapportSpecifiqueController extends AbstractController
{

    /**
     * @Route("/rapportSpecifiques" , name="rapportSpecifiques_show", methods={"GET"})
     */
    public function index(RapportSpecifiqueRepository $rapportSpecifiqueRepository , Request $request): Response
    {
        $data = new SearchData();
        $data->page = $request->get('page' , 1);
        $form = $this->createForm(RapportsSearchType::class , $data);
        $form->handleRequest($request);
        $rapportSpecifiques = $rapportSpecifiqueRepository->findSearch($data);
        return $this->render('rapportSpecifiques/showRapportSpecifiques.html.twig', [
            'rapportSpecifiques' => $rapportSpecifiques,
            'formSearch' => $form->createView()
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
        $rapportSpecifique->setDateRapport(new \DateTime());

        //Creation de la notification associée au rapportSpecifique Crée
        $notification = new Notification();
        $notification->setDateEnvoie(new \DateTime());
        $notification->setRapportSpecifique($rapportSpecifique);

        $form = $this->createForm(RapportSpecifiqueType::class, $rapportSpecifique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($notification);
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
        $notifications = $rapportSpecifique->getNotifications();
        if ($this->isCsrfTokenValid('delete'.$rapportSpecifique->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            foreach($notifications as $notification){
                $entityManager->remove($notification);
                $entityManager->flush();
            }
            $entityManager->remove($rapportSpecifique);
            $entityManager->flush();
            $this->addFlash('info','Le rapport specifique vien d etre Supprimer !');
        }

        return $this->redirectToRoute('rapportSpecifiques_show');
    }
}