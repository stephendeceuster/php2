<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

$public_access = false;
require_once "lib/autoload.php";

$log = $logger->ShowLog();
//$log = str_replace('\r\n', '<br>', $log);
print $log;