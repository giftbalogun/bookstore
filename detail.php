<?php
require_once "./includes/head.php";
require_once "./includes/database.php";
$conn = db_connect();
$row = select4catBook($conn);
?>

<!-- BREADCRUMB -->
<div id="breadcrumb">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li><a href="#">Products</a></li>
			<li><a href="#">Category</a></li>
			<?php
			$id = $_GET['nid'];
			$query = mysqli_query($conn, "select * from books where id='$id'");
			while ($row = mysqli_fetch_array($query)) {
			?>
				<li class="active"><?php echo htmlentities($row['book_title']); ?></li>
			<?php } ?>
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
			<?php
			$id = $_GET['nid'];
			$query = mysqli_query($conn, "select * from books where id='$id'");
			while ($row = mysqli_fetch_array($query)) {
			?>
				<!--  Product Details -->
				<div class="product product-details clearfix">
					<div class="col-md-6">

						<div class="product-view">
							<img src="admin/uploads/<?php echo $row['book_image']; ?>" alt="">
						</div>

					</div>
					<div class="col-md-6">
						<div class="product-body">
							<div class="product-label">
								<span>Author: <?php echo $row['book_author']; ?></span>
							</div>
							<h2 class="product-name"><?php echo htmlentities($row['book_title']); ?>.</h2>
							<h3 class="product-price">$<?php echo htmlentities($row['book_price']); ?>.</h3>
							<p><strong>Availability:</strong> In Stock</p>
							<p><strong>Brand:</strong> E-SHOP</p>
							<?php
							$pt = $row['book_descr'];
							echo (substr($pt, 0)); ?>
							<hr>

							<div class="product-btns">
								<form method="post" action="cart.php">
									<input type="hidden" name="bookisbn" value="<?php echo $row['id']; ?>">
									<button type="submit" class="primary-btn add-to-cart" name="cart"><i class="fa fa-shopping-cart"></i> Add to
										Cart</button>
								</form>

							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="product-tab">
							<ul class="tab-nav">
								<li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
							</ul>
							<div class="tab-content">
								<div id="tab1" class="tab-pane fade in active">
									<?php
									$pt = $row['book_descr'];
									echo (substr($pt, 0)); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /Product Details -->
			<?php } ?>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /section -->

<!-- section -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- section title -->
			<div class="col-md-12">
				<div class="section-title">
					<h2 class="title">Inspired By You</h2>
				</div>
			</div>
			<!-- section title -->
			<?php

			$sql = "SELECT * FROM books ORDER BY categoryid DESC LIMIT 4";
			$query = mysqli_query($conn, $sql);
			while ($row = mysqli_fetch_array($query)) { ?>
				<!-- Product Single -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="product product-single">
						<div class="product-thumb">
							<div class="product-label">
								<span>Author: <?php echo $row['book_author']; ?></span>
							</div>
							<img height="390" width="270" src="admin/uploads/<?php echo $row['book_image']; ?>" alt="">
						</div>
						<div class="product-body">
							<h3 class="product-price">$<?php echo $row['book_price']; ?></h3>

							<h2 class="product-name"><a href="#"><a href="detail.php?nid=<?php echo $row['id'] ?>"><?php echo $row['book_title']; ?></a></h2>
							<div class="product-btns">
								<form method="post" action="cart.php">
									<input type="hidden" name="bookisbn" value="<?php echo $row['id']; ?>">
									<button type="submit" class="primary-btn add-to-cart" name="cart"><i class="fa fa-shopping-cart"></i> Add to
										Cart</button>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Product Single -->
			<?php } ?>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /section -->


<?php
require_once "./includes/footer.php";
?>