<?php

    session_start();
    header('Content-Type: application/json');

    if (!isset($_SESSION['username'])) {
        echo json_encode(['success' => false, 'error' => 'Not authenticated']);
        exit;
    }

    require 'vendor/autoload.php';

    $currentUsername = $_SESSION['username'];
    $newUsername = $_POST['username'];
    $newPassword = $_POST['password'];

    $mongoClient = new MongoDB\Client("mongodb+srv://admin:123@cluster0.tz018.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0");
    $db = $mongoClient->tienda_online;
    $collection = $db->users;

    $updateFields = ['username' => $newUsername];
    if (!empty($newPassword)) {
        $updateFields['password'] = $newPassword;
    }

    $result = $collection->updateOne(
        ['username' => $currentUsername],
        ['$set' => $updateFields]
    );

    if ($result->getModifiedCount() > 0) {
        $_SESSION['username'] = $newUsername;
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Update failed or no changes made']);
    }
    
?>