<?php
require_once('database.php');
$product_id = filter_input(
    INPUT_POST,
    'product_id',
    FILTER_VALIDATE_INT
);
$category_id = filter_input(
    INPUT_POST,
    'category_id',
    FILTER_VALIDATE_INT
);

$query = 'SELECT *
    FROM categories
    ORDER BY categoryID';
$statement = $db->prepare($query);
$statement->execute();
$categories = $statement->fetchAll();
$statement->closeCursor();

$query = 'SELECT * FROM products WHERE productID = :product_id';
$statement1 = $db->prepare($query);
$statement1->bindValue(':product_id', $product_id);
$statement1->execute();
$product = $statement1->fetch();
$statement1->closeCursor();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>TDC Outfitters | Edit Product</title>
</head>

<body>
    <header>
        <a href="index.php" class="title-link">
            <h1>TDC Outfitters | Edit Product</h1>
        </a>
    </header>
    <div class="container">
        <section class="section-header">
            <h2>Edit Product</h2>
        </section>
        <main>
            <form action="save_product.php" method="post" class="edit-form">
                <label>Category:</label>
                <select name="category_id">
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?php echo $category['categoryID']; ?>">
                            <?php echo $category['categoryName']; ?>
                        </option>
                    <?php endforeach; ?>
                </select> <br>

                <input type="hidden" name="product_id" value="<?php echo $product['productID'] ?>">

                <label>Name:</label>
                <input type="text" name="name" value="<?php echo $product['name'] ?>"><br>

                <label>imgUrl:</label>
                <input type="text" name="imgUrl" value="<?php echo $product['imgUrl'] ?>"><br>

                <label>Quantity:</label>
                <input type="text" name="quantity" value="<?php echo $product['quantity'] ?>"><br>

                <label>Price:</label>
                <input type="text" name="price" value="<?php echo $product['price'] ?>"><br>

                <label>Color:</label>
                <input type="text" name="color" value="<?php echo $product['color'] ?>"><br>

                <label>&nbsp;</label>
                <input type="submit" value="Save Product"><br>
            </form>
        </main>

        <a href="index.php" id="product-link">View Product List</a>
    </div>

    <footer>&copy; <?php echo date('Y') ?> TDC Outfitters, Inc.</footer>

</body>

</html>