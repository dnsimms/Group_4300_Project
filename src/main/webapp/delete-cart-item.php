<?php

include('./admin_pages/database.php');

$cartID = filter_input(
    INPUT_POST,
    'cartID',
    FILTER_VALIDATE_INT
);

$query = 'DELETE FROM cart WHERE cartID = :cartID';
$statement = $db->prepare($query);
$statement->bindValue(':cartID', $cartID);
$statement->execute();
$statement->closeCursor();

include('ShoppingCart.php');
