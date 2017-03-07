<?php include("inc/inc_header.php"); ?>

<?php include ("inc/inc_nav.php"); ?>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="well well-sm">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">
                                    Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Entrez votre nom" required="required" />
                            </div>
                            <div class="form-group">
                                <label for="email">
                                    Email Address</label>
                                <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                </span>
                                    <input type="email" class="form-control" id="email" placeholder="Entrez votre email" required="required" /></div>
                            </div>
                            <div class="form-group">
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">
                                    Message</label>
                                <textarea name="message" id="message" class="form-control" rows="9" cols="25" required="required"
                                          placeholder="Message"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary pull-right" id="btnContactUs">
                                Envoyez votre message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <form>
                <legend><span class="glyphicon glyphicon-globe"></span>Nos locaux.</legend>
                <address>
                    <strong>Astrorama.</strong><br>
                    Adresse perdue dans les montagnes<br>
                    Oui dans les montagnes, Nice.<br>
                    <abbr title="Numéro">
                        Tel:</abbr>
                    (123) 456-7890
                </address>
                <address>
                    <strong>Full Name</strong><br>
                    <a href="mailto:#">parsec@astrorama.net</a>
                </address>
            </form>
        </div>
    </div>
</div>


<?php include ("inc/inc_footer.php"); ?>
