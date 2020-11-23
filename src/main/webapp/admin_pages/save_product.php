<?php
// Get the product data
$category_id = filter_input(
    INPUT_POST,
    'category_id',
    FILTER_VALIDATE_INT
);

$product_id = filter_input(
    INPUT_POST,
    'product_id',
    FILTER_VALIDATE_INT
);

$name = filter_input(INPUT_POST, 'name');
$imgUrl = filter_input(INPUT_POST, 'imgUrl');
$quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);
$price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
$color = filter_input(INPUT_POST, 'color');
// Validate inputs
if (
    $category_id == null || $category_id == false || $product_id == null || $product_id == false || $name == null
    || $imgUrl == null || $quantity == null || $quantity == false
    || $price == null || $price == false || $color == null
) {
    $error = 'Category ID: ' . $category_id . '<br> Product ID: ' . $product_id . '<br> Name: ' . $name . '<br> ImgURL: ' . $imgUrl . '<br> Quantity: ' . $quantity . '<br> Color: ' . $color . '<br> Price: ' . $price;
    include('error.php');
} else {
    require_once('database.php');

    // Add the product to the database  
    $query = 'UPDATE products
              SET
                name = :name,
                imgUrl = :imgUrl,
                quantity = :quantity,
                price = :price,
                color = :color
              WHERE
                productID = :productID';
    $statement = $db->prepare($query);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':imgUrl', $imgUrl);
    $statement->bindValue(':quantity', $quantity);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':color', $color);
    $statement->bindValue(':productID', $product_id);
    $statement->execute();
    $statement->closeCursor();
    // Display the Product List page
    include('index.php');
}
