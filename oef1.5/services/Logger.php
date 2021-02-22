<?php


class Logger
{
    private $fp;
    private $logfile;

    public function __construct() {
        $this->logfile = $_SERVER['DOCUMENT_ROOT'] . "/php2/oef1.5/log/log.txt";
        $this->fp = fopen($this->logfile, 'a+');
    }

    public function Log($msg) {
        fwrite($this->fp, date("Y-m-d h:i:sa") . " -> " . $msg . "\r\n");
    }

    public function ShowLog() {
        $log = file_get_contents($this->logfile);
        $log = str_replace("\r\n", "<br>", $log);
        return $log;
    }
}