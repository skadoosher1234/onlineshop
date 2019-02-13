<?php include('formaction.php') ?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

 <div><h2>See customer's order</h2></div>
 	<div>
 		 <?php echo display_error(); ?>

		<form action="form.php" method="POST">
		<div>	<label>Name:</label> 
			<input type="text" name="username" value="<?php echo $username; ?>">
		</div>
		<div>	<label>Password:</label>
			<input type="password" name="password" value="<?php echo $password; ?>">
			<button type="submit" name="log_user">SUBMIT</button>
			<div><p>Want to be member? <a href="eregister.php">click here!</a></p>
	  	</form>
	</div>

</body>
</html>