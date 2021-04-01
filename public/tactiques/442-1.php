<?php
        // Ligne 3
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
        // Ligne 2
        if($match->getLigne2E1()->unwrap()[0]!=null){
            $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne2E1()->unwrap()[0]->getPhoto(), 370, 230, 20), 0, 0, 'L', false );
        }else{
            $pdf->Cell( 7, 7, $pdf->Image($slot, 370, 230, 20), 0, 0, 'L', false );
        }
        if($match->getLigne2E1()->unwrap()[1]!=null){
            $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne2E1()->unwrap()[1]->getPhoto(), 390, 250, 20), 0, 0, 'L', false );
        }else{
            $pdf->Cell( 7, 7, $pdf->Image($slot, 390, 250, 20), 0, 0, 'L', false );
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

        // Ligne 1
        if($match->getLigne1E1()->unwrap()[0]!=null){
            $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne1E1()->unwrap()[0]->getPhoto(), 365, 300, 20), 0, 0, 'L', false );
        }else{
            $pdf->Cell( 7, 7, $pdf->Image($slot, 365, 300, 20), 0, 0, 'L', false );
        }
        if($match->getLigne1E1()->unwrap()[1]!=null){
            $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne1E1()->unwrap()[1]->getPhoto(), 390, 320, 20), 0, 0, 'L', false );
        }else{
            $pdf->Cell( 7, 7, $pdf->Image($slot, 390, 320, 20), 0, 0, 'L', false );
        }

        if($match->getLigne1E1()->unwrap()[2]!=null){
            $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne1E1()->unwrap()[2]->getPhoto(), 440, 320, 20), 0, 0, 'L', false );
        }else{
            $pdf->Cell( 7, 7, $pdf->Image($slot, 440, 320, 20), 0, 0, 'L', false );
        }

        if($match->getLigne1E1()->unwrap()[3]!=null){
            $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getLigne1E1()->unwrap()[3]->getPhoto(), 465, 300, 20), 0, 0, 'L', false );
        }else{
            $pdf->Cell( 7, 7, $pdf->Image($slot, 465, 300, 20), 0, 0, 'L', false );
        }

        if($match->getGardienE1()->unwrap()[0]!=null){
            $pdf->Cell( 7, 7, $pdf->Image("../public/images/".$match->getGardienE1()->unwrap()[0]->getPhoto(), 4617, 335, 20), 0, 0, 'L', false );
        }else{
            $pdf->Cell( 7, 7, $pdf->Image($slot, 417, 335, 20), 0, 0, 'L', false );
        }
        ?>