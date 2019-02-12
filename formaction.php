<?php
session_start();
$username='';
$password='';
$email='';
$name='';
$address='';

$errors=array();

$conn = mysqli_connect('localhost', 'root', '', 'onlineshop');

if(mysqli_connect_errno()){
	echo "conection failed".mysqli_connect_error();
}


if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: onlineshop.php");
}

if(isset($_POST['reg_user'])){
	register();
}

function register(){
		global $conn, $errors, $username, $email;

	$name=e($_POST['name']);
	$username=e($_POST['username']);
	$email=e($_POST['email']);
	$address=e($_POST['address']);
	$password1=e($_POST['password1']);
	$password2=e($_POST['password2']);
	
	if(empty($_POST['name'])){
		array_push($errors, "name required");
	}
	if(empty($_POST['username'])){
		array_push($errors, "Username required");
	}
	if(empty($_POST['email'])){
		array_push($errors, "Email required");
	}
	if(empty($_POST['address'])){
		array_push($errors, "Address required");
	}
	if(empty($_POST['password1'])){
		array_push($errors, "Password required");
	}
	if($password1 != $password2){
		array_push($errors, "Two password do not match");
	}
	$check_query="SELECT * from customers where customer_username= '$username' and customer_email= '$email'";
	$result= mysqli_query($conn, $check_query);
	$user = mysqli_fetch_assoc($result);
	if($user){
		if($user['customer_username'] === $username){
			array_push($errors, "Username is created, different try");
		}
		if($user['customer_email'] === $email){
			array_push($errors, "Email is registered");
		}
	}
	if(count($errors) == 0){
		$password = md5($password1);
		if(isset($_POST['user_type'])){
			$user_type=e($_POST['user_type']);
			$query = "INSERT into customers (customer_name, customer_username, customer_address, customer_password, customer_email, user_type)values('$name', '$username', '$address', '$password', '$email','$user_type')";
			mysqli_query($conn, $query);
			$_SESSION['success'] = "New user succesfully created.";
			header('location:admin_home.php');
		}
		else{
			$query = "INSERT into customers(customer_name, customer_username, customer_address, customer_password, customer_email, user_type)values('$name', '$username', '$address', '$password', '$email','user')";
			mysqli_query($conn, $query);
			$logged_in_user_id = mysqli_insert_id($conn);
			echo mysqli_insert_id($conn) ."inserted ID";
			$_SESSION['user']=getUserByID($logged_in_user_id);
			$_SESSION['success']='You are now logged in';
			header('location:onlineshop.php');
		}
	}
}

