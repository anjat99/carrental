<?php noteAccessPages();?>
<div id="sliderWrapper">  
    <div class="show fade ">  
        <img src="assets/images/audi_q8.jpg" class="imgCarousel" />  
       
    </div>  
    <div class="show fade">  
        <img src="assets/images/nissan_armada.jpg" class="imgCarousel"/>  
    </div>  
        
    <div class="show fade">  
        <img src="assets/images/porscheGT.jpg" class="imgCarousel"/>  

    </div>  

    <!-- Navigation arrows -->  
    <a id="left"><i class="fas fa-angle-left"></i></a>  
    <a id="right"><i class="fas fa-angle-right"></i></a>  
    <a id="down" href="#titleAbout"><i class="fas fa-angle-down"></i></a> 

    <div id="circles"> 
        <span class="circle" id="dot1"></span>  
        <span class="circle" id="dot2"></span>  
        <span class="circle" id="dot3"></span>  
    </div>
</div>  
 </header>

 <!-- #region ABOUT - 3 SECTIONS (ON TABLET DEVICES IN ONE ROW 3 SECTION, MOBILE DEVICES - 2 IN A ROW, SMALL MOBILE DEVICES 1 IN A ROW) -->
 <main>
    <header id="titleAbout">
        <h2>Why should you pick us....</h2>
        <span class="line"></span>
    </header>

    <section id="aboutSections">
        <article class="aSection">
            <figure class="img">
                <img src="assets/icons/support.png" alt=""/>
            </figure>
            <div class="descSection">
                <h3>Best Price Guarantee</h3>
                <p>We prefer to work with locally owned and operated lodging and tour operators. This allows more money to stay inside of local communities and in the hands of people who live in the destinations you visit. We give 10% of income to conservation and charity organizations.</p>
            </div>
        </article>
        <article class="aSection">
            <figure class="img">
                <img src="assets/icons/graduation-cap.png" alt=""/>
            </figure>
            <div class="descSection">
                <h3>Our Dedicated Support</h3>
                <p>Looking to find great travel deals or enjoy the biggest savings on your next trip? RentalCars.com has you covered. With our easy-to-use website and app, along with 24-hour customer service, booking your next trip couldn't be simpler.</p>
            </div>
        </article>
        <article class="aSection">
            <figure class="img">
                <img src="assets/icons/like.png" alt=""/>
            </figure>
            <div class="descSection">
                <h3>Best Rental Agent</h3>
                <p>As one of the world's leading online rental agencies, RentalCars.com is here to help you plan the perfect trip. Whether you're going on holiday, or taking a business trip, RentalCars.com is here to help you .</p>
            </div>
        </article>
    </section>

    <!-- POPULAR VEHICLES -->
        <header id="titleAbout">
            <h2>MOST POPULAR VEHICLES</h2>
             <span class="line"></span>
        </header>

        <section id="vehiclesSections">
            <?php
                    $newCars=showNewCars(); 
                    foreach ($newCars as $car):
            ?>
            
            <article class="aSection mb-4">
                    <figure class="imgCars">
                    <img src="<?=$car->picture ?>" alt="" class="img-fluid"/>
                    </figure>
                    <div class="descSectionCars">
                        <h3><strong><?= $car->brand ?></strong>, <?= $car->model ?></h3>
                        <p>Type: <?= $car->type ?></p>
                        <p>Daily price: <?= $car->dailyPrice ?></p>
                    </div>
                    <a class="button aboutBtn text-center mb-2" href="index.php?page=vehicles">
                    <span class="btnInner mbBtn text-center mb-2">
                        See more
                    </span>
                    </a>
            </article>
            <?php endforeach; ?>
        </section>


</main>