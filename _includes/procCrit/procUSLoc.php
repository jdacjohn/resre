<?php

/*
 * resre
 * procUSLoc
 *
 * Description - Enter a description of the file and its purpose.
 *
 * Author:      John Arnold <john@jdacsolutions.com>
 * Link:           https://jdacsolutions.com
 *
 * Created:             Aug 9, 2018 3:49:07 PM
 * Last Updated:    Date 
 * Copyright            Copyright 2018 JDAC Computing Solutions All Rights Reserved
 */

    $root = '../../';
    require($root . '_includes/app_start.inc.php');

    $postFrom = isset($_POST['postFrom']) ? $_POST['postFrom'] : '';
    $mitigants = new resre\ResReMitigators;
    $home = new resre\ResReHome();
    $response = 0;
    $trigger = '';
    // Get the mitgation set from the session if already created, else create one.
    if (isset($_SESSION[SESSION_NAME]['mitigants'])) {
        $mitigants = unserialize($_SESSION[SESSION_NAME]['mitigants']);
    } 
    $selected = $mitigants->getStories()->getCurVal();
    // Get the home object from the session if already created, else create one.
    if (isset($_SESSION[SESSION_NAME]['home'])) {
        $home = unserialize($_SESSION[SESSION_NAME]['home']);
    } 
    
    printVarIfDebug($postFrom, getenv('gDebug'), "Posted From");

    if ($postFrom == '__us-loc__') {
        // Posted from the location page.  Save the location post data to the home object.
        $home->geoLoc = filter_input(INPUT_POST, 'input_geoLoc', FILTER_SANITIZE_STRING);
        $home->latLng = $_POST['geo-home-location'];
        $home->zipCode = $_POST['geo-home-postal_code'];
        $home->locality = $_POST['geo-home-locality'];
        $home->state = $_POST['geo-home-state'];
        $home->country = $_POST['geo-home-country_short'];
    }
      
    // Save the home and mitigator objects to the session
    $_SESSION[SESSION_NAME]['home'] = serialize($home);
    $_SESSION[SESSION_NAME]['mitigants'] = serialize($mitigants);
    printVarIfDebug($_SESSION, getenv('gDebug'), 'Session After Posting');
    printVarIfDebug($selected, getenv('gDebug'), 'Value of PostBack selection:');
    printVarIfDebug($mitigants, getenv('gDebug'), 'ResReMitigators');
    printVarIfDebug($home, getenv('gDebug'), 'ResReHome');

    header('Location: ' . SITE_ROOT . '/us/stories.php');