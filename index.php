<?php
require_once "./includes/header.php";
require_once "./includes/database.php";

$conn = db_connect();
$row = select4LatestBook($conn);
$catb = select4catBook($conn);
?>
<!-- HOME -->
<div id="home">
	<!-- container -->
	<div class="container">
		<!-- home wrap -->
		<div class="home-wrap">
			<!-- home slick -->
			<div id="home-slick">
				<!-- banner -->
				<div class="banner banner-1">
					<img src="./img/banner01.jpg" alt="">
					<div class="banner-caption text-center">
						<h1>Quality Books</h1>
						<h3 class="white-color font-weak">Up to 50% Discount</h3>
						<a href="./book.php" class="primary-btn">Shop Now</a>
					</div>
				</div>
				<!-- /banner -->

				<!-- banner -->
				<div class="banner banner-1">
					<img src="./img/banner02.png" alt="">
					<div class="banner-caption">
						<h1 class="primary-color">HOT DEAL<br><span class="white-color font-weak">Up to 50% OFF</span>
						</h1>
						<a href="./book.php" class="primary-btn">Shop Now</a>
					</div>
				</div>
				<!-- /banner -->

				<!-- banner -->
				<div class="banner banner-1">
					<img src="./img/banner03.jpg" alt="">
					<div class="banner-caption">
						<h1>Find a Classic <span>Collection</span></h1>
						<a href="./book.php" class="primary-btn">Shop Now</a>
					</div>
				</div>
				<!-- /banner -->
			</div>
			<!-- /home slick -->
		</div>
		<!-- /home wrap -->
	</div>
	<!-- /container -->
</div>
<!-- /HOME -->

<!-- section -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- banner -->
			<div class="col-md-4 col-sm-6">
				<a class="banner banner-1" href="#">
					<img src="./img/banner01.jpg" alt="">
					<div class="banner-caption text-center">
						<h2>NEW COLLECTION</h2>
					</div>
				</a>
			</div>
			<!-- /banner -->

			<!-- banner -->
			<div class="col-md-4 col-sm-6">
				<a class="banner banner-1" href="#">
					<img src="./img/banner02.png" alt="">
					<div class="banner-caption text-center">
						<h2>NEW COLLECTION</h2>
					</div>
				</a>
			</div>
			<!-- /banner -->

			<!-- banner -->
			<div class="col-md-4 col-md-offset-0 col-sm-6 col-sm-offset-3">
				<a class="banner banner-1" href="#">
					<img src="./img/banner03.jpg" alt="">
					<div class="banner-caption text-center">
						<h2>NEW COLLECTION</h2>
					</div>
				</a>
			</div>
			<!-- /banner -->

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

		<!-- section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h2 class="title">Recently Added For You</h2>
						</div>
					</div>
					<!-- section title -->
					<?php foreach ($row as $book) { ?>
						<!-- Product Single -->
						<div class="col-md-3 col-sm-6 col-xs-6">
							<div class="product product-single">
								<div class="product-thumb">
									<div class="product-label">
										<span>Author: <?php echo $book['book_author']; ?></span>
									</div>
									<img height="390" width="270" src="admin/uploads/<?php echo htmlentities($book['book_image']); ?>" alt="">
								</div>
								<div class="product-body">
									<h3 class="product-price">$<?php echo $book['book_price']; ?></h3>
									<h2 class="product-name"><a href="detail.php?nid=<?php echo htmlentities($book['id']) ?>"><?php echo $book['book_title']; ?></a></h2>
									<div class="product-btns">
										<form method="post" action="cart.php">
											<input type="hidden" name="bookisbn" value="<?php echo $book['id']; ?>">
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

				<!-- row -->
				<div class="row">
					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h2 class="title">Inspired By You</h2>
						</div>
					</div>
					<!-- section title -->
					<?php foreach ($catb as $book) { ?>
						<!-- Product Single -->
						<div class="col-md-3 col-sm-6 col-xs-6">
							<div class="product product-single">
								<div class="product-thumb">
									<div class="product-label">
										<span>Author: <?php echo $book['book_author']; ?></span>
									</div>
									<img height="390" width="270" src="admin/uploads/<?php echo $book['book_image']; ?>" alt="">
								</div>
								<div class="product-body">
									<h3 class="product-price">$<?php echo $book['book_price']; ?></h3>

									<h2 class="product-name"><a href="detail.php?nid=<?php echo htmlentities($book['id']) ?>"><?php echo $book['book_title']; ?></a></h2>
									<div class="product-btns">
										<form method="post" action="cart.php">
											<input type="hidden" name="bookisbn" value="<?php echo $book['id']; ?>">
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

	</div>
</div>
<?php
require_once "./includes/footer.php";
?>