<?php
    ob_start();
    session_start();
    require_once "../config/connection.php";
    header("Content-type:application/json");
    $code=404;
    $data=null;

    if(isset($_POST['send'])){
        $ime=$_POST['ime'];
        $prezime=$_POST['prezime'];
        $email=$_POST['email'];
        $lozinka=$_POST['lozinka'];
        $username=$_POST['username'];
        $telefon = $_POST['telefon'];

        $errors=[];

        $reIme = "/^[A-ZŠĐŽČĆ][a-zšđžčć]{2,29}(\s[A-Z][a-z]{2,29})*$/";
        $rePrezime = "/^[A-ZŠĐŽČĆ][a-zšđžčć]{2,49}(\s[A-Z][a-z]{2,49})*$/";
        $reEmail = "/^[a-z]{3,}(\.)?[a-z\d]{1,}(\.[a-z0-9]{1,})*\@[a-z]{2,7}\.[a-z]{2,3}(\.[a-z]{2,3})?$/";
        $reLozinka = "/^\S{5,50}$/";
        $reUsername = "/^[\d\w\_\-\.]{4,30}$/";
        $reTelefon = "/^[+]?[\d]{10,13}$/";

        if(!preg_match($reIme, $ime)){
            $errors[] =  "bad format for name";
        }

        if(!preg_match($rePrezime, $prezime)){
            $errors[] =  "bad format for surname";
        }
            
        if(!preg_match($reEmail, $email)){
            $errors[] =  "bad format for email";
        }

        if(!preg_match($reLozinka, $lozinka)){
            $errors[] =  "bad format for password";
        }
        if(!preg_match($reUsername, $username)){
            $errors[] =  "bad format for username";
        }
        if(!preg_match($reTelefon, $telefon)){
            $errors[] =  "bad format for name";
        }

        if(count($errors)){
            $data=$errors;
            $code=422;
        }
        else{
            $queryReg = "INSERT INTO user (id_user, name, surname, email, username, password, phone_number, id_role) VALUES(NULL, :ime, :prezime, :email, :username, :lozinka, :telefon,  2)";

            $rez=$connection->prepare($queryReg);
            $rez->bindParam(":ime", $ime);
            $rez->bindParam(":prezime", $prezime);
            $rez->bindParam(":username",$username);
            $rez->bindParam(":email",$email);
            $lozinka = md5($lozinka);
            $rez->bindParam(":lozinka",$lozinka);
            $rez->bindParam(":telefon",$telefon);

            try{
                $uneto = $rez->execute();
                if($uneto){
                    $code = 202;
                    $data = "uspesno";
                    header("Refresh:0; url=https://anjatomic.000webhostapp.com/index.php?page=login");
                    echo json_encode(['message'=> 'User successfully registred']);
                    $_SESSION['uspelo'] = "Successfully registred!";

                }
            }catch(PDOException $e){
                echo json_encode(['message'=> $e->getMessage()]);
                $code=409;
                enrollErrors($e->getMessage());
            }
        }
    http_response_code($code);
    }
?>