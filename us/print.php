<?php
    $root = '../';
    require($root . '_includes/app_start.inc.php');
    require_once($root . '_config/tcpdf_config.php');
    
    $resReHome = unserialize($_SESSION[SESSION_NAME]['home']);
    $mitigants = unserialize($_SESSION[SESSION_NAME]['mitigants']);
    if (isset($_SESSION[SESSION_NAME]['assessor'])) {
        $assessor = unserialize($_SESSION[SESSION_NAME]['assessor']);
    } else {
    printVarIfDebug('Not getting new assessor from SESSION', getenv('gDebug'), 'Assessor in Print Function');
        $assessor = new resre\ResReDamageAssessment($mitigants->getBaseConfig(), $mitigants->getCurHomeCharString(), $resReHome->getNumberOfComponents(), $resReHome->homeValue);
        $assessor->buildReport();
        $_SESSION[SESSION_NAME]['assessor'] = serialize($assessor);
    }
    if (isset($_SESSION[SESSION_NAME]['retroAssessor'])) {
        $retroAssessor = unserialize($_SESSION[SESSION_NAME]['retroAssessor']);
    } else {
        $retroAssessor = new resre\ResReDamageAssessment($mitigants->getBaseConfig(), $mitigants->getOptimalHomeCharString(), 7, $resReHome->homeValue);
        $retroAssessor->buildReport();
        $_SESSION[SESSION_NAME]['retroAssessor'] = serialize($retroAssessor);
    }
    
    printVarIfDebug($assessor, getenv('gDebug'), 'Assessor in Print Function');
    printVarIfDebug($resReHome, getenv('gDebug'), 'ResRe Home');

    $pdf = new resre\ResReTCPDF('P', 'mm', 'A4', true, 'UTF-8');
    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Resilient Residence');
    $pdf->SetTitle('Resilient Residence Damage Assessment');
    $pdf->SetSubject('Home Storm Damage Potential Losses');
    $pdf->SetKeywords('CATEGORY ' . $assessor->getHurricaneCategory() . ' DAMAGE ESTIMATE');
    
    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, $pdf->getSubject(), array(0,74,128,), array(26,45,60));
    // Set footer line and text color to slate.
    $pdf->setFooterData(array(26,45,60), array(26,45,60));
    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    // add a page
    $pdf->AddPage();

    // Write Report Header
    $pdf->SetFont('EncodeSans-Black', '', 22);
    $pdf->SetTextColor(0,74,128);
    $pdf->Write(0, 'Resilient Residence Report', '', 0, 'L', true, 0, false, false, 0);
    $pdf->SetFont('EncodeSans-Black', '', 28);
    $pdf->setCellHeightRatio(1.5);
    $pdf->Write(0, $resReHome->homeOwnerFirstName . "'s " . $resReHome->homeName, '', 0, 'L', true, 0, false, false, 0);
    $body = 'The purpose of this report is to identify specific actions that you can take to strengthen your home against ' .
        'hurricanes.  Please use this report as a resource to make your home as hurricane-resistant as possible.  ' .
        'Contact a licensed, bonded, and insured contractor to plan your repairs and to ensure your home is ready for high winds.';
    $pdf->SetFont('EncodeSans-Regular', '', 12);
    $pdf->setCellHeightRatio(1.25);
    $pdf->SetTextColor(0,0,0);
    $pdf->Write(0, $body, '', 0, 'L', true, 0, false, false, 0);
    
    // Write Report Summary
    $pdf->setFont('EncodeSans-Black', '', 22);
    $pdf->SetTextColor(0,74,128);
    $pdf->setCellHeightRatio(2.0);
    $pdf->Write(0,'Hurricane Category', '', 0, 'L', true, 0, false, false, 0);
    $pdf->SetFont('EncodeSans-Regular', '', 12);
    $pdf->setCellHeightRatio(1.25);
    $pdf->SetTextColor(0,0,0);
    $body = 'Based on your selection, the estimated damage for a Category ' . $assessor->getHurricaneCategory() . ' Hurricane is described below.';
    $pdf->Write(0, $body, '', 0, 'L', true, 0, false, false, 0);
    // Write the circles with the Hurricane Category Selection.
    $lineStyle = array('width' => 0.25, 'dash' => 0, 'color' => array(0, 74, 128));
    $pdf->SetFont('EncodeSans-Bold', '', 16);
    $pdf->setCellHeightRatio(4.0);
    $pdf->SetTextColor(0,74,128);
    $startAbscissa = 35;
    $startCellWidth = 40;
    $cellWidthArray = array(40,30, 40, 30, 40);
    for ($i = 1; $i <= 5; $i++) {
        $fillColor = ($i == $assessor->getHurricaneCategory()) ? array(243,201,60) : array(252,232,164); 
        $abscissa = $startAbscissa * $i;
        $cellWidth = $cellWidthArray[$i - 1];
        $pdf->Circle($abscissa, 105, 8, 0, 360, 'F', $lineStyle, $fillColor);
        $pdf->Circle($abscissa, 105, 8, 0, 360, 'C', $lineStyle, $fillColor);
        $pdf->Cell($cellWidth, 0, $i, 0, 0, 'C', 0, '', 0);
    }
    $pdf->Ln();
    $pdf->SetFont('EncodeSans-Regular', '', 12);
    $pdf->setCellHeightRatio(3.25);
    $pdf->SetTextColor(0,0,0);
    $body = 'Your cost impact risk of a Category ' . $assessor->getHurricaneCategory() . ' hurricane is ';
    $pdf->Cell(92, 0, $body, 0, 0, 'L', 0, '', 0);
    $pdf->setFont('EncodeSans-Bold', '', 12);
    $impactPct = number_format(($assessor->getEstimatedLoss() / $resReHome->homeValue) * 100, 2);
    $pdf->Cell(13, 0, $impactPct . "%", 0, 0, 'L', 0, '', 0);
    $pdf->SetFont('EncodeSans-Regular', '', 12);
    $body =" of your home's value before retrofits.";
    $pdf->Cell(0, 0, $body, 0, 0, 'L', 0, '', 0);
    $pdf->Ln();
    // Draw the Damage Scale Image;
    $pdf->SetFont('EncodeSans-Bold', '', 14);
    $pdf->SetTextColor(0,74,128);
    $pdf->Write(0, 'DAMAGE & CALCULATOR COST ANALYSIS', '', 0, 'C', true, 0, false, false, 0);

    $pdf->Image($root . 'us/images/pdf/calculator.png', '', '', 0, 0, 'PNG', '', '', false, 300, 'C');
    $pdf->SetTextColor(255,255,255);
    $pdf->setCellHeightRatio(2.0);
    $pdf->Cell(50, 0, 'After Retrofits', 0, 0, 'R', 0, '', 0);
    $pdf->Cell(80, 0, ' ', 0, 0, 'C', 0, '', 0);
    $pdf->Cell(50, 0, 'Before Retrofits', 0, 0, 'L', 0, '', 0);
    $pdf->Ln();
    $pdf->setCellHeightRatio(1.25);
    $pdf->Cell(50, 0, '$' . number_format($retroAssessor->getEstimatedLoss(), 0), 0, 0, 'R', 0, '', 0);
    $pdf->Cell(80, 0, ' ', 0, 0, 'C', 0, '', 0);
    $pdf->Cell(50, 0, '$' . number_format($assessor->getEstimatedLoss(), 0), 0, 0, 'L', 0, '', 0);
    $pdf->Ln();
    $pdf->Ln();
    $pdf->Ln();
    // Write the Cost Legend
    $pdf->SetTextColor(0,74,128);
    $pdf->setCellHeightRatio(3.0);
    $pdf->Write(0, 'MITIGATION COST ANALYSIS', '', 0, 'C', true, 0, false, false, 0);
    $pdf->setCellHeightRatio(1.25);    
    $pdf->SetFont('EncodeSans-Bold', '', 12);
    $pdf->Cell(90, 0, 'Free - $$$', 0, 0, 'C', 0, '', 0);
    $pdf->Cell(90, 0, '$$', 0, 0, 'C', 0, '', 0);
    $pdf->Ln();
    $pdf->SetFont('EncodeSans-Regular', '', 12);
    $pdf->Cell(90, 0, 'Less than $500', 0, 0, 'C', 0, '', 0);
    $pdf->Cell(90, 0, '$501 - $1000', 0, 0, 'C', 0, '', 0);
    $pdf->Ln();
    $pdf->Ln();
    $pdf->SetFont('EncodeSans-Bold', '', 12);
    $pdf->Cell(90, 0, '$$$', 0, 0, 'C', 0, '', 0);
    $pdf->Cell(90, 0, '$$$$', 0, 0, 'C', 0, '', 0);
    $pdf->Ln();
    $pdf->SetFont('EncodeSans-Regular', '', 12);
    $pdf->Cell(90, 0, '$1001 - $5000', 0, 0, 'C', 0, '', 0);
    $pdf->Cell(90, 0, '$5001+', 0, 0, 'C', 0, '', 0);


    $pdf->Ln();
    $pdf->addPage();
    // Suggested Retrofits
    $pdf->SetFont('EncodeSans-Black', '', 28);
    $pdf->setCellHeightRatio(1.5);
    $pdf->SetTextColor(0,74,128);
    $pdf->Write(0, 'Suggested Retrofits', '', 0, 'L', true, 0, false, false, 0);
    $pdf->Ln();
    
    //Stories
    $pdf->Image($root . 'us/images/report-icons/stories.png', '', '', 0, 0, 'PNG', '', '', false, 300, 'L');
    $mitigant = $mitigants->getStories();
    
    $pdf->SetFont('EncodeSans-Bold', '', 14);
    $pdf->SetTextColor(0,0,0);
    $pdf->setCellHeightRatio(4.0);
    $pdf->SetLineStyle(array('width' => 0.85 / $pdf->getScaleFactor(), 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(26,45,60)));

    $pdf->Cell(30, 0, ' ', 'B', 0, 'C', 0, '', 0);
    $pdf->Cell(0, 0, 'Number of Stories:  ' . $mitigant->getLabel(), 'B', 0, 'L', 0, '', 0);
    $pdf->Ln();
    $pdf->setCellHeightRatio(2.0);
    $pdf->Cell(100, 0, 'Flash Recommendations', 0, 0, 'L', 0, '', 0);
    $pdf->Cell(30, 0, 'Costs', 0, 0, 'C', 0, '', 0);
    $pdf->Cell(60, 0, 'Resources', 0, 0, 'L', 0, '', 0);
    $pdf->Ln();
    $pdf->SetFont('EncodeSans-Regular', '', 12);
    $pdf->setCellHeightRatio(1.25);
    $cells1 = $pdf->MultiCell(100, 0, $mitigant->getRecommendation(), 0, 'L', 0, 0);
    $pdf->SetFont('EncodeSans-Bold', '', 12);
    $pdf->Cell(30, 0, $mitigant->getCostIndicator(), 0, 0, 'C', 0, '', 0);
    $pdf->SetFont('EncodeSans-Regular', '', 12);
    $pdf->Cell(60, 0, ($mitigant->getResources() != '') ? $mitigant->getResFriendlyName() : 'No Resources Available', 0, 0, 'L', 0, $mitigant->getResources(), 0);
    for ($i = 1; $i <= $cells1 + 1; $i++) {
        $pdf->Ln();
    }
    if (!$mitigant->getCostMsg() == '') {
        $cells2 = $pdf->MultiCell(100, 0, $mitigant->getCostMsg(), 0, 'L', 0, 0);
        $pdf->Cell(30, 0, ' ', 0, 0, 'C', 0, '', 0);
        for ($i = 1; $i <= $cells2 + 1; $i++) {
            $pdf->Ln();
        }
    }
    $pdf->Ln();
    
    //Wall Types
    $pdf->Image($root . 'us/images/report-icons/wall-types.png', '', '', 0, 0, 'PNG', '', '', false, 300, 'L');
    $mitigant = $mitigants->getWallType();
    
    $pdf->SetFont('EncodeSans-Bold', '', 14);
    $pdf->SetTextColor(0,0,0);
    $pdf->setCellHeightRatio(4.0);
    $pdf->SetLineStyle(array('width' => 0.85 / $pdf->getScaleFactor(), 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(26,45,60)));

    $pdf->Cell(30, 0, ' ', 'B', 0, 'C', 0, '', 0);
    $pdf->Cell(0, 0, 'Wall Type:  ' . $mitigant->getLabel(), 'B', 0, 'L', 0, '', 0);
    $pdf->Ln();
    
    $pdf->setCellHeightRatio(2.0);
    $pdf->Cell(100, 0, 'Flash Recommendations', 0, 0, 'L', 0, '', 0);
    $pdf->Cell(30, 0, 'Costs', 0, 0, 'C', 0, '', 0);
    $pdf->Cell(60, 0, 'Resources', 0, 0, 'L', 0, '', 0);
    $pdf->Ln();
    $pdf->SetFont('EncodeSans-Regular', '', 12);
    $pdf->setCellHeightRatio(1.25);
    $cells1 = $pdf->MultiCell(100, 0, $mitigant->getRecommendation(), 0, 'L', 0, 0);
    $pdf->SetFont('EncodeSans-Bold', '', 12);
    $pdf->Cell(30, 0, $mitigant->getCostIndicator(), 0, 0, 'C', 0, '', 0);
    $pdf->SetFont('EncodeSans-Regular', '', 12);
    $pdf->Cell(60, 0, ($mitigant->getResources() != '') ? $mitigant->getResFriendlyName() : 'No Resources Available', 0, 0, 'L', 0, $mitigant->getResources(), 0);
    for ($i = 1; $i <= $cells1 + 1; $i++) {
        $pdf->Ln();
    }
    if (!$mitigant->getCostMsg() == '') {
        $cells2 = $pdf->MultiCell(100, 0, $mitigant->getCostMsg(), 0, 'L', 0, 0);
        $pdf->Cell(30, 0, ' ', 0, 0, 'C', 0, '', 0);
        for ($i = 1; $i <= $cells2 + 1; $i++) {
            $pdf->Ln();
        }
    }
    $pdf->Ln();
    
    // Shutters
    $pdf->Image($root . 'us/images/report-icons/shutters.png', '', '', 0, 0, 'PNG', '', '', false, 300, 'L');
    $mitigant = $mitigants->getShutters();
    
    $pdf->SetFont('EncodeSans-Bold', '', 14);
    $pdf->SetTextColor(0,0,0);
    $pdf->setCellHeightRatio(4.0);
    $pdf->SetLineStyle(array('width' => 0.85 / $pdf->getScaleFactor(), 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(26,45,60)));

    $pdf->Cell(30, 0, ' ', 'B', 0, 'C', 0, '', 0);
    $pdf->Cell(0, 0, 'Shutters:  ' . $mitigant->getLabel(), 'B', 0, 'L', 0, '', 0);
    $pdf->Ln();
    
    $pdf->setCellHeightRatio(2.0);
    $pdf->Cell(100, 0, 'Flash Recommendations', 0, 0, 'L', 0, '', 0);
    $pdf->Cell(30, 0, 'Costs', 0, 0, 'C', 0, '', 0);
    $pdf->Cell(60, 0, 'Resources', 0, 0, 'L', 0, '', 0);
    $pdf->Ln();
    $pdf->SetFont('EncodeSans-Regular', '', 12);
    $pdf->setCellHeightRatio(1.25);
    $cells1 = $pdf->MultiCell(100, 0, $mitigant->getRecommendation(), 0, 'L', 0, 0);
    $pdf->SetFont('EncodeSans-Bold', '', 12);
    $pdf->Cell(30, 0, $mitigant->getCostIndicator(), 0, 0, 'C', 0, '', 0);
    $pdf->SetFont('EncodeSans-Regular', '', 12);
    $pdf->Cell(60, 0, ($mitigant->getResources() != '') ? $mitigant->getResFriendlyName() : 'No Resources Available', 0, 0, 'L', 0, $mitigant->getResources(), 0);
    for ($i = 1; $i <= $cells1 + 1; $i++) {
        $pdf->Ln();
    }
    if (!$mitigant->getCostMsg() == '') {
        $cells2 = $pdf->MultiCell(100, 0, $mitigant->getCostMsg(), 0, 'L', 0, 0);
        $pdf->Cell(30, 0, ' ', 0, 0, 'C', 0, '', 0);
        for ($i = 1; $i <= $cells2 + 1; $i++) {
            $pdf->Ln();
        }
    }
    $pdf->Ln();
    $pdf->AddPage();
    // Suggested Retrofits
    $pdf->SetFont('EncodeSans-Black', '', 28);
    $pdf->setCellHeightRatio(1.5);
    $pdf->SetTextColor(0,74,128);
    $pdf->Write(0, 'Suggested Retrofits', '', 0, 'L', true, 0, false, false, 0);
    $pdf->Ln();
    // Roof Shape
    $pdf->Image($root . 'us/images/report-icons/roof-shapes.png', '', '', 0, 0, 'PNG', '', '', false, 300, 'L');
    $mitigant = $mitigants->getRoofShape();
    
    $pdf->SetFont('EncodeSans-Bold', '', 14);
    $pdf->SetTextColor(0,0,0);
    $pdf->setCellHeightRatio(4.0);
    $pdf->SetLineStyle(array('width' => 0.85 / $pdf->getScaleFactor(), 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(26,45,60)));

    $pdf->Cell(30, 0, ' ', 'B', 0, 'C', 0, '', 0);
    $pdf->Cell(0, 0, 'Roof Shape:  ' . $mitigant->getLabel(), 'B', 0, 'L', 0, '', 0);
    $pdf->Ln();
    
    $pdf->setCellHeightRatio(2.0);
    $pdf->Cell(100, 0, 'Flash Recommendations', 0, 0, 'L', 0, '', 0);
    $pdf->Cell(30, 0, 'Costs', 0, 0, 'C', 0, '', 0);
    $pdf->Cell(60, 0, 'Resources', 0, 0, 'L', 0, '', 0);
    $pdf->Ln();
    $pdf->SetFont('EncodeSans-Regular', '', 12);
    $pdf->setCellHeightRatio(1.25);
    $cells1 = $pdf->MultiCell(100, 0, $mitigant->getRecommendation(), 0, 'L', 0, 0);
    $pdf->SetFont('EncodeSans-Bold', '', 12);
    $pdf->Cell(30, 0, $mitigant->getCostIndicator(), 0, 0, 'C', 0, '', 0);
    $pdf->SetFont('EncodeSans-Regular', '', 12);
    $pdf->Cell(60, 0, ($mitigant->getResources() != '') ? $mitigant->getResFriendlyName() : 'No Resources Available', 0, 0, 'L', 0, $mitigant->getResources(), 0);
    for ($i = 1; $i <= $cells1 + 1; $i++) {
        $pdf->Ln();
    }
    if (!$mitigant->getCostMsg() == '') {
        $cells2 = $pdf->MultiCell(100, 0, $mitigant->getCostMsg(), 0, 'L', 0, 0);
        $pdf->Cell(30, 0, ' ', 0, 0, 'C', 0, '', 0);
        for ($i = 1; $i <= $cells2 + 1; $i++) {
            $pdf->Ln();
        }
    }
    $pdf->Ln();
    
    $mitigant = $mitigants->getGarageDoor();
    // Only print the Garage Door Section if the home has one.
    if ($mitigant->getMitKey() != '')  {
        // Roof Shape
        $pdf->Image($root . 'us/images/report-icons/garage.png', '', '', 0, 0, 'PNG', '', '', false, 300, 'L');

        $pdf->SetFont('EncodeSans-Bold', '', 14);
        $pdf->SetTextColor(0,0,0);
        $pdf->setCellHeightRatio(4.0);
        $pdf->SetLineStyle(array('width' => 0.85 / $pdf->getScaleFactor(), 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(26,45,60)));

        $pdf->Cell(30, 0, ' ', 'B', 0, 'C', 0, '', 0);
        $pdf->Cell(0, 0, 'Garage Door:  ' . $mitigant->getLabel(), 'B', 0, 'L', 0, '', 0);
        $pdf->Ln();

        $pdf->setCellHeightRatio(2.0);
        $pdf->Cell(100, 0, 'Flash Recommendations', 0, 0, 'L', 0, '', 0);
        $pdf->Cell(30, 0, 'Costs', 0, 0, 'C', 0, '', 0);
        $pdf->Cell(60, 0, 'Resources', 0, 0, 'L', 0, '', 0);
        $pdf->Ln();
        $pdf->SetFont('EncodeSans-Regular', '', 12);
        $pdf->setCellHeightRatio(1.25);
        $cells1 = $pdf->MultiCell(100, 0, $mitigant->getRecommendation(), 0, 'L', 0, 0);
        $pdf->SetFont('EncodeSans-Bold', '', 12);
        $pdf->Cell(30, 0, $mitigant->getCostIndicator(), 0, 0, 'C', 0, '', 0);
        $pdf->SetFont('EncodeSans-Regular', '', 12);
        $pdf->Cell(60, 0, ($mitigant->getResources() != '') ? $mitigant->getResFriendlyName() : 'No Resources Available', 0, 0, 'L', 0, $mitigant->getResources(), 0);
        for ($i = 1; $i <= $cells1 + 1; $i++) {
            $pdf->Ln();
        }
        if (!$mitigant->getCostMsg() == '') {
            $cells2 = $pdf->MultiCell(100, 0, $mitigant->getCostMsg(), 0, 'L', 0, 0);
            $pdf->Cell(30, 0, ' ', 0, 0, 'C', 0, '', 0);
            for ($i = 1; $i <= $cells2 + 1; $i++) {
                $pdf->Ln();
            }
        }
        $pdf->Ln();        
    }
    
    // Roof -to-Wall Connections
    $pdf->Image($root . 'us/images/report-icons/roof-wall.png', '', '', 0, 0, 'PNG', '', '', false, 300, 'L');
    $mitigant = $mitigants->getRoofToWall();
    
    $pdf->SetFont('EncodeSans-Bold', '', 14);
    $pdf->SetTextColor(0,0,0);
    $pdf->setCellHeightRatio(4.0);
    $pdf->SetLineStyle(array('width' => 0.85 / $pdf->getScaleFactor(), 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(26,45,60)));

    $pdf->Cell(30, 0, ' ', 'B', 0, 'C', 0, '', 0);
    $pdf->Cell(0, 0, 'Roof to Wall Connections:  ' . $mitigant->getLabel(), 'B', 0, 'L', 0, '', 0);
    $pdf->Ln();
    
    $pdf->setCellHeightRatio(2.0);
    $pdf->Cell(100, 0, 'Flash Recommendations', 0, 0, 'L', 0, '', 0);
    $pdf->Cell(30, 0, 'Costs', 0, 0, 'C', 0, '', 0);
    $pdf->Cell(60, 0, 'Resources', 0, 0, 'L', 0, '', 0);
    $pdf->Ln();
    $pdf->SetFont('EncodeSans-Regular', '', 12);
    $pdf->setCellHeightRatio(1.25);
    $cells1 = $pdf->MultiCell(100, 0, $mitigant->getRecommendation(), 0, 'L', 0, 0);
    $pdf->SetFont('EncodeSans-Bold', '', 12);
    $pdf->Cell(30, 0, $mitigant->getCostIndicator(), 0, 0, 'C', 0, '', 0);
    $pdf->SetFont('EncodeSans-Regular', '', 12);
    $pdf->Cell(60, 0, ($mitigant->getResources() != '') ? $mitigant->getResFriendlyName() : 'No Resources Available', 0, 0, 'L', 0, $mitigant->getResources(), 0);
    for ($i = 1; $i <= $cells1 + 1; $i++) {
        $pdf->Ln();
    }
    if (!$mitigant->getCostMsg() == '') {
        $cells2 = $pdf->MultiCell(100, 0, $mitigant->getCostMsg(), 0, 'L', 0, 0);
        $pdf->Cell(30, 0, ' ', 0, 0, 'C', 0, '', 0);
        for ($i = 1; $i <= $cells2 + 1; $i++) {
            $pdf->Ln();
        }
    }
    $pdf->Ln();
    if ($mitigants->getGarageDoor()->getMitKey() != '') {
        $pdf->AddPage();
        // Suggested Retrofits
        $pdf->SetFont('EncodeSans-Black', '', 28);
        $pdf->setCellHeightRatio(1.5);
        $pdf->SetTextColor(0,74,128);
        $pdf->Write(0, 'Suggested Retrofits', '', 0, 'L', true, 0, false, false, 0);
        $pdf->Ln();
    }
    // Roof Deck Attachment A
    $pdf->Image($root . 'us/images/report-icons/rda-a.png', '', '', 0, 0, 'PNG', '', '', false, 300, 'L');
    $mitigant = $mitigants->getRdaA();
    
    $pdf->SetFont('EncodeSans-Bold', '', 14);
    $pdf->SetTextColor(0,0,0);
    $pdf->setCellHeightRatio(4.0);
    $pdf->SetLineStyle(array('width' => 0.85 / $pdf->getScaleFactor(), 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(26,45,60)));

    $pdf->Cell(30, 0, ' ', 'B', 0, 'C', 0, '', 0);
    $pdf->Cell(0, 0, 'Roof Deck Attacment Nail Length:  ' . $mitigant->getLabel(), 'B', 0, 'L', 0, '', 0);
    $pdf->Ln();
    
    $pdf->setCellHeightRatio(2.0);
    $pdf->Cell(100, 0, 'Flash Recommendations', 0, 0, 'L', 0, '', 0);
    $pdf->Cell(30, 0, 'Costs', 0, 0, 'C', 0, '', 0);
    $pdf->Cell(60, 0, 'Resources', 0, 0, 'L', 0, '', 0);
    $pdf->Ln();
    $pdf->SetFont('EncodeSans-Regular', '', 12);
    $pdf->setCellHeightRatio(1.25);
    $cells1 = $pdf->MultiCell(100, 0, $mitigant->getRecommendation(), 0, 'L', 0, 0);
    $pdf->SetFont('EncodeSans-Bold', '', 12);
    $pdf->Cell(30, 0, $mitigant->getCostIndicator(), 0, 0, 'C', 0, '', 0);
    $pdf->SetFont('EncodeSans-Regular', '', 12);
    $pdf->Cell(60, 0, ($mitigant->getResources() != '') ? $mitigant->getResFriendlyName() : 'No Resources Available', 0, 0, 'L', 0, $mitigant->getResources(), 0);
    for ($i = 1; $i <= $cells1 + 1; $i++) {
        $pdf->Ln();
    }
    if (!$mitigant->getCostMsg() == '') {
        $cells2 = $pdf->MultiCell(100, 0, $mitigant->getCostMsg(), 0, 'L', 0, 0);
        $pdf->Cell(30, 0, ' ', 0, 0, 'C', 0, '', 0);
        for ($i = 1; $i <= $cells2 + 1; $i++) {
            $pdf->Ln();
        }
    }
    $pdf->Ln();

    if ($mitigants->getGarageDoor()->getMitKey() == '') {
        $pdf->AddPage();
        // Suggested Retrofits
        $pdf->SetFont('EncodeSans-Black', '', 28);
        $pdf->setCellHeightRatio(1.5);
        $pdf->SetTextColor(0,74,128);
        $pdf->Write(0, 'Suggested Retrofits', '', 0, 'L', true, 0, false, false, 0);
        $pdf->Ln();
    }

    // Roof Deck Attachment B
    $pdf->Image($root . 'us/images/report-icons/rda-b.png', '', '', 0, 0, 'PNG', '', '', false, 300, 'L');
    $mitigant = $mitigants->getRdaB();
    
    $pdf->SetFont('EncodeSans-Bold', '', 14);
    $pdf->SetTextColor(0,0,0);
    $pdf->setCellHeightRatio(4.0);
    $pdf->SetLineStyle(array('width' => 0.85 / $pdf->getScaleFactor(), 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(26,45,60)));

    $pdf->Cell(30, 0, ' ', 'B', 0, 'C', 0, '', 0);
    $pdf->Cell(0, 0, 'Roof Deck Attacment Nail Spacing:  ' . $mitigant->getLabel(), 'B', 0, 'L', 0, '', 0);
    $pdf->Ln();
    
    $pdf->setCellHeightRatio(2.0);
    $pdf->Cell(100, 0, 'Flash Recommendations', 0, 0, 'L', 0, '', 0);
    $pdf->Cell(30, 0, 'Costs', 0, 0, 'C', 0, '', 0);
    $pdf->Cell(60, 0, 'Resources', 0, 0, 'L', 0, '', 0);
    $pdf->Ln();
    $pdf->SetFont('EncodeSans-Regular', '', 12);
    $pdf->setCellHeightRatio(1.25);
    $cells1 = $pdf->MultiCell(100, 0, $mitigant->getRecommendation(), 0, 'L', 0, 0);
    $pdf->SetFont('EncodeSans-Bold', '', 12);
    $pdf->Cell(30, 0, $mitigant->getCostIndicator(), 0, 0, 'C', 0, '', 0);
    $pdf->SetFont('EncodeSans-Regular', '', 12);
    $pdf->Cell(60, 0, ($mitigant->getResources() != '') ? $mitigant->getResFriendlyName() : 'No Resources Available', 0, 0, 'L', 0, $mitigant->getResources(), 0);
    for ($i = 1; $i <= $cells1 + 1; $i++) {
        $pdf->Ln();
    }
    if (!$mitigant->getCostMsg() == '') {
        $cells2 = $pdf->MultiCell(100, 0, $mitigant->getCostMsg(), 0, 'L', 0, 0);
        $pdf->Cell(30, 0, ' ', 0, 0, 'C', 0, '', 0);
        for ($i = 1; $i <= $cells2 + 1; $i++) {
            $pdf->Ln();
        }
    }
    $pdf->Ln();

    // Water Barrier
    $pdf->Image($root . 'us/images/report-icons/water-barrier.png', '', '', 0, 0, 'PNG', '', '', false, 300, 'L');
    $mitigant = $mitigants->getWaterBarrier();
    
    $pdf->SetFont('EncodeSans-Bold', '', 14);
    $pdf->SetTextColor(0,0,0);
    $pdf->setCellHeightRatio(4.0);
    $pdf->SetLineStyle(array('width' => 0.85 / $pdf->getScaleFactor(), 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(26,45,60)));

    $pdf->Cell(30, 0, ' ', 'B', 0, 'C', 0, '', 0);
    $pdf->Cell(0, 0, 'Secondary Water Resitance:  ' . $mitigant->getLabel(), 'B', 0, 'L', 0, '', 0);
    $pdf->Ln();
    
    $pdf->setCellHeightRatio(2.0);
    $pdf->Cell(100, 0, 'Flash Recommendations', 0, 0, 'L', 0, '', 0);
    $pdf->Cell(30, 0, 'Costs', 0, 0, 'C', 0, '', 0);
    $pdf->Cell(60, 0, 'Resources', 0, 0, 'L', 0, '', 0);
    $pdf->Ln();
    $pdf->SetFont('EncodeSans-Regular', '', 12);
    $pdf->setCellHeightRatio(1.25);
    $cells1 = $pdf->MultiCell(100, 0, $mitigant->getRecommendation(), 0, 'L', 0, 0);
    $pdf->SetFont('EncodeSans-Bold', '', 12);
    $pdf->Cell(30, 0, $mitigant->getCostIndicator(), 0, 0, 'C', 0, '', 0);
    $pdf->SetFont('EncodeSans-Regular', '', 12);
    $pdf->Cell(60, 0, ($mitigant->getResources() != '') ? $mitigant->getResFriendlyName() : 'No Resources Available', 0, 0, 'L', 0, $mitigant->getResources(), 0);
    for ($i = 1; $i <= $cells1 + 1; $i++) {
        $pdf->Ln();
    }
    if (!$mitigant->getCostMsg() == '') {
        $cells2 = $pdf->MultiCell(100, 0, $mitigant->getCostMsg(), 0, 'L', 0, 0);
        $pdf->Cell(30, 0, '  ', 0, 0, 'C', 0, '', 0);
        for ($i = 1; $i <= $cells2 + 1; $i++) {
            $pdf->Ln();
        }
    }
    $pdf->Ln();

    //Close and output PDF document
    $pdf->Output('Resilient Residence Report.pdf', 'I');

?>
<!DOCTYPE html>
/*
* resre
* print
*
* Description - Enter a description of the file and its purpose.
*
* Author:      John Arnold <john@jdacsolutions.com>
    * Link:           https://jdacsolutions.com
    *
    * Created:             Jul 25, 2018 6:40:26 PM
    * Last Updated:    Date 
    * Copyright            Copyright 2018 JDAC Computing Solutions All Rights Reserved
    */
    <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title></title>
        </head>
        <body>
        </body>
    </html>
