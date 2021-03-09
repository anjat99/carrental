<div class="row col-lg-12 pl-0" id="sredinaAdmin">
    <?php
        include_once "nav.php";
    ?>
    <div class="row col-lg-9 bg-light ml-2" id="sadrzajAdmin">
        <div class="row">
                <div class="d-flex justify-content-between flex-wrap">
                    <div class="d-flex  flex-wrap">
                    <div class="ml-auto">
                        <h2 class="ml-auto">Welcome back, 
                        <?php
                            if(isset($_SESSION['user'])) {
                                $admin = $_SESSION['user'];
                                if($_SESSION['user']->id_role==1)
                                echo $admin->name." ".$admin->surname;
                            }
                        ?>
                        </h2>
                    </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 text-center text-bela">
                            Number Of LoggedIn Users: <?= countLogged(); ?>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>