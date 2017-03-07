<?php include("inc/inc_header.php"); ?>

<?php include ("inc/inc_nav.php"); ?>

<!--LIGHTBOX-->
<section class="lightbox">
    <div class="column">
        <img src="img/img_nature.jpg" style="width:100%" onclick="openModal();currentSlide(1)" class="hover-shadow cursor">
    </div>

    <div class="column">
        <img src="img/img_fjords.jpg" style="width:100%" onclick="openModal();currentSlide(2)" class="hover-shadow cursor">
    </div>

    <div class="column">
        <img src="img/img_mountains.jpg" style="width:100%" onclick="openModal();currentSlide(3)" class="hover-shadow cursor">
    </div>

    <div class="column">
        <img src="img/img_lights.jpg" style="width:100%" onclick="openModal();currentSlide(4)" class="hover-shadow cursor">
    </div>

    <div id="myModal" class="modal">
        <span class="close cursor" onclick="closeModal()">&times;</span>

        <div class="modal-content">

            <div class="mySlides">
                <div class="numbertext">1 / 4</div>
                <img src="img/img_nature_wide.jpg" style="width:100%">
            </div>

            <div class="mySlides">
                <div class="numbertext">2 / 4</div>
                <img src="img/img_fjords_wide.jpg" style="width:100%">

            </div>
            <div class="mySlides">

                <div class="numbertext">3 / 4</div>
                <img src="img/img_mountains_wide.jpg" style="width:100%">

            </div>

            <div class="mySlides">
                <div class="numbertext">4 / 4</div>
                <img src="img/img_lights_wide.jpg" style="width:100%">
            </div>

            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>

            <div class="caption-container">
                <p id="caption"></p>
            </div>

            <div class="column">
                <img class="demo cursor" src="img/img_nature_wide.jpg" style="width:100%" onclick="currentSlide(1)" alt="Nature and sunrise">
            </div>

            <div class="column">
                <img class="demo cursor" src="img/img_fjords_wide.jpg" style="width:100%" onclick="currentSlide(2)" alt="Trolltunga, Norway">
            </div>

            <div class="column">
                <img class="demo cursor" src="img/img_mountains_wide.jpg" style="width:100%" onclick="currentSlide(3)" alt="Mountains and fjords">
            </div>

            <div class="column">
                <img class="demo cursor" src="img/img_lights_wide.jpg" style="width:100%" onclick="currentSlide(4)" alt="Northern Lights">
            </div>

        </div>
    </div>

</section>
<!--FIN LIGHTBOX-->

<?php include ("inc/inc_footer.php"); ?>
