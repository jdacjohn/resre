<?php

/*
 * resre
 * procUS-RDA-B
 *
 * Description - Enter a description of the file and its purpose.
 *
 * Author:      John Arnold <john@jdacsolutions.com>
 * Link:           https://jdacsolutions.com
 *
 * Created:             Aug 9, 2018 5:02:14 PM
 * Last Updated:    Date 
 * Copyright            Copyright 2018 JDAC Computing Solutions All Rights Reserved
 */

    $root = '../../';
    require($root . '_includes/app_start.inc.php');
    
    $postFrom = isset($_POST['postFrom']) ? $_POST['postFrom'] : '';
    $mitigants = new resre\ResReMitigators();
    $home = new resre\ResReHome;

    // Get the mitgation set from the session if already created, else create one.
    if (isset($_SESSION[SESSION_NAME]['mitigants'])) {
        $mitigants = unserialize($_SESSION[SESSION_NAME]['mitigants']);
    }
    $selected =  $mitigants->getWaterBarrier()->getMitKey();

    printVarIfDebug($postFrom, getenv('gDebug'), "Posted From");

    if ($postFrom == '__us-RDA-B__') {
        // Save the shutter selection to the session
        $mitigantA = $mitigants->getRdaA();
        $mitigantB = $mitigants->getRdaB();
        $rdab = isset($_POST['__chars-rdab__']) ? $_POST['__chars-rdab__'] : '';
        switch ($rdab) {
            case '6':
                $mitigantB->setCurVal($mitigantA->getCurVal() . 's');
                $mitigantB->setMitKey('rdab6');
                break;
            case '12':
                $mitigantB->setCurVal($mitigantA->getCurVal() . 'd');
                $mitigantB->setMitKey('rdab12');
                break;
            case 'other':
                $mitigantB->setCurVal($mitigantA->getCurVal() . 'd');
                $mitigantB->setMitKey('other');
                break;
            case 'unknown':
                $mitigantB->setCurVal($mitigantA->getCurVal() . 'd');
                $mitigantB->setMitKey('unknown');
                break;
        }
        $target = '/us/water-barrier.php';
    } elseif ($postFrom == "__self__") {
        // User is trying to upload an image
        $userDir = $_SESSION[SESSION_NAME]['user']['userHash'];
        $fileName = $_FILES['file']['name'];
        printVarIfDebug($fileName, getenv('gDebug'), 'Name of File to Upload');
        $location = $root . 'userImages/'. $userDir . '/roof-deck-attach-B/';
        printVarIfDebug($location, getenv('gDebug'), 'Name of Folder to Upload To');
        if (!$userDir == '') {
            $_SESSION[SESSION_NAME]['response'] = saveUserImage($fileName, $location, 'RDA-B');
        } else {
            $_SESSION[SESSION_NAME]['response'] = '<span style="color: #F00;">You must <a href="' . $root . 'us/index.php"><strong>log in</strong></a> to upload images.</span>';
        }
        $target = '/us/roof-deck-attach-B.php';
    } elseif ($postFrom == '__us-RDA-B-save__') {
        if (isset($_SESSION[SESSION_NAME]['home'])) {
            $home = unserialize($_SESSION[SESSION_NAME]['home']);
        }
        $newID = saveState($mitigants, $home);
        $_SESSION[SESSION_NAME]['trigger'] = 'dataSaved';
        $target = '/us/roof-deck-attach-B.php';
    } elseif ($postFrom == '__us-RDA-B-back__') {
        $target = '/us/roof-deck-attach-A.php';
    }

    $_SESSION[SESSION_NAME]['mitigants'] = serialize($mitigants);
    
    printVarIfDebug($_SESSION, getenv('gDebug'), 'Session after POST');
    printVarIfDebug($mitigants, getenv('gDebug'), 'ResReMitigators');
    printVarIfDebug($selected, getenv('gDebug'), 'Value of PostBack selection:');

    header('Location: ' . SITE_ROOT . $target);
    