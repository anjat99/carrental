<?php
    ob_start();
    session_start();
    require_once("functions.php");
    header("Content-type:application/json");
    $code=404;
    $data=null;

       if(isset($_POST['send'])){
            $email=$_POST['email'];
            $lozinka=$_POST['lozinka'];
            $reEmail = "/^[a-z]{3,}(\.)?[a-z\d]{1,}(\.[a-z0-9]{1,})*\@[a-z]{2,7}\.[a-z]{2,3}(\.[a-z]{2,3})?$/";
            $reLozinka = "/^\S{5,50}$/";

            $errors=[];

            if(!preg_match($reLozinka,$lozinka)){
                $errors[]="Password is not in good format";
            }
            if(!preg_match($reEmail, $email)){
                $errors[] =  "Email is not in good format";
            }

            if(count($errors)>0){
                $_SESSION['errors']="Invalid email or password";
                header("Location:../index.php?page=login");
                $code=422;
            }else{
                require_once("../config/connection.php");
                $lozinka=md5($lozinka);

                $query="SELECT u.*, r.name as role FROM user u INNER JOIN role r ON r.id_role=u.id_role  WHERE u.email=:email AND u.password=:lozinka";
                $send=$connection->prepare($query);
                $send->bindParam(":email",$email);
                $send->bindParam(":lozinka",$lozinka);
                $send->execute();

                    try{
                        if($send->rowCount()==1){
                            $rezultat=$send->fetch();
                            $_SESSION['user']=$rezultat;
                                $code=202;
                                if($rezultat->role=="customer" || $rezultat->role=="VIP customer" ){
                                        markLogged($rezultat->id_user, $rezultat->email);
                                    header("Location:../index.php?page=home");
                                    $data="customer";
                                }else if($rezultat->role=="admin"){
                                        header("Location: ../../../views/pages/admin.php");
                                    $data="admin";
                                }
                        }
                        else {
                                $code=422;
                                $_SESSION['errors']="Wrong password/email";
                                enrollErrors("Wrong password/email");
                        }
                    
                    }catch(Exception $e){
                        echo $e->getMessage();
                        enrollErrors($e->getMessage());
                            $code=500;
                    }
                        http_response_code($code);
                        echo json_encode($data);
                
                
            }
            
        }else{
            header("Location:../index.php?page=home");
        }