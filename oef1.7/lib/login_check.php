<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

$public_access = true;
require_once "autoload.php";

$user = $container->getLoginChecker()->LoginCheck();

if ( $user )
{
    $_SESSION['user'] = $user;
    $container->getMessageService()->AddMessage("infos", "Welkom, " . $_SESSION['user']->getVoornaam());
    $container->getRouter()->GoHome();
}
else
{
    unset( $_SESSION['user'] );
    $container->getRouter()->GoToNoAccess();
}


