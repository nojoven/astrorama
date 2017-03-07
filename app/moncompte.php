<?php

session_start();


if(!isset($_SESSION['email']))
{

    header("Location: login.php");

}

include_once("inc/inc_header.php");    
include_once("inc/inc_nav.php");


include_once('connection.php');
include_once('oldconnection.php');
include_once('TestBDD.php');
include_once('visiteur.php');

//include_once('classes.php');
 
//var_dump($_SESSION);

// si des donnees viennent de login.php via $_POST ou  que $_GET contient $continue = "ok" c'est pour pouvoir rebondir et appeler la deuxieme methode
if((isset($_POST) && !empty($_POST)) || (isset($_GET['continue']) && $_GET['continue'] == "ok")) 
{
    $ancienUser = new TestBDD; //on instancie l'objet qui sert a tester les presences dans les bases de donnees
    if(!isset($_GET['continue']) || $_GET['continue'] != "ok") // si $_POST contient quelque chose $continue n'est pas dans le GET ou $continue != "ok" ca veut dire qu on n'a pas encore teste la presence de l'utilisateur dans dans astroramabis
    {
        //on definit dans ce cas les variables de sessions qui vont nous servir 
        $_SESSION['email']  = $_POST['emailuser'];
        $_SESSION['pass']   = crypt($_POST['pass'], "\$1\$AYw5dz8Jm0");    
        
        //on teste la presence de l'utilisateur dans la nouvelle bdd
        $ancienUser->isNewUser($con);
        
    }
    elseif (isset($_GET['versImport'])) //si $_POST existe et n'est pas vide et  $_GET contient $continue = "ok" alors $_GET a recu $versImport
    {
        $versImport = $_GET['versImport']; //on extrait $versImport et on verifie qu'il contient bien false
        if($versImport == "false")
        {   
            $ancienUser->verifierAnciennePresence($bdd, $con);  // comme il le contient on lance la verif de la presence de l'utilisateur dans l'ancienne bdd
        }
    }
 
}



// on recupere les donnees de l'utilisateur pour les utiliser en placeholder dans le formulaire qui lui permet de modifier ses donnees personnelles
$myDatas = $con->prepare("SELECT * FROM user WHERE email = :email AND crpwd = :pass");
$myDatas->bindValue(":email",  $_SESSION['email']);
$myDatas->bindValue(":pass",   $_SESSION['pass']);
$myDatas->execute();
if($myDatas->rowCount() == 1) // si une ligne de la table lui correspond
{

    $mesInfos = $myDatas->fetch(); // on met ses donnees personnelles dans $mesInfos, elles  serviront en placeholder.

}
?>

<?php
//message d'accueil pour les nouveaux inscrits

if(isset($_GET["registerOk"]))
{
    
    $registerOk =  "Bienvenue ".$mesInfos['prenom'].". Vous pouvez maintenant accéder à votre compte.";
    
    
    echo "<script type='text/javascript' language='Javascript' id='newUserWelcome' > 
     var welcome = '".$registerOk."';
     swal('Felicitations!', welcome, 'success', 'timer: 3000'); 
    </script>";

} 
?>
<?php
if($mesInfos['rights'] != 2) // si vous etes admin un lien s'affiche qui mene vers une page de crud
{
    $adminCrud = "Gestion des abonnes"; 
}
?>

<div class="row">
    <span id="warningUpdate">
        <?php 
            //si le fornulaire d'update a ete mal rempli on affiche le message d'erreur issu de la methode modifMesDonnees($con)
            if(isset($retryUpdate)) 
            {
                echo $retryUpdate;
            } 
//le formulaire qui suit permet de faire un update des donnes utilisateur        
        ?>
    </span>
    
    <div class="col-sm-5">
        <form class="form-horizontal col-sm-12 profile" method="POST" action="register.php">
               
                <div class="row">
                   <div class="form-group col-sm-10">
                    
                    <div class="cols-sm-12">
                        <div class="input-group">
                            <span class=""><i class="fa fa-user fa" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="upNom" id="upNom"  placeholder="<?php echo $mesInfos['nom'];  ?>" />
                        </div>
                    </div>
                    
                    
                    <div class="cols-sm-12">
                        <div class="input-group">
                            <span class=""><i class="fa fa-user fa" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="upPrenom" id="upNom"  placeholder="<?php echo $mesInfos['prenom'];  ?>"/>
                        </div>
                    </div>
                
                    
                    <div class="cols-sm-12">
                        <div class="input-group">
                            <span class=""><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="upEmail" id="upEmail"  placeholder="<?php echo $mesInfos['email']  ?>"/>
                        </div>
                    </div>
                
                   
                    <div class="cols-sm-12">
                        <div class="input-group">
                            <span class=""><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="upTel" id="upTel"  placeholder="<?php echo $mesInfos['tel']  ?>"/>
                        </div>
                    </div>
                
                   
                    <div class="cols-sm-12">
                        <div class="input-group">
                            
                            <span class=""><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                            <input type="password" class="form-control" name="upPwd" id="upPwd"  placeholder="Mot de passe"/>
                        </div>
                    </div>
                
                    
                    <div class="cols-sm-12">
                        <div class="input-group">
                            <span class=""><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                            <input type="password" class="form-control" name="upConfirmPwd" id="upConfirmPwd"  placeholder="Confirmez ce mot de passe"/>
                        </div>
                    </div>
                
                </div>             
                <div class="col-sm-2 float-right" id="editbtn">
                    <input type="submit" name="login" class="btn btn-primary editButton" value="Editer"> 
                </div>
            </div>
        </form>
        <div class="col-sm-3 " >
            <a href="unlog.php" >
                <input type="submit"  name="unlog" class="btn btn-primary offset-9 "  value="Deconnexion">
            </a> 
        </div>
    </div>
<?php
    $updatingUser = new Visiteur;
    if(isset($_POST['upConfirmPwd']))
    {    
        $updatingUser->modifMesDonnees($con);
    }
?>
    <div class="col-sm-7 pt10">
        <div class="row">
            <div class="col-sm-8 ">
                <div class="recorded-evt">
                    <h3>Evenement N°<?php  ?></h3>
                    <h4>Nom : <?php  ?></h4>
                    <p>En fonction.</p>
                </div>
            </div>
            <div class="col-sm-2" >
                    <input type="submit" name="login" class="btn btn-primary recorded-btn" value="Modifier">
            </div>
            <div class="col-sm-2" >
                    <input type="submit" name="login" class="btn btn-primary recorded-btn" value="Annuler">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 ">
                <div class="recorded-evt">
                    <h3>Evenement N°<?php  ?></h3>
                    <h4>Nom : <?php  ?></h4>
                    <p>En fonction.</p>
                </div>
            </div>
            <div class="col-sm-2" >
                    <input type="submit" name="login" class="btn btn-primary recorded-btn" value="Modifier">
            </div>
            <div class="col-sm-2" >
                    <input type="submit" name="login" class="btn btn-primary recorded-btn" value="Annuler">
            </div>
        </div>
    </div>
</div>
<span id="spanAdmin" >
        <?php 
            if(isset($adminCrud)) 
            {
                ?> <a href="crud.php"><?php echo $adminCrud; ?></a> <?php
            }
        ?>
</span>
     
      
     
<?php
require("inc/inc_footer.php"); 
?>


