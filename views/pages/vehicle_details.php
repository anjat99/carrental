</header>
<?php 
    if(isset($_GET['id'])){ 
        $id = $_GET['id']; 

        $query = "SELECT COUNT(DISTINCT rc.id_rent)as rented, v.*,v.available as available, v.price_per_day as dailyPrice, b.name as brand, ft.name as fuel, vt.name as `type` FROM vehicle v INNER JOIN brand b ON b.id_brand=v.id_brand INNER JOIN fuel_type ft ON ft.id_fuel_type=v.id_fuel_type INNER JOIN vehicle_type vt ON vt.id_type=v.id_type LEFT OUTER JOIN rental_car rc ON v.id_vehicle=rc.id_vehicle LEFT OUTER JOIN user u ON u.id_user=rc.id_user WHERE v.id_vehicle=:id "; 
        
        $rez=$connection->prepare($query);
        $rez->bindParam(':id',$id); 
        
        try { 
            $rez->execute(); 
            $car = $rez->fetch(); 
            
            if($car): ?> 
                <article class="project">
                    <figure class="imgP d-flex align-items-start">
                    <img src="<?=$car->picture ?>" alt="" class="img-fluid"/>
                    </figure>
                    <div>
                        <h3><strong><?= $car->brand ?></strong>, <?= $car->model ?></h3>
                        <p>
                            <p>Type: <?= $car->type ?></p>
                            <p>Daily price: <?= $car->dailyPrice ?></p>
                            <p>Construction year: <?= $car->construction_year ?></p>
                            <p>Fuel Type: <?= $car->fuel ?></p>
                            <?php if($car->available > 0): ?>
                                <p>AVAILABLE: <?= $car->available?> vehicles</p>
                            <?php else: ?>
                                <p>NO VEHICLES AVAILABLE</p>
                            <?php endif; ?>
                                
                        </p>
                        <?php	if(!isset($_SESSION['user'])):?>
                        <a class="button" href="#">
                            <span class="btnInner" id="rentObican">
                                Rent a car
                            </span>
                        </a>
                        <?php endif; if(isset($_SESSION['user']) && $_SESSION['user']->role === 'customer'):?>
                            <?php if($car->available > 0): ?>
                                <button type="button" class="btnInnerShowMore" id="btnAddRent" name="btnAddRent">Rent this car</button> 
                            <?php else: ?>
                                <button type="button" class="btnInnerShowMore btn-primary"  id="btnAddRentNot"  name="btnAddRent">Rent this car</button> 
                            <?php endif; ?>
                           

                        <?php endif; ?>	

                        
                    </div>

                </article>
                <div class="row">
                    <!-- reviews -->
                    <div class="col-12">
                        <div class="renting">
                        <?php	if(isset($_SESSION['user']) && $_SESSION['user']->role === 'customer'):
                                    $customer =$_SESSION['user']->id_user;
                            ?>
                            <form method="post" action="rent.php" class="form d-flex flex-column align-items-center m-4" id="formaRent" name="formaRent">
                            <div class="form-group">
								<label for="startdate">Start date of rent</label>
								<input type="date" name="startdate" id="startdate" value=""  max="2021-12-31"> 
								<p class='text-danger' id="datumGreskaStart"> </p>
							</div> 
                            <div class="form-group">
								<label for="enddate">End date of rent</label>
								<input type="date" name="enddate" id="enddate" value=""  max="2022-01-31"> 
								<p class='text-danger' id="datumGreskaEnd"> </p>
							</div> 
                            
                                <button type="button" id="btnSendRent" name="btnSendRent" class='btnAdmin btnIzmenaStyle'data-dailyprice="<?=$car->dailyPrice?>" data-vehicle="<?=$car->id_vehicle?>">SEND</button>
                            </form>
                            <?php endif; ?>	
                        </div>
                        </div>
                        </div>
       
                <?php else: header("Location: index.php");  ?>
            <?php endif;?>
            <?php 
            } catch (PDOException $e) { 
                echo $e->getMessage(); 
                header("Location: index.php"); 
            } 
        
}
?>
