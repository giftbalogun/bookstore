<?php
require_once "./includes/head.php";
require_once "./includes/database.php";
require_once "./includes/cart.php";
$conn = db_connect();
// book_isbn got from form post method, change this place later.
if (isset($_POST['bookisbn'])) {
    $book_isbn = $_POST['bookisbn'];
}

if (isset($book_isbn)) {
    // new iem selected
    if (!isset($_SESSION['cart'])) {
        //$_SESSION['cart'] is associative array that bookisbn => qty
        $_SESSION['cart'] = array();

        $_SESSION['total_items'] = 0;
        $_SESSION['total_price'] = '0.00';
    }

    if (!isset($_SESSION['cart'][$book_isbn])) {
        $_SESSION['cart'][$book_isbn] = 1;
    } elseif (isset($_POST['cart'])) {
        $_SESSION['cart'][$book_isbn]++;
        unset($_POST);
    }
}

// if save change button is clicked , change the qty of each bookisbn
if (isset($_POST['save_change'])) {
    foreach ($_SESSION['cart'] as $isbn => $qty) {
        if ($_POST[$isbn] == '0') {
            unset($_SESSION['cart']["$isbn"]);
        } else {
            $_SESSION['cart']["$isbn"] = $_POST["$isbn"];
        }
    }
}

if (isset($_SESSION['cart']) && (array_count_values($_SESSION['cart']))) {
    $_SESSION['total_price'] = total_price($_SESSION['cart']);
    $_SESSION['total_items'] = total_items($_SESSION['cart']);
?>
    <!-- BREADCRUMB -->
    <div id="breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Checkout</li>
            </ul>
        </div>
    </div>
    <!-- /BREADCRUMB -->

    <!-- section -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <form id="checkout-form" class="clearfix" action="cart.php" method="POST">

                    <div class="col-md-12">
                        <div class="order-summary clearfix">
                            <div class="section-title">
                                <h3 class="title">Order Review</h3>
                            </div>

                            <table class="shopping-cart-table table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th></th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-center">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($_SESSION['cart'] as $isbn => $qty) {
                                        $conn = db_connect();
                                        $book = mysqli_fetch_assoc(getBookByIsbn($conn, $isbn));
                                    ?>
                                        <tr>
                                            <td class="thumb"><img src="admin/uploads/<?php echo $book['book_image']; ?>" alt=""></td>
                                            <td class="details">
                                                <a href="detail.php?nid=<?php echo $book['id'] ?>"><?php echo $book['book_title']; ?></a>
                                                <ul>
                                                    <li><span>Quantity: <?php echo $_SESSION['total_items']; ?></span></li>
                                                    <li><span>Author: <?php echo $book['book_author']; ?></span></li>
                                                </ul>
                                            </td>
                                            <td class="price text-center">
                                                <strong>$<?php echo $book['book_price']; ?></small></del></td>
                                            <td class="qty text-center"><input class="input" type="number" value="<?php echo $qty; ?>" size="2" name="<?php echo $isbn; ?>"></td>
                                            <td class="total text-center"><strong class="primary-color">$<?php echo $qty * $book['book_price']; ?></strong>
                                            </td>

                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="empty" colspan="3"></th>
                                        <th>Total Quantity</th>
                                        <th colspan="2" class="sub-total"><?php echo $_SESSION['total_items']; ?></th>
                                    </tr>
                                    <tr>
                                        <th class="empty" colspan="3"></th>
                                        <th>SHIPING</th>
                                        <td colspan="2">Standard Shipping</td>
                                    </tr>
                                    <tr>
                                        <th class="empty" colspan="3"></th>
                                        <th>TOTAL</th>
                                        <th colspan="2" class="total">$<?php echo $_SESSION['total_price']; ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="pull-right">
                                <button class="primary-btn" name="save_change" type="submit">Save Order</button>
                                <a href="checkout.php" class="primary-btn">Place Order</a>
                            </div>
                        </div>

                    </div>
                </form>

            <?php } else {
            echo '
            <div class="section">
		        <!-- container -->
		        <div class="container">
			        <!-- row -->
			        <div class="row">
				        <div class="alert alert-info" role="alert">
					       <p class="text-center" >Your Basket is Empty! Add Items</p>
	  			        </div>
			        </div>
			        <!-- /row -->
		        </div>
		        <!-- /container -->
            </div>
    ';
        } ?>

            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /section -->


    <?php
    require_once "./includes/footer.php";
    ?>