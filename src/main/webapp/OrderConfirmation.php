<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>TDC Outfitters | Order Confirmation</title>
    <link rel="stylesheet" href="styles.css">

    <style>
        main {
            padding: 2rem 10rem;
        }
    </style>
</head>

<body>
    <nav>
        <h1 class="title">TDC Outfitters</h1>
        <ul class="links">
            <li><a href="index.php" style="text-decoration: none; color: white">Home</a></li>
            <li><a href="all-items.php" style="text-decoration: none; color: white">Store</a></li>
            <li><a href="AboutUs.html" style="text-decoration: none; color: white">About</a></li>
            <li><a href="Contact.html" style="text-decoration: none; color: white">Contact</a></li>
        </ul>
        <ul class="icons">
            <li><a href="search-page.php"><img src="search-icon.svg" alt="" class="top-icon"></a></li>
            <li><a href="http://localhost:8080/Group_4300_Project_war_exploded/Login.jsp"><img src="profile-icon.svg" alt="" class="top-icon" id="entry"></a></li>
            <li><a href="ShoppingCart.php"><img src="cart-icon.svg" alt="" class="top-icon"></a></li>
        </ul>
    </nav>
    <main>
        <h2>Your order has been confirmed!</h2><br>

        <h3>Thank you for shopping at TDC Outfitters!</h3>
        <p>Click on the store button to continue shopping.</p>



    </main>
</body>

</html>

<?php

include('./admin_pages/database.php');

$query = 'DELETE FROM cart';
$statement = $db->prepare($query);
$statement->execute();
$statement->closeCursor();

?>