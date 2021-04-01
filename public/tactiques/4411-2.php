<?php
    if($match->getLigne4E2()->unwrap()[0]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne4E2()->unwrap()[0]->getPhoto(), 415, 465, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 415, 465, 20), 0, 0, 'L', false );
    }
    if($match->getLigne3E2()->unwrap()[0]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne3E2()->unwrap()[0]->getPhoto(), 415, 505, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 415, 505, 20), 0, 0, 'L', false );
    }
    if($match->getLigne2E2()->unwrap()[0]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne2E2()->unwrap()[0]->getPhoto(), 365, 530, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 365, 530, 20), 0, 0, 'L', false );
    }
    if($match->getLigne2E2()->unwrap()[1]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne2E2()->unwrap()[1]->getPhoto(), 395, 550, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 395, 550, 20), 0, 0, 'L', false );
    }
    if($match->getLigne2E2()->unwrap()[2]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne2E2()->unwrap()[2]->getPhoto(), 440, 550, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 440, 550, 20), 0, 0, 'L', false );
    }
    if($match->getLigne2E2()->unwrap()[3]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne2E2()->unwrap()[3]->getPhoto(), 460, 530, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 460, 530, 20), 0, 0, 'L', false );
    }
    if($match->getLigne1E2()->unwrap()[0]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne1E2()->unwrap()[0]->getPhoto(), 365, 590, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 365, 590, 20), 0, 0, 'L', false );
    }
    if($match->getLigne1E2()->unwrap()[1]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne1E2()->unwrap()[1]->getPhoto(), 390, 610, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 390, 610, 20), 0, 0, 'L', false );
    }
    if($match->getLigne1E2()->unwrap()[2]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne1E2()->unwrap()[2]->getPhoto(), 440, 610, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 440, 610, 20), 0, 0, 'L', false );
    }
    if($match->getLigne1E2()->unwrap()[3]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne1E2()->unwrap()[3]->getPhoto(), 465, 590, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 465, 590, 20), 0, 0, 'L', false );
    }
    if($match->getGardienE2()->unwrap()[0]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getGardienE2()->unwrap()[0]->getPhoto(), 417, 635, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 417, 635, 20), 0, 0, 'L', false );
    }

?>