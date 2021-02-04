<?php


class city {
    // Properties
    public $id;
    public $filename;
    public $title;
    public $width;
    public $height;
    public $published;
    public $lan_id;
    public $date;

    // Methods
    function __construct($id, $filename, $title, $width, $height, $published, $lan_id, $date) {
        $this->id = $id;
        $this->filename = $filename;
        $this->title = $title;
        $this->width = $width;
        $this->height = $height;
        $this->published = $published;
        $this->lan_id = $lan_id;
        $this->date = $date;

    }

    function set_id($id) {
        $this->id = $id;
    }
    function get_id() {
        return $this->id;
    }

    function set_filename($filename) {
        $this->filename = $filename;
    }
    function get_filename() {
        return $this->filename;
    }

    function set_title($title) {
        $this->title = $title;
    }
    function get_title() {
        return strtoupper($this->title);
    }

    function set_width($width) {
        $this->width = $width;
    }
    function get_width() {
        return $this->width;
    }

    function set_height($height) {
        $this->height = $height;
    }
    function get_height() {
        return $this->height;
    }

    function set_published($published) {
        $this->published = $published;
    }
    function get_published() {
        return $this->published;
    }

    function set_lan_id($lan_id) {
        $this->lan_id = $lan_id;
    }
    function get_lan_id() {
        return $this->lan_id;
    }

    function set_name($date) {
        $this->date = $date;
    }
    function get_date() {
        return $this->date;
    }
}