<?php
require_once "./includes/head.php";
require_once "./includes/database.php";
$conn = db_connect();
if (!isset($_SESSION['user'])) {
	echo '
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<div class="alert alert-danger" role="alert">
					You Need to <a href="login.php">Signin</a> First! 
	  			</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	';
}
if (isset($_SESSION['cart']) && (array_count_values($_SESSION['cart']))) {
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
				<form id="checkout-form" class="clearfix" action="validate.php" method="POST">

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
												<a href="#"><?php echo $book['book_title']; ?></a>
												<ul>
													<li><span>Quantity: <?php echo $_SESSION['total_items']; ?></span></li>
													<li><span>Author: <?php echo $book['book_author']; ?></span></li>
												</ul>
											</td>
											<td class="price text-center">
												<strong>$<?php echo $book['book_price']; ?></small></del></td>
											<td class="qty text-center"><?php echo $qty; ?></td>
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
								<a href="cart.php" class="primary-btn">Edit Cart</button></a>
								<a href="validate.php" class="primary-btn">Validate Order Order</a>
							</div>
						</div>

					</div>
				</form>

			<?php } else {
			echo '<p class="text-warning text-center">Your cart is empty! Please make sure you add some books in it!</p>';
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