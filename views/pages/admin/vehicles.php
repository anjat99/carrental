<?php
    // session_start();
    if(isset($_SESSION['user']) && $_SESSION['user']->role==='admin'):
        $user=$_SESSION['user'];
		$id = $_SESSION['user']->id_user;
        require_once("../../config/connection.php"); 
        require_once("../../models/vehicles/functions.php"); 
        $query = "SELECT COUNT(*) as numberCars from vehicle";
        $obj = $connection->query($query)->fetch();
        $per_page = 3;
        $countLink = ceil($obj->numberCars/$per_page);
        $paging = isset($_GET['page']) ? $_GET['page'] : 1;
        $query = "SELECT COUNT(DISTINCT rc.id_rent)as rented, v.*, b.name as brand, ft.name as fuel, vt.name as `type` FROM vehicle v INNER JOIN brand b ON b.id_brand=v.id_brand INNER JOIN fuel_type ft ON ft.id_fuel_type=v.id_fuel_type INNER JOIN vehicle_type vt ON vt.id_type=v.id_type LEFT OUTER JOIN rental_car rc ON v.id_vehicle=rc.id_vehicle LEFT OUTER JOIN user u ON u.id_user=rc.id_user GROUP BY v.id_vehicle";
        $vehicles= $connection->query($query)->fetchAll();
?>

