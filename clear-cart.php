<?php
    $conn = mysqli_connect("localhost", "root", "", "yube");
    if (!$conn) {
        die("Connection has been failed");
    }

    $query = "SELECT * FROM products";
    $result = mysqli_query($conn, $query);

    $cartItems = json_decode($_POST['items'], true);
    foreach($cartItems as $item => $count) {
        foreach($result as $product) {
            if($item == $product['id']) {
                $newStock = $product['stock']-$count;
                $query = "UPDATE products SET stock='".$newStock."' WHERE id='".$item."'";
                mysqli_query($conn, $query);
            }
        }
    }
?>