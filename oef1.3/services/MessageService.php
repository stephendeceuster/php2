<?php


class MessageService {
    private $errors;
    private $input_errors;
    private $infos;

    public function __construct() {
        $this->errors = $_SESSION['errors'];
        $this->input_errors = $_SESSION['input_errors'];
        $this->infos = $_SESSION['infos'];

        $_SESSION['errors'] = [];
        $_SESSION['input_errors'] = [];
        $_SESSION['infos'] = [];
    }

    public function CountErrors() {
        return count($this->errors);
    }
    public function CountInputErrors() {
        return count($this->input_errors);
    }
    public function CountInfos() {
        return count($this->infos);
    }

    public function CountNewErrors() {
        return count($_SESSION['errors']);
    }
    public function CountNewInputErrors() {
        return count($_SESSION['input_errors']);
    }
    public function CountNewInfos() {
        return count($_SESSION['infos']);
    }

    public function GetInputErrors() {
        if ($this->CountInputErrors()) {
            return $this->input_errors;
        } else {
            return null;
        }
    }

    public function AddMessage($type, $msg, $key = null) {

    }

}