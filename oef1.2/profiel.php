<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

$public_access = false;
require_once "lib/autoload.php";

PrintHead();
PrintJumbo( $title = "Profiel", $subtitle = "" );
PrintNavbar();
?>

<div class="container">
    <div class="row">



        <?php

            var_dump($_SESSION['user']);


            //get data
            //$data1 = GetData( "select * from user where usr_id=" . $_SESSION['user']['usr_id'] );
            //$data1 = GetData( "select * from user where usr_id=" . $_SESSION['user']->getId() );
            //echo '<br>VARDUMP DATA1<br>';

            $data[0] = $_SESSION['user']->toArray2();
            echo '<br>VARDUMP DATA<br>';
            var_dump($data);

            //get template
            $output = file_get_contents("templates/profiel.html");

            //add extra elements
            $extra_elements['csrf_token'] = GenerateCSRF( "profiel.php"  );

            //merge
            $output = MergeViewWithData( $output, $data );
            $output = MergeViewWithExtraElements( $output, $extra_elements );
            $output = MergeViewWithErrors( $output, $errors );
            $output = RemoveEmptyErrorTags( $output, $data );

            print $output;
        ?>

    </div>
</div>

</body>
</html>