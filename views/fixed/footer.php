<!-- Footer -->
<footer class="footer container-fluid">
        <div class="row rowFooter">
            <div class="col-xl-4 col-md-5 col-sm-6"id="aboutUs">
                <h3><strong>About Us</strong></h3>
                <p>We offer a varied fleet of cars, ranging from the compact. All our vehicles are bought and maintained at official dealerships only. As we are not affiliated with any specific automaker, we are able to provide a variety of vehicle makes and models for customers to rent. Ur main mission is to be recognised as the global leader in Car Rental for companies.<br>If you have any questions about our vehicles or about our work feel free to contact us any time. We are looking forward to answer on your questions.</p>
                <ul id="mreze" class="d-flex">
         <!-- DINAMIČKI ISPIS DRUŠTVENIH MREŽA -->
                    <?php
                        $socials = getSocialMedia();
                        foreach($socials as $s):
                    ?>
                        <li>
                          <a href="<?= $s->path ?>" target="_blank">
                            <?= $s->icon?>
                          </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <p>Copyright &copy;<span class="yearCopyright">
                     <!-- DINAMIČKI ISPIS TEKUĆE GODINE -->
                </span> <em>All rights reserved.</em> | <br/>by RentalCars </p>
            </div>
            <div class="col-xl-2 col-md-3 col-sm-3 odvoji" >
                <h3><em>Navigation:</em></h3>
                <div class="nav link"> 
                     <!-- DINAMIČKI ISPIS NAVIGACIONIH LINKOVA -->
                     <?php
                                echo showMainNavMenu();
                            ?>
                </div>
            </div>
            <div class="col-xl-2 col-md-4 col-sm-3 odvoji">
                <h3><em>Useful links:</em></h3>
                <div>
                    <div class="link">
                        <ul>
                            <li>
                                <a href="sitemap.xml">Sitemap</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-5 col-sm-6 odvoji">
                <h3 ><em>Working hours:</em></h3>
                <div class="text-white">
                    <p>Monday-Friday: 7:00am to 9:00pm</p>
                    <p>Weekend: 10:00am to 10:00pm</p>
                </div>
            </div>
        </div>
    </footer>
    <div id="copyright"></div>
    <div id="scrollTop">
        <a href="#">
            <i class="fas fa-angle-double-up goToTop"></i>
        </a>
    </div>

    <!-- JS files -->
    <!-- JQuery & Bootstrap -->
    <script src="assets/js/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <!-- My js -->
    <script src="assets/js/main.js" type="text/javascript" ></script>

</body>
</html>