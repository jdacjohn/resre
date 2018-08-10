<?php

/*
 * resre
 * procUSStories
 *
 * Description - Enter a description of the file and its purpose.
 *
 * Author:      John Arnold <john@jdacsolutions.com>
 * Link:           https://jdacsolutions.com
 *
 * Created:             Aug 9, 2018 4:22:57 PM
 * Last Updated:    Date 
 * Copyright            Copyright 2018 JDAC Computing Solutions All Rights Reserved
 */

    $root = '../../';
    require($root . '_includes/app_start.inc.php');
    
    $postFrom = isset($_POST['postFrom']) ? $_POST['postFrom'] : '';
    $mitigants = new resre\ResReMitigators();
    $home = new resre\ResReHome();
    $trigger = '';
    // Get the mitgation set from the session if already created, else create one.
    if (isset($_SESSION[SESSION_NAME]['mitigants'])) {
        $mitigants = unserialize($_SESSION[SESSION_NAME]['mitigants']);
    }

    printVarIfDebug($postFrom, getenv('gDebug'), "Posted From");

    if ($postFrom == '__us-stories__') {
        // Save the base config for number of stories.
        $mitigant = $mitigants->getStories();
        $mitigant->setCurVal(isset($_POST['__chars-stories__']) ? $_POST['__chars-stories__'] : '');
        $mitigant->setOptimumVal($mitigant->getCurVal());
        $mitigant->setMitKey(strtolower($mitigant->getCurVal()));
        $target = '/us/wall-types.php';
    } elseif ($postFrom == "__self__") {
        // User is trying to upload an image
        $userDir = $_SESSION[SESSION_NAME]['user']['userHash'];
        $fileName = $_FILES['file']['name'];
        printVarIfDebug($fileName, getenv('gDebug'), 'Name of File to Upload');
        $location = $root . 'userImages/'. $userDir . '/stories/';
        printVarIfDebug($location, getenv('gDebug'), 'Name of Folder to Upload To');
        if (!$userDir == '') {
            $_SESSION[SESSION_NAME]['response'] = saveUserImage($fileName, $location, 'stories');
        } else {
            $_SESSION[SESSION_NAME]['response'] = '<span style="color: #F00;">You must <a href="' . $root . 'us/index.php"><strong>log in</strong></a> to upload images.</span>';
        }
        $target = '/us/stories.php';
    } elseif ($postFrom == '__us-stories-save__') {
        if (isset($_SESSION[SESSION_NAME]['home'])) {
            $home = unserialize($_SESSION[SESSION_NAME]['home']);
        }
        $newID = saveState($mitigants, $home);
        $_SESSION[SESSION_NAME]['trigger'] = 'dataSaved';
        $target = '/us/stories.php';
    } elseif ($postFrom == '__us-stories-back__') {
        $target = '/us/loc.php';
    }
      
    $_SESSION[SESSION_NAME]['mitigants'] = serialize($mitigants);
    printVarIfDebug($_SESSION, getenv('gDebug'), 'Session After Posting');
    printVarIfDebug($mitigants, getenv('gDebug'), 'ResReMitigators');
    printVarIfDebug($selected, getenv('gDebug'), 'Value of PostBack selection:');
    
    header('Location: ' . SITE_ROOT . $target);
    