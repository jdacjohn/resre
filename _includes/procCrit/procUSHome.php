<?php

/*
 * resre
 * procUSHome
 *
 * Description - Enter a description of the file and its purpose.
 *
 * Author:      John Arnold <john@jdacsolutions.com>
 * Link:           https://jdacsolutions.com
 *
 * Created:             Aug 9, 2018 3:38:28 PM
 * Last Updated:    Date 
 * Copyright            Copyright 2018 JDAC Computing Solutions All Rights Reserved
 */
    $root = '../../';
    require($root . '_includes/app_start.inc.php');
    include($root . '_includes/classes/ResReHome.php');
    
    $home = '';
    if (isset($_SESSION[SESSION_NAME]['home'])) {
        // Get the ResReHome object from the session
        $home = unserialize($_SESSION[SESSION_NAME]['home']);
    } else {
        // First time here - Create a new ResReHome object.
        $home = new resre\ResReHome();
    }

    $postFrom = isset($_POST['postFrom']) ? $_POST['postFrom'] : '';
    printVarIfDebug($postFrom, getenv('gDebug'), "Posted From");

    // If form was posted from index. php,  process home property id info, else set loc values back to what they were before looping
    // back from the stories.php page.
    if ($postFrom == "__us-home__") {
        // Get the form data from us-home
        $home->homeName = filter_input(INPUT_POST, 'input_homeName', FILTER_SANITIZE_STRING);
        $home->homeOwnerFirstName = filter_input(INPUT_POST, 'input_firstName', FILTER_SANITIZE_STRING);
        $val = preg_replace("/[^0-9]/", "", filter_input(INPUT_POST, 'input_homeValue', FILTER_SANITIZE_STRING));
        printVarIfDebug($val, getenv('gDebug'), 'Home Val after filtering and stripping nonnumeric');
        
        $home->homeValue = is_numeric($val) ? $val : 300000;
        // Save it to the session
        $_SESSION[SESSION_NAME]['home'] = serialize($home);
        $target = '/us/loc.php';
    }  else {
        $target = '/us/index.php';
    }
    printVarIfDebug($_SESSION, getenv('gDebug'), 'Session on After Posting');
    printVarIfDebug($home, getenv('gDebug'), 'ResReHome object');
    
    header('Location: ' . SITE_ROOT . $target);
