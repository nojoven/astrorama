<?php 

session_start();                  
include_once("inc/inc_header.php");    
include_once("inc/inc_nav.php");     
include_once("connection.php");       
include_once("classes.php");
include_once("visiteur.php");

//register.php permet de s'inscrire du coup on utilise une classe Visiteur qui possede une methode inscription
$utilisateur = new Visiteur; //on instancie Visiteur
$areYouInside = $con->prepare("SELECT * FROM user"); //on recupere les donnees d' astroramabis dans $control
$areYouInside->execute();
 
$control = $areYouInside->fetchAll();

//var_dump($control);
$utilisateur->inscription($con, $control); //on appelle inscription($con, $control) pour permettre linscription


?>

<div align="center" id="ed">
<?php 
    
    if(isset($warnError) && $warnError != "")
    {
        echo $warnError;
    }
    
?>
</div>
<div class="container">
    <div class="row main">
        <div class="main-login main-center">
            <form class="form-horizontal" method="POST" action="register.php">

               <div class="form-group">
                    <label for="name" class="cols-sm-2 control-label">Votre nom</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="lastName" id="lastName"  placeholder="Entrez votre nom"/>
                        </div>
                    </div>
                </div>

               <div class="form-group">
                    <label for="name" class="cols-sm-2 control-label">Votre prénom</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="firstName" id="firstName"  placeholder="Entrez votre prénom"/>
                        </div>
                    </div>
                </div>

               <div class="form-group">
                    <label for="email" class="cols-sm-2 control-label">Adresse email</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="email" id="email"  placeholder="Adresse email"/>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="email" class="cols-sm-2 control-label">Téléphone</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="telephone" id="telephone"  placeholder="Votre numéro de téléphone"/>
                        </div>
                    </div>
                </div>

               <div class="form-group">
                    <label for="password" class="cols-sm-2 control-label">Mot de passe</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                            <input type="password" class="form-control" name="password" id="password"  placeholder="Entrez votre mot de passe"/>
                        </div>
                    </div>
                </div>

               <div class="form-group">
                    <label for="confirm" class="cols-sm-2 control-label">Confirmez le mot de passe</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                            <input type="password" class="form-control" name="confirmPwd" id="confirm"  placeholder="Confirmez votre mot de passe"/>
                        </div>
                    </div>
                </div>

               <div class="form-group ">
                    <button type="submit" class="btn btn-primary btn-lg btn-block login-button">Inscription</button>
                </div>
                <div class="login-register">
                    <a href="moncompte.php">Connexion</a>
                </div>
            </form>
        </div>
    </div>
</div>



<?php include ("inc/inc_footer.php"); ?>
