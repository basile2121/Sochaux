<?php


namespace App\Controller;


namespace App\Controller;
define("FPDF_FONTPATH","fpdf/font/");
require("../fpdf/fpdf.php");
use App\Data\SearchData;
use App\Entity\Notification;
use App\Entity\RapportSpecifique;
use App\Form\RapportSpecifiqueType;
use App\Form\RapportsSearchType;
use App\Repository\NotificationRepository;
use App\Repository\RapportSpecifiqueRepository;
use phpDocumentor\Reflection\Types\String_;
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

        $form = $this->createForm(RapportSpecifiqueType::class, $rapportSpecifique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($rapportSpecifique);
            $entityManager->flush();
            $this->addFlash('info','Le rapport specifique ' .$rapportSpecifique->getJoueur() . ' vien d etre ajouter !');

            if ($rapportSpecifique->getNoteJoueur() >= 14){
                //Creation de la notification associée au rapportSpecifique Crée
                $notification = new Notification();
                $notification->setDateEnvoie(new \DateTime());
                $notification->setRapportSpecifique($rapportSpecifique);
                $entityManager->persist($notification);
                $entityManager->flush();
            }

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

    /**
     * @Route("/rapportSpecifiques/genereRapportPDF/{id}" , name="genereRapportPDF", methods={"GET"})
     * @throws \Exception
     */
    public function genereRapportPDF(RapportSpecifique $rapportSpecifique): Response
    {
        $pdf = new \FPDF("P","pt","A4");
        $pdf ->Open(); //indique que l'on crée un fichier PDF
        $pdf ->AddPage(); //permet d'ajouter une page
        $pdf ->SetFont('Helvetica','B',11); //choix de la police
        $pdf ->SetXY(330, 25); // indique des coordonnées pour
        $image1 = "../public/images/logo_fc_sochaux.jpg";
        $pdf->Cell( 100, 100, $pdf->Image($image1, -10, 10, 150), 0, 0, 'L', false );
        $prenom = $rapportSpecifique->getJoueur()->getPrenom();
        $nom =  $rapportSpecifique->getJoueur()->getNom();
        $titre= $nom ." ". $prenom;
        $pdf->SetFont('Arial','B',15);
        $w=$pdf->GetStringWidth($titre)-6;
        $pdf->SetX(($w+400)/2);
        $pdf->SetFillColor(230,230,0);
        $pdf->SetLineWidth(1);
        $pdf->SetX(200);
        $pdf->Cell(200,45,$titre,1,1,'C',1);
        $pdf->SetFont('Arial','',12);
        $pdf->Ln(10);
        $pdf->SetTitle($titre);

        $pdf->SetY(100);
        $pdf->SetFont('Arial','B',12);
        $pdf->SetX(140);
        $pdf->Cell(330,25,("Informations de l'agent ".$rapportSpecifique->getNomAgent()),0,0,'C',0);

        $pdf->SetFont('Arial','',12);
        $pdf->Ln();
        $pdf->SetX(70);
        $pdf->Cell(188,40,utf8_decode("Mail Agent"),1,0,'C',0);
        $pdf ->Cell(288,40,utf8_decode($rapportSpecifique->getMailAgent()),1,0,'C',0); //insertion d'une ligne
        $pdf->Ln();
        $pdf->SetX(70);
        $pdf->Cell(188,40,utf8_decode("Telephone Agent"),1,0,'C',0);
        $pdf ->Cell(288,40,utf8_decode( $rapportSpecifique->getTelephoneAgent()),1,0,'C',0); //insertion d'une ligne
        $pdf->Ln();
        $pdf->SetX(70);
        $pdf->Cell(188,40,utf8_decode("Adresse Agent"),1,0,'C',0);
        $pdf ->Cell(288,40,utf8_decode( $rapportSpecifique->getAdresseAgent()),1,0,'C',0); //insertion d'une ligne
        $pdf->Ln();


        $pdf->SetY(270);
        $pdf->SetFont('Arial','B',12);
        $pdf->SetX(140);
        $pdf->Cell(330,25,("Le rapport specifique de ".$rapportSpecifique->getJoueur()),0,0,'C',0);

        $pdf->SetFont('Arial','',12);
        $pdf->SetY(305);
        $pdf->SetX(70);
        $pdf->Cell(188,40,"Date Rapport",1,0,'C',0);
        $date = $rapportSpecifique->getDateRapport()->format('d/m/Y');
        $pdf ->Cell(288,40, $date,1,0,'C',0); //insertion d'une ligne
        $pdf->Ln();
        $pdf->SetX(70);
        $pdf->Cell(188,40,utf8_decode("Match"),1,0,'C',0);
        $pdf ->Cell(288,40, utf8_decode($rapportSpecifique->getEquipe1()." - ".$rapportSpecifique->getEquipe2()),1,0,'C',0); //insertion d'une ligne
        $pdf->Ln();
        $pdf->SetX(70);
        $pdf->Cell(188,40,utf8_decode("Note Du joueur"),1,0,'C',0);
        $pdf ->Cell(288,40, utf8_decode($rapportSpecifique->getNoteJoueur())."/20",1,0,'C',0); //insertion d'une ligne
        $pdf->Ln();

        $pdf->SetY(450);
        $pdf->SetFont('Arial','B',12);
        $pdf->SetX(140);
        $pdf->Cell(330,25,"Les Qualites du Joueur" , 0,0,'C',0);
        $pdf->SetFont('Arial','',12);
        $pdf->SetY(500);
        $pdf->SetX(70);

        $technique = $rapportSpecifique->getQualiteTechnique();
        $tailleTechnique = strlen($technique);
        if ($tailleTechnique < 20){
            $pdf->Cell(188,40  ,utf8_decode("Qualité Technique"),1,0,'D',0);
            $pdf->MultiCell(288,40, utf8_decode($technique),1,'D',0);
        }else{
            $pdf->Cell(188,40  ,utf8_decode("Qualité Technique"),1,0,'D',0);
            $pdf->MultiCell(288,23, utf8_decode($rapportSpecifique->getQualiteTechnique()),1,'D',0);
        }

        $pdf->Ln();
        $pdf->SetX(70);

        $physique = $rapportSpecifique->getQualitePhysique();
        $taillePhysique = strlen($physique);
        if ($taillePhysique < 50){
            $pdf->Cell(188,40,utf8_decode("Qualité Physique"),1,0,'D',0);
            $pdf->MultiCell(288,40, utf8_decode($physique),1,'D',0);
        }else{
            $pdf->Cell(188,40,utf8_decode("Qualité Physique"),1,0,'D',0);
            $pdf->MultiCell(288,23, utf8_decode($physique),1,'D',0);
        }


        $pdf->Ln();
        $pdf->SetX(70);

        $tactique = $rapportSpecifique->getQualiteTactique();
        $tailleTactique = strlen($tactique);
        if ($tailleTactique < 50){
            $pdf->Cell(188,40,utf8_decode("Qualité Tactique"),1,0,'D',0);
            $pdf->MultiCell(288,40, utf8_decode($tactique),1,'D',0);
        }else{
            $pdf->Cell(188,40,utf8_decode("Qualité Tactique"),1,0,'D',0);
            $pdf->MultiCell(288,23, utf8_decode($tactique),1,'D',0);
        }

        $pdf->Ln();
        $pdf->SetX(70);

        $mental = $rapportSpecifique->getQualiteMentale();
        $tailleMental = strlen($mental);
        if ($tailleMental < 50){
            $pdf->Cell(188,40,utf8_decode("Qualité Mental"),1,0,'D',0);
            $pdf->MultiCell(288,40, utf8_decode($mental),1,'D',0);
        }else{
            $pdf->Cell(188,40,utf8_decode("Qualité Mental"),1,0,'D',0);
            $pdf->MultiCell(288,23, utf8_decode($mental),1,'D',0);
        }
        $pdf->Ln();

        $pdf ->Output(); //génère le PDF et l'affiche
        die("");
    }
}