<?php include('formaction.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<h2>Register</h2>
	<div class="container">
		<form action="eregister.php" method="POST">
			<?php include('errors.php'); ?>
			<div>
				<label>Name</label>
				<input type="text" name="name">
			</div>
			<div>
				<label>Username</label>
				<input type="text" name="username">
			</div>
			<div>
				<label>Email</label>
				<input type="text" name="email">
			</div>
			<div>
				<label>Password</label>
				<input type="password" name="password1">
			</div>
			<div>
				<label>Confirm Password</label>
				<input type="password" name="password2">
			</div>
			<div>
				<label>Enter address</label>
				<input type="text" name="address">
				<button type="submit" name="reg_user">SUBMIT</button>
			</div>
			<div>
				<p>Already member?<a href='form.php'> sign in</a></p>
			</div>
		</form>
	</div>

</body>
</html>