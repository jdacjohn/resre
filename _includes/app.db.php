<?php

/*
 * resre
 * app
 *
 * Description - Enter a description of the file and its purpose.
 *
 * Author:      John Arnold <john@jdacsolutions.com>
 * Link:           https://jdacsolutions.com
 *
 * Created:             May 16, 2018 8:45:35 AM
 * Last Updated:    Date 
 * Copyright            Copyright 2018 JDAC Computing Solutions All Rights Reserved
 */

/**
 *  Connect to the Application DB and return a DB Connection Handle.
 */
function db_connect() {
    if (!getenv('DB_SERVER')) {
        die('One or more environment variables failed assertions: DATABASE_DSN is missing');
    } elseif (!$dbConn = mysqli_connect(getenv('DB_SERVER'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'), getenv('DB_DATABASE'))) {
        die("Could not connect to the database.  Please try again later.");
    } else {
        return $dbConn;
    } 
}

/**
 *   Insert a new user into the user table and return the id of the new user account.
 * @param string $userName
 * @param string $userPW
 */
function createUser($userName = '', $userPW = '', $userHash = '') {
    $lastInsertID = 0;
    if (!$userName == '' && !$userPW == '') {
        $userCount = getUserCount($userName);
        if ($userCount > 0) {
            $lastInsertID = -1;
        } else {
            $dbConn = db_connect();
            $user = mysqli_real_escape_string($dbConn, $userName);
            $pw = mysqli_real_escape_string($dbConn, $userPW);
            $query = "insert into user (`user_email`, `authentication_string`, `create_date`, `user_hash`) values('" . $user . "', PASSWORD('" . $pw . "'), now(), '" . $userHash . "')";
            $res = mysqli_query($dbConn, $query);
            if ($res) {
                $lastInsertID = mysqli_insert_id($dbConn);
            }
            mysqli_close($dbConn);
        }
    }
    return $lastInsertID;
}

/**
 *  Return the  user row matching the $email argument 
 * @param string $email - email address of the user
 * @return array
 */
function getUserId($email = '') {
    $return = array();
    if (!$email == '') {
        $dbConn = db_connect();
        $query = "select id from user where user_email = '" . $email . "'";
        $result = mysqli_query($dbConn, $query);
        if ($result) {
            $return = mysqli_fetch_array($result);
        }
        mysqli_close($dbConn);
    }
    return $return;
}

/**
 *  Insert a new password reset request into the pw_reset table.
 * @param int $userId
 * @param string $hash
 */
function insertPWResetRequest($userId, $hash) {
    $query = "insert into pw_reset (`user_id`, `user_hash`, `date_added`) values(" . $userId . ", '" . $hash . "', NOW())";
    printVarIfDebug($query, getenv('gDebug'), 'Insert Query');
    $dbConn = db_connect();
    $result = mysqli_query($dbConn, $query);
    if ($result) {
            printVarIfDebug('Query Passed', getenv('gDebug'), 'Insert Query');

    } else {
            printVarIfDebug('Query Failed', getenv('gDebug'), 'Insert Query');

    }
    mysqli_close($dbConn);
}

function getPWResetHashSet($hash) {
    $row = array();
    $query = "select `user_id`, `date_added` from pw_reset where `user_hash` = '" . $hash . "'";
    $dbConn = db_connect();
    $result = mysqli_query($dbConn, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
    }
    mysqli_close($dbConn);
    return $row;
}

function updateUserPassword($uid, $pw) {
    $success = 0;
    $dbConn = db_connect();
    $query = "update `user` set `authentication_string` = PASSWORD('" . $pw . "') where `id` = " . $uid;
        printVarIfDebug($query, getenv('gDebug'), 'SQL: ');
    $result = mysqli_query($dbConn, $query);
    if ($result) {
        $success = 1;
    }
    mysqli_close($dbConn);
    return $success;
}

/**
 *  Check to see if the user exists in the user table.  Return the number of rows matching the userEmail
 * @param string $userEmail
 */
function getUserCount($userEmail) {
    $dbConn = db_connect();
    $query = "select id from `user` where user_email = '" . $userEmail . "'";
    $res = mysqli_query($dbConn, $query);
    $userCount = mysqli_num_rows($res);
    mysqli_close($dbConn);
    return $userCount;
}

/**
 *  Check the user and pw against the user table.  Return 0 on no match, 1 on match.  Update the user's number of logins if creds
 *  match.
 * @param string $user
 * @param string $pw
 */
function auth_user($user = '', $pw = '') {
    $success = 0;
    if (!$user == '' && !$pw == '') {
        $dbConn = db_connect();
        $query = "select id from user where user_email = '" . mysqli_real_escape_string($dbConn,$user) . "' and authentication_string = PASSWORD('" . mysqli_real_escape_string($dbConn,$pw) . "')";
        $res = mysqli_query($dbConn, $query);
        if (mysqli_num_rows($res) > 0) {
            // Credentials matched, updte the number of logins for the user.
            $update = "update user set logins = logins + 1 where user_email = '" . mysqli_real_escape_string($dbConn,$user) . "'";
            mysqli_query($dbConn,$update);
            $success = 1;
        }
        mysqli_close($dbConn);
    }
    return $success;
}

function getUserHash($user) {
    $userHash = 'Not found';
    $dbConn = db_connect();
    $query = "select user_hash from user where user_email = '" . $user . "'";
    $res = mysqli_query($dbConn, $query);
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_array($res);
        $userHash = $row['user_hash'];
    }
    mysqli_close($dbConn);
    return $userHash;
}

function getWBID($bc, $chcs, $components) {
    $wbID = 0;
    printVarIfDebug('Made it to the APP_DB func', getenv('gDebug'), 'Progress');
        printVarIfDebug($bc, getenv('gDebug'), 'BaseConfig in DB APP');
        printVarIfDebug($chcs, getenv('gDebug'), 'homeCharString in DB APP');
        printVarIfDebug($components, getenv('gDebug'), 'Components in DB APP');
    
    if (!$bc == '' && !$chcs == '' && $components >= 6 && $components <= 7) {
        $dbConn = db_connect();
        $query = "select wbID from houseDescriptions where nWindChar = " . $components . " and sbtName = '" . $bc . "' and charDescription = '" . $chcs . "'";
        printVarIfDebug($query, getenv('gDebug'), 'SQL: ');
        $res = mysqli_query($dbConn, $query);
        if (mysqli_num_rows($res) > 0) {
            $resultRow = mysqli_fetch_array($res);
            $wbID = $resultRow['wbID'];
        }
        mysqli_close($dbConn);
    }
    return $wbID;
}

function getLossRatio($wbID, $windSpeed, $terrainID = 3, $dmgLossDescID = 5) {
    $lossRatio = 0;
    if ($wbID > 0 && $windSpeed >= 50) {
        $lrWSCol = 'WS' . $windSpeed;
        printVarIfDebug($lrWSCol, getenv('gDebug'), 'LR Table WS Column: ');
        $query = "select " . $lrWSCol . " as lossRatio from lossratios where wbID = " . $wbID . " and TerrainID = " . $terrainID . " and DamLossDescID = " . $dmgLossDescID;
        printVarIfDebug($query, getenv('gDebug'), 'SQL: ');
        $dbConn = db_connect();
        $result = mysqli_query($dbConn, $query);
        if (mysqli_num_rows($result) > 0) {
            $resRow = mysqli_fetch_array($result);
            $lossRatio = $resRow['lossRatio'];
        }
        mysqli_close($dbConn);
    } 
    return $lossRatio;
}

/**
 *   Insert a new user data row into the user_data_2 table and return the id of the new row.
 * @param object $resReDA - an instance of ResReDamageAssessment 
 * @param object $resReHome - an instance of ResReHome
 */
function insertUserData($resReDA, $resReHome, $mitigators) {
    $userHash = $_SESSION[SESSION_NAME]['user']['userHash'];
    $lastInsertID = 0;
    if (($foundId = getUserData($userHash)) > 0) {
       $lastInsertID = updateUserData($resReDA, $resReHome, $mitigators, $foundId);
    } else {
        $dbConn = db_connect();
        $query = "insert into user_data_2 (`user_hash`, `zipCode`, `latlng`, `baseConfig`, `charDescription`, `homeValue`, `buildYear`, `homeName`, `firstName`, `locality`, `state`, `country`, `geoLoc`, `dateAdded`, `components`, `mitigators`, `home_serialized`) " .
            "values('" . $userHash . "', '" . $resReHome->zipCode . "', '" . $resReHome->latLng . "', '" . $resReDA->getBaseConfig() . "', '" . $resReDA->getCurHomeCharString() . "', " .
            $resReHome->homeValue . ", " . $resReHome->buildYear . ", '" . $resReHome->homeName . "', '" . $resReHome->homeOwnerFirstName . "', '" .
            $resReHome->locality . "', '" . $resReHome->state . "', '" . $resReHome->country . "', '" . $resReHome->geoLoc . "', NOW(), " . $resReHome->getNumberOfComponents() . ", '" . base64_encode(serialize($mitigators)) . "', '" . base64_encode(serialize($resReHome)) . "')" ;

        printVarIfDebug($query, getenv('gDebug'), 'INSERT USERDATA SQL: ');

        $result = mysqli_query($dbConn, $query);
        if ($result) {
            $lastInsertID = mysqli_insert_id($dbConn);
        }
        mysqli_close($dbConn);
    }
    return $lastInsertID;
}

function updateUserData($resReDA, $resReHome, $mitigators, $rowId) {
    $updatedRow = 0;
    $query = "update user_data_2 set " .
        "`zipCode` = '" . $resReHome->zipCode . "', " .
        "`latlng` = '" . $resReHome->latLng . "', " .
        "`baseConfig` = '" . $resReDA->getBaseConfig() . "', " .
        "`charDescription` = '" . $resReDA->getCurHomeCharString() . "', " .
        "`homeValue` = " . $resReHome->homeValue . ", " .
        "`buildYear` = " . $resReHome->buildYear . ", " .
        "`homeName` = '" . $resReHome->homeName . "', " .
        "`firstName` = '" . $resReHome->homeOwnerFirstName . "', " .
        "`locality` = '" . $resReHome->locality . "', " .
        "`state` = '" . $resReHome->state . "', " .
        "`country` = '" . $resReHome->country . "', " .
        "`geoLoc` = '" . $resReHome->geoLoc . "', " .
        "`dateAdded` = NOW(), " .
        "`components` = " . $resReHome->getNumberOfComponents() . ", " .
        "`mitigators` = '" . base64_encode(serialize($mitigators)) . "', " .
        "`home_serialized` = '" . base64_encode(serialize($resReHome)) . "' " .
        "where `user_hash` = '" . $_SESSION[SESSION_NAME]['user']['userHash'] . "'";
        $dbConn = db_connect();
        $res = mysqli_query($dbConn, $query);
        if (!$res) {
            printVarIfDebug('Error updating Database', true);
        } else {
            $updatedRow = $rowId;
        }
        mysqli_close($dbConn);
        return $updatedRow;
}

function getUserData($userHash = '') {
    $userId = 0;
    $query = "select id from user_data_2 where user_hash = '" . $userHash . "'";
    $dbConn = db_connect();
    $result = mysqli_query($dbConn,$query);
    if (mysqli_num_rows($result) > 0) {
        $userId = mysqli_fetch_array($result)['id'];
    }
    mysqli_close($dbConn);
    return $userId;
}

function getSerializedUserData($rowId = 0) {
    $emptySet = array(
        'mitigators' => '',
        'home_serialized' => ''
    );
    if($rowId > 0) {
        $query = "select `mitigators`, `home_serialized` from user_data_2 where id = " . $rowId;
        $dbConn = db_connect();
        $result = mysqli_query($dbConn, $query);
        if (mysqli_num_rows($result) > 0) {
            $emptySet = mysqli_fetch_array($result);
        }
        mysqli_close($dbConn);
    }
    return $emptySet;
}

function getMitigationInfo($feature = '', $option = '') {
    $result = [];
    if (!$feature == '' && !$option == '') {
        $dbConn = db_connect();
        $query = "select option_label, message, cost_msg, cost_indicator, resources, res_friendly_name from mit_msg where feature = '" . $feature . "' and f_option = '" . $option . "'";
    printVarIfDebug($query, getenv('gDebug'), 'MIT MSG QUERY: ');
        $res = mysqli_query($dbConn, $query);
        if (mysqli_num_rows($res) > 0) {
            $result = mysqli_fetch_array($res);
        }
        mysqli_close($dbConn);
    }
    return $result;
}

