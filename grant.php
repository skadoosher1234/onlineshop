
<?php 
	include('formaction.php');
	if(!isLoggedIn()){
		$_SESSION['msg']="You must login first";
		header('location: form.php');
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h2>WELCOME</h2>
<?php if(isset($_SESSION['success'])) : ?>

<div class="error success"> 

	<h3>
		<?php 
		echo $_SESSION['success'];
		unset($_SESSION['success']);
		?>
	</h3>
</div>
<?php endif ?>

<div>
	<?php if(isset($_SESSION['user'])) : ?>
		<strong>
			<?php echo $_SESSION['user']['customer_username']; ?>
		</strong>
			<i><?php echo ($_SESSION['user']['user_type']) ;?></i>
			<a href="grant.php?logout='1'"> Logout </a>
	<?php endif ?>
</div>
<?php
// global $conn;
// $query = "SELECT * from product";
// $result = mysqli_query($conn, $query);
// if($row = mysqli_fetch_array($result)){
// 	echo '<tr>';
// 		echo '<th>'.$row["product_name"]'</th>';
// 		echo '<th>'.$row["product_price"]'</th>';
// 	echo '</tr>';
// }
?>	
</div>
</body>
</html>