<?php noteAccessPages();?>
  <!-- INTRO -->
  <div class="intro container-fluid">
        <div class="wrapper row">
            <div id="over" class="col-lg-12">
                <h1 id="typewriteText">Browse more vehicles and rent the favourite one...</h1>
            </div>
        </div>
    </div> <!-- end #intro -->
</header>


<main>
<!-- catalog -->
<div class="catalog">
    <div class="container-fluid mt-4 p-2" id="allCars">
        <div class="row mt-3" id="cars">
            <?php
                $defaultAllVehicles=getAllVehicles(); 
                foreach ($defaultAllVehicles as $car):
            ?>
            <article class="aSection col-12 col-sm-6 col-md-4 col-lg-3 ">
                <figure class="imgCars">
                    <img src="<?=$car->picture ?>" alt="" class="img-fluid"/>
                </figure>
                <div class="descSection">
                    <h3><strong><?= $car->brand ?></strong>, <?= $car->model ?></h3>
                    <p>Type: <?= $car->type ?></p>
                    <p>Daily price: <?= $car->dailyPrice ?></p>
                </div>
                    <a class="button aboutBtn" href="index.php?page=vehicle&id=<?= $car->id_vehicle ?>">
                        <span class="btnInner mbBtn">
                            Read more
                        </span>
                    </a>
            </article>
            <!-- end card -->
            <?php endforeach; ?> 
        </div>
    </div>
</div>
	<!-- end catalog -->
</main>
