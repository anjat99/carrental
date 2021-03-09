<?php
 if(isset($_SESSION['user']) && $_SESSION['user']->role==='admin'):
        require_once("../../config/connection.php"); 
    // require_once("../../models/renting/functions.php");
    $query = "SELECT COUNT(*) as numberRent from rental_car";
    $obj = $connection->query($query)->fetch();
    $per_page = 3;
    $countLink = ceil($obj->numberRent/$per_page);
    $paging = isset($_GET['page']) ? $_GET['page'] : 1;
    $query = "SELECT rc.*, u.username as customer, v.id_vehicle as id, v.model as vehicle FROM vehicle v INNER JOIN rental_car rc ON v.id_vehicle=rc.id_vehicle INNER JOIN user u ON u.id_user=rc.id_user";
    $rents= $connection->query($query)->fetchAll(); 

?>
    <div class="row col-lg-12 pl-0" id="sredinaAdmin">
           <?php
                include_once "nav.php";
           ?>
            <div class="row col-lg-9 bg-light ml-2" id="sadrzajAdmin">
                    <div class="row col-lg-12">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Rented cars</h4>
                                        <div class="table-responsive" id="tabelaZaPorudzbine">
                                            <!--TABELA PORUDZBINA -->
                                            <table class="centar table table-striped" border="1">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th>VEHICLE</th>
                                                        <th>CUSTOMER</th>
                                                        <th>START DATE</th>
                                                        <th>END DATE</th>
                                                        <th>RENT PRICE</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach($rents as $r) :?>
                                                       
                                                            <td><?=$r->vehicle?></td>
                                                            <td><?=$r->customer?></td>
                                                            <td>
                                                               <?php
                                                                    $startdate= $r->start_date;
                                                                    echo date('Y-m-d', strtotime(str_replace('-','/', $startdate)));
                                                               ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $date = $r->end_date;
                                                                    if( strtotime($date) < time()){
                                                                        echo "Expired";
                                                                    }else{
                                                                        echo date('Y-m-d', strtotime(str_replace('-','/', $date)));
                                                                    }
                                                                ?>
                                                            </td>
                                                            <td><?=$r->rent_price?>&euro;</td>
                                                        </tr>
                                                    <?php endforeach; ?>   
                                                    </tbody>
                                            </table>
                                        </div>
                                        <?php endif;?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>