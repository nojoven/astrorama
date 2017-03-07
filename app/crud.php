<?php
session_start(); // on a besoin des variables de session
include_once("inc/inc_header.php");    
include_once("inc/inc_nav.php");
include_once('connection.php');
include_once('oldconnection.php');
//include_once('../dist/libs/grocery-crud-1.5.8.1/application/libraries/Grocery_CRUD.php');
//include_once('../dist/libs/grocery-crud-1.5.8.1/application/libraries/image_moo.php');
?>

<?php
if(isset($_GET['oneDeleted']) && $_GET['oneDeleted'] == true && isset($_GET['stopUser']))
{ 
?>
<h2>
    <?php 
        extract($_GET); 
        echo $stopUser." a bien ete supprime. ";  
    ?>
</h2>
<?php 
}
?>

<?php
// on recupere les donnees d'astroramabis.
$cruder = $con->prepare("SELECT * FROM user");
$cruder->execute();

$abonnes = $cruder->fetchAll(); // on met ses donnees personnelles dans $mesInfos, elles  serviront en placeholder.
foreach($abonnes as $abonne)
{
    
    $keepId = $abonne['user_id'];

?>

<?php /*if(isset($_GET['oneDeleted'] && $_GET['oneDeleted'] == true) && isset($_GET['stopuser']))
{ ?>
<h2>
    <?php 
        extract($_GET); 
        echo $stopUser." a bien ete supprime.";  
    ?>
</h2>
<?php }*/ ?>

<br />
<table class="table table-hover table-inverse">
  <thead>
    <tr>
      <th>user_id</th>
      <th>Nom</th>
      <th>Prenom</th>
      <th>Email</th>
      <th>Telephone</th>
      <th>Statut</th>      
      <th>Nombre de reservations</th>
      <th>Derniere visite</th>
      <th>Derniere reservation</th>
      <th>Action</th>
      
    </tr>
  </thead>
  <tbody>
    <tr>
     
      <td><?php echo $abonne['user_id']; ?></td>  
      <td><?php echo $abonne['nom']; ?></td>      
      <td><?php echo $abonne['prenom']; ?></td>      
      <td><?php echo $abonne['email']; ?></td>      
      <td><?php echo $abonne['tel']; ?></td>      
      <td>
          <?php 
            $status = $abonne['rights'];           
            if($status == 1)
            {
                echo "Admin";   
            }else
            {
                echo "Visiteur";            
            }            
          ?>
      </td>    
      <td><?php echo $abonne['last_visit']; ?></td>      
      <td><?php echo $abonne['nb_reservation']; ?></td>      
      <td><?php echo $abonne['event_id']; ?></td>      
          
      <td>
        
        
        <a>
            <button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#editUserModal">
                Editer
            </button>
        </a>
        
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                ...
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>
        
         
        <button type="button" class="btn btn-outline-danger  btn-outline-warning"
        onclick="swal({
              title: 'AVERTISSEMENT!',
              text: 'CET UTILISATEUR SERA DEFINITIVEMENT SUPPRIME !',
              type: 'warning',
              showCancelButton: true,
              cancelButtonText: 'ANNULER',
              confirmButtonColor: '#DD6B55',
              confirmButtonText: 'OUI, je le supprime.',
              closeOnConfirm: false
            },
            function(){

              timer: 5000;
            
            document.location.href='deleteUser.php?user_id=<?php echo $keepId; ?>';
            });

            "   
        >
            Supprimer
        </button>
        
          
          
          
      </td>      
    </tr>    
  </tbody>
</table>
<?php

}


// ATTENTION METTRE UNE SWEET ALERT JS AVANT SUPPRESSION DE L'UTILISATEUR
// APPRENDRE A FAIRE LES BOUTONS d'un CRUD
// PEUT ETRE FAIRE APPARAITRE UN FORMULAIRE QUAND ON CLIQUE EDITER ET CODER LES TESTS ET l'UPDATE
// RENDRE CA JOLI



include_once("inc/inc_footer.php");
?>
    
    
    
    