function getUserByID($id){
	global $conn;
	$query ="SELECT * FROM customer where customer_id=". $id;
	$result = mysqli_query($conn, $query);
	$user = mysqli_fetch_assoc($result);
	return $user;
}
function e($val){
	global $conn;
	return mysqli_real_escape_string($conn, trim($val));
}
function display_error(){
	global $errors;

	if(count($errors) > 0){
		echo '<small><div class="error">';
		foreach ($errors as $keys => $error){
			echo $error.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp';
		}
		echo '</div></small>';
	}
}
function isLoggedIn(){
	if (isset($_SESSION['user'])){
		return true;
	}else{
		return false;
	}
}
if (isset($_POST['log_user'])){
	login();
}
function login(){
	global $conn , $username, $errors;
	$username = e($_POST['username']);
	$password = e($_POST['password']);

	if(empty($_POST['username'])){
		array_push($errors, "Username is required");
	}
	if(empty($_POST['password'])){
		array_push($errors, "Password is required");
	}
	if(count($errors) == 0){
		$password = md5($password);
		$query = "SELECT * from customers where customer_username = '$username' and customer_password = '$password' LIMIT 1";
		$result= mysqli_query($conn, $query);
		if(mysqli_num_rows($result) == 1){
			
			$logged_in_user = mysqli_fetch_assoc($result);
			if($logged_in_user['user_type'] == 'admin'){
			$_SESSION['user'] = $logged_in_user;
			$_SESSION['success'] = "You are now logged in";
			header('location: onlineshop.php?page=admin');
			}else{ 
			$_SESSION['user'] = $logged_in_user;
			$_SESSION['success'] = " You are now logged in";
			header('location: onlineshop.php?page=user');
			}
		}else {
		array_push($errors, "wrong username combination");
	}
	}
}
/*function isAdmin(){
	if(isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin'){
		return true;
	}else{
		return false;
	}
}*/
if(isset($_POST['sub_pro'])){
	addProduct();
}
function addProduct(){
	global $conn,$errors;
	
	
	$name=e($_POST['names']);
	$category=e($_POST['category']);
	$quantity=e($_POST['quantity']);
	$supplier=e($_POST['supplier']);
	$discount=e($_POST['discount']);
	$price=e($_POST['price']);
	$date=e($_POST['date']);
	$image=$_FILES['image']['name'];
	$target_file="Images/".basename($image);


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
	if(empty($_FILES['image'])){
		array_push($errors, "file is required");
	}
	if(count($errors) == 0){
			
			
	
			$query="INSERT into products (product_name, product_category, product_supplier, product_quantity, product_discount, product_price, product_date, product_image) values ('$name', '$category','$supplier', '$quantity', '$discount', '$price', '$date', '$image')";

			mysqli_query($conn,$query);
			if(move_uploaded_file($_FILES['image']['tmp_name'], $target_file)){
			echo "file uploaded succesfully";
			}else{
			echo "file didnt uploaded";
			}
		}
}
function showProduct(){
	global $conn;
	$query = "SELECT * from products order by product_id desc LIMIT 10";
	$result = mysqli_query($conn, $query);
	
	if(mysqli_num_rows($result) > 1){
	while($row = mysqli_fetch_array($result)){
		echo '<div class="featureCol">';
		echo '<form action="onlineshop.php?add=&id='.$row['product_id'].'"method="post">';
		echo '<img src="Images/'.$row['product_image'].'">';
		echo '<h4 class="name">'.$row["product_name"].'</h4>';
		echo '<h4 class="price">'.$row["product_price"]."$".'</h4>';
		echo '<input type="hidden" name="hidden_name" value="'.$row["product_name"].'"/>';
		echo '<input type="hidden" name="hidden_price" value="'.$row["product_price"].'"/>';
		echo '<input type="text" name="quantity" value="1" class="quantity" />';
		echo '<input type="submit" name="add_to_cart" class="add_to_cart" value="Add to Cart">';
		echo '</form>';
		echo "</div>";
	}
	}
}
if(isset($_POST['add_to_cart'])){
	add_to_cart();
}
function add_to_cart(){
	if(isset($_SESSION["add_cart"]))
	{
		$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
		if(!in_array($_GET["id"], $item_array_id))
		{
			$count = count($_SESSION["add_cart"]);
			$item_array = array(
				'item_id'			=>	$_GET["id"],
				'item_name'			=>	$_POST["hidden_name"],
				'item_price'		=>	$_POST["hidden_price"],
				'item_quantity'		=>	$_POST["quantity"]
			);
			$_SESSION["add_cart"][$count] = $item_array;
		}
		else
		{
			echo '<script>alert("Item Already Added")</script>';
		}
	}
	else
	{
		$item_array = array(
			'item_id'			=>	$_GET["id"],
			'item_name'			=>	$_POST["hidden_name"],
			'item_price'		=>	$_POST["hidden_price"],
			'item_quantity'		=>	$_POST["quantity"]
		);
		$_SESSION["add_cart"][0] = $item_array;
	}
}
if(isset($_POST['search_button'])){
	search();
}
function search(){
	global $conn;
	$search = e($_POST['search']);

	$query = "SELECT * FROM products WHERE product_name LIKE %$search% or product_category LIKE %$search% or product_date LIKE %$search% or product_supplier LIKE %$search%";
	$result = mysqli_query($conn, $query);
	if(mysqli_num_rows($result) > 1){
		while( $row = mysqli_fetch_assoc($result)){
		echo "<h2> YOUR RESULTS ARE HERE </h2>";
		echo '<div class="featureCol">';
		echo '<form action="onlineshop.php?add=&id='.$row['product_id'].'"method="post">';
		echo '<img src="Images/'.$row['product_image'].'">';
		echo '<h4 class="name">'.$row["product_name"].'</h4>';
		echo '<h4 class="price">'.$row["product_price"]."$".'</h4>';
		echo '<input type="hidden" name="hidden_name" value="'.$row["product_name"].'"/>';
		echo '<input type="hidden" name="hidden_price" value="'.$row["product_price"].'"/>';
		echo '<input type="text" name="quantity" value="1" class="quantity" />';
		echo '<input type="submit" name="add_to_cart" class="add_to_cart" value="Add to Cart">';
		echo '</form>';
		echo "</div>";
		}
	}else{
		echo "<h2>No match found!</h2>";
	}
}


/*function userCheck(){
	global $conn;

	$query = "SELECT * from customers";
	$result = mysqli_query($conn; $query);
	$row = mysqli_fetch_array($result);
} */

			//if(move_uploaded_file($_FILES['image']['tmp_name'], $target_file)){

	//		echo "file uploaded successfully";
	//}else{
	//		echo "file didnt uploaded";









/*$sql="SELECT customer.customer_name as name, product.product_name as product, orders.order_date as date from orderdetails 
inner join customer on customer.customer_id = orderdetails.order_id 
inner join product on product.product_id = orderdetails.product_id
inner join orders on orders.order_id = orderdetails.order_id where customer.customer_username = '$username'";

$results = $conn -> query($sql);



if($results -> num_rows == 1){
	echo "record has found <br>"; 
	while($rows=$results ->fetch_assoc()){
		
		$_SESSION['name'] = $postname;
		echo "Products are here ". $rows["name"]. " - Product Name: ". $rows["product"]. " - Date" . $rows["date"] . "<br>";
	}
} */

?>