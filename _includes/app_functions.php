<?php
use Gregwar\Image\Image;

/*
 * resre
 * app_functions
 *
 * Description - Enter a description of the file and its purpose.
 *
 * Author:      John Arnold <john@jdacsolutions.com>
 * Link:           https://jdacsolutions.com
 *
 * Created:             May 16, 2018 8:45:53 AM
 * Last Updated:    Date 
 * Copyright            Copyright 2018 JDAC Computing Solutions All Rights Reserved
 */

// Constants for newFieldArray()
define('THE_VALUE', 0);
define('THE_TYPE', 1);
define('THE_DEFINED_VALUE', 2);
define('THE_NOT_DEFINED_VALUE', 3);
define('FIELD_IS_ARRAY', 4);
define('ALLOW_NULL_VALUE', 5);

if (!defined('ARRAY_GLUE')) { define('ARRAY_GLUE', "||"); }
if (!defined('POSTBACK_PARAMETER_PREFIX')) define('','__postback__');

// SESSION FUNCTIONS
/**
 *  Blow away everything in the session
 * @param type $limit_to_index
 */
function reset_session($limit_to_index = false) {
    $userArray = array(
        'userId' => '',
        'userHash' => '',
        'logged_in' => false,
        'last_initialized' => '',
        'last_activity' => 0
    );
    $_SESSION[SESSION_NAME]['user'] = $userArray;
}

/**
 *  Initialize the session for the logged in user
 */
function init_user_session($user, $userHash) {
    reset_session();
    $timeNow = time();
    $_SESSION[SESSION_NAME]['user']['userId'] = $user;
    $_SESSION[SESSION_NAME]['user']['userHash'] = $userHash;
    $_SESSION[SESSION_NAME]['user']['last_initialized'] = $timeNow;
    $_SESSION[SESSION_NAME]['user']['last_initialized_fmt'] = date("d F Y H:i:s", $timeNow);
    $_SESSION[SESSION_NAME]['user']['last_activity'] = $timeNow;
    $_SESSION[SESSION_NAME]['user']['last_activity_fmt'] = date("d F Y H:i:s", $timeNow);
    $_SESSION[SESSION_NAME]['user']['logged_in'] = true;
    
    // Check to see if the user has a saved state.  if so, load it.
    $rowId = getUserData($userHash);
    printVarIfDebug($rowId, getenv('gDebug'), 'User ID of Row we want');
    if ($rowId > 0) {
        $serialized = getSerializedUserData($rowId);
        $mitigants = (!$serialized['mitigators'] == '') ? unserialize(base64_decode($serialized['mitigators'])) : new resre\ResReMitigators();
        $home = (!$serialized['home_serialized'] == '') ? unserialize(base64_decode($serialized['home_serialized'])) : new resre\ResReHome();
        $_SESSION[SESSION_NAME]['home'] = serialize($home);
        $_SESSION[SESSION_NAME]['mitigants'] = serialize($mitigants);
    }
}

/**
 *  Save the current state of the UX to the database.  Return the id of the row updated or inserted.
 * @param resre\ResReMitigators $resReMitigators
 * @param resre\ResReHome $resReHome
 * @return int
 */
function saveState($resReMitigators, $resReHome) {
    // User clicked the save button.
    $baseConfig = $resReMitigators->getBaseConfig();
    $curHomeCharStr = $resReMitigators->getCurHomeCharString($resReHome->getNumberOfComponents());
    $assessor = new resre\ResReDamageAssessment($baseConfig, $curHomeCharStr, $resReHome->getNumberOfComponents(), $resReHome->homeValue);

    printVarIfDebug('We have hit the save entry point', getenv('gDebug'), 'Attempting to Save');
    printVarIfDebug($assessor, getenv('gDebug'), 'ResReDamageAssessment');
    $newID = $assessor->saveData($resReHome, $resReMitigators);
    printVarIfDebug($newID, getenv('gDebug'), 'ID of inserted/updated row');
    return $newID;
}


// LOGIN FUNCTIONS
/**
 * Check if a particular user is logged in
 * @param type $user_id
 * @return boolean
 */
function is_logged_in_user($user_id) {
    return (is_logged_in() && $user_id == $_SESSION[SESSION_NAME]['user']['userId']);
}

/**
 * Check if the session shows a logged in user
 * @return boolean
 */
