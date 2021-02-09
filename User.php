<?php


class User
{

    private $id_user = null;
    private $email = null;
    private $password = null;
    private $name = null;
    private $phoneNumber = null;
    private $postalCode = null;
    private $place = null;
    private $address = null;
    private $orgNumber = null;
    private $typeOfUser = null;
    private $rating1to5 = null;
    private $rating_numberOfVoters = null;
    private $specification = null;
    private $levelOfExperience = null;
    private $websiteURL = null;
    private $description = null;
    private $userHasPaid = null;
    private $userLastPayment = null;
    private $durationOfLastPayment = null;
    private $age = null;
    private $requiredColumnsFilled = null;

    private $image = null;
    private $country = null;
    private $benefits = null;
    private $numOfEmp = null;
    private $gender = null;
    private $industry = null;
    private $startupPhase = null;
    private $lookingFor = null;
    private $businessModel = null;
    private $title = null;

    private function addAllUserdataFromSessionObject($object) {
        $id_user = $object[0];
        for ($i = 0; $i < sizeof($object) ; $i++) {

        }
    }

    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
        return null;
    }

    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
        return $this;
    }


}