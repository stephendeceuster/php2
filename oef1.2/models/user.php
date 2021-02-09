<?php


class user {
    // Properties
    private $id;
    private $voornaam;
    private $naam;
    private $email;
    private $telefoon;

    // Methods
    function setId($id) {
        $this->id = $id;
    }
    function getId() {
        return $this->id;
    }

    function setVoornaam($voornaam) {
        $this->voornaam = $voornaam;
    }
    function getVoornaam() {
        return strtoupper( $this->voornaam );
    }

    function setNaam($naam) {
        $this->naam = $naam;
    }
    function getNaam() {
        return strtoupper( $this->naam );
    }

    function setEmail($email) {
        $this->email = $email;
    }
    function getEmail() {
        return $this->email;
    }

    function setTelefoon($telefoon) {
        $this->telefoon = $telefoon;
    }
    function getTelefoon() {
        return $this->telefoon;
    }

    public function toArray2(): array
    {
        $retarr = [];

        foreach( $this as $key => $value )
        {
            $retarr[$key] = $value;
        }
        return $retarr;
    }
}