</header>

<main>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6 mx-auto mb-4">
                <form class='form-horizontal' action="/models/register.php" method="POST" novalid >
                    <div class="control-group">
                        <h2>Registration form</h2>
                    </div>
                    <div class="form-group">
                        <input type="text" id="ime" name="ime" class="form-control" placeholder="Name">
                        <p class='text-danger' id="imeGreskaRegister"> </p>
                        
                    </div>
                    <div class="form-group">
                        <input type="text" id="prezime" name="prezime" class="form-control" placeholder="Surname">
                            <p class='text-danger' id="prezimeGreskaRegister"> </p>
                    </div>

                    <div class="form-group">
                        <input type="text"  id="username" name="username" class="form-control" placeholder="Username">
                        <p class='text-danger' id="usernameGreskaRegister"> </p>
                    </div>

                    <div class="form-group">
                        <input type="email"  id="email" name="email" class="form-control" placeholder="Email">
                        <p class='text-danger' id="emailGreskaRegister"></p>
                    </div>

                    <div class="form-group">
                        <input type="password" id="lozinka" name="lozinka" class="form-control" placeholder="Password">
                        <p class='text-danger' id="lozinkaGreskaRegister"></p>
                    </div>

                    <div class="form-group">
                            <input type="text" id="telefon" name="telefon" class="form-control" placeholder="Phone No">
                            <p class='text-danger' id="telefonGreskaRegister"> </p>
                    </div> 

                    <div class="control-group">
                            <div class="controls">
                                <button class='btn btn-success register' type='button' id="btnRegistracija" name="btnRegistracija">Register</button>
                            </div>
                            <div id="poruka"></div>
                    </div>

                    <strong>Already have an account? <a href="index.php?page=login">Login!</a></strong>

                    <div id="poruka"></div>
                </form>
            </div>
        </div>
    </div>
</main>