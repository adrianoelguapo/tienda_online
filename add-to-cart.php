<?php

    session_start();
    header('Content-Type: application/json');

    if (!isset($_SESSION['username'])) {
        echo json_encode(['success' => false, 'error' => 'User not logged in']);
        exit;
    }

    if (!isset($_POST['product_id'])) {
        echo json_encode(['success' => false, 'error' => 'No product ID provided']);
        exit;
    }

    require 'vendor/autoload.php';

    $mongoClient = new MongoDB\Client("mongodb+srv://admin:123@cluster0.tz018.mongodb.net/?retryWrites=true&w=majority");
    $db = $mongoClient->tienda_online;
    $usersCollection = $db->users;
    $productsCollection = $db->products;

    $productId = $_POST['product_id'];

    try {
        $objectId = new MongoDB\BSON\ObjectId($productId);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => 'Invalid product ID']);
        exit;
    }

    $product = $productsCollection->findOne(['_id' => $objectId]);
    if (!$product) {
        echo json_encode(['success' => false, 'error' => 'Product not found']);
        exit;
    }

    $username = $_SESSION['username'];
    $result = $usersCollection->updateOne(
        ['username' => $username],
        ['$push' => ['cart' => $product]]
    );

    if ($result->getModifiedCount() === 1) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Could not add product to cart']);
    }

?>
