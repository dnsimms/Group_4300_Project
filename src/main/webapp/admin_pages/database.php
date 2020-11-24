<?php

    $dsn = 'mysql:host=localhost;dbname=4300_products';
    $username = 'root';
    $password = 'G97t678!';
    
    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('database_error.php');
        exit();
    }
