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
    <title>Product Manager | Home</title>
</head>

<body>
    <header>
        <a href="index.php" class="title-link">
            <h1>Product Manager</h1>
        </a>
    </header>
    <div class="container">
        <section class="section-header">
            <h2>Category List</h2>
        </section>
        <main>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category) : ?>
                        <tr>
                            <td><?php echo $category['categoryName'] ?></td>
                            <td>
                                <form action="delete_category.php" method="post">
                                    <input type="hidden" name="category_id" value="<?php echo $category['categoryID']; ?>">
                                    <input type="submit" value="Delete">
                                </form>
                            </td>
                        </tr>


                    <?php endforeach; ?>
                </tbody>
            </table>
            <h3>Add Category</h3>
            <form action="add_category.php" method="post" class="add-form">
                <label>Category:</label>
                <input type="text" name="categoryName">
                <input type="submit" value="Add"><br>
            </form>
        </main>

        <a href="index.php" id="product-link">List Products</a>
    </div>

    <footer>&copy; <?php echo date('Y') ?> StoreName, Inc.</footer>

</body>

</html>