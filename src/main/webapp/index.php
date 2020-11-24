<?php

include('./admin_pages/database.php');

$query = 'SELECT * FROM products LIMIT 6';

$statement = $db->prepare($query);
$statement->execute();
$products = $statement->fetchAll();
$statement->closeCursor();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>TDC Outfitters | Home</title>

    <link rel="stylesheet" href="styles.css">

    <style>
        main {
            padding: 2rem 10rem;
        }

        .section-title {
            text-align: center;
            margin-top: 8rem;
            margin-bottom: 2rem;
            color: #404040;
        }

        .featured-items {
            display: flex;
        }

        .clothing-item {
            width: 12rem;
            height: 15rem;
            background-color: #404040;
            margin: 0 2rem;
            opacity: 1;
            transition: .5s ease;
        }

        .clothing-item:hover {
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
        <h2 class="section-title" id="demo">FEATURED ITEMS</h2>
        <div class="featured-items">
            <?php foreach ($products as $product) : ?>
                <div class="clothing-item">
                    <img src="<?php echo $product['imgUrl'] ?>" class="images" width="100%" height="100%">
                    <div class="middle">
                        <form method="get" action="product-page.php">
                            <input type="hidden" name="productID" value="<?php echo $product['productID'] ?>">
                            <button type="submit" class="shopButton" name="shopButton">SHOP</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
    <footer>Copyright &copy; 2020</footer>
</body>

</html>