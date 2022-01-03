<?php
    session_start();

    $conn = mysqli_connect("localhost", "root", "", "yube");
    
    if(!$conn) {
        die("Connection has been failed");
    }

    if(!isset($_SESSION['usern'])) {
        header('Location: index.php');
    }
    else if($_SESSION['usern'] !== "admin") {
        header('Location: index.php');
    }
    
    if(isset($_POST['logout'])) {
        session_destroy();
        header('Location: index.php');
    }
?>

<html>

<head>
    <title>yu&be | Admin Panel</title>
    <link rel="stylesheet" type="text/css" href="panel-style.css">
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
                <li><a href="./products.php">Products</a></li>
            </ul></b>
        </nav>


        <!-- PRODUCTS -->

        <form action="" method="post">
            <div class="save">
                <input type="submit" value="Save Changes" name="submit">
            </div>
            <?php
                $query = "SELECT * FROM products";
                $result = mysqli_query($conn, $query);

                if(isset($_POST["submit"])) {
                    foreach($result as $product) {
                        $id = $product['id'];
                        $update_query = "UPDATE products SET stock='".$_POST[$id]."' WHERE id='".$id."'";
                        mysqli_query($conn, $update_query);
                    }
                    echo "<span class='succ'>You've saved the changes successfully</span><br>";
                }
            ?>
            <table>
                <thead>
                    <tr>
                        <th class="product-th">Product</th>
                        <th>Name</th>
                        <th class="quantity-th">Stock</th>
                        <th>Price</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                        $query = "SELECT * FROM products";
                        $result = mysqli_query($conn, $query);

                        foreach($result as $product) {
                            $id = $product['id'];
                            $name = $product['name'];
                            $price = $product['price'];
                            $stock = $product['stock'];

                            echo "
                            <tr id='".$id."'>
                                <td><img src='images/products/".$id.".jpg' alt='".$id."' class='product-img'></td>
                                <td><div class='name'>".$name."</div></td>
                                <td><input type='number' name='".$id."' class='stock' value='".$stock."' min='0'></td>
                                <td><div class='price'>$".$price."</div></td>
                            </tr>
                            ";
                        }
                    ?>
                </tbody>
            </table>
        </form>

        <div class="top" onclick="window.scrollTo({top: 0, behavior: 'smooth'})">&uarr;</div>
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