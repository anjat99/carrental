<?php
    session_start();
    ob_start();
    require_once "../../config/connection.php";
    header("Content-Type: application/json");
    $data = null;
    $code = 404;
    if(isset($_POST['send'])){
        if(isset($_SESSION['user'])){
            $start_date=$_POST['start'];
            $end_date=$_POST['end'];
            $customer=$_SESSION['user']->id_user;
            $vehicle=$_POST['vehicle'];
            $daily_price=$_POST['dailyprice'];
            $rent_price=$_POST['price'];

            $errors=[];
            $ispis="";

            if(empty($start_date) || !isset($start_date)){
                $errors[]= "The field for the start date of rent is required!";
            }
            if(empty($end_date) || !isset($end_date)){
                $errors[]= "The field for the  end date of rent is required!";
            }

            if(count($errors)){
                foreach($errors as $g){
                    enrollErrors($g);
                    echo json_encode(["message"=>$g]); 
                }
                $code=422;      
            }else{

                $seconds_start_date = strtotime($start_date);
                $seconds_end_date = strtotime($end_date);
                $datediff = $seconds_end_date - $seconds_start_date;
                $days = floor($datediff / (60 * 60 * 24)); //6 days
                $query = "SELECT rc.start_date from rental_car rc INNER JOIN user u ON u.id_user=rc.id_user where u.id_user = $customer order by rc.start_date LIMIT 1";
                
                
                if($connection->query($query)->rowCount() != 0){
                    $start_renting = $connection->query($query)->fetch()->start_date;
                    $seconds_start_renting = strtotime($start_renting);
                    $sixty_days_seconds = 60*24*60*60;

                    $query2 = "SELECT COUNT(*) as broj from rental_car rc INNER JOIN user u ON u.id_user=rc.id_user INNER JOIN vehicle v ON v.id_vehicle=rc.id_vehicle where u.id_user = $customer and v.id_vehicle=$vehicle ";
                    $number_rented = $connection->query($query2)->fetch()->broj;

                    if($number_rented >= 3 && $seconds_start_date < $seconds_start_renting + $sixty_days_seconds){
                        $sumPrice = $daily_price * $days;
                        $price = $sumPrice - 15/100 * $sumPrice;

                        $query_role_change = "UPDATE user u INNER JOIN role r ON r.id_role=u.id_role SET u.id_role=3 WHERE u.id_user=$customer";
                        $rez0=$connection->prepare($query_role_change);
                        try{
                            $success = $rez0->execute();
                            if($success){
                                // $data = ['message'=> 'successfully change role to VIP'];
                                $data = "success vip";
                                // echo json_encode(['message'=> 'successfully change role to VIP']);
                            }
                        }catch(PDOException $e){
                            echo json_encode(['message'=> $e->getMessage()]);
                            $code=500;
                            enrollErrors($e->getMessage());
                        }
                    }
                }
                
                $upit="INSERT INTO rental_car VALUES(NULL,:vehicle, :customer, :startdate, :enddate, :price)";
                    $rez=$connection->prepare($upit);
                    $rez->bindParam(":vehicle",$vehicle);
                    $rez->bindParam(":customer",$customer);
                    $rez->bindParam(":startdate",$start_date);
                    $rez->bindParam(":enddate",$end_date);
                    $rez->bindParam(":price",$rent_price);
                
                    try{
                        $success = $rez->execute();
                             $data= "success sent request";
                            //echo json_encode(['message'=> 'Rent successfully sent', 'kod'=>201]);
                            $code=201;

                            if($success){
                                $query_available_change = "UPDATE vehicle SET available=available - 1 WHERE id_vehicle = $vehicle";
                                $rez0=$connection->prepare($query_available_change);
                                try{
                                    $success = $rez0->execute();
                                    if($success){
                                        // $data = ['message'=> 'successfully change availabilty'];
                                        $data = "success change availability";
                                        // echo json_encode(['message'=> 'successfully change availabilty']);
                                        header("Refresh:0;");
                                    }
                                }catch(PDOException $e){
                                    echo json_encode(['message'=> $e->getMessage()]);
                                    $code=500;
                                    enrollErrors($e->getMessage());
                                }
                            }
                            
                        header("Refresh:0;");
                    }
                    catch(PDOException $e){
                        echo json_encode(['message'=> $e->getMessage()]);
                        $code=500;
                        enrollErrors($e->getMessage());
                    }
            }
        }else{
            $poruka="You have to login/register in order to request for rent";
            $code=404;
        }
    echo json_encode($data);
http_response_code($code);
 }
?>