<?php

namespace resre;

/**
 * Description of Mitigant
 *
 * @author John Arnold <john@jdacsolutions.com>
 */

class Mitigant {
    // properties / instance variables
    private $curVal = '';
    private $optimumVal = '';
    private $feature = '';
    private $mitKey = '';
    private $recommendation = '';
    private $label;
    private $costMsg = '';
    private $costIndicator = '';
    private $resources = '';
    private $resFriendlyName = '';
    
    public function __construct($curChar, $bestChar, $msgKey, $parent) {
        $this->curVal = $curChar;
        $this->optimumVal = $bestChar;
        $this->mitKey = $msgKey;
        $this->feature = $parent;
    }
    
    public function getCurVal() {
        return $this->curVal;
    }

    public function getOptimumVal() {
        return $this->optimumVal;
    }

    public function getMitKey() {
        return $this->mitKey;
    }

    public function getRecommendation() {
        return $this->recommendation;
    }

    public function setCurVal($curVal) {
        $this->curVal = $curVal;
    }

    public function setOptimumVal($optimumVal) {
        $this->optimumVal = $optimumVal;
    }

    public function setMitKey($mitKey) {
        $this->mitKey = $mitKey;
        $dataRow = getMitigationInfo($this->feature, $this->mitKey);
        if (count($dataRow) > 0) {
            $this->label = $dataRow['option_label'];
            $this->recommendation = $dataRow['message'];
            $this->costMsg = $dataRow['cost_msg'];
            $this->costIndicator = $dataRow['cost_indicator'];
            $this->resources = $dataRow['resources'];
            $this->resFriendlyName = $dataRow['res_friendly_name'];
        }
    }

    public function setRecommendation($recommendation) {
        $this->recommendation = $recommendation;
    }

    public function getLabel() {
        return $this->label;
    }

    public function getCostMsg() {
        return $this->costMsg;
    }

    public function getCostIndicator() {
        return $this->costIndicator;
    }

    public function getResources() {
        return $this->resources;
    }
    public function getResFriendlyName() {
        return $this->resFriendlyName;
    }

}
