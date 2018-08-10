<?php

/*
 * resre
 * procUSGarageDoor
 *
 * Description - Enter a description of the file and its purpose.
 *
 * Author:      John Arnold <john@jdacsolutions.com>
 * Link:           https://jdacsolutions.com
 *
 * Created:             Aug 9, 2018 4:54:36 PM
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
    $selected =  $mitigants->getRoofToWall()->getMitKey();

    printVarIfDebug($postFrom, getenv('gDebug'), "Posted From");

    if ($postFrom == '__us-garagedoor__') {
        // Save the shutter selection to the session
        $mitigant = $mitigants->getGarageDoor();
        $garageSel = isset($_POST['garageSelect']) ? $_POST['garageSelect'] : '';
        printVarIfDebug($garageSel, getenv('gDebug'), "Garage Door Selection Hidden");
        
        switch ($garageSel) {
            case 'gdsup':
            case 'gdstd':
            case 'gdwkd':
                $mitigant->setCurVal($garageSel);
                $mitigant->setMitKey($garageSel);
                break;
            case 'gdnod':
            case 'gdno2':
                $mitigant->setCurVal($garageSel);
                $mitigant->setMitKey('');
                break;
            default:
                if ($mitigants->getShutters()->getCurVal() == 'shtno') {
                    $mitigant->setCurVal('gdwkd');
                    $mitigant->setMitKey('gdwkd');    
                } else {
                    $mitigant->setCurVal('gdno2');
                    $mitigant->setMitKey('');
                }
        }
        $target = '/us/roof-wall.php';
    } elseif ($postFrom == "__self__") {
        // User is trying to upload an image
        $userDir = $_SESSION[SESSION_NAME]['user']['userHash'];
        $fileName = $_FILES['file']['name'];
        printVarIfDebug($fileName, getenv('gDebug'), 'Name of File to Upload');
        $location = $root . 'userImages/'. $userDir . '/garage/';
        printVarIfDebug($location, getenv('gDebug'), 'Name of Folder to Upload To');
        if (!$userDir == '') {
            $_SESSION[SESSION_NAME]['response'] = saveUserImage($fileName, $location, 'garage');
        } else {
            $_SESSION[SESSION_NAME]['response'] = '<span style="color: #F00;">You must <a href="' . $root . 'us/index.php"><strong>log in</strong></a> to upload images.</span>';
        }
        $target = '/us/garage-door.php';
    } elseif ($postFrom == '__us-garagedoor-save__') {
        if (isset($_SESSION[SESSION_NAME]['home'])) {
            $home = unserialize($_SESSION[SESSION_NAME]['home']);
        }
        $newID = saveState($mitigants, $home);
        $_SESSION[SESSION_NAME]['trigger'] = 'dataSaved';
        $target = '/us/garage-door.php';
    } elseif ($postFrom == '__us-garagedoor-back__') {
        $target = '/us/roof-shape.php';
    }

    $_SESSION[SESSION_NAME]['mitigants'] = serialize($mitigants);
    
    printVarIfDebug($_SESSION, getenv('gDebug'), 'Session after POST');
    printVarIfDebug($mitigants, getenv('gDebug'), 'ResReMitigators');
    printVarIfDebug($selected, getenv('gDebug'), 'Value of PostBack selection:');

    header('Location: ' . SITE_ROOT . $target);
    