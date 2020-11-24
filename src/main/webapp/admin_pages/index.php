<?php

require('database.php');

/* GET CATEGORY ID */
$categoryID = filter_input(INPUT_GET, 'categoryID', FILTER_VALIDATE_INT);

if ($categoryID == NULL || $categoryID == false) {
    $categoryID = 1;
}

/* GET NAME FOR CATEGORY */
$queryCategory = 'SELECT * FROM categories
                    WHERE categoryID = :categoryID';
$statement1 = $db->prepare($queryCategory);
$statement1->bindValue(':categoryID', $categoryID);
$statement1->execute();
$category = $statement1->fetch();
$categoryName = $category['categoryName'];
$statement1->closeCursor();

/* GET ALL CATEGORIES */
$queryAllCategories = 'SELECT * FROM categories
                            ORDER BY categoryID';
$statement2 = $db->prepare($queryAllCategories);
$statement2->execute();
$categories = $statement2->fetchAll();
$statement2->closeCursor();


/* GET ALL PRODUCTS FOR SET CATEGORY ID */
$queryAllProducts = 'SELECT * 
FROM products
WHERE categoryID = :category_id;';
$statement3 = $db->prepare($queryAllProducts);
$statement3->bindValue(':category_id', $categoryID);
$statement3->execute();
$products = $statement3->fetchAll();
$statement3->closeCursor();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Product Manager | Home</title>
</head>

<body>
    <header>
        <a href="index.php" class="title-link">
            <h1>StoreName Admin</h1>
        </a>
    </header>
    <div class="container">
        <section class="section-header">
            <h2>Product List</h2>
        </section>
        <aside>
            <nav>
                <a href="add_category_form.php" class="header-link">
                    <h3>Categories</h3>
                </a>
                <ul>
                    <?php foreach ($categories as $category) : ?>
                        <li>
                            <a href="index.php?categoryID=<?php echo $category['categoryID']; ?>">
                                <?php echo $category['categoryName'] ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        </aside>
        <main>
            <h3><?php echo $categoryName ?></h3>
            <table>
                <thead>
                    <th>Color</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    <?php
                    foreach ($products as $product) {
                    ?>
                        <tr>
                            <td><?php echo $product['color'] ?></td>
                            <td><?php echo $product['name'] ?></td>
                            <td>$<?php echo $product['price'] ?></td>
                            <td><?php echo $product['quantity'] ?></td>
                            <td>
                                <form action="edit_product.php" method="post">
                                    <input type="hidden" name="product_id" value="<?php echo $product['productID']; ?>">
                                    <input type="hidden" name="category_id" value="<?php echo $product['categoryID']; ?>">
                                    <input type="submit" value="Edit">
                                </form>
                            </td>

                            <td>
                                <form action="delete_product.php" method="post">
                                    <input type="hidden" name="product_id" value="<?php echo $product['productID']; ?>">
                                    <input type="hidden" name="category_id" value="<?php echo $product['categoryID']; ?>">
                                    <input type="submit" value="Delete">
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a href="add_product_form.php">Add Product</a>
        </main>
    </div>

    <footer>&copy; <?php echo date('Y') ?> StoreName, Inc.</footer>

</body>

</html>