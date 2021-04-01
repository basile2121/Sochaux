<?php
        // Ligne 3
        if($match->getLigne3E1()->unwrap()[0]!=null){
            $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne3E1()->unwrap()[0]->getPhoto(), 360, 170, 20), 0, 0, 'L', false );
        }else{
            $pdf->Cell( 7, 7, $pdf->Image($slot, 360, 170, 20), 0, 0, 'L', false );
        }
        if($match->getLigne3E1()->unwrap()[1]!=null){
            $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne3E1()->unwrap()[1]->getPhoto(), 470, 170, 20), 0, 0, 'L', false );
        }else{
            $pdf->Cell( 7, 7, $pdf->Image($slot, 470, 170, 20), 0, 0, 'L', false );
        }
        if($match->getLigne3E1()->unwrap()[2]!=null){
            $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne3E1()->unwrap()[2]->getPhoto(), 415, 190, 20), 0, 0, 'L', false );
        }else{
            $pdf->Cell( 7, 7, $pdf->Image($slot, 415, 190, 20), 0, 0, 'L', false );
        }
        // Ligne 2
        if($match->getLigne2E1()->unwrap()[0]!=null){
            $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne2E1()->unwrap()[0]->getPhoto(), 380, 220, 20), 0, 0, 'L', false );
        }else{
            $pdf->Cell( 7, 7, $pdf->Image($slot, 380, 220, 20), 0, 0, 'L', false );
        }
        if($match->getLigne2E1()->unwrap()[1]!=null){
            $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne2E1()->unwrap()[1]->getPhoto(), 415, 250, 20), 0, 0, 'L', false );
        }else{
            $pdf->Cell( 7, 7, $pdf->Image($slot, 415, 250, 20), 0, 0, 'L', false );
        }
        if($match->getLigne2E1()->unwrap()[2]!=null){
            $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne2E1()->unwrap()[2]->getPhoto(), 445, 220, 20), 0, 0, 'L', false );
        }else{
            $pdf->Cell( 7, 7, $pdf->Image($slot, 445, 220, 20), 0, 0, 'L', false );
        }
        // Ligne 1
        if($match->getLigne1E1()->unwrap()[0]!=null){
            $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne1E1()->unwrap()[0]->getPhoto(), 360, 290, 20), 0, 0, 'L', false );
        }else{
            $pdf->Cell( 7, 7, $pdf->Image($slot, 360, 290, 20), 0, 0, 'L', false );
        }
        if($match->getLigne1E1()->unwrap()[1]!=null){
            $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne1E1()->unwrap()[1]->getPhoto(), 385, 300, 20), 0, 0, 'L', false );
        }else{
            $pdf->Cell( 7, 7, $pdf->Image($slot, 385, 300, 20), 0, 0, 'L', false );
        }
        if($match->getLigne1E1()->unwrap()[2]!=null){
            $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigneE1()->unwrap()[2]->getPhoto(), 465, 290, 20), 0, 0, 'L', false );
        }else{
            $pdf->Cell( 7, 7, $pdf->Image($slot, 465, 290, 20), 0, 0, 'L', false );
        }
        if($match->getLigne1E1()->unwrap()[3]!=null){
            $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne1E1()->unwrap()[3]->getPhoto(), 440, 300, 20), 0, 0, 'L', false );
        }else{
            $pdf->Cell( 7, 7, $pdf->Image($slot, 440, 300, 20), 0, 0, 'L', false );
        }
        if($match->getGardienE1()->unwrap()[0]!=null){
            $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getGardienE1()->unwrap()[0]->getPhoto(), 415, 335, 20), 0, 0, 'L', false );
        }else{
            $pdf->Cell( 7, 7, $pdf->Image($slot, 415, 335, 20), 0, 0, 'L', false );
        }
        ?>



