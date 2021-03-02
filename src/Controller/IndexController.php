<?php

namespace App\Controller;

use App\Repository\NotificationRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index_index")
     */
    public function index(Request $request , NotificationRepository $notificationRepository)
    {

//        if(! is_null($this->getUser())){
//            echo "<br>";
//            echo " id: ".$this->getUser()->getId();
//            echo " roles :   ";
//            print_r($this->getUser()->getRoles());
//            die();
//        }
        $notifications = $notificationRepository->findBy([],['dateEnvoie' => 'DESC']);
        $count = 0;
        foreach ($notifications as $not) {
            $count++;
        }

        if($this->isGranted('ROLE_ADMIN')) {
            // return $this->redirectToRoute('accueil');
            return $this->render('accueil.html.twig', [
                'notifications' => $notifications,
            ]);
        }
        if($this->isGranted('ROLE_CLIENT')) {
            // return $this->redirectToRoute('accueil');
            return $this->render('accueil.html.twig');
        }
        return $this->render('accueil.html.twig', [
            'notifications' => $notifications,
            'nbNotification' => $count
        ]);

    }




}