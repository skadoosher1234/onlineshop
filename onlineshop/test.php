<!DOCTYPE html>
<html>
<head>
	<title>image</title>
</head>
<body>
	<div id="content">
		<div><?php echo display_error(); ?></div>
		<form method="post" action="test.php">
			<div>
				<label>Product Name</label>
				<input type="text" name="names">
			</div>
			<div>
				<label>Category</label>
				<select name="category">
				<option value="electronics"> Electronics </option>
				<option value="phone"> Phone </option>
				<option value="clothes"> Clothes </option>
				<option value="book"> Book </option>
				<option value="home"> Home </option>
				<option value="stationary"> Stationary </option>
				</select>
			</div>
			<div>
				<label>Supplier</label>
				<input type="text" name="supplier">
			</div>
			<div>
				<label>Quantity</label>
				<input type="text" name="quantity">
			</div>
			<div>
				<label>Discount</label>
				<input type="text" name="discount">
			</div>
			<div>
				<label>Price</label>
				<input type="text" name="price">
			</div>
			<div>
				<label>Date</label>
				<input type="date" name="date">
			</div>
			<div>
				<label>Image</label>
				<input type="file" name="image">
		    </div>
			<button type="submit" name="submit">SUBMIT</button>
		</form>


	</div>
</body>
</html>
<?php 
	$image='';
	$errors=array();
	$conn = mysqli_connect('localhost', 'root', '', 'onlineshop');
	if(mysqli_connect_errno()){
		echo "connection failed". mysqli_connect_error();
	}else{
		echo "connection succesfull";
	}
	if(isset($_POST['submit'])){
		
		$name=$_POST['names'];
		$category=$_POST['category'];
		$quantity=$_POST['quantity'];
		$supplier=$_POST['supplier'];
		$discount=$_POST['discount'];
		$price=$_POST['price'];
		$date=$_POST['date'];
		$image=$_FILES['image']['name'];
		$target= "Images/".basename($_FILES['image']['name']);
		
		if(empty($_POST['names'])){
		array_push($errors, "name required");
		}
		if(empty($_POST['category'])){
		array_push($errors, "choose category");
		}
		if(empty($_POST['quantity'])){
		array_push($errors, "quantity required");
		}
		if(empty($_POST['supplier'])){
		array_push($errors, "supplier required");
		}
		if(empty($_POST['price'])){
		array_push($errors, "price required");
		}
		if(empty($_POST['date'])){
		array_push($errors, "date required");
		}
		if(empty($_POST['image'])){
		array_push($errors, "file is required");
		}
		
		if(count($errors) == 0){



			$query="INSERT into products (product_name, product_category, product_supplier, product_quantity, product_discount, product_price, product_date, product_image) values ('$name', '$category','$supplier', '$quantity', '$discount', '$price', '$date', '$image')";
			mysqli_query($conn, $query);
			if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
			echo " file uploaded";
			}else{
			echo "file didnt uploaded";
			}
		}else{
			echo "Your information inserted";
		}
}

function display_error(){
	global $errors;

	if(count($errors) > 0){
		echo '<div class="error">';
		foreach ($errors as $error){
			echo $error . '<br>';
		}
		echo '</div>';
	}
	}


?>