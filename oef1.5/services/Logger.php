<?php


class Logger
{
    private $fp;
    private $logfile = "log/log.txt";

    public function __construct() {
        $this->fp = fopen($this->logfile, a+);
    }

    public function Log($msg) {
        fwrite($this->fp, date("Y-m-d h:i:sa") . " -> " . $msg . "\r\n");
    }

    public function ShowLog() {
        $log = file_get_contents($this->logfile);
        return $log;
    }
}