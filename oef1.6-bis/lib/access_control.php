<?php

if ( ! isset($public_access) ) $public_access = false;

CheckAccess( $container->getRouter(), $public_access );

function CheckAccess( $router, $public_access )
{
    if ( ! $public_access AND ! isset($_SESSION['user']) )
    {
        $router->GoToNoAccess();
    }
}



