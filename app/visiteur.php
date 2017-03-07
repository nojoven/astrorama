<?php


include_once('connection.php');
include_once('classes.php');





//le row count  se fait toujours uniquement sur la variable qui contient la requete 

class Visiteur extends User
{
    public $nb_reservations;
    public $nb_recap_reserv;
    // la methode inscription permet d'ajouter un utilisateur a la base de donnees astroramabis, donc elle prend en parametre $con et $control qui contient les donnses d'astroramabis a comparer a celle de l'utilisateur.
    function inscription($con, $control) 
    {
        
        
        if(isset($_POST) && !empty($_POST) && $_POST['password'] === $_POST['confirmPwd'])
        {   
            
        //si l'utilisateur a envoye des donnees via le formulaire on les extrait et on les teste
            
            
            

            extract($_POST);
            
            
            
            
            $email                      =  filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $telephone                  =  filter_input(INPUT_POST, 'telephone', FILTER_SANITIZE_NUMBER_INT);
            $password                   =  trim($confirmPwd);

            $minStringLength            = 4;    
            $maxStringLength            = 25;

            $minPassLength              = 9;    
            $maxPassLength              = 30;

            $minMailLength              = 10;    
            $maxMailLength              = 255;

            $minTelLength               = 10;    
            $maxTelLength               = 11;

            $warnError                  = "";
            
            
            foreach($control as $contenu) // il faut empecher un utilisateur deja inscrit de faire des doublons dans la base  de donnees
                
            {   
                if($telephone == $contenu['tel'] && $email == $contenu['email'] && $firstName == $contenu['prenom'])
                {
                echo " Vous etes deja inscrit. <br />";
                
                }
            }
            
            // a chaque erreur de remplissage du formulaire on ajoute un message d'erreur a la variable $warnError
            if(strlen($lastName) < $minStringLength) 
            {
                $shortLastName = "Nom de famille trop court. Quatre lettres minimum. <br/>";            
                $warnError += $shortLastName;
                
            }
            elseif(strlen($firstName) < $minStringLength)
            {
                $shortFirststName = "Prénom trop court. Quatre lettres minimum. <br/>";
                $warnError += $shortFirstName;
            }
            elseif(strlen($email) < $minStringLength)
            {
                $shortMail = "Adresse électronique trop courte . Dix caracteres minimum. <br/>";
                $warnError += $shortMail;//var_dump("test");
            }
            elseif(strlen($password) < $minPassLength)
            {
                $shortPass = "Mot de passe trop court . Neuf caracteres minimum. <br/>";
                $warnError += $shortPass;
            }
            elseif(strlen($telephone) < $minTelLength)
            {
                $shortTel = "Numéro de téléphone trop court. Dix chiffres minimum. <br/>";
                $warnError += $shortTel;
            }
            elseif(strlen($lastName) > $maxStringLength) 
            {
                $longLastName = "Nom de famille trop long. Vingt-cinq lettres maximum. <br/>";
                $warnError += $longLastName;
            }
            elseif(strlen($firstName) > $maxStringLength)
            {
                $longFirstName = "Prénom trop Long. Vingt-cinq lettres maximum. <br/>";
                $warnError += $longFirstName;
            }
            elseif(strlen($email) > $maxMailLength)
            {
                $longMail = "Adresse électronique trop longue . Trente-cinq caracteres maximum. <br/>";
                $warnError += $longMail;
            }
            elseif(strlen($telephone) > $maxTelLength)
            {
                $longTel = "Numéro de téléphone trop long. Onze chiffres maximum. <br/>";
                $warnError += $longTel;
            }
            elseif(strlen($password) > $maxPassLength)
            {
                $LongPass = "Mot de passe trop long . Trente caracteres maximum. <br/>";
                $warnError += $LongPass;var_dump("test6");
            }
            else // si tous les champs sont bien remplis on ajoute un nouvel utilisateur a astroramabis
            { 
                              
                $registering = $con->prepare("INSERT INTO user(nom, prenom, email, crpwd, tel, rights) VALUES(:lastName, :firstName, :email, :crpwd, :telephone,  :rights)");
                $registering->bindValue(":lastName",                $lastName);
                $registering->bindValue(":firstName",               $firstName);
                $registering->bindValue(":email",                   $email);
                $registering->bindValue(":crpwd",                   crypt($password, "\$1\$AYw5dz8Jm0"));
                $registering->bindValue(":telephone",               $telephone);
                $registering->bindValue(":rights",                          2);
            
		        $registering->execute();
                
                //et on lui attribue des variables de session
                $_SESSION['email']  = $email;
                $_SESSION['pass']   = crypt($password, "\$1\$AYw5dz8Jm0");
	               
                header("Location: moncompte.php?registerOk"); // on redirige vers moncompte.php

            }
            echo $warnError; //on affiche le contenu de $warnError, s'il est vide il n'y aura rien d'affiche
            
        }else
        {
            $blankForm = "Veuillez completer le formulaire afin de pouvoir vous inscrire et acceder a votre compte";
        }
            
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
    
    
    public function modifMesDonnees($con)  // cette fonction met a jour une ligne d'user dans astroramabis
    {
        
        
        
        if(isset($_POST['upNom']) && isset($_POST['upPrenom']) && isset($_POST['upEmail']) && isset($_POST['upTel']) && isset($_POST['upPwd']) && isset($_POST['upConfirmPwd']) && $_POST['upPwd'] === $_POST['upConfirmPwd'])
        {   // si le formulaire a ete complete on extrait ses donnees et on les teste
        extract($_POST);
        $upPwd = trim($upConfirmPwd);
        
        
        $minStringLength            = 4;    
        $maxStringLength            = 25;

        $minPassLength              = 9;    
        $maxPassLength              = 30;

        $minMailLength              = 10;    
        $maxMailLength              = 255;

        $minTelLength               = 10;    
        $maxTelLength               = 11;
        }
        
        if(
            !(strlen($upNom)        < $minStringLength 
            && strlen($upPrenom)    < $minStringLength 
            && strlen($upEmail)     < $minStringLength 
            && strlen($upPwd)       < $minPassLength 
            && strlen($upTel)       < $minTelLength 
            && strlen($upNom)       > $maxStringLength 
            && strlen($upPrenom)    > $maxStringLength 
            && strlen($upEmail)     > $maxMailLength 
            && strlen($upTel)       > $maxTelLength 
            && strlen($upPwd)       > $maxPassLength)
        )
        {  // s'il est bien rempli on fait l'update      
            $updateMyDatas = $con->prepare("UPDATE user SET nom = :nom, prenom = :prenom, email = :email, crpwd = :crpwd,  tel = :tel WHERE email = :sessmail"); var_dump("ouestu");
            $updateMyDatas->bindValue("nom:",         trim($upNom));
            $updateMyDatas->bindValue("prenom:",      trim($upPrenom));
            $updateMyDatas->bindValue("email:",       trim($upEmail));
            $updateMyDatas->bindValue("crpwd:",       crypt($upPwd, "\$1\$AYw5dz8Jm0"));
            $updateMyDatas->bindValue("tel:",         trim($upTel));
            $updateMyDatas->bindValue("sessmail:",    $_SESSION['email']);

            $updateMyDatas->execute();
        }else
        {   //sinon on affecte un message d'erreur a $retryUpdate
            $retryUpdate = "Veuillez vérifier vos entrées, remplir à nouveau les champs et valider";
            
        }
    }
    
    
    public function reserverSandwich()
    {
        //function reserverSandwich
    }

}
?>