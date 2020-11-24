<?php
session_start();
$connect = mysqli_connect("localhost", "root", "", "storedb1");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>TDC Outfitters | Checkout</title>
    <link rel="stylesheet" href="styles.css">

    <style>
        main {
            padding-left: 8em;
            width: 50%;
        }

        .overview {
            float: right;
            width: 50%;
            margin: 2em;
            padding: 2em;
            border: thin solid gray;
            text-align: center;
        }

        .checkout-form {
            margin: 2em;
            padding: 2em;
            border: thin solid gray;
            text-align: center;
        }

        .checkout-fields {
            margin: 1em;
            height: 2.5em;
        }

        .numItems {
            border-bottom: thin solid gray;
        }

        .checkout-form-label {
            margin: .5em;
            padding: .5em;
        }

        #address1,
        #address2,
        #ccn,
        #cardholder {
            width: 35em;
        }

        #city {
            width: 16.5em;
            float: left;
        }

        #cityLabel {
            padding-left: 4em;
            margin-left: 1em;
        }

        #stateLabel {
            padding-left: 8.5em;
        }

        #zipLabel {
            padding-left: 2.5em;
        }

        #state {
            width: 4em;
            float: left;
        }

        #zip-code {
            width: 8em;
            float: left;
        }

        #cvv {
            width: 6em;
            float: left;
        }

        #expiration {
            width: 16em;
            float: left;
        }
    </style>
</head>

<body>
    <nav>
        <h1 class="title">TDC Outfitters</h1>
        <ul class="links">
            <li><a href="index.php" style="text-decoration: none; color: white">Home</a></li>
            <li><a href="all-items.php" style="text-decoration: none; color: white">Store</a></li>
            <li><a href="AboutUs.html" style="text-decoration: none; color: white">About</a></li>
            <li><a href="Contact.html" style="text-decoration: none; color: white">Contact</a></li>
        </ul>
        <ul class="icons">
            <li><a href="search-page.php"><img src="search-icon.svg" alt="" class="top-icon"></a></li>
            <li><a href="http://localhost:8080/Group_4300_Project_war_exploded/Login.jsp"><img src="profile-icon.svg" alt="" class="top-icon" id="entry"></a></li>
            <li><a href="ShoppingCart.html"><img src="cart-icon.svg" alt="" class="top-icon"></a></li>
        </ul>
    </nav>


    <main>
        <form class="checkout-form" action="OrderConfirmation.php" method="post">
            <!-- This section is for the address information-->
            <h2 class="shippingAdd">Shipping Address</h2>
            <label class="checkout-form-label" for="address1">Address 1</label><br>
            <input type="text" class="checkout-fields" id="address1" name="address1" required /><br>

            <label class="checkout-form-label" for="address2">Address 2</label><br>
            <input type="text" class="checkout-fields" id="address2" name="address2" /><br>

            <label class="checkout-form-label" for="city" id="cityLabel">City</label>
            <label class="checkout-form-label" for="state" id="stateLabel">State</label>
            <label class="checkout-form-label" for="zip-code" id="zipLabel">Zip Code</label><br>

            <input type="text" class="checkout-fields" id="city" name="city" required />
            <input type="text" class="checkout-fields" id="state" name="state" required />
            <input type="text" class="checkout-fields" id="zip-code" name="state" maxlength="5" required /><br>

            <!-- This section is for payment information-->
            <h2 class="paymentInfo">Payment Information</h2>
            <label class="checkout-form-label" for="ccn">Card Number</label><br>
            <input type="text" class="checkout-fields" id="ccn" name="ccn" maxlength="19" placeholder="xxxx-xxxx-xxxx-xxxx" required><br>

            <label class="checkout-form-label" for="cardholder">Cardholder Name</label><br>
            <input type="text" class="checkout-fields" id="cardholder" name="cardholder" required /><br>

            <label class="checkout-form-label" for="cvv">CVV</label>
            <label class="checkout-form-label" for="expiration">Expiration Date</label><br>

            <input type="text" class="checkout-fields" id="cvv" name="cvv" maxlength="3" required />
            <!-- Might change expiration date to a select field, validation would be easier -->
            <input type="text" class="checkout-fields" id="expiration" name="expiration" maxlength="5" placeholder="xx/xx" required /><br>

            <input type="submit" class="checkout-button" id="checkout-button" name="checkout-button" value="PLACE ORDER" />
        </form>

    </main>

    <aside class="overview">
        <!-- Will be easier to properly implement once database is running
             Whole area is basically a placeholder   -->
        <h2 class="numItems">X Items</h2>
        <table class="table-cart">
            <tbody>
                <tr>
                    <th style="text-align: left;">Name</th>
                    <th style="text-align: left;">Product ID</th>
                    <th style="text-align: right;">Quantity</th>
                    <th style="text-align: right;">Price</th>
                    <th style="text-align: center;">Remove</th>
                </tr>
                <?php
                foreach ($_SESSION["cart_product"] as $product) {
                    $price = $product["quantity"] * $product["price"];
                ?>
                    <tr>
                        <td><img src="<?php echo $product["image"]; ?>" class="cart-product-image" />
                            <?php echo $product["name"]; ?></td>
                        <td><?php echo $product["productID"]; ?></td>
                        <td style="text-align: right;"><?php echo $product["quantity"]; ?></td>
                        <td style="text-align: right;"><?php echo "$" . $product["price"]; ?></td>
                    </tr>
                <?php
                    $total_price += ($product["price"] * $product["quantity"]);
                }
                ?>

            </tbody>
        </table>
        <p>Sub-total: <?php echo $total_price; ?></p>
        <p>Shipping: <?php echo $shipping_price = 25; ?></p>
        <p>Tax: <?php echo ($total_price + $shipping_price) * 0.07; ?></p>
    </aside>

    <footer>Copyright &copy; 2020</footer>

</body>

</html>