<?php

    // Ligne 3
    if($match->getLigne3E2()->unwrap()[0]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne3E2()->unwrap()[0]->getPhoto(), 360, 470, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 360, 470, 20), 0, 0, 'L', false );
    }
    if($match->getLigne3E2()->unwrap()[1]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne3E2()->unwrap()[1]->getPhoto(), 470, 470, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 470, 470, 20), 0, 0, 'L', false );
    }
    if($match->getLigne3E2()->unwrap()[2]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne3E2()->unwrap()[2]->getPhoto(), 415, 490, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 415, 490, 20), 0, 0, 'L', false );
    }
    // Ligne 2
    if($match->getLigne2E2()->unwrap()[0]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne2E2()->unwrap()[0]->getPhoto(), 380, 520, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 380, 520, 20), 0, 0, 'L', false );
    }
    if($match->getLigne2E2()->unwrap()[1]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne2E2()->unwrap()[1]->getPhoto(), 415, 550, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 415, 550, 20), 0, 0, 'L', false );
    }
    if($match->getLigne2E2()->unwrap()[2]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne2E2()->unwrap()[2]->getPhoto(), 445, 520, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 445, 520, 20), 0, 0, 'L', false );
    }
    // Ligne 1
    if($match->getLigne1E2()->unwrap()[0]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne1E2()->unwrap()[0]->getPhoto(), 360, 590, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 360, 590, 20), 0, 0, 'L', false );
    }
    if($match->getLigne1E2()->unwrap()[1]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne1E2()->unwrap()[1]->getPhoto(), 385, 300, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 385, 600, 20), 0, 0, 'L', false );
    }
    if($match->getLigne1E2()->unwrap()[2]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne1E2()->unwrap()[0]->getPhoto(), 465, 590, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 465, 590, 20), 0, 0, 'L', false );
    }
    if($match->getLigne1E2()->unwrap()[3]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne1E2()->unwrap()[3]->getPhoto(), 440, 600, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 440, 600, 20), 0, 0, 'L', false );
    }

    if($match->getGardienE2()->unwrap()[0]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getGardienE2()->unwrap()[0]->getPhoto(), 415, 635, 20), 0, 0, 'L', false );
    }else {
        $pdf->Cell(7, 7, $pdf->Image($slot, 415, 635, 20), 0, 0, 'L', false);
    }
    ?>
