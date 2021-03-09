<?php
 session_start();

    if(isset($_SESSION['user']) && $_SESSION['user']->role==='admin'):
        if(isset($_POST['btnIzmena'])){
        require_once("../../config/connection.php");
    
        $id = $_POST['skrivenoPolje'];
        $name=$_POST['tbIme'];
        $surname=$_POST['tbPrezime'];
        $username=$_POST['tbUsername'];
        $email=$_POST['tbEmail'];
        $role=$_POST['ddlUloga'];
        $phone=$_POST['tbPhone'];
     
        $greske=[];
        $reimeprez="/^[A-Z][a-z]{2,14}(\s[A-Z][a-z]{2,20})*$/";
        $reuser="/^[\d\w\_\-\.]{4,30}$/";

        if($role==0){
            array_push($greske, "Role of user is required");
        }
        if(!preg_match($reimeprez, $name)){
            array_push($greske, "Surname is not in good format");
        }else if($name==""){
            array_push($greske, "The field of  name can't be empty!");
        }

        if(!preg_match($reimeprez, $surname)){
            array_push($greske, "Surname is not in good format");
        }else if($surname==""){
            array_push($greske, "The field of  surname can't be empty!");
        }

        if(!preg_match($reuser, $username)){
            array_push($greske, "USername is not in good format");
        }else if($username==""){
            array_push($greske, "The field of  username can't be empty!");
        }

        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
             array_push($greske, "Email is not in good format");
        }else if($email==""){
            array_push($greske, "The field of  email can't be empty!");
        }

        if(count($greske)){
            $_SESSION['poruka']="Not valid data";
            enrollErrors("Not valid data");
        }else{
             global $connection;
                $upit="UPDATE user u INNER JOIN role r ON r.id_role=u.id_role SET u.name=:name, u.surname=:surname, u.email=:email, r.id_role=:id_role, u.username=:username, u.phone_number=:phone WHERE u.id_user=$id";
                $send=$connection->prepare($upit);
                $send->bindParam(":name",$name);
                $send->bindParam(":surname",$surname);
                $send->bindParam(":username",$username);
                $send->bindParam(":email",$email);
                $send->bindParam(":id_role",$role);
                $send->bindParam(":phone",$phone);

                try{
                    $uspelo = $send->execute();
                    if($uspelo){
                       $_SESSION['poruka']="User is successfully updated!";
                       header("Refresh:0;");
                    }else{
                        $_SESSION['poruka']="Something went wrong, user is not updated!";
                        enrollErrors("Something went wrong, user is not updated!");
                    }
                    
                }catch(PDOException $e){
                    echo $e->getMessage();
                    enrollErrors( $e->getMessage());
                    $_SESSION['poruka']="Error, user is not updated";
                  }
           
        }
        // echo "Nije uspoelo";
        header("Location:../../views/pages/admin.php?page=customers");
    }
    endif;