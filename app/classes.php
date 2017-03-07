<?php


include('connection.php');
include('oldconnection.php');
//include('visiteur.php');



class User 
{
    public $nom;
    public $prenom;
    public $pwd;
    public $email;
    public $tel;    
    public $rights;
    public $id;
    public $last_visit;
    
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