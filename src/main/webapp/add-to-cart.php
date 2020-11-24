<?php
// Get the product data
$productID = filter_input(
    INPUT_POST,
    'productID',
    FILTER_VALIDATE_INT
);

$name = filter_input(INPUT_POST, 'name');
$imgUrl = filter_input(INPUT_POST, 'imgUrl');
$price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
$productQuantity = filter_input(INPUT_POST, 'productQuantity', FILTER_VALIDATE_INT);
$productSize = filter_input(INPUT_POST, 'productSize');
// Validate inputs
if (
    $productID == null || $productID == false || $name == null
    || $imgUrl == null || $price == null || $price == false || $productQuantity == null
    || $productQuantity == false || $productSize == false
) {
    $error = 'Invalid inputs! Please return back to home page.';
    include('./admin_pages/error.php');
} else {
    require_once('./admin_pages/database.php');

    // Add the product to the database  
    $query = "INSERT INTO cart (productID, userID, productQuantity, productSize, name, imgUrl, price)
    VALUES                     (:productID, 1, :productQuantity, :productSize, :name, :imgUrl, :price)";
    $statement = $db->prepare($query);
    $statement->bindValue(':productID', $productID);
    $statement->bindValue(':productQuantity', $productQuantity);
    $statement->bindValue(':productSize', $productSize);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':imgUrl', $imgUrl);
    $statement->bindValue(':price', $price);
    $statement->execute();
    $statement->closeCursor();
    // Display the Product List page
    include('index.php');
}
