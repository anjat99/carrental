<?php
    session_start();
    ob_start();
    require_once("../../config/connection.php");
    require_once("functions.php");
    $data=null;
    $code=404;
    header("Content-type:application/json");
    if(isset($_SESSION['user']) && $_SESSION['user']->role==='admin'):
        try{
            $data=getAllCustomers();
            $code=200;
        }catch(PDOException $e){
            $code=500;
            $data=["greska"=>$e->getMessage()];
            enrollErrors($e->getMessage());
            echo $e->getMessage();
        }
    echo json_encode($data);
    http_response_code($code);
endif;