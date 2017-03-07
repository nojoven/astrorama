<?php session_start(); ?>


<?php
include_once("inc/inc_header.php");    
include_once("inc/inc_nav.php");
include_once("connection.php");

if(isset($_GET))
{
    extract($_GET);
    $keepId = $user_id; var_dump($keepId);
}else
{
    header("Location: crud.php?noDelete=true");
}

$findName = $con->prepare("SELECT * FROM user WHERE user_id = :id");
$findName->bindValue(":id", $keepId);
$findName->execute();
if($findName->rowCount() == 1)
{
    $toStop = $findName->fetch();
    $stopUser = $toStop['prenom']." ".$toStop['nom'];
}



$deleteQuery = $con->prepare("DELETE FROM user WHERE user_id = :uId");
$deleteQuery->bindValue(":uId", $toStop['user_id']);

$deleteQuery->execute();


header("Location: crud.php?oneDeleted=true&stopUser=$stopUser");












































?>