<?php


class MessageService {
    private $errors;
    private $input_errors;
    private $infos;

    public function __construct() {
        if ( key_exists( 'errors', $_SESSION ) AND is_array( $_SESSION['errors']) ) {
            $this->errors = $_SESSION['errors'];
            $_SESSION['errors'] = [];
        }

        if ( key_exists( 'msgs', $_SESSION ) AND is_array( $_SESSION['msgs']) ) {
            $this->infos = $_SESSION['msgs'];
            $_SESSION['msgs'] = [];
        }

        $this->input_errors = $_SESSION['input_errors'];
        $_SESSION['input_errors'] = [];
    }

    public function CountErrors() {
        return is_array($this->errors) ? count($this->errors) : 0;
    }

    public function CountInputErrors() {
        return is_array($this->input_errors) ? count($this->input_errors) : 0;
    }

    public function CountInfos() {
        return is_array($this->infos) ? count($this->infos) : 0;
    }

    public function CountNewErrors() {
        var_dump($_SESSION);
        // return is_array($_SESSION['errors']) ? count($_SESSION['errors']) : 0;
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
        //return null;
        return [];
    }

    public function AddMessage($type, $msg, $key = null) {
        if ($type === 'input_error') {
            $_SESSION['errors'][$key . "_error"] = $msg;
        } else {
            $_SESSION[$type] = $msg;
        }
    }

    public function ShowErrors() {
        print "<p style='color:red'>$this->errors</p>";
    }

    public function ShowInfos() {
        if (isset($this->infos[0])) {
            print "<div class='msgs'>" . $this->infos[0] . "</div>";
        }
    }

}