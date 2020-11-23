<?php

$categoryID = 1;

$dsn = 'mysql:host=localhost;dbname=my_guitar_shop1';
$username = 'root';
$password = '';

try {
    $db = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    echo "<p>An error occured while connecting to the database: $error_message</p>";
}



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
        <h1>Product Manager</h1>
    </header>
    <div class="container">
        <section class="section-header">
            <h2>Product List</h2>
        </section>
        <aside>
            <nav>
                <h3>Categories</h3>
                <ul>
                    <li><a href="">Guitars</a></li>
                    <li><a href="">Basses</a></li>
                    <li><a href="">Drums</a></li>
                </ul>
            </nav>
        </aside>
        <main>
            <h3>Basses</h3>
            <table>
                <thead>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th></th>
                </thead>
                <tbody>
                    <?php
                    $query = 'SELECT productID, productName, price 
                                  FROM products
                                  WHERE categoryID = :category_id;';
                    $statement = $db->prepare($query);
                    $statement->bindValue(':category_id', $categoryID);
                    $statement->execute();
                    $products = $statement->fetchAll();
                    $statement->closeCursor();

                    foreach ($products as $product) {
                    ?>
                        <tr>
                            <td><?php echo $product['productID'] ?></td>
                            <td><?php echo $product['productName'] ?></td>
                            <td>$<?php echo $product['price'] ?>.00</td>
                            <td><button>Delete</button></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a href="">Add Product</a>
        </main>
    </div>

    <footer>&copy; 2010 My Guitar Shop, Inc.</footer>

</body>

</html>