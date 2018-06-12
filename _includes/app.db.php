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
function createUser($userName = '', $userPW = '') {
    $lastInsertID = 0;
    if (!$userName == '' && !$userPW == '') {
        $userCount = getUserCount($userName);
        if ($userCount > 0) {
            $lastInsertID = -1;
        } else {
            $dbConn = db_connect();
            $user = mysqli_real_escape_string($dbConn, $userName);
            $pw = mysqli_real_escape_string($dbConn, $userPW);
            $query = "insert into user (`user_email`, `authentication_string`, `create_date`) values('" . $user . "', PASSWORD('" . $pw . "'), now())";
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
 *  Check to see if the user exists in the user table.  Return the number of rows matching the userEmail
 * @param string $userEmail
 */
function getUserCount($userEmail) {
    $dbConn = db_connect();
    $query = "select id from user where user_email = '" . $userEmail . "'";
    $res = mysqli_query($dbConn, $query);
    return mysqli_num_rows($res);
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
    }
    return $success;
}
