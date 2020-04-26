<?php
require_once "./includes/head.php";
require_once "./includes/database.php";

$conn = db_connect();

$firstname = trim($_POST['firstname']);
$firstname = mysqli_real_escape_string($conn, $firstname);

$lastname = trim($_POST['lastname']);
$lastname = mysqli_real_escape_string($conn, $lastname);


$address = trim(trim($_POST['address']));
$address = mysqli_real_escape_string($conn, $address);

$city = trim($_POST['city']);
$city = mysqli_real_escape_string($conn, $city);

$zipcode = trim($_POST['zipcode']);
$zipcode = mysqli_real_escape_string($conn, $zipcode);

// find customer
$customer = getCustomerIdbyEmail($_SESSION['email']);
$id = $customer['id'];
$query = "UPDATE customers set 
	firstname='$firstname', lastname='$lastname' , address='$address', city='$city', zipcode='$zipcode'  where id='$id'
	";
mysqli_query($conn, $query);
$date = date("Y-m-d H:i:s");
// insertIntoOrder($conn, $customer['id'], $_SESSION['total_price'],$date);
insertIntoCart($conn, $customer['id'], $date);

// take orderid from order to insert order items
// $orderid = getOrderId($conn, $customer['id']);
$Cartid = getCartId($conn, $customer['id']);

foreach ($_SESSION['cart'] as $isbn => $qty) {
	$bookprice = getbookprice($isbn);
	$query = "INSERT INTO cartItems(cartid,productid,quantity) VALUES 
		('$Cartid', '$isbn', '$qty')";
	$result = mysqli_query($conn, $query);
	if (!$result) {
		echo "Insert value false!" . mysqli_error($conn);
		exit;
	}
}

unset($_SESSION['total_price']);
unset($_SESSION['cart']);
unset($_SESSION['total_items']);
?>

<!-- BREADCRUMB -->
<div id="breadcrumb">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active">Order Processing Gateway</li>
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
			<p class="lead text-success" id="p">Your order has been processed sucessfully..</p>
			<script>
				window.setTimeout(function() {
					window.location.href = "./index.php";
				}, 3000);
			</script>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /section -->

<?php
require_once "./includes/footer.php";
?>