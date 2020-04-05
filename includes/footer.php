<!-- FOOTER -->
<footer id="footer" class="section section-grey">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row justify-content-start">

            <!-- footer widget -->
            <div class="col-sm-6 col-md-5 col-lg-6">
                <div class="footer">
                    <!-- footer logo -->
                    <div class="footer-logo">
                        <a class="logo" href="#">
                            <img src="./img/logo.png" alt="">
                        </a>
                    </div>
                    <!-- /footer logo -->
                    <p>J's Store - Where Knowledge is Power</p>
                </div>
            </div>
            <!-- /footer widget -->

            <!-- footer widget -->
            <div class="col-sm-6 col-md-5 offset-md-2 col-lg-6 offset-lg-0">
                <div class="footer">
                    <h3 class="footer-header">My Account</h3>
                    <ul class="list-links">
                        <?php
                        if (isset($_SESSION['user'])) {
                            echo '<li><a href="#">My Account</a></li>';
                            echo '<li><a href="orderhistory.php"> Order History</a></li>';
                            echo '<li><a href="logout.php">Logout</a></li>';
                        } else {
                            echo '<li><a href="login.php"> Login</a></li>';
                            echo '<li><a href="signup.php"> Create An Account</a></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <!-- /footer widget -->
        </div>
        <!-- /row -->

    </div>
    <!-- /container -->
</footer>
<!-- /FOOTER -->

<!-- jQuery Plugins -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/nouislider.min.js"></script>
<script src="js/jquery.zoom.min.js"></script>
<script src="js/main.js"></script>

</body>

</html>