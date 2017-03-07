<?php

session_start();


include('connection.php');
include('oldconnection.php');


include('classes.php');
 
//var_dump($_SESSION);
if((isset($_POST) && !empty($_POST)) || (isset($_GET['continue']) && $_GET['continue'] == "ok")) 
{
    $ancienUser = new TestBDD;
    if(!isset($_GET['continue']) || $_GET['continue'] != "ok")
    {
        $_SESSION['email']  = $_POST['emailuser'];
        $_SESSION['pass']   = crypt($_POST['pass'], "\$1\$AYw5dz8Jm0");    

        $ancienUser->isNewUser($con);
        
    }
    elseif (isset($_GET['versImport']))
    {
        $versImport = $_GET['versImport'];
        if($versImport == "false")
        {   
            $ancienUser->verifierAnciennePresence($bdd, $con);
        }
    }
 
    //var_dump($_POST);
   
    //$pass = $_POST['pass']; 
    
    
    //$minimumUserLength  = 4;    
    //$maximumUserLength  = 35;
    
    //$minimumPassLength  = 4;    
    //$maximumPassLength  = 35;
    
    //if(!strlen($emailuser) > $maximumUserLength || !strlen($emailuser) < $minimumUserLength || !strlen($pass) < $minimumPassLength || !strlen($pass) > $maximumPassLength)
        {
        //$reponse = $bdd->query("SELECT email FROM users");
        // while ($donnees = $reponse->fetch()){
        //        echo $donnees['lieu'] . '<br />';
        //}
         /*   
        $reponse = $bdd->prepare("SELECT * FROM users WHERE email = :email");
            $reponse->bindValue(":email", $emailuser);
            $reponse->execute();
            //echo $reponse->rowCount();
            if($reponse->rowCount() == 1) { echo "Utilisateur present dans astroramintra ";
            }
            else echo "je suis pas content";
        */
        //}
}
//    
//        else {
//            echo " Veuillez respecter les indications. ";    
//            header("Location: login.php?test");    
//        }

//if(!isset($_POST) || empty($_POST)) 
//{
//    header("Location: login.php?erreur=".$erreur); 
//}
?>