<?php

include('./admin_pages/database.php');

$productID = filter_input(INPUT_GET, 'productID', FILTER_VALIDATE_INT);

$query = 'SELECT * FROM products WHERE productID = :productID;';
$statement = $db->prepare($query);
$statement->bindValue(':productID', $productID);
$statement->execute();
$product = $statement->fetch();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>TDC Outfitters | <?php echo $product['name']; ?></title>

    <link rel="stylesheet" href="styles.css">

    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        main {
            padding: 2rem 10rem;
            height: 100%;
        }

        .product-page {
            padding: 2.5rem 0;
            display: flex;
            height: 100%;
        }

        .product-details {
            width: 40%;
        }

        .product-name {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .product-image {
            margin-right: 5rem;
        }

        .product-group {
            display: flex;
            font-size: 1.5rem;
            font-weight: 500;
            margin-bottom: 1rem;
        }

        .product-label {
            width: 20%;
        }

        p {
            width: 20%;
        }

        input {
            width: 2.5rem;
            height: 2rem;
            padding: .5rem;
            text-align: right;
        }

        input[type=submit] {
            margin-top: 1rem;
            width: 10rem;
            height: 3rem;
            background-color: #404040;
            border: none;
            color: white;
            text-align: center;
        }

        input[type=submit]:hover {
            transform: scale(1.1);
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
    <main>
        <div class="product-page">
            <div class="product-image">
                <img src="<?php echo $product['imgUrl'] ?>" alt="" class="product-image">
            </div>

            <div class="product-details">
                <h2 class="product-name">
                    <?php echo $product['name'] ?>
                </h2>
                <div class="product-group">
                    <p class="product-label">Color:</p>
                    <p style="text-transform: capitalize;"><?php echo $product['color'] ?></p>
                </div>
                <div class="product-group">
                    <p class="product-label">Price:</p>
                    <p> $<?php echo $product['price'] ?>.00</p>
                </div>
                <form action="add-to-cart.php" method="POST">
                    <input type="hidden" name="productID" value="<?php echo $productID ?>">
                    <input type="hidden" name="name" value="<?php echo $product['name'] ?>">
                    <input type="hidden" name="imgUrl" value="<?php echo $product['imgUrl'] ?>">
                    <input type="hidden" name="price" value="<?php echo $product['price'] ?>">
                    <div class="product-group">
                        <label for="" class="product-label">Size:</label>
                        <select name="productSize" id="">
                            <option value="XS">XS</option>
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                        </select>
                    </div>
                    <div class="product-group">
                        <label class="product-label">Quantity:</label>
                        <input type="number" name="productQuantity" min="0">
                    </div>

                    <input type="submit" value="Add To Cart">
                </form>
            </div>
        </div>
    </main>
    <footer>Copyright &copy; 2020</footer>
</body>

</html>