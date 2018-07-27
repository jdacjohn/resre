<?php
namespace resre;

/**
 * Description of ResReMitigators
 *
 * @author John Arnold <john@jdacsolutions.com>
 */
class ResReMitigators {
    private $stories;
    private $wallType;
    private $shutters;
    private $roofShape;
    private $garageDoor;
    private $roofToWall;
    private $rdaA;
    private $rdaB;
    private $waterBarrier;
    
    /**
     * Create a mitigation set with instantiated best characteristics for each wind component
     */
    public function __construct() {
        // Stories doesnt' matter.  CurChar and Best Char will always be the same based on user selection.  Non-upgradeable
        $this->stories = new Mitigant('', '', '', 'stories');
        // Wall Type selection value goes to baseConfig, not curHomeCharString.  Non-upgradeable
        $this->wallType = new Mitigant('', 'rmfys', '', 'wall type');
        // Shutters - either Yes or No.  Won't make a difference because  based on mitKey value.  Non-upgradeable
        $this->shutters = new Mitigant('', 'shtys', '', 'shutters');
        // Roof Shape
        $this->roofShape = new Mitigant('', 'rship', '', 'roof shape');
        //  Garage doors - If shutters, garage door won't make a difference.  If no shutters, best garage door is gdstd (Wind Resistant)
        $this->garageDoor = new Mitigant('', 'gdsup', '', 'garage door');
        // Roof to Wall Connectors - Best is strap  (Remember - this comes from B (spacing selection) after nail length selection
        $this->roofToWall = new Mitigant('', 'strap', '', 'roof to wall');
        // RDA-A - 8 or 10 inch nails at 6'" spacing is best
        $this->rdaA = new Mitigant('', 'rda8s', '', 'rda-A');
        // RDA-B - Will be the same as -A - only the mitKey will differ for imformational purposes
        $this->rdaB = new Mitigant('', 'rda8s', '', 'rda-B');
        // Water Barrier - Best option is yes, doesn't matter the type
        $this->waterBarrier = new Mitigant('', 'swrys', '', 'water barrier');
    }
    /**
     * 
     * @return resre\Mitigant
     */
    function getStories() {
        return $this->stories;
    }

    function getWallType() {
        return $this->wallType;
    }

    function getShutters() {
        return $this->shutters;
    }

    function getRoofShape() {
        return $this->roofShape;
    }

    function getGarageDoor() {
        return $this->garageDoor;
    }

    function getRoofToWall() {
        return $this->roofToWall;
    }

    function getRdaA() {
        return $this->rdaA;
    }

    function getRdaB() {
        return $this->rdaB;
    }

    function getWaterBarrier() {
        return $this->waterBarrier;
    }
    
    /**
     *  Build and return the 'base config' string for the current property.
     * @return string
     */
    public function getBaseConfig() {
        return $this->wallType->getCurVal() . $this->stories->getCurVal();
    }

    /**
     * Build and return the current home characteristics string for the property.
     * @param int $noWindComps - determines if extra wall type string is required.
     */
    public function getCurHomeCharString($noWindComps = 6) {
        $curHomeCharStr = '';
        if ($noWindComps >= 6 && $noWindComps <= 7) {
            $curHomeCharStr = $this->getRoofShape()->getCurVal() .
                $this->getWaterBarrier()->getCurVal() .
                $this->getRdaB()->getCurVal() .
                $this->getRoofToWall()->getCurval() .
                $this->getGarageDoor()->getCurVal() .
                $this->getShutters()->getCurVal();
            if ($noWindComps == 7) {
                $curHomeCharStr .= $this->getWallType()->getMitKey();
            }
        }
        return $curHomeCharStr;
    }
    
    public function getOptimalHomeCharString($numComps = 6) {
        $charString = 
        $this->getRoofShape()->getOptimumVal() .
        $this->getWaterBarrier()->getOptimumVal() .
        $this->getRdaB()->getOptimumVal() .
        $this->getRoofToWall()->getOptimumVal() .
        $this->getGarageDoor()->getOptimumVal() .
        $this->getShutters()->getOptimumval();
        if ($numComps == 7) {
            $charString .= 'rmfys';
        }
        return $charString;
    }
}
