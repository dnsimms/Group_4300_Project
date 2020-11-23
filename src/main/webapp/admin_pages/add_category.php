<?php
$categoryName = filter_input(INPUT_POST, 'categoryName');

if ($categoryName == null) {
    $error = "Invalid product data. Check all fields and try again.";
    include('error.php');
} else {
    require_once('database.php');

    //Figure out category ID
    $query = 'SELECT categoryID FROM categories ORDER BY categoryID DESC LIMIT 1';
    $statement1 = $db->prepare($query);
    $statement1->execute();
    $category = $statement1->fetch();
    $statement1->closeCursor();
    $category['categoryID']++;
    echo '<script>';
    echo 'console.log(' . json_encode($category, JSON_HEX_TAG) . ')';
    echo '</script>';

    // Add the product to the database  
    $query = 'INSERT INTO categories (categoryID, categoryName) VALUES (:categoryID, :name)';
    $statement = $db->prepare($query);
    $statement->bindValue(':categoryID', $category['categoryID']);
    $statement->bindValue(':name', $categoryName);
    $statement->execute();
    $statement->closeCursor();
    // Display the Product List page
    include('index.php');
}
