<?php


class FictiveCity extends AbstractCity
{
    private $real = false;

    public function isReal() {
        return $this->real;
    }

}