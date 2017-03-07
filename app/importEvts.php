<?php
// ce fichier ne sert qu'une fois, hors site



include('connection.php');
include('oldconnection.php');

class ImportEvent    //cette classe possede une methode  qui va recuperer les evenements d'astroramintra pour les mettre dans astroramabis
{

    public function recupEvts($bdd, $con)
    {
    
    
        
    $detect = $bdd->prepare("SELECT agenda, date_agenda, heure_debut, heure_fin, titre, texte FROM agenda WHERE agenda > 6595 AND titre != 'Planning Julien' AND titre != 'Congés Roger' AND titre != 'Congés Samantha' AND titre != 'UNIFORMATION' ORDER BY agenda ASC");
    $detect->execute();
    
    $foundEvts = $detect->fetchAll();
    
    foreach($foundEvts as $foundEvt)
    {
        $duration = $foundEvt['heure_fin'] - $foundEvt['heure_debut'];
        
        
        $insertEvt = $con->prepare(
        "INSERT INTO evenements (event_id, titre, date_event, debut, duree, description, tout_petits, tarif_reduit, plein_tarif, tarif_parsec) VALUES(:id, :titre,  :date_agenda, :heure_debut, :duree, :texte, :tout_petits, :tarif_jeune, :plein_tarif,  :tarif_parsec) WHERE titre LIKE '%iel ouvert%' ");
        
        $insertEvt->bindValue(":id",                            $foundEvt['agenda']);
        $insertEvt->bindValue(":titre",                         $foundEvt['titre']);
        $insertEvt->bindValue(":date_agenda",                   $foundEvt['date_agenda']);
        $insertEvt->bindValue(":heure_debut",                   $foundEvt['heure_debut']);
        $insertEvt->bindValue(":duree",                         $duration);
        $insertEvt->bindValue(":texte",                         $foundEvt['texte']);
        $insertEvt->bindValue(":tout_petits",                   0);
        $insertEvt->bindValue(":tarif_jeune",                   8);
        $insertEvt->bindValue(":plein_tarif",                   10);
        $insertEvt->bindValue(":tarif_parsec",                  0);
           
        $insertEvt->execute();
        
        $putEvt = $con->prepare(
        "INSERT INTO evenements (event_id, titre, date_event, debut, duree, description, tout_petits, tarif_reduit, plein_tarif, tarif_parsec) VALUES(:id, :titre,  :date_agenda, :heure_debut, :duree, :texte, :tout_petits, :tarif_jeune, :plein_tarif,  :tarif_parsec) WHERE titre NOT LIKE '%iel ouvert%' ");
        
        $putEvt->bindValue(":id",                            $foundEvt['agenda']);
        $putEvt->bindValue(":titre",                         $foundEvt['titre']);
        $putEvt->bindValue(":date_agenda",                   $foundEvt['date_agenda']);
        $putEvt->bindValue(":heure_debut",                   $foundEvt['heure_debut']);
        $putEvt->bindValue(":duree",                         $duration);
        $putEvt->bindValue(":texte",                         $foundEvt['texte']);
        $putEvt->bindValue(":tout_petits",                   0);
        $putEvt->bindValue(":tarif_jeune",                   10);
        $putEvt->bindValue(":plein_tarif",                   13);
        $putEvt->bindValue(":tarif_parsec",                  0);
           
        $putEvt->execute();
        
        
        
    }
    
        
        
        
        
        
    }

}

$newAgenda = new ImportEvent;
$newAgenda->recupEvts($bdd, $con);
































?>