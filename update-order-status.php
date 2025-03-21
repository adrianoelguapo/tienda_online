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

    // Actualizamos el estado del pedido a "rejected"
    $orderUpdateResult = $ordersCollection->updateOne(
        ['_id' => $objectId],
        ['$set' => ['state' => 'rejected']]
    );
    
    // Para cada producto del pedido, sumamos de vuelta la cantidad solicitada al stock
    if (isset($order['products'])) {
        $products = is_array($order['products']) ? $order['products'] : iterator_to_array($order['products']);
        foreach ($products as $prod) {
            if (isset($prod['_id']) && isset($prod['quantity'])) {
                // Convertir _id a ObjectId si es necesario
                if ($prod['_id'] instanceof MongoDB\BSON\ObjectId) {
                    $prodId = $prod['_id'];
                } else {
                    try {
                        $prodId = new MongoDB\BSON\ObjectId((string)$prod['_id']);
                    } catch (Exception $e) {
                        continue;
                    }
                }
                // Convertir la cantidad a entero
                $qty = (int)$prod['quantity'];
                // Incrementamos el stock en la cantidad correspondiente
                $productsCollection->updateOne(
                    ['_id' => $prodId],
                    ['$inc' => ['stock' => $qty]]
                );
            }
        }
    }
    
    // Usamos getMatchedCount para validar que se encontró el pedido, 
    // ya que getModifiedCount puede ser 0 si el estado ya estaba en "rejected"
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