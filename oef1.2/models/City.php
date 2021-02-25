<?php


class city {
    // Properties
    private $id;
    private $filename;
    private $title;
    private $width;
    private $height;
    private $published;
    private $lan_id;
    private $date;

    // Methods
    //function __construct($id, $filename, $title, $width, $height, $published, $lan_id, $date) {
    //    $this->id = $id;
    //    $this->filename = $filename;
    //    $this->title = $title;
    //    $this->width = $width;
    //    $this->height = $height;
    //    $this->published = $published;
    //    $this->lan_id = $lan_id;
    //    $this->date = $date;
    //}

    function setId($id) {
        $this->id = $id;
    }
    function getId() {
        return $this->id;
    }

    function setFilename($filename) {
        $this->filename = $filename;
    }
    function getFilename() {
        return $this->filename;
    }

    function setTitle($title) {
        $this->title = $title;
    }
    function getTitle() {
        return strtoupper($this->title);
    }

    function setWidth($width) {
        $this->width = $width;
    }
    function getWidth() {
        return $this->width;
    }

    function setHeight($height) {
        $this->height = $height;
    }
    function getHeight() {
        return $this->height;
    }

    function setPublished($published) {
        $this->published = $published;
    }
    function getPublished() {
        return $this->published;
    }

    function setLanId($lan_id) {
        $this->lan_id = $lan_id;
    }
    function getLanId() {
        return $this->lan_id;
    }

    function setDate($date) {
        $this->date = $date;
    }
    function getDate() {
        return $this->date;
    }

    public function toArray(): array
    {
        return [
            "id" => $this->getId(),
            "filename" => $this->getFilename(),
            "title" => $this->getTitle(),
            "width" => $this->getWidth(),
            "height" => $this->getHeight(),
            "published" => $this->getPublished(),
            "lan_id" => $this->getLanId(),
            "date" => $this->getDate()
        ];
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