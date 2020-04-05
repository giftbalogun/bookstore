<?php
require_once "./includes/head.php";
require_once "./includes/database.php";
// connect database
if (isset($_SESSION['cart']) && (array_count_values($_SESSION['cart']))) {
	$customer = getCustomerIdbyEmail($_SESSION['email']);
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
				<form id="checkout-form" class="clearfix" method="post" action="process.php">
					<div class="col-md-6">
						<div class="billing-details">

							<div class="section-title">
								<h3 class="title">Billing Details</h3>
							</div>
							<div class="form-group">
								<input class="input" type="text" value="<?php echo $customer['firstname'] ?>" name="firstname">
							</div>
							<div class="form-group">
								<input class="input" type="text" value="<?php echo $customer['lastname'] ?>" name="lastname">
							</div>
							<div class="form-group">
								<input class="input" type="email" value="<?php echo $customer['email'] ?>" name="email">
							</div>
							<div class="form-group">
								<input class="input" type="text" value="<?php echo $customer['address'] ?>" name="address">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="city" value="<?php echo $customer['city'] ?>">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="country" placeholder="Country">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="zipcode" value="<?php echo $customer['zipcode'] ?>">
							</div>
							<div class="form-group">
								<input class="input" type="tel" name="phone" value="<?php echo $customer['phone'] ?>">
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="shiping-methods">
							<div class="section-title">
								<h4 class="title">Shiping Methods</h4>
							</div>

							<div class="input-checkbox">
								<input type="radio" name="shipping" id="shipping-2" checked>
								<label for="shipping-2">Standard - $4.00</label>
								<div class="caption">
									<p>Our Shipping Cost at Affordable Rate<p>
								</div>
							</div>

						</div>

						<div class="payments-methods">
							<div class="section-title">
								<h4 class="title">Payments Methods</h4>
							</div>
							<div class="input-checkbox">
								<input type="radio" name="payments" id="payments-1" checked>
								<label for="payments-1">Pay On Delivery</label>
								<div class="caption">
									<p>Pay Cash At Delivery Point<p>
								</div>
							</div>
						</div>
					</div>

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
										<th class="text-right"></th>
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
											<td class="price text-center"><strong>$<?php echo $book['book_price']; ?></td>
											<td class="qty text-center"><?php echo $qty; ?></td>
											<td class="total text-center"><strong class="primary-color">$<?php echo $qty * $book['book_price']; ?></strong></td>
										</tr>
									<?php } ?>

								</tbody>
								<tfoot>
									<tr>
										<th class="empty" colspan="3"></th>
										<th>SUBTOTAL</th>
										<th colspan="2" class="sub-total"><?php echo "$" . $_SESSION['total_price']; ?></th>
									</tr>
									<tr>
										<th class="empty" colspan="3"></th>
										<th>SHIPING</th>
										<td colspan="2">$4 Standard Shipping</td>
									</tr>
									<tr>
										<th class="empty" colspan="3"></th>
										<th>TOTAL</th>
										<th colspan="2" class="total"><?php echo "$" . ($_SESSION['total_price'] + 4); ?></th>
									</tr>
								</tfoot>
							</table>
							<div class="pull-right">
								<button type="submit" class="primary-btn">Place Order</button>
							</div>
						</div>

					</div>
				</form>
			<?php
		} else {
			echo "<p class=\"text-warning\">Your cart is empty! Please make sure you add some books in it!</p>";
		}
			?>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->

	<?php
	require_once "./includes/footer.php";
	?>