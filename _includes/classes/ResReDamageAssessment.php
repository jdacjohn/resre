<?php
namespace resre;

/**
 *  ShipCalcEstimate builds a vehicle shipping cost estimate based on startPoint, endPoint, vehicleType, and vehicleSize.
 *
 *  @author John Arnold, JDAC Solutions <john@jdacsolutions.com>
 *  @copyright  Copyright (c) 2018 jdacsolutions.com
 *  @version    $1.0$
 */
/**
 * ResReDamageAssessment develops loss ratio results form the US HAZUS DB set to report potential damage costs
 *  for a home in the event of a severe storm.
 *
 * @author John Arnold, JDAC Solutions <john@jdacsolutions.com>
 * @copyright Copyright (c) 2018 jdacsolutions.com
 */
class ResReDamageAssessment {
 
        private $baseConfig = '';
        private $curHomeCharString = '';
        private $windSpeed = 0;
        private $wsComponents = 6;
        private $homeValue = 300000;
        private $hurricaneCategory = 2;
        private $lossRatio = 0;
        private $wbID = 0;
        
        public function __construct($bc, $chcs, $components =  6, $value = 300000, $ws = 100) {
            $this->baseConfig = $bc;
            $this->curHomeCharString = $chcs;
            $this->wsComponents = $components;
            $this->homeValue = $value;
            $this->windSpeed = $ws;
        }
        
        /**
         *  Set the windspeed and hurricane category.
         * @param int $hc - Min: 1 Max: 5 - The Hurricane Category
         */
        public function setHurricaneCategory($hc = 1) {
            // Default to 1 for out of range hurricane category values
            if ($hc < 1 || $hc > 5) {
                $hc = 1;
            }
            $this->hurricaneCategory = $hc;
            switch ($this->hurricaneCategory) {
                case 1:
                    $this->windSpeed = 85;
                    break;
                case 2:
                    $this->windSpeed = 100;
                    break;
                case 3:
                    $this->windSpeed = 120;
                    break;
                case 4:
                    $this->windSpeed = 145;
                    break;
                case 5:
                    $this->windSpeed = 165;
                    break;
            }
        }
        
        /**
         *  Calculate the required damage assessment data based on the  receiver's instantiated properties
         */
        public function buildReport() {
            $this->wbID = getWBID($this->baseConfig, $this->curHomeCharString, $this->wsComponents);
            printVarIfDebug($this->wbID, getenv('gDebug'), 'wbID returned from DB');
            if ($this->wbID > 0) {
                // Match found.  Let's get the loss ratio.
                // Current application defaults the terrian ID to 3 and the damageLossDescriptionID to 5.  I'm not sure why but
                // I'm going to go ahead and set these up as args on the DB function call with defaults to these values.  That way
                // if they ever want to expand this, they can be included in the function calls.
                $this->lossRatio = getLossRatio($this->wbID, $this->windSpeed);
                printVarIfDebug($this->lossRatio, getenv('gDebug'), 'Loss Ratio Returned from DB');
            }
        }
        
        public function getEstimatedLoss() {
            return $this->homeValue * $this->lossRatio;
        }
        
        /**
         * 
         * @param object $resReHome - PHP ResReHome object containing properties we want to save in addition to this object's properties.
         */
        public function saveData($resReHome, $mitigators) {
            $id = insertUserData($this, $resReHome, $mitigators);
            return $id;
        }
        
        // Getters and Setters
        function getHurricaneCategory() {
            return $this->hurricaneCategory;
        }

        function getBaseConfig() {
            return $this->baseConfig;
        }

        function getCurHomeCharString() {
            return $this->curHomeCharString;
        }

        function getWindSpeed() {
            return $this->windSpeed;
        }

        function getWsComponents() {
            return $this->wsComponents;
        }

        function getHomeValue() {
            return $this->homeValue;
        }

        function getLossRatio() {
            return $this->lossRatio;
        }

        function getWbID() {
            return $this->wbID;
        }

}
