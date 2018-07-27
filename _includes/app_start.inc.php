<?php
global $root;
//Get configuration variables used throughout project
require_once($root . '_config/config.inc.php');

//redirect to offline message if performing updates
/*if (strpos($_SERVER['PHP_SELF'],'offline.php') === false && !isset($_REQUEST['debug'])) {
	header(PROJECT_URL.'/offline.php');
}*/

//turn off debugging for production
//if (ARE_WE_LIVE) {
//    unset($_REQUEST['debug']);
//    putenv("gDebug= false");
//} else {
//    if (isset($_REQUEST['debug'])) {
//        $debugOn = trim($_REQUEST['debug']);
//    } else {
//        $debugOn = 'false';
 //   }
 //   putenv("gDebug=$debugOn");
 //   if (getenv('gDebug')) {
 //       ob_start();
 //   }
//}

// Define some appRelatedConstants

    
//Include common functions
require_once($root . '_includes/app.db.php');
require_once($root . '_includes/app_functions.php');
//require_once(WEB_ROOT.PROJECT_DIR.'/_includes/addURLParamFunction.inc.php');
//require_once(WEB_ROOT.PROJECT_DIR.'/_includes/stringSwapClass.inc.php');
// require_once(WEB_ROOT.PROJECT_DIR.'/_includes/project-functions.inc.php');

//Some application level variables
$arrErr = getParam(POSTBACK_PARAMETER_PREFIX.'error', true);

//To make self referrencing easy
$gFullSelfRequest = 'http'.((isset($_SERVER['HTTPS'])) ? 's' : '').'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; //With QS
$gQualifiedSelfRequest = 'http'.((isset($_SERVER['HTTPS'])) ? 's' : '').'://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']; //Without QS

$cookie_lifetime = (3600 * 24 * 30); // 30 day cookie life.
$idle_timeout = 3600;
$time = time();

session_set_cookie_params($cookie_lifetime);
session_start(); //start the session
printVarIfDebug(session_id(), getenv('gDebug'), 'SessionID');


if (!isset($_SESSION[SESSION_NAME])) {
    printVarIfDebug('Session has been garbage collected', getenv('gDebug'));
    // The session has been garbage collected and is basically empty.  Rebuild the init session values and keys
    reset_session();
}

// Check if sesstion has been idle
/**
* Here we look for the user's LAST_ACTIVITY timestamp. If
* it's set and indicates our $timeout_duration has passed,
* blow away any previous $_SESSION data and start a new one.
*/
if (isset($_SESSION[SESSION_NAME]['user']['last_activity']) && ($time - $_SESSION[SESSION_NAME]['user']['last_activity']) > $idle_timeout) {
    printVarIfDebug('Session Idle Timed Out', getenv('gDebug'));
    session_unset();
    session_destroy();
    session_start();
    reset_session();
}

/**
* Finally, update LAST_ACTIVITY so that our timeout
* is based on it and not the user's login time.
*/
$_SESSION[SESSION_NAME]['user']['last_activity'] = $time;
$_SESSION[SESSION_NAME]['user']['last_activity_fmt'] = date("d F Y H:i:s", $time);

define('APP_LOADED',1);
