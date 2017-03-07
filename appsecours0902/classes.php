<?php


include('connection.php');
include('oldconnection.php');


class TestBDD 
{
    public function isNewUser($con)
    {
        if(isset($_SESSION)) 
        {
                $reponse = $con->prepare("SELECT * FROM user WHERE email = :email AND crpwd = :pass");
                $reponse->bindValue(":email", $_SESSION['email']);
                $reponse->bindValue(":pass", $_SESSION['pass']);
                $reponse->execute();
                
                //echo $reponse->rowCount();
                if($reponse->rowCount() == 1)
                {
                    header("Location: moncompte.php");
                }
                elseif($reponse->rowCount() != 1) 
                { 
                    header("Location: moncompte.php?continue=ok&versImport=false");  
                }
                
        }
        else 
        {
            header("Location: login.php?erreur=pasbon");
        }
    } 
    

    public function verifierAnciennePresence($bdd, $con)
    {
        if(isset($_SESSION)) 
        {
            $reponse = $bdd->prepare("SELECT * FROM users WHERE email = :email AND crpwd = :pass");
            $reponse->bindValue(":email", $_SESSION['email']);
            $reponse->bindValue(":pass", $_SESSION['pass']);
            $reponse->execute();
            //echo $reponse->rowCount();
            if($reponse->rowCount() == 1)
            {
                //$user = $bdd->query("SELECT * FROM users");
                $old = $reponse->fetch();
                //extract($user)
                    //ici il faudrait crpwd =crypted $user['pwd'] ;
               // $droitsAdmin= $bdd->query("SELECT * FROM users WHERE fonction = 'Administrateur'");
                /*$oldnom         = $old['nom'] ;
                $oldprenom      = $old['prenom'];
                $oldemail       = $old['email'];  
                $oldcrpwd       = $old['crpwd'];
                $oldtel         = $old['tel'];*/

                $insertOld = $con->prepare("INSERT INTO user(nom, prenom, email, crpwd, tel) VALUES (:nom, :prenom, :email, :crpwd, :tel)");
                $insertOld->bindValue(":nom",       $old['nom']);
                $insertOld->bindValue(":prenom",    $old['prenom']);
                $insertOld->bindValue(":email",     $old['email']);
                $insertOld->bindValue(":crpwd",     crypt($old['pwd'], "\$1\$AYw5dz8Jm0"));
                $insertOld->bindValue(":tel",       $old['tel']);

                $insertOld->execute();



                //$findRights = $bdd->prepare("SELECT * FROM users WHERE fonction = 'Administrateur'");
                //$findRights->execute();

                //$oldrights = $findRights->fetchAll();

                //foreach( $oldrights['Administrateur'] as $Administrateur)
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
            else 
            {
                header("Location:register.php");
            }
        }   
    }
}


abstract class mintraUpdate
{
    public function newToOld($con, $bdd)
    {
        $areYouNew  = $con->prepare("SELECT email FROM user");
        $areYouNew->execute();
        $verif      = $areYouNew->fetchAll();
        
        $areYouOld  = $bdd->prepare("SELECT email FROM users");
        $areYouOld  = $con->execute();
        $verifbis   =  $areYouOld->fetchAll();
        
        foreach($verif as $elt)
        { 
            foreach($verifbis as $element)
            {
                if ($elt['email'] !== $element['email'])
                {
                $fillOldBd = $bdd->prepare("INSERT INTO 
                    users
                    (email, crpwd, nom, prenom, last_visit, fonction, tel)
                    VALUES(:email, :crpwd, :prenom, :last_visit, :rights, :tel)");
            
                $fillOldBd->bindValue(":email",         $verif['email']);
                $fillOldBd->bindValue(":crpwd",         $verif['crpwd']);
                $fillOldBd->bindValue(":nom",           $verif['nom']);
                $fillOldBd->bindValue(":prenom",        $verif['prenom']);
                $fillOldBd->bindValue(":last_visit",    $verif['last_visitl']);
                $fillOldBd->bindValue(":rights",        $verif['rights']);
                $fillOldBd->bindValue(":tel",           $verif['tel']);  
                
                $fillOldBd->execute(); 
                }
                
                
            }
        }  
    }
} 



class User 
{
    public $nom;
    public $prenom;
    public $pwd;
    public $mail;
    public $tel;    
    public $rights;
    public $id;
    public $last_visit;
    
}



class Visiteur extends User
{
    public $nb_reservations;
    public $nb_recap_reserv;
    
    public function inscription()
    {
        //function inscription
    }
    
    public function reserver()
    {
        //function reserver
    }
    
    public function modifierReservation()
    {
        //function modifierReservation
    }
    
    public function supprReservation()
    {
        //function supprReservation
    }
    
    
    public function afficherMesDonnees()
    {
        //function afficherMesDonnees
    }
    
    
    public function reserverSandwich()
    {
        //function reserverSandwich
    }
    
}


class Admin extends User {

    public function afficherDonneesAdmin()
    {
        //function afficherDonneesAdmin
    }
    
    
    
    public function insertEvent()
    {
        //function insertEvent
    }
    
    public function updateEvent()
    {
        //function updateEvent
    }
    
    
    public function deleteEvent()
    {
        //function deleteEvent
    }
    
    
    public function addNewUser()
    {
        //function addNewUser
    }
    

    public function importOldUser()
    {
        //function 
    }
    
    
        
    public function updateNewUser()
    {
        //function updateNewUser
    }
    
    
    public function deleteNewUser()
    {
        //function deleteNewUser
    }
       
    public function updateReserv()
    {
        //function updateReserv
    }
    
        
    public function deleteReserv()
    {
        //function deleteReserv
    }
    
    
    public function deleteSandwiches()
    {
        //function deleteSandwiches
    }
    
            
    public function modifSandwiches()
    {
        //function modifSandwiches
    }
    
    
    
    public function sendOneMail()
    {
        //function sendOneMail
    }
    
    
    public function emailToAll()
    {
        //function emailToAll
    }
    



}



class Reservation {

    public $date;
    public $heure;
    public $duree;
    public $titre;
    public $sous_titre;
    public $description;
    public $typeInvite;
    public $image;

    
    
    public function TropNombreux()
    {
        //function TropNombreux
    }
    
    
    public function displayEvent()
    {
        //function displayEvent
    }
    
    
    public function displayComingEvents()
    {
        //function displayComingEvents
    }
    
    public function msgImportant()
    {
        //function msgImportant
    }
    
    
    public function calcTarif()
    {
        //function calcTarif
    }
    
    
    public function displayTarif()
    {
        //function displayTarif
    }
    
    
}

























?>