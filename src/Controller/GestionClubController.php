<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Entity\Club;
use App\Form\ClubsSearchType;
use App\Form\ClubType;
use App\Form\JoueursSearchType;
use App\Repository\ClubRepository;
use App\Repository\ContratRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\VarDumper\Cloner\Data;


class GestionClubController extends AbstractController
{

    /**
     * @Route("/gestion" , name="gestion_show", methods={"GET"})
     */
    public function index(ContratRepository $contratRepository, Request $request): Response
    {
        $contrats = $contratRepository->findAllContrat();

        return $this->render('gestionClub/showGestion.html.twig', [
            'contrats' => $contrats,
        ]);
    }

}