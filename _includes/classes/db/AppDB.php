<?php

/*
 *  namespace
 * AppDB
 *
 * Description - Enter a description of the file and its purpose.
 *
 * Author:      John Arnold <john@jdacsolutions.com>
 * Link:           https://jdacsolutions.com
 *
 * Created:             Aug 2, 2018 7:40:40 PM
 * Last Updated:    Date 
 * Copyright            Copyright 2018 JDAC Computing Solutions All Rights Reserved
 */

namespace resre\db;

/**
 * Description of AppDB
 *
 * @author John Arnold <john@jdacsolutions.com>
 */
class AppDB {
    private $dbConn;
    
    public function db_connect() {
        if (!getenv('DB_SERVER')) {
            die('One or more environment variables failed assertions: DATABASE_DSN is missing');
        } elseif (!$this->dbConn = mysqli_connect(getenv('DB_SERVER'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'), getenv('DB_DATABASE'))) {
            die("Could not connect to the database.  Please try again later.");
        } else {
            return $this->dbConn;
        } 
    }
    
    public function getDBConn() {
        return $this->dbConn;
    }
    
}