<div class="row col-lg-12 pl-0" id="sredinaAdmin">
    <?php
        include_once "nav.php";
    ?>
    <div class="row col-lg-9 bg-light ml-auto" id="sadrzajAdmin">
        <div class="row">
            <div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title d-flex justify-content-between">vehicles
                            <span>
                                <input type="button" value="Add" id='addVehicle'class='btnAdminUpdate btn-primary col-lg-12'>
                            </span>
                        </h4>
                                    
                        <div class="table-responsive" id="tabelaProizvodi">
                            <table class="centar table table-striped" border="1">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Cover</th>
                                        <th>Model</th>
                                        <th>Price per day</th>
                                        <th>Type</th>
                                        <th>Brand</th>
                                        <th>Fuel type</th>
                                        <th>Available</th>
                                        <th>Contruction Year</th>
                                        <th>Seating</th>
                                        <th>No.of rents</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach($vehicles as $i) :?>
                                        
                                        <tr class="rem1  py-1">
                                            <td>
                                                <img width="50" height="50" src="../../<?=$i->picture?>" alt="<?=$i->model?>" class="img-fluid"/>
                                              
                                                </td>
                                            <td><?=$i->model?></td>
                                            <td><?=$i->price_per_day?>&euro;</td>
                                            <td><?=$i->type?></td>
                                            <td><?=$i->brand?></td>
                                            <td><?=$i->fuel?></td>
                                            <td>
                                                <?php
                                                    if($i->available <= 0){
                                                        echo "NO VEHICLES AVAILABLE";
                                                    }else{
                                                        echo $i->available;
                                                    }
                                                ?>
                                            </td>
                                            <td><?=$i->construction_year?></td>
                                            <td><?=$i->number_seats?></td>
                                            <td><?=$i->rented?></td>
                                            <td>
                                                <a href='#' data-id="<?=$i->id_vehicle?>" class='btnAdmin btn-primary updateCar'><i class="far fa-edit"></i></a>
                                            </td>
                                            <td>
                                                <a href='#' data-id="<?=$i->id_vehicle?>" class='btnAdmin btn-primary deleteCar'><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        
                                        </tr>
                                    <?php endforeach; ?>   
                                    </tbody>
                            </table>
                        </div>

                        <div class="row">
                            <div class="col-md-6 ml-auto" id="editCarForm">
                                <h2>Update vehicle</h2>
                                    <form method="post" action="../../models/vehicles/update.php">
                                        <div class="form-group">
                                            <input type="hidden" name="skrivenoPoljeVehicle" id="skrivenoPoljeVehicle" class=form-control>
                                        </div>
                                      
                                        <div class="form-group">
                                            <label>Model: </label>
                                            <input type="text" name="modelUpdate" id="modelUpdate" placeholder='Model' class='form-control'>
                                        </div>
                                        <div class="form-group">
                                            <label>Daily price: </label>
                                            <input type="text" name="dailyPriceUpdate" id="dailyPriceUpdate" placeholder='Daily Price' class='form-control'>
                                        </div>
                                        <div class="form-group">
                                            <label>Construction year: </label>
                                            <input type="text" name="constructionYearUpdate" id="constructionYearUpdate" placeholder='Contruction Year' class='form-control'>
                                        </div>
                                        <div class="form-group">
                                            <label>No.of seats: </label>
                                            <input type="text" name="numberSeatsUpdate" id="numberSeatsUpdate" placeholder='Number of seats' class='form-control'>
                                        </div>

                                        <label>Fuel type: </label>
                                        <div class="form-group">
                                            <select name='ddlFuelTypeUpdate' id='ddlFuelTypeUpdate' class=form-control>
                                                <option value='0'>Choose</option>
                                                    <?php
                                                        $queryFTypes=getFuelTypes();
                                                        foreach ($queryFTypes as $ft):?>
                                                            <option value="<?=$ft->id_fuel_type?>"><?=$ft->name?></option>
                                                        <?php endforeach;
                                                    ?>
                                            </select>
                                        </div>

                                        <label>Brands: </label>
                                        <div class="form-group">
                                            <select name='ddlBrandUpdate' id='ddlBrandUpdate' class=form-control>
                                                <option value='0'>Choose</option>
                                                    <?php
                                                        $queryBrend=getBrands();
                                                        foreach ($queryBrend as $b):?>
                                                            <option value="<?=$b->id_brand?>"><?=$b->name?></option>
                                                        <?php endforeach;
                                                    ?>
                                            </select>
                                        </div>
                                        <label>Type: </label>
                                        <div class="form-group">
                                            <select name='ddlTypeUpdate' id='ddlTypeUpdate' class=form-control>
                                                <option value='0'>Choose</option>
                                                    <?php
                                                        $queryTypes=getTypes();
                                                        foreach ($queryTypes as $t):?>
                                                            <option value="<?=$t->id_type?>"><?=$t->name?></option>
                                                        <?php endforeach;
                                                    ?>
                                            </select>
                                        </div>
                                       

                                            <input type="submit" value="Edit" name='btnEditVehicle'
                                            id='btnEditVehicle' class='btnAdminUpdate btn-primary'>
                                            <input type="button" value="hide" id='hideUpdateCars'
                                            class='btnAdminUpdate btn-primary'>
                                    </form>
                                </div>

                                <div class="odgovorUpdateProizvod">
                                    <?php
                                        if(isset($_SESSION['errorsUpdate'])){
                                            $errorsUpdate=$_SESSION['errorsUpdate'];
                                            echo "<p>$errorsUpdate</p>";
                                            unset($_SESSION['errorsUpdate']);
                                        }
                                    ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 ml-auto" id="dataCarsAdd">
                                    <h2>Insert vehicle</h2>
                                    <form method="POST" action="../../models/vehicles/insert.php" enctype='multipart/form-data'>
                                  
                                        <div class="form-group">
											<label for="upload">Upload cover </label>
											<input id="upload" name="upload" type="file" accept=".png, .jpg, .jpeg">
										</div>
                
                                        <div class="form-group">
                                            <label>Model: </label>
                                            <input type="text" name="modelAdd" id="modelAdd" placeholder='Model' class='form-control'>
                                        </div>
                                        <div class="form-group">
                                            <label>Daily price: </label>
                                            <input type="text" name="dailyPriceAdd" id="dailyPriceAdd" placeholder='Daily Price' class='form-control'>
                                        </div>
                                        <div class="form-group">
                                            <label>Construction year: </label>
                                            <input type="text" name="constructionYearAdd" id="constructionYearAdd" placeholder='Contruction Year' class='form-control'>
                                        </div>
                                        <div class="form-group">
                                            <label>No.of seats: </label>
                                            <input type="text" name="numberSeatsAdd" id="numberSeatsAdd" placeholder='Number of seats' class='form-control'>
                                        </div>
                                        <div class="form-group">
                                            <label>Available: </label>
                                            <input type="text" name="availableAdd" id="availableAdd" placeholder='Number of available vehicles' class='form-control'>
                                        </div>
                                        <label>Fuel type : </label>
                                        <div class="form-group">
                                            <select name='ddlFuelTypeAdd' id='ddlFuelTypeAdd' class=form-control>
                                                <option value='0'>Choose fuel type</option>
                                                <?php
                                                    $queryFTypes=getFuelTypes();
                                                    foreach ($queryFTypes as $ft):?>
                                                        <option value="<?=$ft->id_fuel_type?>"><?=$ft->name?></option>
                                                <?php endforeach;
                                                ?>
                                            </select>
                                        </div>
                                        <label>Brand : </label>
                                        <div class="form-group">
                                            <select name='ddlBrandAdd' id='ddlBrandAdd' class=form-control>
                                                <option value='0'>Choose brand:</option>
                                                <?php
                                                    $queryBrend=getBrands();
                                                    foreach ($queryBrend as $b):?>
                                                        <option value="<?=$b->id_brand?>"><?=$b->name?></option>
                                                <?php endforeach;
                                                ?>
                                            </select>
                                        </div>
                                        <label>Type : </label>
                                        <div class="form-group">
                                            <select name='ddlTypeAdd' id='ddlTypeAdd' class=form-control>
                                                <option value='0'>Choose type:</option>
                                                <?php
                                                    $queryTypes=getTypes();
                                                    foreach ($queryTypes as $t):?>
                                                        <option value="<?=$t->id_type?>"><?=$t->name?></option>
                                                <?php endforeach;
                                                ?>
                                            </select>
                                        </div>
                                
                                        <input type="submit" value="insert" name='btnAddVehicle' id='btnAddVehicle' class='btnAdmin btnIzmenaStyle'>&nbsp;
                                        <input type="button" value="Cancel" id='hideFormAddCars' class='btnAdmin btnIzmenaStyle'>

                                        <?php
                                            if(isset($_GET['poruka'])){
                                                echo $_GET['poruka'];
                                            }
                                            if(isset($_SESSION['errorsUnos'])){
                                                $errorsUnos=$_SESSION['errorsUnos'];

                                                foreach($errorsUnos as $jednaGreska){
                                                    echo "<p>$jednaGreska</p>";
                                            }
                                            unset($_SESSION['errorsUnos']);
                                            }
                                        ?>
                                    </form>
                                </div>

                                <div class="odgovorAddProduct">
                                    <?php if(isset($_SESSION['poruka'])):
                                        echo $_SESSION['poruka'];
                                        unset($_SESSION['poruka']);

                                            endif; ?>
                                </div>
                    </div>
                    <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>