<?php
//require_once './../lib/autoload.php';

class Container
{
    private $dbmanager;
    private $logger;
    private $messageservice;

    public function __construct(DBManager $dbmanager, Logger $logger, MessageService $messageservice) {
        $this->dbmanager = $dbmanager;
        $this->logger = $logger;
        $this->messageservice = $messageservice;
    }
}