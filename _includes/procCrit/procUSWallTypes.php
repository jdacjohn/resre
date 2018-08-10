<?php

/*
 * resre
 * procUSWallTypes
 *
 * Description - Enter a description of the file and its purpose.
 *
 * Author:      John Arnold <john@jdacsolutions.com>
 * Link:           https://jdacsolutions.com
 *
 * Created:             Aug 9, 2018 4:32:59 PM
 * Last Updated:    Date 
 * Copyright            Copyright 2018 JDAC Computing Solutions All Rights Reserved
 */

    $root = '../../';
    require($root . '_includes/app_start.inc.php');
    
    $postFrom = isset($_POST['postFrom']) ? $_POST['postFrom'] : '';
    $mitigants = new resre\ResReMitigators();
    $home = new resre\ResReHome();
    $response = 0;
    $trigger = '';
    // Get the mitgation set from the session if already created, else create one.
    if (isset($_SESSION[SESSION_NAME]['mitigants'])) {
        $mitigants = unserialize($_SESSION[SESSION_NAME]['mitigants']);
    }
    $selected =  $mitigants->getShutters()->getMitKey();
    // Get the home object from the session if already created, else create one.
    if (isset($_SESSION[SESSION_NAME]['home'])) {
        $home = unserialize($_SESSION[SESSION_NAME]['home']);
    }
    
    printVarIfDebug($postFrom, getenv('gDebug'), "Posted From");

    if ($postFrom == '__us-walltypes__') {
        // Save the base config for wall type.
        $mitigant = $mitigants->getWallType();
        $wallType = isset($_POST['__chars-walltype__']) ? $_POST['__chars-walltype__'] : '';
        switch ($wallType) {
            case 'WS':
                $mitigant->setCurVal($wallType);
                $mitigant->setOptimumVal($wallType);
                $mitigant->setMitKey(strtolower($wallType));
                $home->setNumberOfComponents(6);
                break;
            case 'rmfys':
                $mitigant->setCurVal('MS');
                $mitigant->setOptimumVal('MS');
                $mitigant->setMitKey($wallType);
                $home->setNumberOfComponents(7);
                break;
            case 'rmfno':
                $mitigant->setCurVal('MS');
                $mitigant->setOptimumVal('MS');
                $mitigant->setMitKey($wallType);
                $home->setNumberOfComponents(7);
                break;
            case 'unknown':
                $mitigant->setCurVal('WS');
                $mitigant->setOptimumVal('WS');
                $mitigant->setMitKey($wallType);
                $home->setNumberOfComponents(6);
                break;
        }
        $target = '/us/shutters.php';
    } elseif ($postFrom == "__self__") {
        // User is trying to upload an image
        $userDir = $_SESSION[SESSION_NAME]['user']['userHash'];
        $fileName = $_FILES['file']['name'];
        printVarIfDebug($fileName, getenv('gDebug'), 'Name of File to Upload');
        $location = $root . 'userImages/'. $userDir . '/wall-types/';
        printVarIfDebug($location, getenv('gDebug'), 'Name of Folder to Upload To');
        if (!$userDir == '') {
            $_SESSION[SESSION_NAME]['response'] = saveUserImage($fileName, $location, 'wall-type');
        } else {
            $_SESSION[SESSION_NAME]['response'] = '<span style="color: #F00;">You must <a href="' . $root . 'us/index.php"><strong>log in</strong></a> to upload images.</span>';
        }
        $target = '/us/wall-types.php';
    } elseif ($postFrom == '__us-walltypes-save__') {
        $newID = saveState($mitigants, $home);
        $_SESSION[SESSION_NAME]['trigger'] = 'dataSaved';
        $target = '/us/wall-types.php';
    } elseif ($postFrom == '__us-walltypes-back__') {
        $target = '/us/stories.php';
    }

    $_SESSION[SESSION_NAME]['mitigants'] = serialize($mitigants);
    $_SESSION[SESSION_NAME]['home'] = serialize($home);
    printVarIfDebug($_SESSION, getenv('gDebug'), 'Session After Posting');
    printVarIfDebug($mitigants, getenv('gDebug'), 'ResReMitigators');
    printVarIfDebug($mitigants, getenv('gDebug'), 'ResReHome');
    printVarIfDebug($selected, getenv('gDebug'), 'Value of PostBack selection:');

    header('Location: ' . SITE_ROOT . $target);
    