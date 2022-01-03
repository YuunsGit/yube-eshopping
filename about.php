<?php
    session_start();

    $conn = mysqli_connect("localhost", "root", "", "yube");
    
    if (!$conn) {
        die("Connection failed: ".mysqli_connect_error());
    }
    
    if(isset($_POST['logout'])) {
        session_destroy();
        header('Location: index.php');
    }
?>

<html>

<head>
    <title>yu&be | About Us</title>
    <link rel="stylesheet" type="text/css" href="about-style.css">
    <link rel="stylesheet" type="text/css" href="common-style.css">
    <link rel="icon" type="image/png" href="./images/favicon.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">
        // CART COUNT

        $(document).ready(function() {
            var cartNum = localStorage.getItem("cartCount")
            if(cartNum) {
                $(".count").text(cartNum)
            }
        })
    </script>
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
            <?php
                if(!isset($_SESSION['usern'])) {
                    echo "<a href='login.php' class='login'>Sign in</a>";
                }
                else {
                    echo "
                    <form action='index.php' method='post'>
                        <input type='submit' name='logout' method='post' class='logout' value='Log out'/>
                    </form>
                    <a href='cart.php' class='cart'>Cart <u class='count'>0</u></a>
                    <span class='welcome'>Welcome <b>".$_SESSION['usern']."</b>!</span>
                    ";
                    if($_SESSION['usern'] == 'admin') {
                        echo "
                        <a href='panel.php' class='panel'>Admin Panel</a>
                        ";
                    }
                }
            ?>
        </div>
        <nav>
            <b><ul class="nav-links">
                <li><a href="./index.php">Home</a></li>
                <li><a href="./about.php" id="active">About</a></li>
                <li><a href="./contact.php">Contact</a></li>
                <li><a href="./products.php">Products</a></li>
            </ul></b>
        </nav>


        <!-- ABOUT -->


        <img src="images/branch.png" alt="branch" class="branch">
        <div class="yube">
            yu&be Shopping has started running on 17th March 2021 in Ankara. yu&be Shopping serves of selling electronical products 
            such as laptops, displays, printers, mouses and so on. It's established by Yunus Emre Kepenek and Buket Bozkurt.
            This website is also developed by Yunus Emre Kepenek and Buket Bozkurt.
        </div>
        <div class="buket-wrapper">
            <div class="buket">
                <h1>Buket Bozkurt</h1>
                <h2>Ankara Science University - Industrial Engineering</h2><br>
                <img src="./images/buket.jpeg" alt="buketbozkurt">
                 <p>Hi! I'm Buket Bozkurt. I study industrial engineering in Ankara Science University aka. Ankara Bilim Üniversitesi.
                    My favourite subject is Web Design and Programming. I live in Ankara and I'm 20 years old.
                    We started running yu&be Shopping on 17th March 2021 with Yunus Emre Kepenek. I am a dependable person who is great at time management.
                    I am always energetic and eager to learn new skills. I am able to handle multiple tasks on a daily basis. I am responsible from development and management
                    section of yu&be corparation. Since we started yu&be with Yunus Emre Kepenek, I'm very busy.
                 </p>
            </div>
        </div>
        <div class="yunus-wrapper">
            <div class="yunus">
                <h1>Yunus Emre Kepenek</h1>
                <h2>Ankara Science University - Software Engineering</h2><br>
                <img src="./images/yunus.jpeg" alt="yunusemrekepenek">
                <p>Hi! I'm Yunus Emre Kepenek. I study software engineering in Ankara Science University aka. Ankara Bilim Üniversitesi.
                    My favourite subject is Web Design and Programming. I live in Ankara and I'm 19 years old.
                    We started running yu&be Shopping on 17th March 2021 with Buket Bozkurt. I am responsible from development and research
                    section of yu&be corparation. Since we started yu&be with Buket Bozkurt, I'm very busy. I'm very creative person and I can
                    create very creative UI/UX designs. I am also a designer who creates artwork online.
                </p>
            </div>
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