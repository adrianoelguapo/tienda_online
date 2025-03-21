<?php

    session_start();
    require 'vendor/autoload.php';

    if (!isset($_SESSION['username'])) {
        echo json_encode(['success' => false, 'error' => 'User not logged in']);
        exit;
    }

    if (!isset($_POST['product_id'])) {
        echo json_encode(['success' => false, 'error' => 'No product ID provided']);
        exit;
    }

    $productId = $_POST['product_id'];

    try {
        $objectId = new MongoDB\BSON\ObjectId($productId);
    } catch(Exception $e) {
        echo json_encode(['success' => false, 'error' => 'Invalid product ID']);
        exit;
    }

    $mongoClient = new MongoDB\Client("mongodb+srv://admin:123@cluster0.tz018.mongodb.net/?retryWrites=true&w=majority");
    $db = $mongoClient->tienda_online;
    $usersCollection = $db->users;

    $result = $usersCollection->updateOne(
        ['username' => $_SESSION['username']],
        ['$pull' => ['wishlist' => ['_id' => $objectId]]]
    );

    if ($result->getModifiedCount() === 1) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Product not found in wishlist']);
    }
    
?>