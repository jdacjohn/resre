<?php

/*
 * resre
 * procUSRoofWall
 *
 * Description - Enter a description of the file and its purpose.
 *
 * Author:      John Arnold <john@jdacsolutions.com>
 * Link:           https://jdacsolutions.com
 *
 * Created:             Aug 9, 2018 4:57:17 PM
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
    $selected =  $mitigants->getRdaA()->getMitKey();
    
    printVarIfDebug($postFrom, getenv('gDebug'), "Posted From");

    if ($postFrom == '__us-roofwall__') {
        // Save the shutter selection to the session
        $mitigant = $mitigants->getRoofToWall();
        $rwall = isset($_POST['__chars-rwall__']) ? $_POST['__chars-rwall__'] : '';
        switch ($rwall) {
            case 'tnail':
                $mitigant->setCurval($rwall);
                $mitigant->setMitKey($rwall);
                break;
            case 'strap':
                $mitigant->setCurVal($rwall);
                $mitigant->setMitKey('straps');
                break;
            case 'clip':
                $mitigant->setCurVal('strap');
                $mitigant->setMitKey('clips');
                break;
            case 'other':
                $mitigant->setCurVal('tnail');
                $mitigant->setMitKey('other');
                break;
            case 'unknown':
                $mitigant->setCurval('tnail');
                $mitigant->setMitKey('unknown');
                break;
            default:
                $mitigant->setCurval('tnail');
                $mitigant->setMitKey('unknown');                
        }
        $target = '/us/roof-deck-attach-A.php';
    } elseif ($postFrom == "__self__") {
        // User is trying to upload an image
        $userDir = $_SESSION[SESSION_NAME]['user']['userHash'];
        $fileName = $_FILES['file']['name'];
        printVarIfDebug($fileName, getenv('gDebug'), 'Name of File to Upload');
        $location = $root . 'userImages/'. $userDir . '/roof-to-wall/';
        printVarIfDebug($location, getenv('gDebug'), 'Name of Folder to Upload To');
        if (!$userDir == '') {
            $_SESSION[SESSION_NAME]['response'] = saveUserImage($fileName, $location, 'roof-wall');
        } else {
            $_SESSION[SESSION_NAME]['response'] = '<span style="color: #F00;">You must <a href="' . $root . 'us/index.php"><strong>log in</strong></a> to upload images.</span>';
        }
        $target = '/us/roof-wall.php';
    } elseif ($postFrom == '__us-roofwall-save__') {
        if (isset($_SESSION[SESSION_NAME]['home'])) {
            $home = unserialize($_SESSION[SESSION_NAME]['home']);
        }
        $newID = saveState($mitigants, $home);
        $_SESSION[SESSION_NAME]['trigger'] = 'dataSaved';
        $target = '/us/roof-wall.php';
    } elseif ($postFrom == '__us-roofwall-back__') {
        $target = '/us/garage-door.php';
    }

    $_SESSION[SESSION_NAME]['mitigants'] = serialize($mitigants);
    
    printVarIfDebug($_SESSION, getenv('gDebug'), 'Session after POST');
    printVarIfDebug($mitigants, getenv('gDebug'), 'ResReMitigators');
    printVarIfDebug($selected, getenv('gDebug'), 'Value of PostBack selection:');

    header('Location: ' . SITE_ROOT . $target);
    