<?php
require_once "./includes/head.php";
require_once "./includes/database.php";
$count = 0;
$conn = db_connect();
?>
<!-- BREADCRUMB -->
<div id="breadcrumb">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active">Boosk By Category</li>
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

			<!-- MAIN -->
			<div id="main" class="col-9">
				<!-- STORE -->
				<div id="store">
					<!-- row -->
					<div class="row">
						<?php
						if (isset($_GET['pageno'])) {
							$pageno = $_GET['pageno'];
						} else {
							$pageno = 1;
						}
						$no_of_records_per_page = 6;
						$offset = ($pageno - 1) * $no_of_records_per_page;
						$total_pages_sql = "SELECT COUNT(*) FROM books";
						$result = mysqli_query($conn, $total_pages_sql);
						$total_rows = mysqli_fetch_array($result)[0];
						$total_pages = ceil($total_rows / $no_of_records_per_page);

						$sql = "select * from books where Is_Active=1 order by categoryid desc  LIMIT $offset, $no_of_records_per_page";
						$query = mysqli_query($conn, $sql);
						while ($row = mysqli_fetch_array($query)) {
						?>
							<!-- Product Single -->
							<div class="col-md-4 col-sm-6 col-xs-6">
								<div class="product product-single">
									<div class="product-thumb">
										<div class="product-label">
											<span>Author: <?php echo $row['book_author']; ?></span>
										</div>
										<img height="390" width="270" src="admin/uploads/<?php echo $row['book_image']; ?>" alt="">
									</div>
									<div class="product-body">
										<h3 class="product-price">$<?php echo $row['book_price']; ?></h3>

										<h2 class="product-name"><a href="detail.php?nid=<?php echo htmlentities($row['id']) ?>"><?php echo htmlentities($row['book_title']); ?></a></h2>
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
							<div class="clearfix visible-sm visible-xs"></div>
						<?php } ?>
					</div>
					<!-- /row -->
				</div>
				<!-- /STORE -->

				<!-- store bottom filter -->
				<div class="store-filter clearfix">
					<ul class="store-pages">
						<li><span class="text-uppercase">Page:</span></li>
						<li class="page-item"><a href="?pageno=1" class="page-link">First</a></li>
						<li class="<?php if ($pageno <= 1) {
										echo 'disabled';
									} ?> page-item">
							<a href="<?php if ($pageno <= 1) {
											echo '#';
										} else {
											echo "?pageno=" . ($pageno - 1);
										} ?>" class="page-link">Prev</a>
						</li>
						<li class="<?php if ($pageno >= $total_pages) {
										echo 'disabled';
									} ?> page-item">
							<a href="<?php if ($pageno >= $total_pages) {
											echo '#';
										} else {
											echo "?pageno=" . ($pageno + 1);
										} ?> " class="page-link">Next</a>
						</li>
						<li class="page-item"><a href="?pageno=<?php echo $total_pages; ?>" class="page-link">Last</a>
						</li>
					</ul>
				</div>
			</div>
			<!-- /store bottom filter -->
		</div>
		<!-- /MAIN -->
	</div>
	<!-- /row -->
</div>
<!-- /container -->
</div>
<!-- /section -->

<?php
require_once "./includes/footer.php";
?>