<?php

require('./admin_pages/database.php');

/* GET CATEGORY ID */
$categoryID = filter_input(INPUT_GET, 'categoryID', FILTER_VALIDATE_INT);

if ($categoryID == NULL || $categoryID == false) {
    $categoryID = 0;
}

/* GET ALL CATEGORIES */
$queryAllCategories = 'SELECT * FROM categories
                            ORDER BY categoryID';
$statement2 = $db->prepare($queryAllCategories);
$statement2->execute();
$categories = $statement2->fetchAll();
$statement2->closeCursor();

if ($categoryID > 0) {
    /* GET NAME FOR CATEGORY */
    $queryCategory = 'SELECT * FROM categories
                        WHERE categoryID = :categoryID';
    $statement1 = $db->prepare($queryCategory);
    $statement1->bindValue(':categoryID', $categoryID);
    $statement1->execute();
    $category = $statement1->fetch();
    $categoryName = $category['categoryName'];
    $statement1->closeCursor();

    /* GET ALL PRODUCTS FOR SET CATEGORY ID */
    $queryAllProducts = 'SELECT * 
    FROM products
    WHERE categoryID = :category_id;';
    $statement3 = $db->prepare($queryAllProducts);
    $statement3->bindValue(':category_id', $categoryID);
    $statement3->execute();
    $products = $statement3->fetchAll();
    $statement3->closeCursor();
} else {
    // Getting all the products
    $query = 'SELECT * FROM products';
    $statement = $db->prepare($query);
    $statement->execute();
    $products = $statement->fetchAll();
    $statement->closeCursor();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>TDC Outfitters | Store</title>

    <link rel="stylesheet" href="styles.css">

    <style>
        main {
            padding: 0 10rem;
        }

        a:visited {
            color: white;
        }

        a:hover {
            text-decoration: underline;
        }

        .section-title {
            text-align: center;
            margin-top: 4rem;
            margin-bottom: 2rem;
            color: #404040;
        }

        .section-title a {
            color: #404040;
            text-transform: uppercase;
        }

        .section-title a {
            color: #404040;
        }

        .all-items {
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

        .category-list {
            display: flex;
            width: 100%;
            height: 3rem;
            margin-bottom: 2rem;
            border: 1px solid black;
            list-style: none;
        }

        .category {
            display: flex;
            padding: 0;
            align-items: center;
            justify-content: center;
            width: 6rem;
            background-color: #404040;
            color: white;
            border-right: 1px solid white;
        }

        .category:hover {
            background-color: white;
            color: #404040;
            border-right: 1px solid #404040;
        }

        .category-link {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-transform: capitalize;
        }

        .category-link:hover {
            color: #404040;
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
        <?php if ($categoryID < 1) { ?>
            <h2 class="section-title">ALL ITEMS</h2>
        <?php } else { ?>

            <h2 class="section-title"><a href="all-items.php"><?php echo $categoryName ?></a></h2>
        <?php } ?>
        <ul class="category-list">
            <?php foreach ($categories as $category) : ?>
                <li class="category">
                    <a href="all-items.php?categoryID=<?php echo $category['categoryID'] ?>" class="category-link">
                        <?php echo $category['categoryName'] ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="all-items">
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