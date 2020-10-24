<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;



class Test extends AbstractController
{

    /**
     * @Route("/", name="accueil")
     */
    public function index()
    {

        return $this->render('base.html.twig', [
            'controller_name' => 'Sochaux',
        ]);
    }
}