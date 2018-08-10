<?php

/*
 * resre
 * procUSWaterBarrier
 *
 * Description - Enter a description of the file and its purpose.
 *
 * Author:      John Arnold <john@jdacsolutions.com>
 * Link:           https://jdacsolutions.com
 *
 * Created:             Aug 9, 2018 5:05:11 PM
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
    // Get the home object from the session if already created, else create one.
    if (isset($_SESSION[SESSION_NAME]['home'])) {
        $home = unserialize($_SESSION[SESSION_NAME]['home']);
    }

    printVarIfDebug($postFrom, getenv('gDebug'), "Posted From");

    $heading = 'Your Report is Complete';
    // Set the session vars based on the _POST values
    if ($postFrom == '__us-WB__') {
        $mitigant = $mitigants->getWaterBarrier();
        // Save the shutter selection to the session
        $waterBarrier = isset($_POST['__chars-wb__']) ? $_POST['__chars-wb__'] : '';
        switch ($waterBarrier) {
            case 'swryscc':
                $mitigant->setCurVal('swrys');
                $mitigant->setMitKey($waterBarrier);
                break;
            case 'swryssa':
                $mitigant->setCurVal('swrys');
                $mitigant->setMitKey($waterBarrier);
                break;
            case 'swrno':
                $mitigant->setCurVal($waterBarrier);
                $mitigant->setMitKey($waterBarrier);
                break;
        }
        $target = '/us/complete.php';
    } elseif ($postFrom == "__self__") {
        // User is trying to upload an image
        $userDir = $_SESSION[SESSION_NAME]['user']['userHash'];
        $fileName = $_FILES['file']['name'];
        printVarIfDebug($fileName, getenv('gDebug'), 'Name of File to Upload');
        $location = $root . 'userImages/'. $userDir . '/water-barrier/';
        printVarIfDebug($location, getenv('gDebug'), 'Name of Folder to Upload To');
        if (!$userDir == '') {
            $_SESSION[SESSION_NAME]['response'] = saveUserImage($fileName, $location, 'water-barrier');
        } else {
            $_SESSION[SESSION_NAME]['response'] = '<span style="color: #F00;">You must <a href="' . $root . 'us/index.php"><strong>log in</strong></a> to upload images.</span>';
        }
        $target = '/us/water-barrier.php';
    } elseif ($postFrom == '__us-WB-save__') {
        if (isset($_SESSION[SESSION_NAME]['home'])) {
            $home = unserialize($_SESSION[SESSION_NAME]['home']);
        }
        $newID = saveState($mitigants, $home);
        $_SESSION[SESSION_NAME]['trigger'] = 'dataSaved';
        $_SESSION[SESSION_Name]['heading'] = 'Your Report Has Been Saved';
        $target = '/us/water-barrier.php';
    } elseif ($postFrom == '__us-WB-back__') {
        $target = '/us/roof-deck-attach-B.php';
    }
    // Write the changes back to the session.
    $_SESSION[SESSION_NAME]['mitigants'] = serialize($mitigants);

    if ($target == '/us/complete.php') {
        // Build the base config and currentHomeCharString from the session data.
        $baseConfig = $mitigants->getBaseConfig();
        $currentHomeCharString = $mitigants->getCurHomeCharString();
        $retrofitCharString = $mitigants->getOptimalHomeCharString($home->getNumberOfComponents());

        printVarIfDebug($_SESSION, getenv('gDebug'), 'Session after POST');
        printVarIfDebug($mitigants, getenv('gDebug'), 'ResRe Mitigators');
        printVarIfDebug($baseConfig, getenv('gDebug'), 'Base Home Configuration String');
        printVarIfDebug($currentHomeCharString, getenv('gDebug'), 'Current Home Characteristics String');
        printVarIfDebug($retrofitCharString, getenv('gDebug'), 'Retrofit String');

        // Get the initial Damage Assessment Results.
        $assessor = new resre\ResReDamageAssessment($baseConfig, $currentHomeCharString, $home->getNumberOfComponents(), $home->homeValue);
        printVarIfDebug($assessor, getenv('gDebug'), 'Current DamageAssessor Object');

        $assessor->buildReport();
        $dmgWithoutMitigation = $assessor->getEstimatedLoss();
        printVarIfDebug($dmgWithoutMitigation, getenv('gDebug'), 'Damage before mitigation');

        // Get Retrofit Damage Assessment Results
        $retroAssessor = new resre\ResReDamageAssessment($baseConfig, $retrofitCharString, $home->getNumberOfComponents(), $home->homeValue);
        printVarIfDebug($retroAssessor, getenv('gDebug'), 'Retro DamageAssessor Object');

        $retroAssessor->buildReport();
        $dmgAfterMitigation = $retroAssessor->getEstimatedLoss();
        printVarIfDebug($dmgAfterMitigation, getenv('gDebug'), 'Damage after mitigation');

        // Store the objects in the session
        $_SESSION[SESSION_NAME]['assessor'] = serialize($assessor);
        $_SESSION[SESSION_NAME]['retroAssessor'] = serialize($retroAssessor);
    }

header('Location: ' . SITE_ROOT . $target);

        