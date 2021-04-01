<?php
    if($match->getLigne4E1()->unwrap()[0]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne4E1()->unwrap()[0]->getPhoto(), 415, 165, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 415, 165, 20), 0, 0, 'L', false );
    }
    if($match->getLigne3E1()->unwrap()[0]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne3E1()->unwrap()[0]->getPhoto(), 415, 205, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 415, 205, 20), 0, 0, 'L', false );
    }
    if($match->getLigne2E1()->unwrap()[0]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne2E1()->unwrap()[0]->getPhoto(), 365, 230, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 365, 230, 20), 0, 0, 'L', false );
    }
    if($match->getLigne2E1()->unwrap()[1]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne2E1()->unwrap()[1]->getPhoto(), 395, 250, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 395, 250, 20), 0, 0, 'L', false );
    }
    if($match->getLigne2E1()->unwrap()[2]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne2E1()->unwrap()[2]->getPhoto(), 440, 250, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 440, 250, 20), 0, 0, 'L', false );
    }
    if($match->getLigne2E1()->unwrap()[3]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne2E1()->unwrap()[3]->getPhoto(), 460, 230, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 460, 230, 20), 0, 0, 'L', false );
    }
    if($match->getLigne1E1()->unwrap()[0]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne1E1()->unwrap()[0]->getPhoto(), 365, 290, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 365, 290, 20), 0, 0, 'L', false );
    }
    if($match->getLigne1E1()->unwrap()[1]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne1E1()->unwrap()[1]->getPhoto(), 390, 310, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 390, 310, 20), 0, 0, 'L', false );
    }
    if($match->getLigne1E1()->unwrap()[2]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne1E1()->unwrap()[2]->getPhoto(), 440, 310, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 440, 310, 20), 0, 0, 'L', false );
    }
    if($match->getLigne1E1()->unwrap()[3]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne1E1()->unwrap()[3]->getPhoto(), 465, 290, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 465, 290, 20), 0, 0, 'L', false );
    }
    if($match->getGardienE1()->unwrap()[0]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getGardienE1()->unwrap()[0]->getPhoto(), 417, 335, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 417, 335, 20), 0, 0, 'L', false );
    }

?>