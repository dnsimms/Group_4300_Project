<?php
// Get the product data
$category_id = filter_input(
    INPUT_POST,
    'category_id',
    FILTER_VALIDATE_INT
);

$name = filter_input(INPUT_POST, 'name');
$imgUrl = filter_input(INPUT_POST, 'imgUrl');
$price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
$color = filter_input(INPUT_POST, 'color');
// Validate inputs
if (
    $category_id == null || $category_id == false || $name == null
    || $imgUrl == null || $price == null || $price == false || $color == null
) {
    $error = 'Category ID: ' . $category_id . '<br> Name: ' . $name . '<br> ImgURL: ' . $imgUrl . '<br> Quantity: ' . $quantity . '<br> Color: ' . $color . '<br> Price: ' . $price;
    include('error.php');
} else {
    require_once('database.php');

    // Add the product to the database  
    $query = "INSERT INTO products
(name, imgUrl, quantity, price, size, categoryID, color)
VALUES
(:name, :imgUrl, 1, :price, 'M', :category_id, :color)";
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':imgUrl', $imgUrl);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':color', $color);
    $statement->execute();
    $statement->closeCursor();
    // Display the Product List page
    include('index.php');
}
