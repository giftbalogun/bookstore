<?php
require_once "./includes/head.php";
require_once "./includes/database.php";
error_reporting(0);
$conn = db_connect();


if (isset($_POST['login'])) {
	$name = trim($_POST['username']);
	$pass = trim($_POST['password']);

	//Check if its manager
	$query = "SELECT name, pass from manager";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);
	if ($name == $row['name'] && $pass == $row['pass']) {
		$_SESSION['manager'] = true;
		unset($_SESSION['user']);
		unset($_SESSION['email']);
		echo "<script type='text/javascript'> document.location = './admin/dashboard.php'; </script>";
	} else {
		//check if it is customer
		$name = mysqli_real_escape_string($conn, $name);
		$pass = mysqli_real_escape_string($conn, $pass);

		$pass = md5($pass);
		$query = "SELECT email, password from customers";
		$result = mysqli_query($conn, $query);
		for ($i = 0; $i < mysqli_num_rows($result); $i++) {
			$row = mysqli_fetch_assoc($result);
			if ($name == $row['email'] && $pass == $row['password']) {
				$_SESSION['user'] = true;
				$_SESSION['email'] = $name;
				unset($_SESSION['manager']);
				$_SESSION['success'] = "You are now logged in";
				echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
			} else {
				$error = "Wrong Combination";
			}
		}
	}
} else {
	if (!isset($_SESSION['user'])) {
		header('location: ./index.php');
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
			.login-form {
				width: 340px;
				margin: 50px auto;
			}

			.login-form form {
				margin-bottom: 15px;
				background: #f7f7f7;
				box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
				padding: 30px;
			}

			.login-form h2 {
				margin: 0 0 15px;
			}

			.form-control,
			.btn {
				min-height: 38px;
				border-radius: 2px;
			}

			.btn {
				font-size: 15px;
				font-weight: bold;
			}
		</style>
		<div class="login-form">
			<div class="row">
				<?php
				unset($_SESSION['success']);
				?>
				<!---Error Message--->
				<?php if ($error) { ?>
					<div class="alert alert-danger" role="alert">
						<strong>Oh snap!</strong> <?php echo htmlentities($error); ?></div>
				<?php } ?>
			</div>
			<form action="login.php" method="post">
				<h2 class="text-center">Log in</h2>
				<div class="form-group">
					<input type="text" class="form-control" name="username" placeholder="Email" required="required">
				</div>
				<div class="form-group">
					<input type="password" class="form-control" name="password" placeholder="Password" required="required">
				</div>
				<div class="form-group">
					<button type="submit" name="login" class="btn btn-primary btn-block">Log in</button>
				</div>
				<div class="clearfix">
					<label class="pull-left checkbox-inline"><input type="checkbox"> Remember me</label>
					<a href="#" class="pull-right">Forgot Password?</a>
				</div>
			</form>
			<p class="text-center"><a href="signup.php">Create an Account</a></p>
		</div>
	</div>
	<!-- /container -->
</div>
<!-- /section -->

<?php
require_once "./includes/footer.php";
?>