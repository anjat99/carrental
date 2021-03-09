<?php
    session_start();
    $code=404;

    if(isset($_SESSION['user']) && $_SESSION['user']->role==='admin'):
        if(isset($_POST['id'])){ 
            $vehicle=$_POST['id']; 

            require_once("../../config/connection.php");
            require_once("functions.php");
            $query = "DELETE FROM vehicle WHERE id_vehicle=:idV";

            $priprema = $connection->prepare($query);
            $priprema->bindParam(":idV",$vehicle);
         
                try{ 
                    $priprema->execute();
                    $code=204; 
                    header("Refresh:0; url=../../views/pages/admin.php?page=vehicles");
                } catch(PDOException $e){ 
                    $code=409; 
                    enrollErrors($e->getMessage()); 
                    echo $e->getMessage();
                } 
            http_response_code($code); 
        } 
    endif;