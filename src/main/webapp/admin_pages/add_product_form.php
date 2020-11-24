<?php
require('database.php');
$query = 'SELECT *
    FROM categories
    ORDER BY categoryID';
$statement = $db->prepare($query);
$statement->execute();
$categories = $statement->fetchAll();
$statement->closeCursor();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>TDC Outfitters | Add Product</title>
</head>

<body>
    <header>
        <a href="index.php" class="title-link">
            <h1>TDC Outfitters | Add Product</h1>
        </a>
    </header>
    <div class="container">
        <section class="section-header">
            <h2>Add Product</h2>
        </section>
        <main>
            <form action="add_product.php" method="post" class="add-form">
                <label>Category:</label>
                <select name="category_id">
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?php echo $category['categoryID']; ?>">
                            <?php echo $category['categoryName']; ?>
                        </option>
                    <?php endforeach; ?>
                </select> <br>

                <label>Color:</label>
                <input type="text" name="color"><br>

                <label>Name:</label>
                <input type="text" name="name"><br>

                <label>imgUrl:</label>
                <input type="text" name="imgUrl"><br>

                <label>List Price:</label>
                <input type="text" name="price"><br>

                <label>&nbsp;</label>
                <input type="submit" value="Add Product"><br>
            </form>
        </main>

        <a href="index.php" id="product-link">View Product List</a>
    </div>

    <footer>&copy; <?php echo date('Y') ?> TDC Outfitters, Inc.</footer>

</body>

</html>