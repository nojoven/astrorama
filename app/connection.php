<?php
$con = new PDO('mysql:host=localhost:3307;dbname=astroramabis;charset=utf8', 'root', '', 

array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

if(!$con) {

    echo "Connection FAILED";

}


?>