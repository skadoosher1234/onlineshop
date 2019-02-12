<?php include('formaction.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Create user</title>
</head>
<body>
	<div>
		<h2> Admin- Create user</h2>
	</div>
	<form method="post" action="create_user.php">
		<?php echo display_error(); ?>
		<div>
			<label> Name </label>
			<input type='textfield' name='name'>
		</div>
		<div>
			<label> Username </label>
			<input type='textfield' name='username'>
		</div>
		<div>
			<label> Email </label>
			<input type='textfield' name='email'>
		</div>
		<div>
			<label> Address </label>
			<input type='textfield' name='address'>
		</div>
		<div>
			<label> Password </label>
			<input type='password' name='password1'>
		</div>
		<div>
			<label> Confirm password </label>
			<input type='password' name='password2'>
		</div>
		<div>
			<label> User Type </label>
			<select name="user_type">
				<option value=""> </option>
				<option value="admin">Admin</option>
				<option value="user">User</option>
			</select>
		</div>
		<div>
			<button type="submit" class="btn" name="reg_user">Create user</button>
		</div>
	</form>

</body>
</html>