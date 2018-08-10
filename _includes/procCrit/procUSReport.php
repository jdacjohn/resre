<?php

/*
 * resre
 * procUSReport
 *
 * Description - Enter a description of the file and its purpose.
 *
 * Author:      John Arnold <john@jdacsolutions.com>
 * Link:           https://jdacsolutions.com
 *
 * Created:             Aug 9, 2018 5:10:13 PM
 * Last Updated:    Date 
 * Copyright            Copyright 2018 JDAC Computing Solutions All Rights Reserved
 */

    $root = '../../';
    require($root . '_includes/app_start.inc.php');
    
    $postFrom = getParam('postFrom');
    
    if (!isset($_SESSION[SESSION_NAME]['home'])) {
        // Session has expired or user not logged in
        header('Location:  ' . HOME_LINK . 'us/index.php?postFrom=login');
    }
    printVarIfDebug($_SESSION, getenv('gDebug'), 'Session on Entry');
    $resReHome = unserialize($_SESSION[SESSION_NAME]['home']);
    $mitigants = unserialize($_SESSION[SESSION_NAME]['mitigants']);
    if (isset($_SESSION[SESSION_NAME]['assessor'])) {
        $assessor = unserialize($_SESSION[SESSION_NAME]['assessor']);
    } else {
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

    $gDoorYN = $mitigants->getGarageDoor()->getCurVal();
    $numComponents = ($gDoorYN == 'gndod' || $gDoorYN == 'gdno2') ? 8 : 9;
    
    $postFrom = isset($_POST['postFrom']) ? $_POST['postFrom'] : '';
    if ($postFrom == '__us-report__') {
        $assessor->setHurricaneCategory($_POST['hCat']);
        $assessor->buildReport();
        $retroAssessor->setHurricaneCategory($_POST['hCat']);
        $retroAssessor->buildReport();
        $_SESSION[SESSION_NAME]['assessor'] = serialize($assessor);
        $_SESSION[SESSION_NAME]['retroAssessor'] = serialize($retroAssessor);
    }
    $category = $assessor->getHurricaneCategory();
    printVarIfDebug($postFrom, getenv('gDebug'), "Posted From");
    printVarIfDebug($assessor, getenv('gDebug'), "ResRe Current Assessment Object unserialized from Session");
    printVarIfDebug($retroAssessor, getenv('gDebug'), "ResRe Optimal Assessment Object unserialized from Session");
    printVarIfDebug($resReHome, getenv('gDebug'), "ResRe Home object unserialized from Session");
    printVarIfDebug($mitigants, getenv('gDebug'), "Damage Mitigators");
    $target = '/us/report.php';
    
    if ($postFrom == '__us-complete-save__') {
        $newID = saveState($mitigants, $resReHome);
        $_SESSION[SESSION_NAME]['trigger'] = 'dataSaved';
        $_SESSION[SESSION_NAME]['heading'] = 'Your Report Has Been Saved';
        $target = '/us/complete.php';
    } elseif ($postFrom == '__us-complete-back__') {
        $target = '/us/water-barrier.php';
    }
    header('Location: ' . SITE_ROOT . $target);