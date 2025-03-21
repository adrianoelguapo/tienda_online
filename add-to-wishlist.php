<?php

    session_start();
    header('Content-Type: application/json');

    if (!isset($_SESSION['username'])) {
        echo json_encode(['success' => false, 'error' => 'User not logged in']);
        exit;
    }

    if (!isset($_POST['product_id'])) {
        echo json_encode(['success' => false, 'error' => 'Product ID missing']);
        exit;
    }

    $product_id = $_POST['product_id'];

    require 'vendor/autoload.php';

    $mongoClient = new MongoDB\Client("mongodb+srv://admin:123@cluster0.tz018.mongodb.net/?retryWrites=true&w=majority");
    $db = $mongoClient->tienda_online;
    $users = $db->users;
    $products = $db->products;

    try {
        $objectId = new MongoDB\BSON\ObjectId($product_id);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => 'Invalid product ID']);
        exit;
    }

    $product = $products->findOne(['_id' => $objectId]);
    if (!$product) {
        echo json_encode(['success' => false, 'error' => 'Product not found']);
        exit;
    }

    $updateResult = $users->updateOne(
        ['username' => $_SESSION['username']],
        ['$addToSet' => ['wishlist' => $product]]
    );

    if ($updateResult->getModifiedCount() === 1) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Product already in the wishlist']);
    }
    
?>
