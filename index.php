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
    <title>yu&be | Home Page</title>
    <link rel="stylesheet" type="text/css" href="home-style.css">
    <link rel="stylesheet" type="text/css" href="common-style.css">
    <link rel="icon" type="image/png" href="./images/favicon.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">

        // CART ADDING

        $(document).ready(function() {
            var cartNum = localStorage.getItem("cartCount")
            if(cartNum) {
                $(".count").text(cartNum)
            }

            $(".buy").click(function() {
                var id = $(this).attr("id")

                var user = "<?php 
                    $session = (isset($_SESSION['usern'])) ? $_SESSION['usern'] : '';
                    echo $session;
                ?>"
                
                if(user) {
                    var count = parseInt(localStorage.getItem("cartCount"))
                    var items = localStorage.getItem("cartItems")

                    if(count) {
                        localStorage.setItem("cartCount", count + 1)
                        $(".count").text(count + 1)
                    }
                    else {
                        localStorage.setItem("cartCount", 1)
                        $(".count").text(1)
                    }

                    if(items) {
                        var cartItems = JSON.parse(localStorage.getItem("cartItems"))
                        cartItems[id] = (cartItems[id]) ? (cartItems[id] + 1) : 1
                        localStorage.setItem("cartItems", JSON.stringify(cartItems))
                    }
                    else {
                        var cartItems = {}
                        cartItems[id] = 1
                        localStorage.setItem("cartItems", JSON.stringify(cartItems))
                    }

                    $(this).text("Added")
                    $(this).prop('disabled', true);
                    $(this).attr('class', 'added');
                }
                else {
                    window.location.href = "login.php"
                }
            })
        })

        // SLIDER
        
        var toShow = 1;
        show(toShow);

        function next(n) {
            show(toShow += n);
        }

        function current(n) {
            show(toShow = n);
        }

        function show(n) {
            var slides = document.getElementsByClassName("slide");

            if (n > slides.length) {
                toShow = 1
            }
            if (n < 1) {
                toShow = slides.length
            }

            for (var i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }

            slides[toShow-1].style.display = "block";
        }

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
        <div class="header"">
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
                <li><a href="./index.php" id="active">Home</a></li>
                <li><a href="./about.php">About</a></li>
                <li><a href="./contact.php">Contact</a></li>
                <li><a href="./products.php">Products</a></li>
            </ul></b>
        </nav>


        <!-- HOME PAGE -->


        <div class="slide-container">
            <a href="products.php">
            <div class="slide" id="first">
                <img src="./images/sale1.png" alt="sale1">
            </div>
            <div class="slide" onclick="next(1)">
                <img src="./images/sale4.png" alt="sale2">
            </div>
            <div class="slide" onclick="next(1)">
                <img src="./images/sale2.png" alt="sale3">
            </div>
            <div class="slide" onclick="next(1)">
                <img src="./images/sale3.png" alt="sale4">
            </div>
            </a>
            <a class="prev" onclick="next(-1)">&#10094;</a>
            <a class="next" onclick="next(1)">&#10095;</a>
        </div>
        <div class="categories-sale">
            <ul class="categories">
                <h3>Categories</h3>
                <li><a href="products.php#displays" id="displays">Monitors</a></li>
                <li><a href="products.php#laptops" id="laptops">Laptops</a></li>
                <li><a href="products.php#tablets" id="tablets">Tablets</a></li>
                <li><a href="products.php#printers" id="printers">Printers</a></li>
                <li><a href="products.php#mice" id="mice">Mice</a></li>
            </ul>
            <div class="sale">
                <div class="sale-text">
                    <p>FREE SHIPPING</p>
                    <b>OVER $200</b>
                </div>
            </div>
        </div>
        <h1 class="products-header">Best Selling<a href="products.php"><span class="all-products">See all products &rarr;</span></a></h1>
        <div class="products">
            <div class="product">
                <img src="images/products/mouse3.jpg" alt="mouse3">
                <div class="detail">
                    <div class="name">Ender Laser Mouse 2.4GHz Wireless Bluetooth 4.0</div>
                    <span class="price">$14.90</span>
                    <button type="button" id="mouse3" class="buy">Add to Cart</button>
                </div>
            </div>
            <div class="product">
                <h3 class="new">NEW</h3>
                <img src="images/products/printer4.jpg" alt="printer4">
                <div class="detail">
                    <div class="name">Sevinc Printer With 5 Inkpacks Multiple Papers</div>
                    <span class="price">$84.90</span>
                    <button type="button" id="printer4" class="buy">Add to Cart</button>
                </div>
            </div>
            <div class="product">
                <img src="images/products/mouse6.jpg" alt="mouse6">
                <div class="detail">
                    <div class="name">Wireless Mouse, E-YOOSO Computer Mouse</div>
                    <span class="price">$24.90</span>
                    <button type="button" id="mouse6" class="buy">Add to Cart</button>
                </div>
            </div>
            <div class="product">
                <img src="images/products/display4.jpg" alt="display4">
                <div class="detail">
                    <div class="name">Sceptre Curved 27" 75Hz LED Monitor HDMI VGA</div>
                    <span class="price">$130.00</span>
                    <button type="button" id="display4" class="buy">Add to Cart</button>
                </div>
            </div>
            <div class="product" id="last">
                <h3 class="new">NEW</h3>
                <img src="images/products/laptop5.jpg" alt="laptop5">
                <div class="detail">
                    <div class="name">1920x1080 2G Business 16.9' USB AMOLED 8GB Multimedia</div>
                    <span class="price">$268.90</span>
                    <button type="button" id="laptop5" class="buy">Add to Cart</button>
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