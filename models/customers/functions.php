<?php
    function getAllCustomers(){
        return executeQuery("SELECT u.*,r.name as role, COUNT(rc.id_rent)as `countRented` FROM user u INNER JOIN role r on u.id_role=r.id_role LEFT OUTER JOIN rental_car rc ON rc.id_user=u.id_user LEFT OUTER JOIN vehicle v ON v.id_vehicle=rc.id_vehicle GROUP BY u.id_user");
    }


    function getOneCustomer($id){
        global $connection;
        $customer=$connection->prepare("SELECT u.*,r.name as role, COUNT(rc.id_rent)as `countRented` FROM user u INNER JOIN role r on u.id_role=r.id_role LEFT OUTER JOIN rental_car rc ON rc.id_user=u.id_user LEFT OUTER JOIN vehicle v ON v.id_vehicle=rc.id_vehicle WHERE u.id_user=? GROUP BY u.id_user ");
        $customer->execute([$id]);
        return $customer->fetch();
    }

    function getRoles(){
        return executeQuery("SELECT * FROM role");
    }


    function deleteUser($id){
        global $connection;
        $deleting=$connection->prepare("DELETE FROM user WHERE id_user=$id");
        return $deleting->execute();
    }



    function output_json_message($message, $code){
        http_response_code($code);
        echo json_encode(["message" => $message]);
    }
       