function is_logged_in() {
    return ( isset($_SESSION[SESSION_NAME]['user']['logged_in']) && $_SESSION[SESSION_NAME]['user']['logged_in']);
}

/**
 * Processes a login request submitted from the  application login modal.
 * @return string - A string response indicating any error conditions that may occur during login attempt.
 */
function procLoginRequest() {
    $email = filter_input(INPUT_POST,'login_input_email',FILTER_VALIDATE_EMAIL);
    $response = (!$email) ? 'Invalid email address provided.' : '';
    $pw1 = escape(trim($_POST['login_input_password']));
    if ($response == '') {
        // All is good - proceed.
        $loggedIn = user_login($email, $pw1);
        if ($loggedIn > 0) {
            // Initialize a session with the user
            $userHash = getUserHash($email);
            init_user_session($email, $userHash);
        } else {
            $response = 'Invalid email address or password.';
        }        
    }
    return $response;
}

/**
 * Process a new user account request.  Return an error string if user already exists.
 * @return string
 */
function procSignupRequest() {
    $email = filter_input(INPUT_POST,'signup_input_email',FILTER_VALIDATE_EMAIL);
    $response = (!$email) ? 'Invalid email address provided.' : '';
    $pw1 = escape(trim($_POST['signup_input_password']));
    if ($response == '') {
        // All is well with Malooki.  Proceed with caution.
        $userHash = getRandomString();
        $userId = createUser($email, $pw1,$userHash);
        if ($userId > 0) {
            // Initialize a session with the user
            init_user_session($email, $userHash);
        } else {
            $response = 'The email you entered already exists in the system.  Either enter a different email address, or if this is your email address, you can request a password reset <a href="'. HOME_LINK . 'resetpw.php">here</a>.';
        }        
    }
    return $response;
}

function procUpdatePassword() {
    printVarIfDebug('Updating password', getenv('gDebug'), 'Password update status');
    $uid = getParam('user-id');
    $pw1 = escape(trim($_POST['reset_input_password']));
    return updateUserPassword($uid, $pw1);
}

/**
 *  Process password reset request from user.  If email posted to site matches a user account, send  a password
 *  reset link to user.
 */
function procPWResetRequest() { 
    $email = filter_input(INPUT_POST,'pw_input_email',FILTER_VALIDATE_EMAIL);
    $response = (!$email) ? 'Invalid email address provided.' : '';
    printVarIfDebug($email, getenv('gDebug'), 'Reached procPWResetRequest');
    if ($response == '') {
        // If email not found, do nothing
            printVarIfDebug('Response is good', getenv('gDebug'), 'Result of User Email Search');
        if (getUserCount($email) > 0) {
            printVarIfDebug('Found User', getenv('gDebug'), 'Result of User Email Search');
            $userId = getUserId($email)['id'];
            printVarIfDebug($userId, getenv('gDebug'), 'ID from DB');
            $hash = getRandomString(120);
            printVarIfDebug($hash, getenv('gDebug'), 'Unique Hash');
            insertPWResetRequest($userId, $hash);
            $mailer = new resre\PWResetRequest($email, $hash);
            $mailer->sendPWResetMsg();
        }
    }
}

/**
 *  Check if link posted in URL parameter is valid.  If it is, return the user id associated with the hash, otherwise
 *  return 0.
 * @return int
 */
function verifyValidLink() {
    $user = 0;
    $hash = getParam('pr');
    printVarIfDebug($hash, getenv('gDebug'), 'Link Hash');
    $row = getPWResetHashSet($hash);
    if (count($row) > 0) {
        // hash matched a table entry - make sure it's not stale
        $hashDate = strtotime($row['date_added']);
        printVarIfDebug($hashDate, getenv('gDebug'), 'DateTime Hash Created');
        $hashExp = $hashDate + 86400;
        printVarIfDebug($hashExp, getenv('gDebug'), 'DateTime + 24 hours');
        $now = time();
        printVarIfDebug($now, getenv('gDebug'), 'Time of Request');
        
        if ($now < $hashExp) {
            $user = $row['user_id'];
        }
    }
    return $user;
}

function procLogoutRequest() {
    if (is_logged_in()) {
        //if($gDebug) { printvar($_SESSION[SESSION_NAME], 'Session before logout block'); }
        session_unset();
        session_destroy();
        session_start();
        reset_session();
    } 
}

/**
 * Attempt to login a user
 * @param string $user
 * @param string $pw
 * @return int
 */
