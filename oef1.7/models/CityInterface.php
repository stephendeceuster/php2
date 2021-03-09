<?php


interface CityInterface
{
    public function getId();

    public function setId(int $id);

    public function getFilename();

    public function setFilename($filename);

    public function getTitle();

    public function setTitle($title);

    public function getWidth();

    public function setWidth($width);

    public function getHeight();

    public function setHeight($height);

    public function getPublished();

    public function setPublished($published);

    public function getLanId();

    public function setLanId($lan_id);

    public function getDate();

    public function setDate($date);

    public function toArray();

    public function toArray2();

    public function isReal();
}