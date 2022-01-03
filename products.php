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
    <title>yu&be | Products</title>
    <link rel="stylesheet" type="text/css" href="products-style.css">
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
                <li><a href="./contact.php">Contact</a></li>
                <li><a href="./products.php" id="active">Products</a></li>
            </ul></b>
        </nav>


        <!-- PRODUCTS -->
        

        <?php
            // result

            echo "
            <h1 class='products-header' id='displays'>Monitors</h1>
            <div class='products'>
            ";

            $query = "SELECT * FROM products WHERE id LIKE 'display%'";
            $result = mysqli_query($conn, $query);

            foreach($result as $product) {
                $id = $product['id'];
                $name = $product['name'];
                $price = $product['price'];
                $stock = $product['stock'];

                echo "         
                    <div class='product'>
                        <img src='images/products/".$id.".jpg' alt='".$id."' id='displays'>
                        <div class='detail'>
                            <div class='name'>".$name."</div>
                            <span class='price'>$".$price."0</span>
                            ";
                            if($stock == 0) {
                                echo "<button disabled type='button' class='no-stock'>Out of Stock</button>";
                            }
                            else {
                                echo "<button type='button' id='".$id."' class='buy'>Add to Cart</button>";
                            }
                            echo "
                        </div>
                    </div>
                ";
            }
            echo "</div>";


            // LAPTOPS

            echo "
            <h1 class='products-header' id='laptops'>Laptops</h1>
            <div class='products'>
            ";

            $query = "SELECT * FROM products WHERE id LIKE 'laptop%'";
            $result = mysqli_query($conn, $query);

            foreach($result as $product) {
                $id = $product['id'];
                $name = $product['name'];
                $price = $product['price'];
                $stock = $product['stock'];

                echo "         
                    <div class='product'>
                        <img src='images/products/".$id.".jpg' alt='".$id."' id='laptops'>
                        <div class='detail'>
                            <div class='name'>".$name."</div>
                            <span class='price'>$".$price."0</span>
                            ";
                            if($stock == 0) {
                                echo "<button disabled type='button' class='no-stock'>Out of Stock</button>";
                            }
                            else {
                                echo "<button type='button' id='".$id."' class='buy'>Add to Cart</button>";
                            }
                            echo "
                        </div>
                    </div>
                ";
            }
            echo "</div>";


            // MICE

            echo "
            <h1 class='products-header' id='mice'>Mice</h1>
            <div class='products'>
            ";

            $query = "SELECT * FROM products WHERE id LIKE 'mouse%'";
            $result = mysqli_query($conn, $query);

            foreach($result as $product) {
                $id = $product['id'];
                $name = $product['name'];
                $price = $product['price'];
                $stock = $product['stock'];

                echo "         
                    <div class='product'>
                        <img src='images/products/".$id.".jpg' alt='".$id."' id='mice'>
                        <div class='detail'>
                            <div class='name'>".$name."</div>
                            <span class='price'>$".$price."0</span>
                            ";
                            if($stock == 0) {
                                echo "<button disabled type='button' class='no-stock'>Out of Stock</button>";
                            }
                            else {
                                echo "<button type='button' id='".$id."' class='buy'>Add to Cart</button>";
                            }
                            echo "
                        </div>
                    </div>
                ";
            }
            echo "</div>";


            // PRINTERS

            echo "
            <h1 class='products-header' id='printers'>Printers</h1>
            <div class='products'>
            ";

            $query = "SELECT * FROM products WHERE id LIKE 'printer%'";
            $result = mysqli_query($conn, $query);

            foreach($result as $product) {
                $id = $product['id'];
                $name = $product['name'];
                $price = $product['price'];
                $stock = $product['stock'];

                echo "         
                    <div class='product'>
                        <img src='images/products/".$id.".jpg' alt='".$id."'>
                        <div class='detail'>
                            <div class='name'>".$name."</div>
                            <span class='price'>$".$price."0</span>
                            ";
                            if($stock == 0) {
                                echo "<button disabled type='button' class='no-stock'>Out of Stock</button>";
                            }
                            else {
                                echo "<button type='button' id='".$id."' class='buy'>Add to Cart</button>";
                            }
                            echo "
                        </div>
                    </div>
                ";
            }
            echo "</div>";


            // TABLETS

            echo "
            <h1 class='products-header' id='tablets'>Tablets</h1>
            <div class='products'>
            ";

            $query = "SELECT * FROM products WHERE id LIKE 'tablet%'";
            $result = mysqli_query($conn, $query);

            foreach($result as $product) {
                $id = $product['id'];
                $name = $product['name'];
                $price = $product['price'];
                $stock = $product['stock'];

                echo "         
                    <div class='product'>
                        <img src='images/products/".$id.".jpg' alt='".$id."'>
                        <div class='detail'>
                            <div class='name'>".$name."</div>
                            <span class='price'>$".$price."0</span>
                            ";
                            if($stock == 0) {
                                echo "<button disabled type='button' class='no-stock'>Out of Stock</button>";
                            }
                            else {
                                echo "<button type='button' id='".$id."' class='buy'>Add to Cart</button>";
                            }
                            echo "
                        </div>
                    </div>
                ";
            }
            echo "</div>";
        ?>


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
    <div class="top" onclick="window.scrollTo({top: 0, behavior: 'smooth'})">&uarr;</div>
</body>

</html>