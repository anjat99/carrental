<?php
function getAllVehicles(){
    return executeQuery("SELECT v.picture as picture, v.id_vehicle, v.model, b.name as brand, v.price_per_day as dailyPrice, vt.name as type FROM vehicle v INNER JOIN brand b ON b.id_brand=v.id_brand INNER JOIN vehicle_type vt ON vt.id_type=v.id_type");
}
function showNewCars(){
    return executeQuery("SELECT v.picture as picture, v.id_vehicle, v.model, b.name as brand, v.price_per_day as dailyPrice, vt.name as type, v.construction_year as yearSerie FROM vehicle v INNER JOIN brand b ON b.id_brand=v.id_brand INNER JOIN vehicle_type vt ON vt.id_type=v.id_type ORDER BY dailyPrice LIMIT 3");
}
function getFuelTypes(){
    return executeQuery("SELECT * FROM fuel_type");
}
function getBrands(){
    return executeQuery("SELECT * FROM brand");
}
function getTypes(){
    return executeQuery("SELECT * FROM vehicle_type");
}

function getVehicles(){
    return executeQuery("SELECT COUNT(DISTINCT rc.id_rent)as rented, v.*, b.name as brand, ft.name as fuel, vt.name as `type` FROM vehicle v INNER JOIN brand b ON b.id_brand=v.id_brand INNER JOIN fuel_type ft ON ft.id_fuel_type=v.id_fuel_type INNER JOIN vehicle_type vt ON vt.id_type=v.id_type LEFT OUTER JOIN rental_car rc ON v.id_vehicle=rc.id_vehicle LEFT OUTER JOIN user u ON u.id_user=rc.id_user GROUP BY v.id_vehicle");
}

function getOneVehicle($id){
    global $connection;
    $vehicle=$connection->prepare("SELECT COUNT(DISTINCT rc.id_rent)as rented, v.*, b.name as brand, ft.name as fuel, vt.name as `type` FROM vehicle v INNER JOIN brand b ON b.id_brand=v.id_brand INNER JOIN fuel_type ft ON ft.id_fuel_type=v.id_fuel_type INNER JOIN vehicle_type vt ON vt.id_type=v.id_type LEFT OUTER JOIN rental_car rc ON v.id_vehicle=rc.id_vehicle LEFT OUTER JOIN user u ON u.id_user=rc.id_user WHERE v.id_vehicle=? GROUP BY v.id_vehicle ");
    $vehicle->execute([$id]);
    return $vehicle->fetch();
}