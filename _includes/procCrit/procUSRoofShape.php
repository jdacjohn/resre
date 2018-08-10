<?php

/*
 * resre
 * procUSRoofShape
 *
 * Description - Enter a description of the file and its purpose.
 *
 * Author:      John Arnold <john@jdacsolutions.com>
 * Link:           https://jdacsolutions.com
 *
 * Created:             Aug 9, 2018 4:52:12 PM
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
    $selected =  $mitigants->getGarageDoor()->getCurVal();

    printVarIfDebug($postFrom, getenv('gDebug'), "Posted From");
    
    if ($postFrom == '__us-roofshape__') {
        // Save the shutter selection to the session
        $roof = isset($_POST['__chars-roof__']) ? $_POST['__chars-roof__'] : '';
        $mitigant = $mitigants->getRoofShape();
        switch ($roof) {
            case 'rsgab':
            case 'rship':
                $mitigant->setCurVal($roof);
                $mitigant->setMitKey($roof);
                break;
            case 'rscombo':
                $mitigant->setCurVal('rsgab');
                $mitigant->setMitKey('rsgabcmb');
                break;
            case 'rsOther':
                $mitigant->setCurVal('rsgab');
                $mitigant->setMitKey('other');
                break;
            case 'rsUnknown':
                $mitigant->setCurVal('rsgab');
                $mitigant->setMitKey('unknown');
                break;
        }
        $target = '/us/garage-door.php';
    } elseif ($postFrom == "__self__") {
        // User is trying to upload an image
        $userDir = $_SESSION[SESSION_NAME]['user']['userHash'];
        $fileName = $_FILES['file']['name'];
        printVarIfDebug($fileName, getenv('gDebug'), 'Name of File to Upload');
        $location = $root . 'userImages/'. $userDir . '/roof-shape/';
        printVarIfDebug($location, getenv('gDebug'), 'Name of Folder to Upload To');
        if (!$userDir == '') {
            $_SESSION[SESSION_NAME]['response'] = saveUserImage($fileName, $location, 'roof-shape');
        } else {
            $_SESSION[SESSION_NAME]['response'] = '<span style="color: #F00;">You must <a href="' . $root . 'us/index.php"><strong>log in</strong></a> to upload images.</span>';
        }
        $target = '/us/roof-shape.php';
    } elseif ($postFrom == '__us-roofshape-save__') {
        if (isset($_SESSION[SESSION_NAME]['home'])) {
            $home = unserialize($_SESSION[SESSION_NAME]['home']);
        }
        $newID = saveState($mitigants, $home);
        $_SESSION[SESSION_NAME]['trigger'] = 'dataSaved';
        $target = '/us/roof-shape.php';
    } elseif ($postFrom == '__us-roofshape-back__') {
        $target = '/us/shutters.php';
    }

    $_SESSION[SESSION_NAME]['mitigants'] = serialize($mitigants);
    
    printVarIfDebug($_SESSION, getenv('gDebug'), 'Session after POST');
    printVarIfDebug($mitigants, getenv('gDebug'), 'ResReMitigators');
    printVarIfDebug($selected, getenv('gDebug'), 'Value of PostBack selection:');
    printVarIfDebug($response, getenv('gDebug'), 'Upload Response');
    
    header('Location: ' . SITE_ROOT . $target);
    