<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once "./includes/database.php";
if (isset($_SESSION['email'])) {
    $customer = getCustomerIdbyEmail($_SESSION['email']);
    $name = $customer['username'];
}
$conn = db_connect();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>J's Book</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Hind:400,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="css/slick.css" />
    <link type="text/css" rel="stylesheet" href="css/slick-theme.css" />

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="css/nouislider.min.css" />

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="css/style.css" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>

<body>
    <!-- HEADER -->
    <header>

        <!-- header -->
        <div id="header">
            <div class="container">
                <div class="pull-left">
                    <!-- Logo -->
                    <div class="header-logo">
                        <a class="logo" href="index.php">
                            <img src="./img/logo.png" alt="Logo">
                        </a>
                    </div>
                    <!-- /Logo -->

                </div>
                <div class="pull-right">
                    <ul class="header-btns">
                        <!-- Account -->
                        <li class="header-account dropdown default-dropdown">
                            <div class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="true">
                                <div class="header-btns-icon">
                                    <i class="fa fa-user-o"></i>
                                </div>

                                <?php
                                if (isset($_SESSION['user'])) {
                                    echo '<strong class="text-uppercase">' . $name . ' <i class="fa fa-caret-down"></i></strong>';
                                    echo '<h5>Nice To See You</h5>';
                                } else {
                                    echo '<strong class="text-uppercase">Login</strong>';
                                }
                                ?>
                            </div>

                            <ul class="custom-menu">
                                <?php
                                if (isset($_SESSION['user'])) {
                                    echo '<li><a href="#"><i class="fa fa-user-o"></i> My Account</a></li>';
                                    echo '<li><a href="orderhistory.php"><i class="fa fa-user-o"></i> Order History</a></li>';
                                    echo '<li><a href="logout.php"><i class="fa fa-user-o"></i> Logout</a></li>';
                                } else {
                                    echo '<li><a href="./login.php" data-toggle="modal"><i class="fa fa-unlock-alt"></i> Login</a></li>';
                                    echo '<li><a href="signup.php"><i class="fa fa-user-plus"></i> Create An Account</a></li>';
                                }
                                ?>
                            </ul>

                        </li>
                        <!-- /Account -->

                        <!-- Cart -->
                        <li class="header-cart dropdown default-dropdown">
                            <a href="cart.php" aria-expanded="true">
                                <div class="header-btns-icon">
                                    <i class="fa fa-shopping-cart"></i>

                                </div>
                                <strong class="text-uppercase">My Cart:</strong>
                            </a>

                        </li>
                        <!-- /Cart -->

                        <!-- Mobile nav toggle-->
                        <li class="nav-toggle">
                            <button class="nav-toggle-btn main-btn icon-btn"><i class="fa fa-bars"></i></button>
                        </li>
                        <!-- / Mobile nav toggle -->
                    </ul>
                </div>
            </div>
            <!-- header -->
        </div>
        <!-- container -->
    </header>
    <!-- /HEADER -->

    <!-- NAVIGATION -->
    <div id="navigation">
        <!-- container -->
        <div class="container">
            <div id="responsive-nav">
                <!-- category nav -->
                <div class="category-nav">
                    <span class="category-header">Categories <i class="fa fa-list"></i></span>
                    <ul class="category-list">
                        <?php
                        $query = mysqli_query($conn, "Select * from  category where Is_Active=1 LIMIT 9");
                        while ($row = mysqli_fetch_array($query)) {
                        ?>
                            <li class="dropdown side-dropdown">
                                <a href="./category.php" class="dropdown-toggle" aria-expanded="true"><?php echo htmlentities($row['category_name']); ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <!-- /category nav -->

                <!-- menu nav -->
                <div class="menu-nav">
                    <span class="menu-header">Menu <i class="fa fa-bars"></i></span>
                    <ul class="menu-list">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="book.php">Books</a></li>
                    </ul>
                </div>
                <!-- menu nav -->
            </div>
        </div>
        <!-- /container -->
    </div>
    <!-- /NAVIGATION -->