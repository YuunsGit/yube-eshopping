<?php
    $conn = mysqli_connect("localhost", "root", "", "yube");
    if (!$conn) {
        die("Connection has been failed");
    }
?>

<script type="text/javascript">
    $(document).ready(function() {

        // REMOVE BUTTON

        $(".remove").click(function() {
            var id = $(this).parent().parent().attr("id")
            var itemsInCart = JSON.parse(localStorage.getItem("cartItems"))

            localStorage.setItem("cartCount", localStorage.getItem("cartCount")-itemsInCart[id])
            delete itemsInCart[id]
            localStorage.setItem("cartItems", JSON.stringify(itemsInCart))

            location.reload()
        })

        // QUANTITY CHANGE

        $(".quantity").change(function() {
            // UPDATE cartItems
            var max = parseInt($(this).attr("max"))
            var newVal = parseInt($(this).val())
            if(newVal > max) {
                window.alert("You've reached maximum amount of stock!")
                $(this).val(max)
            }
            newVal = (newVal > max) ? max : newVal
            var id = $(this).parent().parent().attr("id")
            var itemsInCart = JSON.parse(localStorage.getItem("cartItems"))

            itemsInCart[id] = newVal
            localStorage.setItem("cartItems", JSON.stringify(itemsInCart))

            // UPDATE cartCount
            var itemCount = 0
            for(const one in itemsInCart) {
                itemCount += itemsInCart[one]
            }
            localStorage.setItem("cartCount", itemCount)
            $(".count").text(itemCount)

            // UPDATE Amount
            var price = $(this).parent().parent().find(".price").text().substring(1)
            var amount = parseFloat(newVal*price)
            var amountRounded = Math.round(amount*10)/10
            $(this).parent().parent().find(".amount").text("$"+amountRounded)

            // UPDATE Total Amount
            var allAmount = $(this).parent().parent().parent().find(".amount").text()
            var amounts = allAmount.split("$")
            var totalAmount = 0
            for(const one of amounts) {
                if(one == '') continue
                var actualAmount = parseFloat(one)
                totalAmount += actualAmount
            }
            var totalRounded = Math.round(totalAmount*10)/10
            
            $(this).parent().parent().parent().parent().find(".total").html("TOTAL = <b>$"+totalRounded+"</b>")
        })
        
        // POPUP CLOSE

        $(".ok").click(function() {
            location.reload()
        })

        // BUY

        $(".buy button").click(function() {
            $.ajax({
                method: "POST",
                url: "clear-cart.php",
                data: {items: localStorage.getItem("cartItems")},
                success: function(data) {
                    $(".execute").html(data)
                }
            }).done(function() {
                localStorage.setItem("cartCount", 0)
                localStorage.removeItem("cartItems")

                $(".popup").show()
            })
        })
    })
</script>

<table>
    <thead>
        <tr>
            <th></th>
            <th class="product-th">Product</th>
            <th>Name</th>
            <th class="quantity-th">Quantity</th>
            <th>Price</th>
            <th class="right-text">Amount</th>
        </tr>
    </thead>

    <tbody>
        <?php
            $query = "SELECT * FROM products";
            $result = mysqli_query($conn, $query);

            $cartItems = json_decode($_POST['items'], true);
            foreach($cartItems as $item => $count) {
                foreach($result as $product) {
                    if($item == $product['id']) {
                        $id = $product['id'];
                        $name = $product['name'];
                        $price = $product['price'];
                        $stock = $product['stock'];

                        echo "
                        <tr id='".$id."'>
                            <td><img src='images/icons/remove.png' alt='remove' class='remove'></td>
                            <td><img src='images/products/".$id.".jpg' alt='".$id."' class='product-img'></td>
                            <td><div class='name'>".$name."</div></td>
                            <td><input type='number' class='quantity' value='".$count."' min='1' max='".$stock."'></td>
                            <td><div class='price'>$".$price."</div></td>
                            <td><div class='amount right-text'>$".($price*$count)."</div></td>
                        </tr>
                        ";
                    }
                }
            }
        ?>
    </tbody>

    <tfoot>
        <tr>
            <td colspan="5" class="bottom"></td>
            <td align="right" class="bottom">
                <div class="total">
                    TOTAL =
                    <?php
                        $total = 0;
                        foreach($cartItems as $item => $count) {
                            foreach($result as $product) {
                                if($item == $product['id']) {
                                    $price = $product['price'];
                                    $total += $count*$price;
                                }
                            }
                        }
                        echo "<b>$".$total."</b>";
                    ?>
                </div>
            </td>
        </tr>
    </tfoot>
</table>

<div class="execute"></div>

<div class="buy">
    <button type="button">Confirm & Buy</button>
</div>

<div class="popup">
    <div class="confirm">
        <b class="received">Your order has been received.</b>
        <br>
        <b class="ok">OK</b>
    </div>
</div>