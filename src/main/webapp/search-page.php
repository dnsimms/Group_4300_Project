<?php

include('./admin_pages/database.php');

$searchTerm = filter_input(INPUT_GET, 'searchTerm', FILTER_DEFAULT);

$query = "SELECT * FROM `products` WHERE (name LIKE '%$searchTerm%') OR (color LIKE '%$searchTerm%') ";
$statement = $db->prepare($query);
$statement->execute();
$products = $statement->fetchAll();
$statement->closeCursor();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>TDC Outfitters | Search</title>

    <link rel="stylesheet" href="styles.css">

    <style>
        main {
            padding: 4rem 10rem;
        }

        .section-title {
            text-align: center;
            margin-bottom: 2rem;
            color: #404040;
        }

        .result-text {
            text-align: center;
            margin-bottom: 2rem;
            font-weight: 400;
            font-size: 1.25rem;
        }

        .search-items {
            display: flex;
            flex-wrap: wrap;
        }

        .clothing-item {
            width: 12rem;
            height: 15rem;
            background-color: #404040;
            margin-bottom: 2.5rem;
            margin-right: 2.5rem;
            margin-left: 1.25rem;
            opacity: 1;
            transition: .5s ease;
        }

        .clothing-item:hover {
            transform: scale(1.1);
        }

        a {
            text-decoration: none;
            color: white;
        }

        a:visited {
            color: white;
        }

        a:hover {
            text-decoration: underline;
        }

        form {
            display: flex;
            margin-bottom: 2rem;
        }

        input[type="text"] {
            width: 85%;
            height: 3rem;
            padding: 1rem;
            font-size: 1rem;
        }

        input[type="submit"] {
            width: 15%;
            color: white;
            background-color: #404040;
            border: none;
        }

        .middle {
            transform: translate(30%, -500%);
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
        <h2 class="section-title">FIND YOUR PRODUCT</h2>
        <?php if ($searchTerm != null || $searchTerm != '') { ?>
            <h3 class="result-text">Found <?php echo count($products) ?> result<?php if (count($products) > 1) { ?>s <?php } ?> for the term "<?php echo $searchTerm ?>"</h3>
        <?php } ?>
        <form action="search-page.php" method="get">
            <input type="text" name="searchTerm">
            <input type="submit" value="SEARCH">
        </form>
        <div class="search-items">
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