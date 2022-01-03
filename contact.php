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
    <title>yu&be | Contact Us</title>
    <link rel="stylesheet" type="text/css" href="contact-style.css">
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
                <li><a href="./about.php">About</a></li>
                <li><a href="./contact.php" id="active">Contact</a></li>
                <li><a href="./products.php">Products</a></li>
            </ul></b>
        </nav>


        <!-- CONTACT -->


        <div class="branches-wrapper">
            <div class="branches">
                <img src="images/branch1.png" alt="">
                <div class="detail">
                    <b>Ankara Armada AVM</b><br>
                    <p class="adress">Beştepeler Mahallesi Eskişehir Yolu (Dumlupınar Cad.) No: 6 B Blok 64/A Söğütözü, Ankara</p>
                    <span class="number">+90 533 461 28 55</span>
                </div>
            </div>
            <div class="branches">
                <img src="images/branch2.png" alt="">
                <div class="detail">
                    <b>Ankara Selanik</b><br>
                    <p class="adress">Eti Mah. Celal Bayar Bulvarı 78/A 06930, Ankara</p>
                    <span class="number">+90 563 546 54 25</span>
                </div>
            </div>
            <div class="branches">
                <img src="images/branch3.png" alt="">
                <div class="detail">
                    <b>Adana Forum AVM</b><br>
                    <p class="adress">Oymaagac Mahallesi 5062.Sokak No:44 Kumsmall / Kocasinan, Adana</p>
                    <span class="number">+90 589 478 65 98</span>
                </div>
            </div>
            <div class="branches">
                <img src="images/branch4.png" alt="">
                <div class="detail">
                    <b>Kayseri Forum AVM</b><br>
                    <p class="adress">Yeni Mah. Öğretmenler Blv. 87071 Sk. No:501200 Seyhan, Kayseri</p>
                    <span class="number">+90 564 548 96 25</span>
                </div>
            </div>
            <div class="branches">
                <img src="images/branch5.png" alt="">
                <div class="detail">
                    <b>İstanbul Teknopark</b><br>
                    <p class="adress">Aydınlı Birlik OSB Mahallesi 1 Nolu Cad. No:8/3 Tuzla, İstanbul</p>
                    <span class="number">+90 524 456 25 65</span>
                </div>
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