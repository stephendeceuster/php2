<?php


class City extends AbstractCity
{
    private $real = true;

    public function isReal() {
       return $this->real;
    }

    public function findOnGoogleMaps()
    {
        return 'https://www.google.be/maps/place/' . $this->getTitle();
    }

}