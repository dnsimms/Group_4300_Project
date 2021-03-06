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
    <title>TDC Outfitters | Shopping Cart</title>
    <link rel="stylesheet" href="styles.css">

    <style>
        .overview {
            width: 50%;
            margin: 2em;
            padding: 2em;
            border: thin solid gray;
            text-align: center;
        }

        .overview2 {
            width: 30%;
            height: 28vh;
            margin: 2em;
            padding: 2em;
            border: thin solid gray;
            text-align: center;
        }

        .numItems {
            border-bottom: thin solid grey;
        }

        .checkout-button,
        #deleteButton {
            background-color: gray;
            border: none;
            text-align: center;
            color: white;
            padding: 6px 18px;
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

        .shopping_page {
            display: flex;
        }

        table,
        th,
        td {
            border: 1px solid gray;
            padding: 3px;
        }

        table {
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
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
            <li><a href="ShoppingCart.php"><img src="cart-icon.svg" alt="" class="top-icon"></a></li>
        </ul>
    </nav>
    <div class="shopping_page">
        <div class="overview2">

            <form action="Checkout.php" method="post">
                <?php $total_price = 0; ?>
                <?php $num_items = 0; ?>

                <?php foreach ($products as $product) : ?>
                    <?php $price = $product["quantity"] * $product["price"]; ?>
                    <?php $total_price += ($product["price"] * $product["quantity"]); ?>
                    <?php $num_items++; ?>
                <?php endforeach; ?>

                <h2 class="numItems"><?php echo $num_items; ?> Items</h2>

                <p class="money">Sub-total: <?php echo "$" . $total_price; ?></p>
                <p class="money">Shipping: <?php echo "$" . $shipping_price = 10; ?></p>
                <p class="money">Tax: <?php echo "$" . $tax = ($total_price + $shipping_price) * 0.07; ?></p><br>
                <p class="money">Total: <?php echo "$" . ($total_price + $shipping_price + $tax); ?></p>
                <input type="submit" class="checkout-button" id="checkout-button" name="checkout-button" value="CHECKOUT" />
            </form>
        </div>

        <aside class="overview">
            <h2><?php echo $num_items; ?> Items</h2>
            <table class="table-cart">
                <tbody>
                    <tr>
                        <th style="text-align: left;"></th>
                        <th style="text-align: left;">Name</th>
                        <th style="text-align: left;">Product ID</th>
                        <th style="text-align: right;">Quantity</th>
                        <th style="text-align: right;">Price</th>
                        <th style="text-align: center;">Delete?</th>
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
                            <td>
                                <form action="delete-cart-item.php" method="POST">
                                    <input type="hidden" name="cartID" value="<?php echo $product['cartID'] ?>">
                                    <input type="submit" id="deleteButton" value="DELETE FROM CART">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>

        </aside>
    </div>

</body>

<footer>Copyright &copy; 2020</footer>

</html>