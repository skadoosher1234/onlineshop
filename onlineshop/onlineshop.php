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
                <input type="text" name="search">
                <button></button>
            </div>
            <div class="login">
                <form action>
                    <label>Login</label>
                    <input type="text" placeholder="Username">
                    <input type="password" placeholder="Password">
                    <button>Login</button>
                    <a href="">A register?</a>
                </form>
            </div>
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
                <div class="featureCol">
                    <?php echo $content; ?>
                </div>
                <div class="featureCol"></div>
                <div class="featureCol"></div>
                <div class="featureCol"></div>
                <div class="featureCol"></div>
                <div class="featureCol"></div>
                <div class="featureCol"></div>
                <div class="featureCol"></div>
                <div class="featureCol"></div>
                <div class="featureCol"></div>
                <div class="featureCol"></div>
                <div class="featureCol"></div>
                <div class="featureCol"></div>
                <div class="featureCol"></div>
                <div class="featureCol"></div>
                <div class="featureCol"></div>
                <div class="featureCol"></div>
                <div class="featureCol"></div>
                <div class="featureCol"></div>
                <div class="featureCol"></div>
            </div>
            
            <div class="sidebar">
            </div>
            
            <div class="footer">
                <p></p>
            <div>
        </div>
    </body>
</html>
