<?php include('formaction.php') ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" type="text/css" href="Styles/Stylesheet.css" />
    </head>
    <body>
        <div class="header-cont">
            <div class="search">
                <input type="text" name="search" placeholder="SEARCH">
                <button type="submit" name="search_button"></button>
            </div>
            <?php if(isset($_GET['page'])){ ?>
                <div class="addtocart">
                    <img src="Images/add_to_cart.png">
                </div>
            <?php } ?>
            
            <?php if(!isset($_GET['page'])){ ?>
            <div class="login">
                <form action="onlineshop.php" method="POST">
                    <label>Login</label>
                    <input type="text" name="username" placeholder="Username">
                    <input type="password" name="password" placeholder="Password">
                    <button name="log_user">Login</button>
                    <a href="page=eregister.php">A register?</a>
                    <?php echo display_error(); ?>

                </form>
            </div>
            <?php 
            }else{ ?>
                <div class="login-success">
                    <strong style="color:#888"><?php echo $_SESSION['user']['customer_username']; ?> </strong>
                    <i style="color:#318"><?php echo $_SESSION['success']; ?></i>
                    <a href="onlineshop.php?logout='1'" style="color: red">Logout</a>
                </div>
            <?php } ?>
            

        </div>
        <div class="wrapper">
            <div class="banner">             
            </div>
            
            <nav class="navigation">
                <ul class="nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#">Electronics</a></li>
                    <li><a href="#">Motors</a></li>
                    <li><a href="#">Sports</a></li>
                    <li><a href="#">Fashion</a></li>
                    <li><a href="#">About</a></li>
                </ul>
            </nav>
            
            <div class="content">

                <?php 
                    if($_SESSION['user']['user_type'] == 'admin'){
                        include('admin_home.php');}
                ?>
                <h2> LAST ADDED PRODUCTS </h2>
                <?php search(); ?>
                <?php showProduct(); ?>

                
            </div>
            
            <div class="sidebar">
                <?php add_to_cart(); ?>
                <table>
                    <tr>
                        <th>Product Name</th>
                        <th>Product Quantity</th>
                        <th>Product Price</th>
                        <th>Total</th>
                    </tr>
                    <?php 
                        if(empty($_SESSION['shopping_cart'])){
                            $total = 0;
                            foreach($_SESSION['shopping_cart'] as $keys => $values){
                    ?>
                    <tr>
                        <td> <?php echo $values['item_name'];?></td>
                        <td> <?php echo $values['item_price'];?></td>
                        <td> <?php echo $values['item_quantity'];?></td>
                        <td> <?php echo number_format($values['item_price'] * $values['item_quantity']); ?></td>
                    </tr>
                    <?php $total = $total + ($values['item_price'] * $values['item_quantity']) ?>;
                    <tr>
                        <td> 
                            <?php echo number_format($total); ?>
                        </td>
                    </tr>
                <?php }

                }?>
                </table>
            </div>
            
            <div class="footer">
                <p></p>
            <div>
        </div>
    </body>
</html>