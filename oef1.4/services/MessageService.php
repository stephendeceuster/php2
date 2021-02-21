<?php


class MessageService {
    private $errors;
    private $input_errors;
    private $infos;

    public function __construct() {
        $this->errors = $_SESSION['errors'];
        $_SESSION['errors'] = [];

        $this->infos = $_SESSION['msgs'];
        $_SESSION['msgs'] = [];

        $this->input_errors = $_SESSION['input_errors'];
        $_SESSION['input_errors'] = [];
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
        return count($_SESSION['msgs']);
    }

    public function GetInputErrors() {
        if ($this->CountInputErrors()) {
            return $this->input_errors;
        }
        return null;
    }

    public function AddMessage($type, $msg, $key = null) {
        if ($type === 'input_error') {
            array_push($_SESSION['errors'][$key . "_error"], $msg);
        } else {
            array_push($_SESSION($type), $msg);
        }
    }

    public function ShowErrors() {
        print "<p style='color:red'>$this->errors</p>";
    }

    public function ShowInfos() {
        print "<div class='msgs'>$this->infos</div>";
    }

}