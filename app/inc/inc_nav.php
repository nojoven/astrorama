<section id="navbar">
    <div class="container">
        <nav class="navbar  navbar-full ">
            <!--PREMIERE COLONNE-->
            <div><!-- col-xs-4 : les deux colonnes on une largeur de 4 et  -xs-middler permet de center verticalement le contenu-->
                <a class="navbar-brand" href="index.php">ACCUEIL</a>
                <a class="navbar-brand title" href="index.php">ASTRORAMA</a>
                <a class="navbar-brand" href="partenaires.php">PARTENAIRES</a>
                <?php 
                    
                    if(!isset($_SESSION['email']))
                    { 
                     ?>  <a class='navbar-brand' href='login.php'>CONNEXION</a> <?php
                    } 
                       elseif(isset($_SESSION['email']))  
                    {  
                     ?>  <a class='navbar-brand' href='moncompte.php'>MON COMPTE</a> <?php
                    } 
                ?>
                
                <a class="navbar-brand" href="FAQ.php">?</a>
                <a class="navbar-brand" href="contact.php">CONTACT</a>
            </div>

            <!--DEUXIEME COLONNE-->
            <div class="col-xs-4 flex-xs-middle nav-sub-menu">

                <!--BURGER MENU-->
                <button class="navbar-toggler hidden-lg-up float-lg-right" type="button" data-toggle="collapse" data-target="#exCollapsingNavbarMD">
                    &#9776;
                </button>
            </div>
        </nav>

            <!--MENU DEROULANT-->
               <div class="collapse navbar-toggleable-md float-lg-right " id="exCollapsingNavbarMD">
                    <ul class="nav navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="partenaires.php">PARTENAIRES</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="moncompte.php">MON COMPTE</a>
                        </li> <li class="nav-item">
                            <a class="nav-link" href="contact.php">CONTACT</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</section>
