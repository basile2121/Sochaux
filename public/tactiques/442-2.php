<?php
    // Ligne 3

    if($match->getLigne3E2()->unwrap()[0]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne3E2()->unwrap()[0]->getPhoto(), 390, 480, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 390, 480, 20), 0, 0, 'L', false );
    }
    if($match->getLigne3E2()->unwrap()[1]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne3E2()->unwrap()[1]->getPhoto(), 440, 180, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 440, 480, 20), 0, 0, 'L', false );
    }
    // Ligne 2
    if($match->getLigne2E2()->unwrap()[0]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne2E2()->unwrap()[0]->getPhoto(), 370, 230, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 370, 530, 20), 0, 0, 'L', false );
    }
    if($match->getLigne2E2()->unwrap()[1]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne2E2()->unwrap()[1]->getPhoto(), 390, 250, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 390, 550, 20), 0, 0, 'L', false );
    }
    if($match->getLigne2E2()->unwrap()[2]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne2E2()->unwrap()[2]->getPhoto(), 440, 250, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 440, 550, 20), 0, 0, 'L', false );
    }
    if($match->getLigne2E2()->unwrap()[3]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne2E2()->unwrap()[3]->getPhoto(), 460, 230, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 460, 530, 20), 0, 0, 'L', false );
    }
    // Ligne 1
    if($match->getLigne1E2()->unwrap()[0]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne1E2()->unwrap()[0]->getPhoto(), 365, 300, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 365, 600, 20), 0, 0, 'L', false );
    }
    if($match->getLigne1E2()->unwrap()[1]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne1E2()->unwrap()[1]->getPhoto(), 390, 320, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 390, 620, 20), 0, 0, 'L', false );
    }

    if($match->getLigne1E2()->unwrap()[2]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne1E2()->unwrap()[2]->getPhoto(), 440, 320, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 440, 620, 20), 0, 0, 'L', false );
    }

    if($match->getLigne1E2()->unwrap()[3]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne1E2()->unwrap()[3]->getPhoto(), 465, 300, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 465, 600, 20), 0, 0, 'L', false );
    }

    if($match->getGardienE2()->unwrap()[0]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getGardienE2()->unwrap()[0]->getPhoto(), 4617, 335, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 417, 635, 20), 0, 0, 'L', false );
    }
    ?>