<?php
include('connection.php');
include('oldconnection.php');

class TestBDD 
{
    public function isNewUser($con)
    {
        if(isset($_SESSION)) 
        {       // on interroge astroramabis
                $reponse = $con->prepare("SELECT * FROM user WHERE email = :email AND crpwd = :pass");
                $reponse->bindValue(":email", $_SESSION['email']);
                $reponse->bindValue(":pass", $_SESSION['pass']);
                $reponse->execute();
                
                //echo $reponse->rowCount();
                if($reponse->rowCount() == 1) // l'utilisateur y est si son email et son mot de passe s'y trouvent sur la meme ligne
                {   
                    header("Location: moncompte.php"); // si l'utilisateur y est on le renvoir a moncompte.php
                }
                elseif($reponse->rowCount() != 1) 
                { 
                    header("Location: moncompte.php?continue=ok&versImport=false"); // sinon on le renvoie aussi en definissant de nouvelles variables , $continue = "ok" et $versImport = false qu'on envoie dans le $_GET
                }
                
        }
        else // si il y a une erreur on renvoie vers login.php
        {
            header("Location: login.php?erreur=FATAL");
        }
    } 
    

    public function verifierAnciennePresence($bdd, $con) // puisqu il n'est pas dans astroramabis l'utilisateur est il dans astroramintra? on a besoin de deux arguments qui sont les deux connexions aux bases de donnees ici pour cette fonction parce que si la reponse est oui on va importer des donnees d'astroramintra pour les mettre dans astroramabis
    {   
        //$_SESSION['email']  = $_POST['emailuser'];
        //$_SESSION['pass']   = crypt($_POST['pass'], "\$1\$AYw5dz8Jm0");
        if(isset($_SESSION)) // s'il y a eu tentative de login il y a une session donc s il ya a une session on verifie que l'email et le mot de passe sont dans astroramintra
            
        {   
            // on interroge astroramintra
            $reponse = $bdd->prepare("SELECT * FROM users WHERE email = :email AND crpwd = :pass");
            $reponse->bindValue(":email", $_SESSION['email']);
            $reponse->bindValue(":pass", $_SESSION['pass']);
            $reponse->execute();
            //echo $reponse->rowCount();
            if($reponse->rowCount() == 1) // si l'utilisateur y est on recupere ses donnees
            {
                
                $old = $reponse->fetch(); //on les met dans $old
                
                // on importe les donnees de $old et in les insere dans la base de donnees
                $insertOld = $con->prepare("INSERT INTO user(nom, prenom, email, crpwd, tel) VALUES (:nom, :prenom, :email, :crpwd, :tel)");
                $insertOld->bindValue(":nom",       $old['nom']);
                $insertOld->bindValue(":prenom",    $old['prenom']);
                $insertOld->bindValue(":email",     $old['email']);
                $insertOld->bindValue(":crpwd",     crypt($old['pwd'], "\$1\$AYw5dz8Jm0"));
                $insertOld->bindValue(":tel",       $old['tel']);

                $insertOld->execute();


                // mais ce n'est pas suffisant car on veut que les droits dans astroramabis soient 1 pour les admins et 2 pour les autres utilisateurs donc on decide de mettre 1 dans astroramabis a chaque vois que c'etait 'Administrateur' dans astroramintra
                
                if($old['fonction'] == 'Administrateur')
                {
                    $rank = 1;
                    $fillRights = $con->prepare("UPDATE user SET rights = :rank WHERE user.email = :email;");
                    $fillRights->bindValue(":rank",       $rank);
                    $fillRights->bindValue(":email",      $old['email']);
                    $fillRights->execute();
                }
                if($old['fonction'] !== 'Administrateur')
                {   
                    $droits = 2;
                    $inputRights = $con->prepare("UPDATE user SET rights = :droits WHERE user.email = :email;");
                    $inputRights->bindValue(":droits",     $droits);
                    $inputRights->bindValue(":email",      $old['email']);
                    $inputRights->execute();  
                
                
                }
                    
                //header("Location: login.php");
            }
            else  // si l'utilisateur n'est nest pas non plus dans asrtoramintra on le dirige vers la page d'inscription
            {
                session_destroy();
                header("Location:register.php");
            }
        }   
    }
}






















?>