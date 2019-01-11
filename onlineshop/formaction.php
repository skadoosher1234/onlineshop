<?php
session_start();
$username='';
$password='';
$email='';
$name='';
$address='';

$errors=array();

$conn = mysqli_connect('localhost', 'root', 'rootpwd', 'onlineshop');

if($conn -> connect_error){
	die("connection failed".$conn-> connect_error);
}
echo "connection successfully";


if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: form.php");
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
	$check_query="SELECT * from customer where customer_username= '$username' and customer_email= '$email'";
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
			$query = "INSERT into customer(customer_name, customer_username, customer_address, customer_pass, customer_email, user_type)values('$name', '$username', '$address', '$password', '$email','$user_type')";
			mysqli_query($conn, $query);
			$_SESSION['success'] = "New user succesfully created.";
			header('location:admin_home.php');
		}
		else{
			$query = "INSERT into customer(customer_name, customer_username, customer_address, customer_pass, customer_email, user_type)values('$name', '$username', '$address', '$password', '$email','user')";
			mysqli_query($conn, $query);
			$logged_in_user_id = mysqli_insert_id($conn);
			echo mysqli_insert_id($conn) ."inserted ID";
			$_SESSION['user']=getUserByID($logged_in_user_id);
			$_SESSION['success']='You are now logged in';
			header('location:grant.php');
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
		echo '<div class="error">';
		foreach ($errors as $error){
			echo $error . '<br>';
		}
		echo '</div>';
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
		array_push($errors, "username is required");
	}
	if(empty($_POST['password'])){
		array_push($errors, "password is required");
	}
	if(count($errors) == 0){
		$password = md5($password);
		$query = "SELECT * from customer where customer_username = '$username' and customer_pass = '$password' LIMIT 1";
		$result= mysqli_query($conn, $query);
		if(mysqli_num_rows($result) == 1){
			
			$logged_in_user = mysqli_fetch_assoc($result);
			if($logged_in_user['user_type'] == 'admin'){
			$_SESSION['user'] = $logged_in_user;
			$_SESSION['success'] = "You are now logged in";
			header('location: admin_home.php');
			}else{
			$_SESSION['user'] = $logged_in_user;
			$_SESSION['success'] = " You are now logged in";
			header('location: grant.php');
			}
		}else {
		array_push($errors, "wrong username combination");
	}
	}
}
function isAdmin(){
	if(isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin'){
		return true;
	}else{
		return false;
	}
}
if(isset($_POST['sub_pro'])){
	addProduct();
}
function addProduct(){
	global $conn,$errors;

	if(empty($_POST['name'])){
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
	if(count($errors) == 0){
		$name=e($_POST['name']);
		$category=e($_POST['category']);
		$quantity=e($_POST['quantity']);
		$supplier=e($_POST['supplier']);
		$discount=e($_POST['discount']);
		$price=e($_POST['price']);
		$date=e($_POST['date']);
		$query="INSERT into product (product_name, product_category, product_supplier, product_quantity, product_discount, product_price, product_date)values('$name', '$category','$supplier', '$quantity', '$discount', '$price', '$date')";
		mysqli_query($conn, $query);
		$_SESSION['success'] = "New products added succesfully";
		header('location: admin_home.php');

	}
}





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