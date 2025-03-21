<?php

    session_start();
    header('Content-Type: application/json');

    if (!isset($_SESSION['username'])) {
        echo json_encode(['success' => false, 'error' => 'User not logged in']);
        exit;
    }

    if (!isset($_POST['product_id'])) {
        echo json_encode(['success' => false, 'error' => 'Missing product ID']);
        exit;
    }

    $productId = $_POST['product_id'];
    require 'vendor/autoload.php';
    $mongoClient = new MongoDB\Client("mongodb+srv://admin:123@cluster0.tz018.mongodb.net/?retryWrites=true&w=majority");
    $db = $mongoClient->tienda_online;
    $usersCollection = $db->users;
    $username = $_SESSION['username'];

    try {
        $objectId = new MongoDB\BSON\ObjectId($productId);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => 'Invalid product ID']);
        exit;
    }

    $result = $usersCollection->updateOne(
        ['username' => $username],
        ['$pull' => ['cart' => ['_id' => $objectId]]]
    );

    if ($result->getModifiedCount() === 1) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Could not remove product from cart']);
    }
    
?>