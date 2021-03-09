<?php
 session_start();
 ob_start();

 $code = 404;

    if(isset($_SESSION['user']) && $_SESSION['user']->role==='admin'):
    $uploadDir = 'assets/images/';
        if(isset($_POST['btnAddVehicle'])){
                require_once("../../config/connection.php");
         
                 //text fields
                 $model = $_POST['modelAdd'];
                 $daily_price = $_POST['dailyPriceAdd'];
                 $construction_year = $_POST['constructionYearAdd'];
                 $number_seats = $_POST['numberSeatsAdd'];
                 $available = $_POST['availableAdd'];
 
                 //ddl
                 $fuel_id=$_POST['ddlFuelTypeAdd'];
                 $brand_id=$_POST['ddlBrandAdd'];
                 $type_id=$_POST['ddlTypeAdd'];
              

                $greske=[];
                
                // img
                $slika = $_FILES['upload'];
                //   var_dump($slika);
               
                $dozvoljeniTipovi=array("image/jpg", "image/jpeg", "image/png");
                $max_size=4*1024*1024;

                $name=$slika["name"];
                $tmpName=$slika["tmp_name"];
                $size=$slika["size"];
                $type=$slika["type"];

                $filePath = $uploadDir . $name;
                $novNazivUpload = 'assets/images/nova_'.time();
  
                $lokacijaSlike=$_SERVER["DOCUMENT_ROOT"]."/carrental/assets/images/new/";
                $lokacija=$lokacijaSlike.time()."-".$name;

                $name  = addslashes($name);
                $filePath  = addslashes($filePath);
                
                if(empty($slika)){
                    $greske[]="You must add a picture of the vehicle";
                }else{

                    if(!in_array($type, $dozvoljeniTipovi)){
                        $greske[]="Your image format is not supported ($name)";
                    }
                    if($size>$max_size){
                        $greske[]="Your image is bigger then 4MB ($name)";
                    }
                }
            
                

                if(count($greske)){
                    $data=["greske"=>$greske];
                    $code=422;
                    $_SESSION['poruka']="The fields can't be empty and all fields are required!";
                }
                if(move_uploaded_file($tmpName, '../../'.$filePath)){

                     $poX=260;
                     


                    list($sirina,$visina)=getimagesize('../../'.$filePath);

                // var_dump($filePath);
                // var_dump($sirina);

                    $novaSirina=$poX; //newWidth
                // var_dump($novaSirina);


                    // $novaVisina = 260;

                    $procenat_promene = $novaSirina/$sirina ;
                    $novaVisina = $visina * $procenat_promene; //newHeight

                  
                    $upit1 = "INSERT INTO vehicle VALUES(NULL,:model, :type, :brand, :fuel, :construction_year, :number_seats, :price_per_day, :available, :picture)";
                    $rez1 = $connection->prepare($upit1);
                    $rez1->bindParam(":model", $model);
                    $rez1->bindParam(":type",  $type_id);
                    $rez1->bindParam(":brand", $brand_id);
                    $rez1->bindParam(":fuel", $fuel_id);
                    $rez1->bindParam(":construction_year", $construction_year);
                    $rez1->bindParam(":number_seats", $number_seats);
                    $rez1->bindParam(":price_per_day", $daily_price);
                    $rez1->bindParam(":available", $available);
                    $rez1->bindParam(":picture", $filePath);
    
    
                    try{
                        $connection->beginTransaction();
                        $rez1->execute();
                        $connection->commit();
                        echo json_encode(['message'=> 'Movie successfully created']);
                        $_SESSION['poruka']="Successfully created vehicle!";
                        $code=201;
                        // header("Refresh:0;");
                        header("Refresh:0; url=../../views/pages/admin.php?page=vehicles");
                       
                    }catch(PDOException $e){
                       
                        $code=500;
                        $konekcija->rollback();
                        echo json_encode(['message'=> $e->getMessage()]);
                        enrollErrors($e->getMessage());
                        $_SESSION['poruka']="Error on server, vehicle is not added";
                        // http_response_code(500);
                        header("Refresh:0; ");

                    }    
                 
                    // header("Refresh:0; ");
                // }
        }
                
    }
                
           

    endif;
