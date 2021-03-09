<?php
ob_start();
 session_start();
 
if(!isset($_SESSION['user'])){
    header("Location: 403.php");
} else {
    if($_SESSION['user']->id_role == 1) {
        $admin = $_SESSION['user'];
 ?>

 <?php
 require_once "../../config/connection.php";

 require_once "../../models/functions.php";
 require_once "../../models/vehicles/functions.php";
 
 require_once("../../views/pages/admin/head.php");
 require_once("../../views/pages/admin/header.php");
 
if(isset($_GET['page'])){
	$page=$_GET['page'];
	switch($page){
		case 'dashboard':
			require_once("../../views/pages/admin/dashboard.php");
			break;
		case 'vehicles':
			require_once("../../views/pages/admin/vehicles.php");
			break;
		case 'customers':
			require_once("../../views/pages/admin/customers.php");
			break;
		case 'renting':
			require_once("../../views/pages/admin/renting.php");
            break;
        case '404':
            require_once("admin/pages/404.php");
			break;
		default:
			require_once("../../views/pages/admin/dashboard.php");
			break;
	}
}else{
	require_once("../../views/pages/admin/dashboard.php");
}

require_once("../../views/pages/admin/footer.php");
   ?>

<?php 
  }else{
    header("Location: 404.php");
 }
}
?>