<?php
namespace resre;

/**
 * Description of ResReHome - PHP class to logically contain all home info for damage assessments
 *
 * @author John Arnold <john@jdacsolutions.com>
 */
class ResReHome {
    /**
     * @var string - Name assisgned to home being assessed for potential storm damage.
     */
    public $homeName = '';
    public $homeOwnerFirstName = '';
    public $homeValue = 0;
    public $zipCode = '';
    public $latLng = '';
    public $buildYear = 2020;
    public $locality = '';
    public $state = '';
    public $country = '';
    public $geoLoc = '';
    private $numberOfComponents = 6;

    public function __construct($hName = 'No-Home-Name', $ownerName = 'Jane-Doe', $value = 1) {
        $this->homeName = $hName;
        $this->homeOwnerFirstName = $ownerName;
        $this->homeValue = $value;
    }
    
    /**
     *  Get the number of components to be used in the damage assessment for this home
     * @return int
     */
    public function getNumberOfComponents() {
        return $this->numberOfComponents;
    }

    /**
     * Set the number of wind characteristics components on the home.  The only valid values for this are 6 or 7.
     * Any other value passed in will be disregarded.
     * @param int $numberOfComponents
     * @return $this
     */
    public function setNumberOfComponents($numberOfComponents) {
        if ($numberOfComponents == 6 || $numberOfComponents == 7) {
            $this->numberOfComponents = $numberOfComponents;
        }
        return $this;
    }
    
    public function getHomeName() {
        return $this->homeName;
    }

    public function getHomeOwnerFirstName() {
        return $this->homeOwnerFirstName;
    }

    public function getHomeValue() {
        return $this->homeValue;
    }

    public function getZipCode() {
        return $this->zipCode;
    }

    public function getLatLng() {
        return $this->latLng;
    }

    public function getBuildYear() {
        return $this->buildYear;
    }

    public function getLocality() {
        return $this->locality;
    }

    public function getState() {
        return $this->state;
    }

    public function getCountry() {
        return $this->country;
    }

    public function getGeoLoc() {
        return $this->geoLoc;
    }

    public function setHomeName($homeName) {
        $this->homeName = $homeName;
        return $this;
    }

    public function setHomeOwnerFirstName($homeOwnerFirstName) {
        $this->homeOwnerFirstName = $homeOwnerFirstName;
        return $this;
    }

    public function setHomeValue($homeValue) {
        $this->homeValue = $homeValue;
        return $this;
    }

    public function setZipCode($zipCode) {
        $this->zipCode = $zipCode;
        return $this;
    }

    public function setLatLng($latLng) {
        $this->latLng = $latLng;
        return $this;
    }

    public function setBuildYear($buildYear) {
        $this->buildYear = $buildYear;
        return $this;
    }

    public function setLocality($locality) {
        $this->locality = $locality;
        return $this;
    }

    public function setState($state) {
        $this->state = $state;
        return $this;
    }

    public function setCountry($country) {
        $this->country = $country;
        return $this;
    }

    public function setGeoLoc($geoLoc) {
        $this->geoLoc = $geoLoc;
        return $this;
    }




}
