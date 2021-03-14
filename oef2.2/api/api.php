<?php

$public_access = true;
require_once './../lib/autoload.php';


//Allow access from outside (see CORS)
//header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Origin: 'https://gf.dev'");
header("Access-Control-Allow-Credentials 'true'");


//Allow GET, POST, PUT, DELETE, OPTIONS http methods
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

//Allow some types of headers
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

//Set response content type and character set
header("Content-Type: application/json; charset=UTF-8");

//Basic Authentication controle
if ($_SERVER['PHP_AUTH_USER'] !== "user" or $_SERVER['PHP_AUTH_PW'] !== "wachtwoord") {
    //als er geen juiste credentials doorgegeven worden, afbreken met code 401 Unauthorized
    header('WWW-Authenticate: Basic realm="Provide your username and password for the Voorbeeld API"');
    header('HTTP/1.0 401 Unauthorized');
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];
$request_uri = $_SERVER['REQUEST_URI'];

$parts = explode("/", $request_uri);

//zoek "api" in de uri
for ($i = 0; $i < count($parts); $i++) {
    if ($parts[$i] == "api") {
        break;
    }
}

$request_part = $parts[$i + 1];
if (count($parts) > $i + 1) {
    $id = $parts[$i + 2];
}

if ($request_part != "btwcode" && $request_part != "btwcodes") {
    print json_encode(["msg" => 'Deze combinatie van Request en Method is niet toegelaten']);
    exit;
}

if ($id && $request_part == "btwcodes") {
    print json_encode(["msg" => 'Deze combinatie van Request en Method is niet toegelaten']);
    exit;
}


//GET btwcodes: alle btwcodes geven
if ($method == "GET" and $request_part == "btwcodes") {
    $sql = "select * from eu_btw_codes";
    $data = $container->getDBManager()->GetData( $sql , 'assoc' );

    print json_encode(["msg" => 'OK', "data" => $data]);
    exit;
}

//GET btwcode: één btwcode geven
if ($method == "GET" and $request_part == "btwcode") {
    $sql = "select * from eu_btw_codes where eub_id=$id";
    $data = $container->getDBManager()->GetData( $sql , 'assoc' );

    if ( $data ) {
        print json_encode(["msg" => 'OK', "data" => $data]);
        exit;
    } else {
        print json_encode(["msg" => 'Het opgegeven ID is ongeldig']);
        exit;
    }
}

//POST spelers: een speler toevoegen
if ($method == "POST" and $request_part == "btwcodes") {
    $land = ucwords(strtolower($_POST["land"]));
    $code = strtoupper($_POST["code"]);
    $sql = "INSERT INTO eu_btw_codes SET eub_land = '$land', eub_code = '$code'";
    $data = $container->getDBManager()->ExecuteSQL( $sql );

    $sql = "SELECT MAX(eub_id) FROM eu_btw_codes";
    $new_id = $container->getDBManager()->GetData( $sql );
    http_response_code(201);
    print json_encode(["msg" => "BTW CODE $code - $land aangemaakt", "eub_id" => $new_id]);
    exit;
}

//PUT speler: een speler updaten
if ($method == "PUT" and $request_part == "btwcode") {
    $sql = "select * from eu_btw_codes where eub_id=$id";
    $data = $container->getDBManager()->GetData( $sql , 'assoc' );
    if ($data) {
        $contents = json_decode(file_get_contents("php://input"));
        $newcode = $contents->code;
        $newland = $contents->land;

        $sql = "UPDATE eu_btw_codes SET eub_land = '$newland', eub_code = '$newcode' WHERE eub_id = $id";
        $data = $container->getDBManager()->ExecuteSQL($sql);
        print json_encode(["msg" => "OK", "info" => "BTW code $newcode - $newland gewijzigd"]);
        exit;
    } else {
        print json_encode(["msg" => 'Het opgegeven ID is ongeldig']);
        exit;
    }
}

//DELETE speler: een speler verwijderen
if ($method == "DELETE" and $request_part == "btwcode") {
    $sql = "select * from eu_btw_codes where eub_id=$id";
    $data = $container->getDBManager()->GetData( $sql , 'assoc' );
    if ($data) {
        $sql = "DELETE FROM eu_btw_codes WHERE eub_id = $id";
        $data = $container->getDBManager()->ExecuteSQL($sql);
        print json_encode(["msg" => "OK", "info" => "BTW code $id verwijderd"]);
        exit;
    } else {
        print json_encode(["msg" => 'Het opgegeven ID is ongeldig']);
        exit;
    }
}





