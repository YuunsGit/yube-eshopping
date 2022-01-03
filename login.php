<?php
    session_start();

    $conn = mysqli_connect("localhost", "root", "", "yube");
    
    if (!$conn) {
        die("Connection has been failed");
    }

    if(isset($_SESSION['usern'])) {
        header('Location: index.php');
    }
    
    if(isset($_POST['logout'])) {
        session_destroy();
        header('Location: index.php');
    }
?>

<html>

<head>
    <title>yu&be | Sign in</title>
    <link rel="stylesheet" type="text/css" href="login-style.css">
    <link rel="stylesheet" type="text/css" href="common-style.css">
    <link rel="icon" type="image/png" href="./images/favicon.png">
</head>

<body>
    <div class="wrapper">
        

        <!-- HEADER -->


        <div class="upper">
            <div><b>Need help?</b> call us! <span class="number">+90 542 324 65 45</span></div>
            <div class="social-media">
                <a href="https://www.instagram.com/yemrekpnk/" target="_blank"><div class="instagram">Instagram</div></a>
                <a href="https://www.youtube.com/c/AnkaraBilim%C3%9Cniversitesi" target="_blank"><div class="youtube">YouTube</div></a>
                <a href="https://twitter.com/ankarabilimuni" target="_blank"><div class="twitter">Twitter</div></a>
                <a href="https://www.facebook.com/ankarabilimuni" target="_blank"><div class="facebook">Facebook</div></a>
            </div>
        </div>
        <div class="header">
            <a href="index.php"><img src="images/logo.png" alt="logo" class="logo"></a>
            <a href="login.php" class="login">Sign in</a>
        </div>
        <nav>
            <b><ul class="nav-links">
                <li><a href="./index.php">Home</a></li>
                <li><a href="./about.php">About</a></li>
                <li><a href="./contact.php">Contact</a></li>
                <li><a href="./products.php">Products</a></li>
            </ul></b>
        </nav>
    </div>


    <!-- LOGIN AND REGISTER -->


    <div class="forms">
        <div class="login-section">
            <form class="login-form" method="post" action="">
                <h1>Sign in</h1>
                <?php
                    if(isset($_POST['lsubmit'])) {
                        if ($_POST['luser'] != "" && $_POST['lpass'] != "") {
                            $query = "SELECT count(*) AS count FROM users WHERE username='".$_POST['luser']."' AND password='".$_POST['lpass']."'";

                            $result = mysqli_query($conn, $query);
                            $row = mysqli_fetch_array($result);
                            
                            $count = $row['count'];

                            if($count > 0) {
                                $_SESSION['usern'] = $_POST['luser'];
                                header('Location: index.php');
                            }
                            else {
                                echo "<span class='err'>Username or password is invalid</span><br>";
                            }
                        }
                        else {
                            echo "<span class='err'>You didn't enter your username or password</span><br>";
                        }
                    }
                ?>
                <input type="textbox" placeholder="Username" class="username" name="luser" autocomplete="off"/>
                <input type="password" placeholder="Password" class="password" name="lpass" autocomplete="off"/>
                <input type="submit" value="SIGN IN" name="lsubmit" class="submit">
            </form>
        </div>
        <div class="register-section">
            <form class="register-form" method="post" action="">
                <h1>Register</h1>
                <?php
                    if(isset($_POST['rsubmit'])) {
                        if ($_POST['ruser'] != "" && $_POST['rpass1'] != "" && $_POST['rpass2'] != "") {
                            $query = "SELECT count(*) AS count FROM users WHERE username='".$_POST['ruser']."'";

                            $result = mysqli_query($conn, $query);
                            $row = mysqli_fetch_array($result);

                            $count = $row['count'];

                            if($count > 0) {
                                echo "<span class='err'>This username already has been taken</span><br>";
                            }

                            else {
                                if($_POST['rpass1'] == $_POST['rpass2']) {
                                    $insertion_query = "INSERT INTO users (username, password) VALUES ('".$_POST['ruser']."', '".$_POST['rpass1']."')";
                                    if(mysqli_query($conn, $insertion_query)) {
                                        echo "<span class='succ'>You've been registered successfully</span><br>";
                                    }
                                }
                                else {
                                    echo "<span class='err'>Passwords are not same</span><br>";
                                }
                            }
                        }
                        else {
                            echo "<span class='err'>You didn't enter your username or password</span><br>";
                        }
                    }
                ?>
                <input type="textbox" placeholder="Username" class="username" name="ruser" autocomplete="off"/>
                <input type="password" placeholder="Password" class="password" name="rpass1" autocomplete="off"/>
                <input type="password" placeholder="Type Password Again" class="password"  name="rpass2" autocomplete="off"/>
                <input type="submit" value="REGISTER" name="rsubmit" class="submit">
            </form>
        </div>
    </div>


    <!-- FOOTER -->


    <footer>
        <div class="sections">
            <div class="about-info">
                <h2>INFORMATION</h2>
                <ul>
                    <li><a href="index.php">Home Page</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                    <li><a href="products.php">Our Products</a></li>
                </ul>
            </div>
            <div class="about-shipping">
                <h2>SHIPPING & DELIVERY</h2>
                <p>
                    Our shipping and delivery is provided by yu&be shipping.
                    You will reach your order in 2 to 4 days.
                    The shipping is free for over $200 purchases.
                </p>
            </div>
            <div class="about-media">
                <h2>FOLLOW US</h2>
                <ul>
                    <li><a href="https://www.instagram.com/yemrekpnk/">Instagram</a></li>
                    <li><a href="https://www.youtube.com/c/AnkaraBilim%C3%9Cniversitesi">YouTube</a></li>
                    <li><a href="https://twitter.com/ankarabilimuni">Twitter</a></li>
                    <li><a href="https://www.facebook.com/ankarabilimuni">Facebook</a></li>
                </ul>
            </div>
        </div>
        <div class="copyright">
            &copy; yu&be. All rights reserved. &bull; Designed by <b>Buket Bozkurt</b> & <b>Yunus Emre Kepenek</b>
        </div>
    </footer>

</body>

</html>