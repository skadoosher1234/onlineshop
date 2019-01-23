<?php include('formaction.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Products</title>
</head>
<body>
	<div><h2> Add products </h2></div>
	<div>
		<form method="post" action="add_pro.php" enctype="multipart/form-data">
			<?php echo display_error() ?>
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
			<div>
				<button type="submit" name="sub_pro">Save</button>
			</div>

		</form>
	</div>



</body>
</html>