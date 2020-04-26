<?php
require_once "./includes/head.php";
require_once "./includes/database.php";
$conn = db_connect();
?>

<!-- BREADCRUMB -->
<div id="breadcrumb">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active">Order History</li>
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
			<form id="checkout-form" class="clearfix">

				<?php if (isset($_SESSION['user'])) {
					$customer = getCustomerIdbyEmail($_SESSION['email']);
					$customerid = $customer['id'];
					$query = "SELECT * FROM cart join cartitems join books join customers
				on customers.id='$customerid' and cart.customerid='$customerid' and cart.id=cartitems.cartid and  cartitems.productid=books.id";
					$result = mysqli_query($conn, $query);
					if (mysqli_num_rows($result) != 0) { ?>
						<div class="col-md-12">
							<div class="order-summary clearfix">
								<div class="section-title">
									<h3 class="title">Order History</h3>
								</div>

								<table class="shopping-cart-table table">
									<thead>
										<tr>
											<th>Product</th>
											<th></th>
											<th class="text-center">Price</th>
										</tr>
									</thead>
									<tbody>
										<?php
										for ($i = 0; $i < mysqli_num_rows($result); $i++) {

											while ($query_row = mysqli_fetch_assoc($result)) {
										?>
												<tr>
													<td class="thumb"><img src="admin/uploads/<?php echo $query_row['book_image']; ?>" alt=""></td>
													<td class="details">
														<a href="#"><?php echo  $query_row['book_title']; ?></a>
														<ul>
															<li><span>Quantity: <?php echo $query_row['quantity']; ?></span></li>
															<li><span>Author: <?php echo $query_row['book_author']; ?></span></li>
															<li><span>Date: <?php echo $query_row['date']; ?></span></li>
														</ul>
													</td>
													<td class="total text-center"><strong class="primary-color">$<?php echo $query_row['book_price']; ?></strong></td>
												</tr>
										<?php }
										} ?>
									</tbody>

								</table>

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
					       <p class="text-center" >You Have Not Made Any Order So Far</p>
	  			        </div>
			        </div>
			        <!-- /row -->
		        </div>
		        <!-- /container -->
            </div>
    ';
					}
				}  ?>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /section -->

<?php
require_once "./includes/footer.php";
?>