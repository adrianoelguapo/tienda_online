<?php

    session_start();
    header('Content-Type: application/json');

    if (!isset($_POST['order_id']) || !isset($_POST['action'])) {
        echo json_encode(['success' => false, 'error' => 'Missing order_id or action']);
        exit;
    }

    $orderId = $_POST['order_id'];
    $action = $_POST['action'];

    require 'vendor/autoload.php';
    $mongoClient = new MongoDB\Client("mongodb+srv://admin:123@cluster0.tz018.mongodb.net/?retryWrites=true&w=majority");
    $db = $mongoClient->tienda_online;
    $ordersCollection = $db->orders;
    $productsCollection = $db->products;

    try {
        $objectId = new MongoDB\BSON\ObjectId($orderId);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => 'Invalid order ID']);
        exit;
    }

    $order = $ordersCollection->findOne(['_id' => $objectId]);
    if (!$order) {
        echo json_encode(['success' => false, 'error' => 'Order not found']);
        exit;
    }

    if ($action === 'accept') {
        $result = $ordersCollection->updateOne(
            ['_id' => $objectId],
            ['$set' => ['state' => 'accepted']]
        );
        if ($result->getMatchedCount() >= 1) {
            echo json_encode(['success' => true, 'message' => 'Order accepted']);
        } else {
            echo json_encode(['success' => false, 'error' => 'Could not update order']);
        }
        exit;
    } elseif ($action === 'reject') {

        $orderUpdateResult = $ordersCollection->updateOne(
            ['_id' => $objectId],
            ['$set' => ['state' => 'rejected']]
        );
        
        if (isset($order['products'])) {
            $products = is_array($order['products']) ? $order['products'] : iterator_to_array($order['products']);
            foreach ($products as $prod) {
                if (isset($prod['_id']) && isset($prod['quantity'])) {

                    if ($prod['_id'] instanceof MongoDB\BSON\ObjectId) {
                        $prodId = $prod['_id'];
                    } else {
                        try {
                            $prodId = new MongoDB\BSON\ObjectId((string)$prod['_id']);
                        } catch (Exception $e) {
                            continue;
                        }
                    }

                    $qty = (int)$prod['quantity'];

                    $productsCollection->updateOne(
                        ['_id' => $prodId],
                        ['$inc' => ['stock' => $qty]]
                    );
                }
            }
        }
        
        if ($orderUpdateResult->getMatchedCount() >= 1) {
            echo json_encode(['success' => true, 'message' => 'Order rejected and stock updated']);
        } else {
            echo json_encode(['success' => false, 'error' => 'Could not update order']);
        }
        exit;
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid action']);
        exit;
    }
    
?>