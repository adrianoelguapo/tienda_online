<?php

    session_start();
    header('Content-Type: application/json');

    if (!isset($_POST['product_id']) || !isset($_POST['quantity'])) {
        echo json_encode(['success' => false, 'error' => 'Missing product_id or quantity']);
        exit;
    }

    $productId = $_POST['product_id'];
    $quantity = (int)$_POST['quantity'];

    require 'vendor/autoload.php';
    $mongoClient = new MongoDB\Client("mongodb+srv://admin:123@cluster0.tz018.mongodb.net/?retryWrites=true&w=majority");
    $db = $mongoClient->tienda_online;
    $productsCollection = $db->products;

    try {
        $prodId = new MongoDB\BSON\ObjectId($productId);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => 'Invalid product ID']);
        exit;
    }

    $result = $productsCollection->updateOne(
        ['_id' => $prodId],
        ['$inc' => ['stock' => $quantity]]
    );

    if($result->getModifiedCount() >= 1){
        echo json_encode(['success' => true, 'message' => 'Stock updated successfully']);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to update stock']);
    }
    
?>
