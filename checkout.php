<?php

    session_start();
    header('Content-Type: application/json');
    require 'vendor/autoload.php';

    if (!isset($_SESSION['username'])) {
        echo json_encode(['success' => false, 'error' => 'User not logged in']);
        exit;
    }

    $username = $_SESSION['username'];
    $mongoClient = new MongoDB\Client("mongodb+srv://admin:123@cluster0.tz018.mongodb.net/?retryWrites=true&w=majority");
    $db = $mongoClient->tienda_online;
    $usersCollection = $db->users;
    $ordersCollection = $db->orders;
    $productsCollection = $db->products;

    $user = $usersCollection->findOne(['username' => $username]);
    if (!$user) {
        echo json_encode(['success' => false, 'error' => 'User not found']);
        exit;
    }

    $cart = isset($user['cart']) ? $user['cart'] : [];
    if (empty($cart)) {
        echo json_encode(['success' => false, 'error' => 'Cart is empty']);
        exit;
    }

    $orderProducts = [];
    $subtotal = 0;
    $insufficientProducts = [];

    foreach ($cart as $item) {
        try {
            $prodId = new MongoDB\BSON\ObjectId((string)$item['_id']);
        } catch (Exception $e) {
            continue;
        }
        
        $productDetails = $productsCollection->findOne(['_id' => $prodId]);
        if ($productDetails) {
            $productArray = (array)$productDetails; // Convertir a array
            $quantity = isset($item['quantity']) ? (int)$item['quantity'] : 1;
            
            $availableStock = (int)$productArray['stock'];
            if ($availableStock < $quantity) {
                $insufficientProducts[] = $productArray['name'];
            }

            $productArray['quantity'] = $quantity;

            $price = (float)$productArray['price'];
            $totalItem = $price * $quantity;
            $subtotal += $totalItem;
            
            $orderProducts[] = $productArray;
        }
    }

    if (!empty($insufficientProducts)) {
        $msg = "Insufficient stock for: " . implode(", ", $insufficientProducts);
        echo json_encode(['success' => false, 'error' => $msg]);
        exit;
    }

    $note = isset($_POST['orderNotes']) ? trim($_POST['orderNotes']) : '';

    foreach ($orderProducts as $product) {
        $prodId = $product['_id'];
        $quantity = $product['quantity'];
        $updateResult = $productsCollection->updateOne(
            ['_id' => $prodId],
            ['$inc' => ['stock' => -$quantity]]
        );
    }

    $order = [
        'user' => $username,
        'products' => $orderProducts,
        'state' => 'pending',
        'total' => (int)round($subtotal),
        'note' => $note
    ];

    $result = $ordersCollection->insertOne($order);

    if ($result->getInsertedCount() === 1) {
        $usersCollection->updateOne(
            ['username' => $username],
            ['$set' => ['cart' => []]]
        );
        echo json_encode(['success' => true, 'message' => 'Order placed successfully']);
    } else {
        echo json_encode(['success' => false, 'error' => 'Could not place order']);
}

?>