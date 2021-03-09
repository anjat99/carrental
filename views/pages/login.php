</header>

<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6 mx-auto mb-4" id="login">
                <h2>LOGIN form</h2>
                <form action="models/login.php" method="POST">
                    <div class="form-group">
                        <input type="text" name="tbEmail" id="tbEmail" class="form-control" placeholder="Email">
                        <p class="text-danger" id="emailGreskaLogin"></p>
                    </div>

                    <div class="form-group">
                        <input type="password" name="tbLozinka" id="tbLozinka" class="form-control" placeholder="Password">
                        <p class="text-danger" id="lozinkaGreskaLogin"></p>
                    </div>

                    <div class="control-group">
                        <div class="controls">
                            <button class='btn btn-info register btnUpdate register' type='button' id="btnLogin" name="btnLogin">Login</button>
                        </div>
                        <div id="poruka"></div>
                    </div>


                    <strong>Don't have an account? <a href="index.php?page=register">Register!</a></strong>

                    <div id="porukaerrorsLogin"></div>
                </form>
        </div>
    </div>
</div>