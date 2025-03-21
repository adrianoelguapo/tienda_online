<?php

    session_start();
    header('Content-Type: application/json');

    if (!isset($_SESSION['username'])) {
        echo json_encode(['success' => false, 'error' => 'User not logged in']);
        exit;
    }

    if (!isset($_POST['product_id']) || !isset($_POST['quantity'])) {
        echo json_encode(['success' => false, 'error' => 'Missing product ID or quantity']);
        exit;
    }

    $productId = $_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
    if($quantity < 1) {
        $quantity = 1;
    }

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
        ['username' => $username, 'cart._id' => $objectId],
        ['$set' => ['cart.$.quantity' => $quantity]]
    );

    if ($result->getModifiedCount() === 1) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Could not update cart quantity']);
    }
    
?>