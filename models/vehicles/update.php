<?php
 session_start();
 ob_start();

 $code = 404;

    if(isset($_SESSION['user']) && $_SESSION['user']->role==='admin'):
        if(isset($_POST['btnEditVehicle'])){
                require_once("../../config/connection.php");
         
                //text fields
                $id=$_POST['skrivenoPoljeVehicle'];
                $model = $_POST['modelUpdate'];
                $daily_price = $_POST['dailyPriceUpdate'];
                $construction_year = $_POST['constructionYearUpdate'];
                $number_seats = $_POST['numberSeatsUpdate'];

                //ddl
                $fuel_id=$_POST['ddlFuelTypeUpdate'];
                $brand_id=$_POST['ddlBrandUpdate'];
                $type_id=$_POST['ddlTypeUpdate'];

                
                $result = $connection->prepare("UPDATE vehicle SET model = ?, price_per_day = ?, construction_year = ?, number_seats = ?, id_fuel_type = ?, id_brand = ?, id_type = ?  WHERE id_vehicle = ?");

                $result->bindValue(1, $model);
                $result->bindValue(2, $daily_price);
                $result->bindValue(3, $construction_year);
                $result->bindValue(4, $number_seats);
                $result->bindValue(5, $fuel_id);
                $result->bindValue(6, $brand_id);
                $result->bindValue(7, $type_id);
                $result->bindValue(8, $id);
        
                try {
                    $uspelo = $result->execute();
                    http_response_code(204); 
                    if($uspelo){
                        $_SESSION['poruka']="Successfully updated vehicle!";
                        $code=201;
                        header("Refresh:0; url=../../views/pages/admin.php?page=vehicles");
                     }else{
                         echo "Nije uspelo izvrsavanje";
                     }
                }
                catch(PDOException $e){
                    echo json_encode(['poruka'=> 'Database problem: ' . $e->getMessage()]);
                    http_response_code(500);
                    $_SESSION['poruka']="Error on server, vehicle is not updates";
                }

                header("Location:../../views/pages/admin.php?page=vehicles");
            }else {
                http_response_code(400); 
            }
        endif;