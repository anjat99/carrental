<?php
ob_start();
session_start();
require_once "config/connection.php";

require_once "models/functions.php";
require_once "models/vehicles/functions.php";
require_once("views/fixed/head.php");
require_once("views/fixed/header.php");

if(isset($_GET['page'])){
    $page=$_GET['page'];
    switch($page){
        case 'home':
            require_once("views/pages/home.php");
            break;
        case 'vehicles':
            require_once("views/pages/browse_vehicles.php");
            break;
        case 'vehicle':
            require_once("views/pages/vehicle_details.php");
            break;
        case 'register':
            require_once("views/pages/register.php");
            break;
        case 'login':
            require_once("views/pages/login.php");
            break;
        default:
            require_once("views/pages/home.php");
            break;
    }
}else{
    require_once("views/pages/home.php");
}

require_once("views/fixed/footer.php");
?>
