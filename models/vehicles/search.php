<?php

require "../../config/connection.php";
if(isset($_POST['keyword'])){ 
    $keyword = "%".$_POST['keyword']."%"; 

    $find_vehicle_query = "SELECT v.picture as carPicture, v.id_vehicle as id, v.model as carModel, b.name as carBrand, v.price_per_day as dailyPrice, vt.name as type FROM vehicle v INNER JOIN brand b ON b.id_brand=v.id_brand INNER JOIN vehicle_type vt ON vt.id_type=v.id_type  WHERE v.model LIKE :keyword GROUP BY v.id_vehicle"; 

    $priprema = $connection->prepare($find_vehicle_query); 
     $priprema->bindParam(":keyword", $keyword); 
     $cars = $priprema->execute(); 
     
     if($cars){ 
         $cars= $priprema->fetchAll(); 
            echo json_encode(["cars" => $cars, "uspeh"=>"Success"]); 
    } 
}