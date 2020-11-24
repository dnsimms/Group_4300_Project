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
    <title>StoreName | Home</title>

    <link rel="stylesheet" href="styles.css">

    <style>
        main {
            padding: 2rem 10rem;
            height: 100%;
        }

        .product-page {
            padding: 2.5rem 0;
            display: flex;
            height: 100%;
        }

        .product-image {
            margin-right: 5rem;
        }
    </style>

</head>


<body>
    <nav>
        <h1 class="title">StoreName</h1>
        <ul class="links">
            <li><a href="index.html" style="text-decoration: none; color: white">Home</a></li>
            <li>Store</li>
            <li><a href="AboutUs.html" style="text-decoration: none; color: white">About</a></li>
            <li><a href="Contact.html" style="text-decoration: none; color: white">Contact</a></li>
        </ul>
        <ul class="icons">
            <li><img src="search-icon.svg" alt="" class="top-icon"></li>
            <li><a href="Login.jsp"><img src="profile-icon.svg" alt="" class="top-icon" id="entry"></a></li>
            <li><a href="ShoppingCart.html"><img src="cart-icon.svg" alt="" class="top-icon"></a></li>
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
            </div>
        </div>
    </main>
    <footer>Copyright &copy; 2020</footer>
</body>

</html>