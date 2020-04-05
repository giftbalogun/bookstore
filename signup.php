<?php
require_once "./includes/head.php";
require_once "./includes/database.php";
error_reporting(0);
?>
<?php

// REGISTER USER
if (isset($_POST['signup'])) {
	$conn = db_connect();

	$firstname = trim($_POST['firstname']);
	$lastname = trim($_POST['lastname']);
	$username = trim($_POST['username']);
	$email = trim($_POST['email']);
	$password = trim($_POST['password']);
	$address = trim(trim($_POST['address']));
	$city = trim($_POST['city']);
	$zipcode = trim($_POST['zipcode']);
	$phone = trim($_POST['phone']);

	// receive all input values from the form
	$firstname = mysqli_real_escape_string($conn, $firstname);
	$lastname = mysqli_real_escape_string($conn, $lastname);
	$username = mysqli_real_escape_string($conn, $username);
	$email = mysqli_real_escape_string($conn, $email);
	$password = mysqli_real_escape_string($conn, $password);
	$address = mysqli_real_escape_string($conn, $address);
	$city = mysqli_real_escape_string($conn, $city);
	$phone = mysqli_real_escape_string($conn, $phone);
	$zipcode = mysqli_real_escape_string($conn, $zipcode);

	// form validation: ensure that the form is correctly filled ...
	// by adding (array_push()) corresponding error unto $errors array
	if (empty($firstname) || empty($lastname) || empty($username) || empty($email) || empty($password) || empty($address) || empty($city) || empty($zipcode) || empty($phone)) {
		$error = "All Fields are Needed";
	} else {

		// first check the database to make sure
		// a user does not already exist with the same username and/or email
		$user_check_query = "SELECT * FROM customers WHERE username='$username' OR email='$email' LIMIT 1";
		$result = mysqli_query($conn, $user_check_query);
		$user = mysqli_fetch_assoc($result);

		if ($user) { // if user exists
			if ($user['username'] === $username) {
				$error = "Username already exists";
			}

			if ($user['email'] === $email) {
				$error = "email already exists";
			}
		}

		// Finally, register user if there are no errors in the form
		if (count($error) == 0) {
			$password = md5($password); //encrypt the password before saving in the database

			$query = mysqli_query($conn, "INSERT INTO customers(firstname, lastname, username, email, password, address, city, zipcode, phone, Is_Active) VALUES
                                        ('$firstname', '$lastname', '$username', '$email', '$password', '$address', '$city', '$zipcode', '$phone', '1')");
			mysqli_query($conn, $query);
			$_SESSION['username'] = $username;
			$_SESSION['success'] = "You are now logged in";
			header('location: index.php');
		}
	}
}
?>

<!-- BREADCRUMB -->
<div id="breadcrumb">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active">Blank</li>
		</ul>
	</div>
</div>
<!-- /BREADCRUMB -->

<!-- section -->
<div class="section">
	<!-- container -->
	<div class="container">
		<style type="text/css">
			.form-control {
				height: 40px;
				box-shadow: none;
				color: #969fa4;
			}

			.form-control:focus {
				border-color: #5cb85c;
			}

			.form-control,
			.btn {
				border-radius: 3px;
			}

			.signup-form {
				width: 400px;
				margin: 0 auto;
				padding: 30px 0;
			}

			.signup-form h2 {
				color: #636363;
				margin: 0 0 15px;
				position: relative;
				text-align: center;
			}

			.signup-form h2:before,
			.signup-form h2:after {
				content: "";
				height: 2px;
				width: 30%;
				background: #d4d4d4;
				position: absolute;
				top: 50%;
				z-index: 2;
			}

			.signup-form h2:before {
				left: 0;
			}

			.signup-form h2:after {
				right: 0;
			}

			.signup-form .hint-text {
				color: #999;
				margin-bottom: 30px;
				text-align: center;
			}

			.signup-form form {
				color: #999;
				border-radius: 3px;
				margin-bottom: 15px;
				background: #f2f3f7;
				box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
				padding: 30px;
			}

			.signup-form .form-group {
				margin-bottom: 20px;
			}

			.signup-form input[type="checkbox"] {
				margin-top: 3px;
			}

			.signup-form .btn {
				font-size: 16px;
				font-weight: bold;
				min-width: 140px;
				outline: none !important;
			}

			.signup-form .row div:first-child {
				padding-right: 10px;
			}

			.signup-form .row div:last-child {
				padding-left: 10px;
			}

			.signup-form a {
				color: #fff;
				text-decoration: underline;
			}

			.signup-form a:hover {
				text-decoration: none;
			}

			.signup-form form a {
				color: #5cb85c;
				text-decoration: none;
			}

			.signup-form form a:hover {
				text-decoration: underline;
			}
		</style>
		<div class="signup-form">
			<div class="row">
				<?php
				echo $_SESSION['success'];
				unset($_SESSION['success']);
				?>
				<!---Error Message--->
				<?php if ($error) { ?>
					<div class="alert alert-danger" role="alert">
						<strong>Oh snap!</strong> <?php echo htmlentities($error); ?></div>
				<?php } ?>
			</div>
			<form method="post" name="signup" action="signup.php">

				<h2 class="text-center">Register</h2>
				<div class="form-group">
					<input type="text" class="form-control" name="firstname" placeholder="Firstname">
				</div>
				<div class="form-group">
					<input type="text" class="form-control" name="lastname" placeholder="Lastname">
				</div>
				<div class="form-group">
					<input type="text" class="form-control" name="username" placeholder="Username">
				</div>
				<div class="form-group">
					<input type="text" class="form-control" name="email" placeholder="Email">
				</div>
				<div class="form-group">
					<input type="password" class="form-control" name="password" placeholder="Password">
				</div>
				<div class="form-group">
					<input type="text" class="form-control" name="address" placeholder="Address">
				</div>
				<div class="form-group">
					<input type="text" class="form-control" name="city" placeholder="City">
				</div>
				<div class="form-group">
					<input type="text" class="form-control" name="phone" placeholder="Phone">
				</div>
				<div class="form-group">
					<input type="text" class="form-control" name="zipcode" placeholder="Zipcode">
				</div>
				<div class="form-group">
					<button type="submit" name="signup" class="btn btn-primary btn-block">Register</button>
				</div>

			</form>
		</div>
	</div>
	<!-- /container -->
</div>
<!-- /section -->

<?php
require_once "./includes/footer.php";
?>