<?php

if (isset($_GET["road"])){
    $road = $_GET["road"];
    $url ="http://140.118.102.44/api/traffic/" . $road;
    print_r($url);;
}


?>