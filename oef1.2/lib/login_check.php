<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

$public_access = true;
require_once "../models/user.php";
require_once "autoload.php";

$user = LoginCheck();

var_dump($user);

if ( $user )  {

    //data to object
    $_SESSION['user'] = new user();
    $_SESSION['user']->setId($user['usr_id']);
    //$_SESSION['user']->setVoornaam($user['usr_voornaam']);
    //$_SESSION['user']->setNaam($user['usr_naam']);
    //$_SESSION['user']->setEmail($user['usr_email']);
    //$_SESSION['user']->setTelefoon($user['usr_telefoon']);
    echo '<br>';
    var_dump($_SESSION['user']);
    //die;

    $_SESSION['msgs'][] = "Welkom, " . $_SESSION['user']->getVoornaam();
    GoHome();
}
else
{
    unset( $_SESSION['user'] );
    GoToNoAccess();
}

function LoginCheck()
{
    if ( $_SERVER['REQUEST_METHOD'] == "POST" )
    {
        //controle CSRF token
        if ( ! key_exists("csrf", $_POST)) die("Missing CSRF");
        if ( ! hash_equals( $_POST['csrf'], $_SESSION['lastest_csrf'] ) ) die("Problem with CSRF");

        $_SESSION['lastest_csrf'] = "";

        //sanitization
        $_POST = StripSpaces($_POST);
        $_POST = ConvertSpecialChars($_POST);

        //validation
        $sending_form_uri = $_SERVER['HTTP_REFERER'];

        //Validaties voor het loginformulier
        if ( true )
        {
            if ( ! key_exists("usr_email", $_POST ) OR strlen($_POST['usr_email']) < 5 )
            {
                $_SESSION['errors']['usr_password'] = "Het wachtwoord is niet correct ingevuld";
            }
            if ( ! key_exists("usr_password", $_POST ) OR strlen($_POST['usr_password']) < 8 )
            {
                $_SESSION['errors']['usr_password'] = "Het wachtwoord is niet correct ingevuld";
            }
        }

        //terugkeren naar afzender als er een fout is
        if ( key_exists("errors" , $_SESSION ) AND count($_SESSION['errors']) > 0 )
        {
            $_SESSION['OLD_POST'] = $_POST;
            header( "Location: " . $sending_form_uri ); exit();
        }

        //search user in database
        $email = $_POST['usr_email'];
        $ww = $_POST['usr_password'];

        $sql = "SELECT * FROM user WHERE usr_email='$email' ";
        $data = GetData($sql);

        if ( count($data) > 0 )
        {
            foreach ( $data as $row )
            {
                if ( password_verify( $ww, $row['usr_password'] ) ) return $row;
            }
        }

        return null;
    }
}
