 <!-- HEADER SECTION BEGIN -->
 <header>
 <nav class="container-fluid" id="menu" >
        <div id="logoHeader">
            <a href="#" class="logo">RentalCars</a>
        </div>
        <?php	
            if(isset($_GET['page']) && $_GET['page'] == "vehicles"): ?>
                <div class="d-flex justify-content-around">
                    <input type="text" id="search" name="search" placeholder="Search for a vehicle..." class="pretragaPocetnaShop ml-3">
				</div>
        <?php endif; ?>

        <div class="nav ml-auto">
            <?php
                echo showMainNavMenu();
            ?>
        </div>
    </nav>
    <!--navigacija za mobilne uredjaje i logo-->
    <nav id="mob">
        <div id="logoHeaderMob">
            <a href="#" class="logo">RentalCars</a>
        </div>
        <div class="nav">
        <?php
              echo showMainNavMenu();
          ?>
        </div>
    </nav>
    <!--// HEADER SECTION END -->
    <!--hamburger ikonica-->   
    <div id="hamburgerIkonica">
        <a href="#"><i class="fas fa-bars"></i></a>
    </div>  
    <br><br><br><br>