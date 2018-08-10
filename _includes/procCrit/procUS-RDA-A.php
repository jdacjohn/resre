<?php

/*
 * resre
 * procUS-RDA-A
 *
 * Description - Enter a description of the file and its purpose.
 *
 * Author:      John Arnold <john@jdacsolutions.com>
 * Link:           https://jdacsolutions.com
 *
 * Created:             Aug 9, 2018 4:59:54 PM
 * Last Updated:    Date 
 * Copyright            Copyright 2018 JDAC Computing Solutions All Rights Reserved
 */

    $root = '../../';
    require($root . '_includes/app_start.inc.php');
    
    $postFrom = isset($_POST['postFrom']) ? $_POST['postFrom'] : '';
    $mitigants = new resre\ResReMitigators();
    $home = new resre\ResReHome();

    // Get the mitgation set from the session if already created, else create one.
    if (isset($_SESSION[SESSION_NAME]['mitigants'])) {
        $mitigants = unserialize($_SESSION[SESSION_NAME]['mitigants']);
    }
    $selected =  $mitigants->getRdaB()->getMitKey();

    printVarIfDebug($postFrom, getenv('gDebug'), "Posted From");

    if ($postFrom == '__us-RDA-A__') {
        // Save the shutter selection to the session
        $mitigant = $mitigants->getRdaA();
        $rdaa = isset($_POST['__chars-rdaa__']) ? $_POST['__chars-rdaa__'] : '';
        switch ($rdaa) {
            case 'rda6d':
                $mitigant->setCurVal('rda6');
                $mitigant->setMitKey('rda6d');
                break;
            case 'rda8d':
                $mitigant->setCurVal('rda8');
                $mitigant->setMitKey('rda8s');
                break;
            case 'rda10d':
                $mitigant->setCurVal('rda8');
                $mitigant->setMitKey('rda10d');
                break;
            case 'rda6s':
                $mitigant->setCurVal('rda6');
                $mitigant->setMitKey('rda6s');
                break;
            case 'other':
                $mitigant->setCurVal('rda6');
                $mitigant->setMitKey('other');
                break;
            case 'unknown':
                $mitigant->setCurVal('rda6');
                $mitigant->setMitKey('unknown');
                break;
        }
        $target = '/us/roof-deck-attach-B.php';
    } elseif ($postFrom == "__self__") {
        // User is trying to upload an image
        $userDir = $_SESSION[SESSION_NAME]['user']['userHash'];
        $fileName = $_FILES['file']['name'];
        printVarIfDebug($fileName, getenv('gDebug'), 'Name of File to Upload');
        $location = $root . 'userImages/'. $userDir . '/roof-deck-attach-A/';
        printVarIfDebug($location, getenv('gDebug'), 'Name of Folder to Upload To');
        if (!$userDir == '') {
            $_SESSION[SESSION_NAME]['response'] = saveUserImage($fileName, $location, 'RDA-A');
        } else {
            $_SESSION[SESSION_NAME]['response'] = '<span style="color: #F00;">You must <a href="' . $root . 'us/index.php"><strong>log in</strong></a> to upload images.</span>';
        }
        $target = '/us/roof-deck-attach-A.php';
    } elseif ($postFrom == '__us-RDA-A-save__') {
        if (isset($_SESSION[SESSION_NAME]['home'])) {
            $home = unserialize($_SESSION[SESSION_NAME]['home']);
        }
        $newID = saveState($mitigants, $home);
        $_SESSION[SESSION_NAME]['trigger'] = 'dataSaved';
        $target = '/us/roof-deck-attach-A.php';
    } elseif ($postFrom == '__us-RDA-A-back__') {
        $target = '/us/roof-wall.php';
    }

    $_SESSION[SESSION_NAME]['mitigants'] = serialize($mitigants);
    printVarIfDebug($_SESSION, getenv('gDebug'), 'Session after POST');
    printVarIfDebug($mitigants, getenv('gDebug'), 'ResReMitigators');
    printVarIfDebug($selected, getenv('gDebug'), 'Value of PostBack selection:');

    header('Location: ' . SITE_ROOT . $target);
    