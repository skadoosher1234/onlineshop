<?php
 include('formaction.php');

if(!isAdmin()){
	$_SESSION['msg']= "You must login first";
	header('location:form.php');
}
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location:form.php");
}
?>
<html>
<head>
	<title>Admin Panel</title>

</head>
<body>
	<div >
		<h2>Admin Panel</h2>
	</div>
	<div >
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>
		<div>

			<div>
				<?php  if (isset($_SESSION['user'])) : ?>
					<strong><?php echo $_SESSION['user']['customer_username']; ?></strong>

					
						<i> (<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
						<br>
						<a href="admin_home.php?logout='1'">logout</a></br>
						<a href="create_user.php"> + add user</a></br>
						<a href="add_pro.php"> + add products</a>
					

				<?php endif ?>
			</div>
		</div>
	</div>
</body>
</html>