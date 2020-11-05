<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index_index")
     */
    public function index(Request $request)
    {

//        if(! is_null($this->getUser())){
//            echo "<br>";
//            echo " id: ".$this->getUser()->getId();
//            echo " roles :   ";
//            print_r($this->getUser()->getRoles());
//            die();
//        }

        if($this->isGranted('ROLE_ADMIN')) {
            // return $this->redirectToRoute('accueil');
            return $this->render('accueil.html.twig');
        }
        if($this->isGranted('ROLE_CLIENT')) {
            // return $this->redirectToRoute('accueil');
            return $this->render('accueil.html.twig');
        }
        return $this->render('accueil.html.twig');

    }
}