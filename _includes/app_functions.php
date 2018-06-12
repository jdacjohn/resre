<?php

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
 *  Blow away everything in the session
 * @param type $limit_to_index
 */
function reset_session($limit_to_index = false) {
    $userArray = array(
        'userId' => '',
        'last_initialized' => '',
        'logged_in' => false
    );
    $property = array(
        'homeName' => '',
        'firstName' => '',
        'homeValue' => 300000,
        'zipCode' => '11111',
        'buildYear' => 2020,
        'latlng' => ''
    );
    $homeChars = array(
        'roofShape' => 'rsgab',
        'secondaryWaterResistance' => 'swrno',
        'roofDeckAttachment' => 'rda6d',
        'wallConnection' => 'tnail',
        'rollerDoor' => 'gdnod',
        'shutters' => 'shtno',
        'extraWallTypeString' => '',
        'numberOfComponents' => 6
    );
    $baseConfig = array(
        'wallType' => 'WS',
        'numberOfStoreys' => 'F1'
    );
    
    $_SESSION[SESSION_NAME]['user'] = $userArray;
    $_SESSION[SESSION_NAME]['property'] = $property;
    $_SESSION[SESSION_NAME]['homeChars'] = $homeChars;
    $_SESSION[SESSION_NAME]['baseConfig'] = $baseConfig;
}

/**
 *  Initialize the session for the logged in user
 */
function init_user_session($user) {
    $_SESSION[SESSION_NAME]['user']['userId'] = $user;
    $_SESSION[SESSION_NAME]['user']['last_initialized'] = time();
    $_SESSION[SESSION_NAME]['user']['logged_in'] = true;
    
}

function is_logged_in_user($user_id) {
    return (is_logged_in() && $user_id == $_SESSION[SESSION_NAME]['user']['userId']);
}

function is_logged_in() {
    if ( isset($_SESSION[SESSION_NAME]['user']['logged_in']) && $_SESSION[SESSION_NAME]['user']['logged_in'] == true) {
        return true;
    } else {
        return false;
    }
}

function user_login($user, $pw) {
    $loginSuccess = auth_user($user,$pw);
    if ($loginSuccess > 0) {
        return 1;
    } else {
        return 0;
    }
}

/*  DEBUGGING METHODS */
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
