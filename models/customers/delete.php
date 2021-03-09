<?php
    session_start();
    $code=404;

    if(isset($_SESSION['user']) && $_SESSION['user']->role==='admin'):
        if(isset($_POST['id'])){
        $id=$_POST['id'];
        
        require_once("../../config/connection.php");
        require_once("functions.php");
            try{
                if(deleteUser($id)){
                    $code=204;
                    header("Refresh:0; url=../../views/pages/admin.php?page=customers");
                }
                else{
                    $code=500;
                }
            }
            catch(PDOException $e){
                $code=409;
                echo $e->getMessage();
                enrollErrors($e->getMessage()); 
            }
        http_response_code($code);
        
        }
 
endif;
