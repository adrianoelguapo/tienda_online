<?php

    session_start();
    header('Content-Type: application/json');

    if(!isset($_POST['login-username']) || !isset($_POST['login-password'])){
        echo json_encode(['success' => false, 'error' => 'Missing username or password']);
        exit;
    }

    $username = $_POST['login-username'];
    $password = $_POST['login-password'];

    require 'vendor/autoload.php';

    $mongoClient = new MongoDB\Client("mongodb+srv://admin:123@cluster0.tz018.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0");
    $db = $mongoClient->tienda_online;
    $collection = $db->users;

    $user = $collection->findOne(['username' => $username]);

    if($user && $user['password'] === $password){
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        echo json_encode(['success' => true, 'role' => $user['role']]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid username or password']);
    }

?>