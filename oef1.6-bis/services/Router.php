<?php


class Router
{
    private $app_root;

    public function __construct($app_root) {
        $this->app_root = $app_root;
    }

    public function GoToNoAccess()
    {
        header("Location: " . $this->app_root . "/no_access.php");
        exit;
    }

    public function GoHome()
    {
        header("Location: " . $this->app_root . "/steden.php");
        exit;
    }

    public function GoToPage( $page )
    {
        header("Location: " . $this->app_root . "/$page");
        exit;
    }
}