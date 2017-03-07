<?php

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


























?>