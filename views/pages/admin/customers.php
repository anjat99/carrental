<?php
    // session_start();
    if(isset($_SESSION['user']) && $_SESSION['user']->role==='admin'):
        require_once("../../config/connection.php"); 
        require_once("../../models/customers/functions.php");
        $query = "SELECT COUNT(*) as numberUsers from user";
        $obj = $connection->query($query)->fetch();
        $per_page = 5;
        $countLink = ceil($obj->numberUsers/$per_page);
        $paging = isset($_GET['page']) ? $_GET['page'] : 1;
        // $from_number = $per_page*($paging-1);
        $query = "SELECT u.*,r.name as role, COUNT(rc.id_rent)as `countRented` FROM user u INNER JOIN role r on u.id_role=r.id_role LEFT OUTER JOIN rental_car rc ON rc.id_user=u.id_user LEFT OUTER JOIN vehicle v ON v.id_vehicle=rc.id_vehicle GROUP BY u.id_user ORDER BY u.register_date DESC";
        $customers= $connection->query($query)->fetchAll(); 
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
                                    <h4 class="card-title">Managing Customers</h4>
                                        <div class="table-responsive" id="tabelaKorisnici">
                                        <table class="centar table table-striped" border="1">
                                            <thead class="thead-dark">
                                                <tr>
                                                <th>RB</th>
                                                <th>Full Name</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Register date</th>
                                                <th>Role</th>
                                                <th>No.rented cars</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                $rb=1;
                                                foreach($customers as $k) :?>
                                                <tr class="rem1 py-1">
                                                    <td><?=$rb++?></td>
                                                    <td><?=$k->name?> <?=$k->surname?></td>
                                                    <td><?=$k->username?></td>
                                                    <td><?=$k->email?></td>
                                                    <td><?=$k->register_date?></td>
                                                    <td><?=$k->role?></td>
                                                    <td><?=$k->countRented?></td>
                                                    <td>
                                                        <a href='#' data-id="<?=$k->id_user?>"class='btnAdmin btn-primary podaciJedanKorisnik'><i class="far fa-edit"></i></a>
                                                    </td>
                                                    <td>
                                                        <a href='#' data-id="<?=$k->id_user?>" class='btnAdmin btn-primary obrisi'><i class="fas fa-trash-alt"></i></a>
                                                    </td>
                                                </tr>

                                                <?php endforeach; ?>   
                                                    </tbody>
                                            </table>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 mx-auto" id="podaci">
                                                <form method="POST" action="../../models/customers/update.php">
                                                    <div class="form-group">
                                                        <input type="hidden" name="skrivenoPolje" id="skrivenoPolje" class=form-control>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" name="tbIme" id="tbIme" placeholder='John' class='form-control'>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" name="tbPrezime" id="tbPrezime" placeholder='Doe' class='form-control'>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" name="tbUsername" id="tbUsername" placeholder='user5715' class='form-control'>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" name="tbEmail" id="tbEmail" placeholder='example@gmail.com' class='form-control'>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" name="tbPhone" id="tbPhone" placeholder='+381641234567' class='form-control'>
                                                    </div>
                                                    <div class="form-group">
                                                        <select name='ddlUloga' id='ddlUloga' class="form-control">
                                                            <option value='0'>Change role:</option>

                                                            <?php
                                                                $queryZaUloge=getRoles();

                                                                foreach ($queryZaUloge as $u):?>
                                                                    <option value="<?=$u->id_role?>"><?=$u->name?></option>
                                                                <?php endforeach;
                                                            ?>

                                                        </select>
                                                    </div>
                                                  
                                                                
                                    <div class=" d-flex justify-content-center">    
                                            <input type="submit" value="Update" name='btnIzmena' id='btnIzmena' class='btnAdmin btnIzmenaStyle form__btn'>
                                            <input type="button" value="Cancel" id='hideForm' class='btnAdmin btnIzmenaStyle form__btn'>
                                    </div>
                                                </form>
                                            </div>

                                            <div class="odgovorUpdate">
                                                <?php if(isset($_SESSION['poruka'])):
                                                    echo $_SESSION['poruka'];
                                                    unset($_SESSION['poruka']);

                                                     endif; ?>
                                            </div>
                                        <?php endif;?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
       