function user_login($user, $pw) {
    //$loginSuccess = auth_user($user,$pw);
    return (auth_user($user,$pw) > 0) ? 1 : 0;
}



/**
 * Move an uploaded user image file to the appropriate folder under userImages
 * @param string $fileName - name of the file that was uploaded
 * @param string $location - the folder location for the file
 * @param string $windChar -  the component selection area
 * @return string
 */
function saveUserImage($fileName, $location, $windChar) {
    
    $response = '';
    // Create new directory if needed.
    if (!is_dir($location)) {
        mkdir($location, 775, true);
    }
    // Get the file extension and if it's a valid type, attempt to move it
    $file_extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    if (in_array($file_extension,VALID_IMG_TYPES)) {
        // Upload file
        if (move_uploaded_file($_FILES['file']['tmp_name'],$location . $fileName)) {
            $response = 'Thank you!  Your file has been uploaded.';
            $imgFileName = random_int(100000, 5000000);
            // Convert the file to a PNG image standardized to app width and height
            $baseName = $imgFileName . '-' . $windChar;
            printVarIfDebug($baseName, getenv('gDebug'), 'File Name =>');
            Image::open($location . $fileName)
             ->resize(LOGO_WIDTH[LOGO_LG], LOGO_HEIGHT[LOGO_LG])
            ->save($location . $baseName . '.png', 'png');
            // Delete the originally uploaded file
            unlink($location . $fileName);
          } else {
              $response = 'There was an issue uploading your file. Please try again.';
          }   
    } else {
        $response = '<span style="color: #f00">Please specify either a <strong>JPG</strong> or <strong>PNG</strong> file to upload.</span>';
    }
    return $response;
}

// COMMON FUNCTIONS
/**
 *  Checks the POST and GET collections for any values with the paramName key and returns the value.
 *  Usage 
 *      getParam(string paramName, boolean fieldIsArray, string the DefaultValue
 * @
 * @param   string    $paramName  - The name of the parameter to be found
 * @param   boolean   $fieldIsArray - Indicates if the parameter to be found is an array
 * @param   mixed     $theDefaultValue - value to return if the param is not found
 * @param   string  $theArrayGlue -     delimiter to be used for array explosion
 * @return  string
 */
function getParam($paramName, $fieldIsArray = false, $theDefaultValue = "", $theArrayGlue = ARRAY_GLUE) {
    $theField = "";
    if (isset($_POST[$paramName])) {
        $theField = $_POST[$paramName];
    } elseif (isset($_GET[$paramName])) {
        $theField = $_GET[$paramName];
    }
    if ($fieldIsArray) {
        //for multiple-item select fields
        if (!is_array($theField)) {
            if (trim($theField) === "") {
                $theField = (($theDefaultValue == "") ? array() : explode($theArrayGlue, $theDefaultValue));
            } else {
                $theField = explode($theArrayGlue, $theField);
            }
        }
    } elseif (is_array($theField)) {
        //the field that was requested is an array but was not requested as one, convert to string
        $theField = ((!sizeof($theField)) ? $theDefaultValue : explode($theArrayGlue, $theField));
    } elseif (trim($theField) == "") {
        $theField = $theDefaultValue;
    }
    return $theField;
}

function escape($input) {
    return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
}

/**
 *  Create a random string to be used as a hash value for new user accounts
 * @param type $length
 * @return string
 */
function getRandomString($length = 40) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string = '';
    for ($i = 0; $i < $length; $i++) {
        $string .= $characters[mt_rand(0, strlen($characters) - 1)];
    }
    return $string;
}

/*  DEBUGGING FUNCTIONS */
/**
 *  Summary
 *          Outputs the object, $var if the  $debug parameter is true.  This method eliminates the need for so many if(0 { } 
 *          statements throughout the code and minimizes 'Too Many Nested If' warnings.
 * @param object $var
 * @param boolean $debug
 * @param string $label
 */
function printVarIfDebug($var, $debug, $label="") {
    if ($debug) {
        print "<pre style=\"border: 1px solid #999; background-color: #f7f7f7; color: #000; overflow: auto; width: auto; text-align: left; padding: 1em;\">" .
            ((strlen(trim($label))) ? htmlentities($label)."\n===================\n" : "" ) . htmlentities(print_r($var, TRUE)) . "</pre>";
    }
}
