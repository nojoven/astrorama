<?php include("inc/inc_header.php"); ?>

<?php include ("inc/inc_nav.php"); ?>


<div class="modal-dialog">
    <div class="loginmodal-container">
        <h1>Connectez-vous</h1><br>
        <form action="moncompte.php"  method="post">
            <input type="text" name="emailuser" placeholder="Adresse mail">
            <input type="password" name="pass" placeholder="Mot de passe">
            <input type="submit" name="login" class="login loginmodal-submit" value="Connexion">
        </form>
        
        

        <div class="login-help">
            <a href="register.php">Pas de compte ? Enregistrez-vous</a><br> <a href="#">Mot de passe oublié ?</a>
        </div>
    </div>
</div>
<?php


if(isset($erreur) && !empty($erreur)) {
   echo " Veuillez completer les champs d'identification. ";
}



?>

<?php include ("inc/inc_footer.php"); ?>
