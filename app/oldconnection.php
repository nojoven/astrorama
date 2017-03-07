<?php
$bdd = new PDO('mysql:host=localhost:3307;dbname=astroramintra;charset=utf8', 'root', '', 

array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));



if(!$bdd) {

    echo "Connection FAILED";

}


?>