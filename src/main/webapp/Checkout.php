<?php
include('./admin_pages/database.php');

$query = 'SELECT * FROM cart';
$statement = $db->prepare($query);
$statement->execute();
$products = $statement->fetchAll();
$statement->closeCursor();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
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

        .checkout-form-label {
            margin: .5em;
            padding: .5em;
        }
        #address1, #address2, #ccn, #cardholder{
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


        .checkout-button {
            background-color: gray;
            border: none;
            text-align: center;
            color: white;
            padding: 10px 25px;
        }

        .cart-product-image {
            border-style: solid;
            height: 15rem;
            width: 12rem;
            float: left;
        }

        .money {
            font-family: sans-serif;
            margin: 5px;
            text-align: right;
            font-size: 22px;

        }

        table, th, td {
            border: 1px solid gray;
            padding: 3px;
        }

        table {
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }

        .checkout_page {
            display: flex;
        }


    </style>
</head>
<body>
<nav>
    <h1 class="title">StoreName</h1>
    <ul class="links">
        <li><a href="index.php" style="text-decoration: none; color: white">Home</a></li>
        <li><a href="all-items.php"style="text-decoration: none; color: white">Store</a></li>
        <li><a href="AboutUs.html" style="text-decoration: none; color: white">About</a></li>
        <li><a href="Contact.html" style="text-decoration: none; color: white">Contact</a></li>
    </ul>
    <ul class="icons">
        <li><a href="search-page.php"><img src="search-icon.svg" alt="" class="top-icon"></a></li>
        <li><a href="http://localhost:8080/Group_4300_Project_war_exploded/Login.jsp"><img src="profile-icon.svg" alt="" class="top-icon" id="entry"></a></li>
        <li><a href="ShoppingCart.php"><img src="cart-icon.svg" alt="" class="top-icon"></a></li>
    </ul>
</nav>

<div class="checkout_page">
    <main>
        <form class="checkout-form" action="OrderConfirmation.php" method="post">
            <!-- This section is for the address information-->
            <h2 class="shippingAdd">Shipping Address</h2>
            <label class="checkout-form-label" for="address1">Address 1</label><br>
            <input type="text" class="checkout-fields" id="address1" name="address1" required/><br>

            <label class="checkout-form-label" for="address2">Address 2</label><br>
            <input type="text" class="checkout-fields" id="address2" name="address2"/><br>

            <label class="checkout-form-label" for="city" id="cityLabel">City</label>
            <label class="checkout-form-label" for="state" id="stateLabel">State</label>
            <label class="checkout-form-label" for="zip-code" id="zipLabel">Zip Code</label><br>

            <input type="text" class="checkout-fields" id="city" name="city" required/>
            <input type="text" class="checkout-fields" id="state" name="state" required/>
            <input type="text" class="checkout-fields" id="zip-code" name="state" maxlength="5" required/><br>

            <!-- This section is for payment information-->
            <h2 class="paymentInfo">Payment Information</h2>
            <label class="checkout-form-label" for="ccn">Card Number</label><br>
            <input type="text" class="checkout-fields" id="ccn" name="ccn"
                   maxlength="19" placeholder="xxxx-xxxx-xxxx-xxxx" required><br>

            <label class="checkout-form-label" for="cardholder">Cardholder Name</label><br>
            <input type="text" class="checkout-fields" id="cardholder" name="cardholder" required/><br>

            <label class="checkout-form-label" for="cvv">CVV</label>
            <label class="checkout-form-label" for="expiration">Expiration Date</label><br>

            <input type="text" class="checkout-fields" id="cvv" name="cvv" maxlength="3" required/>
            <!-- Might change expiration date to a select field, validation would be easier -->
            <input type="text" class="checkout-fields" id="expiration" name="expiration"
                   maxlength="5" placeholder="xx/xx" required/><br>

            <input type="submit" class="checkout-button" id="checkout-button" name="checkout-button" value="PLACE ORDER"/>
        </form>

    </main>

    <aside class="overview">
        <?php $num_items = 0; ?>
        <?php foreach ($products as $product) : ?>
            <?php $num_items++; ?>
        <?php endforeach; ?>
        <h2><?php echo $num_items; ?> Items</h2>
        <table class="table-cart">
            <tbody>
            <tr>
                <th style="text-align: left;"></th>
                <th style="text-align: left;">Name</th>
                <th style="text-align: left;">Product ID</th>
                <th style="text-align: right;">Quantity</th>
                <th style="text-align: right;">Price</th>
                <!--<th style="text-align: center;">Remove</th>-->
            </tr>
            <?php $total_price = 0; ?>

            <?php foreach ($products as $product) : ?>
                <?php $price = $product["quantity"] * $product["price"]; ?>
                <tr>
                    <td><img src="<?php echo $product["imgUrl"]; ?>" class="cart-product-image" /></td>
                    <td><?php echo $product["name"]; ?></td>
                    <td><?php echo $product["productID"]; ?></td>
                    <td><?php echo $product["quantity"]; ?></td>
                    <td><?php echo "$" . $product["price"]; ?></td>
                </tr>
                <?php $total_price += ($product["price"] * $product["quantity"]); ?>

            <?php endforeach; ?>

            </tbody>
        </table>
        <br>
        <p class="money">Sub-total: <?php echo "$" . $total_price; ?></p>
        <p class="money">Shipping: <?php echo "$" . $shipping_price = 10; ?></p>
        <p class="money">Tax: <?php echo "$" . $tax = ($total_price + $shipping_price) * 0.07; ?></p><br>
        <p class="money">Total: <?php echo "$" . ($total_price + $shipping_price + $tax); ?></p>
    </aside>
</div>

<footer>Copyright &copy; 2020</footer>

</body>
</html>