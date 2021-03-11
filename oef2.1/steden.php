<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

require_once "lib/autoload.php";

PrintHead();
PrintJumbo( $title = "Leuke plekken in Europa" ,
                        $subtitle = "Tips voor citytrips voor vrolijke vakantiegangers!" );
PrintNavbar();
?>

<div class="container">
    <div class="row">


<?php
    //toon messages als er zijn
    $container->getMessageService()->ShowErrors();
    $container->getMessageService()->ShowInfos();

    //export button
    $output ="";
    $output .= "<a style='margin-left: 10px' class='btn btn-info' role='button' href='export/export_images.php'>Export CSV</a>";
    $output .= "<div><br></div>";

    //get data
    $data = $container->getDBManager()->GetData( "select * from images" );


    // dit zou waarschijnlijk best in aparte file komen om elders ook te kunnen gebruiken.
    function GetTheWeather($arr, $APIkey) {
        foreach ( $arr as $key=>$row ) {
            $url = 'api.openweathermap.org/data/2.5/weather?q='. $row['img_weather_location'] .'&lang=nl&units=metric&appid=' . $APIkey;

            $restClient = new RESTclient( $authentication = null );
            $restClient->CurlInit($url);
            $response = json_decode($restClient->CurlExec());

            $row['weather_description'] = $response->weather[0]->description;
            $row['weather_temp'] = round($response->main->temp);
            $row['weather_humidity'] = $response->main->humidity;

            $arr[$key] = $row;
        }
        return $arr;
    }

    $data = GetTheWeather($data, $openWeatherKey);

    $template = file_get_contents("templates/column.html");

    //merge
    $output .= MergeViewWithData( $template, $data );
    print $output;
?>

    </div>
</div>

</body>
</html>