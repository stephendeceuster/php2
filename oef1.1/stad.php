<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

require_once "lib/autoload.php";
require_once "models/city.php";

PrintHead();
PrintJumbo('Stad OO style');
PrintNavbar();
?>

<div class="container">
    <div class="row">

        <?php
        if ( ! isset( $_GET['img_id']) ) die("Geen img_id opgegeven");
        if ( ! is_numeric( $_GET['img_id']) ) die("Ongeldig argument " . $_GET['img_id'] . " opgegeven");

        $rows = GetData( "select * from images where img_id=" . $_GET['img_id'] );

        var_dump($rows[0]);
        if ($rows) {
            $row = $rows[0];

            //data to object
            $city = new city();
            $city->setId($row['img_id']);
            $city->setFilename($row['img_filename']);
            $city->setTitle($row['img_title']);
            $city->setWidth($row['img_width']);
            $city->setHeight($row['img_height']);
            $city->setPublished($row['img_published']);
            $city->setLanId($row['img_lan_id']);
            $city->setDate($row['img_date']);

            //get template
            $template = file_get_contents("templates/column_full.html");

            //merge
            $html = $template;

            //object to array
            $properties = $city->toArray2();
            $properties['title'] = $city->getTitle();

            foreach ($properties as $key => $value) {
                $html = str_replace("@img_$key@", $value, $html);
            }

            //output
            print $html;


        }
        ?>

    </div>
</div>

</body>
</html>