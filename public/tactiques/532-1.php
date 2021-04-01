<?php
    if($match->getLigne3E1()->unwrap()[0]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne3E1()->unwrap()[0]->getPhoto(), 390, 180, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 390, 180, 20), 0, 0, 'L', false );
    }
    if($match->getLigne3E1()->unwrap()[1]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne3E1()->unwrap()[1]->getPhoto(), 440, 180, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 440, 180, 20), 0, 0, 'L', false );
    }
    if($match->getLigne2E1()->unwrap()[0]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne2E1()->unwrap()[0]->getPhoto(), 380, 220, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 380, 220, 20), 0, 0, 'L', false );
    }
    if($match->getLigne2E1()->unwrap()[1]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne2E1()->unwrap()[1]->getPhoto(), 415, 220, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 415, 220, 20), 0, 0, 'L', false );
    }
    if($match->getLigne2E1()->unwrap()[2]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne2E1()->unwrap()[2]->getPhoto(), 445, 220, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 445, 220, 20), 0, 0, 'L', false );
    }
    if($match->getLigne1E1()->unwrap()[0]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne1E1()->unwrap()[0]->getPhoto(), 360, 285, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 360, 285, 20), 0, 0, 'L', false );
    }
    if($match->getLigne1E1()->unwrap()[1]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne1E1()->unwrap()[1]->getPhoto(), 385, 295, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 385, 295, 20), 0, 0, 'L', false );
    }
    if($match->getLigne1E1()->unwrap()[2]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne1E1()->unwrap()[2]->getPhoto(), 415, 315, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 415, 315, 20), 0, 0, 'L', false );
    }
    if($match->getLigne1E1()->unwrap()[3]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne1E1()->unwrap()[3]->getPhoto(), 440, 295, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 440, 295, 20), 0, 0, 'L', false );
    }
    if($match->getLigne1E1()->unwrap()[4]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne1E1()->unwrap()[4]->getPhoto(), 465, 285, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 465, 285, 20), 0, 0, 'L', false );
    }
    if($match->getGardienE1()->unwrap()[0]!=null){
        $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getGardienE1()->unwrap()[0]->getPhoto(), 415, 335, 20), 0, 0, 'L', false );
    }else{
        $pdf->Cell( 7, 7, $pdf->Image($slot, 415, 335, 20), 0, 0, 'L', false );
    }

?>