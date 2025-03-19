<?php

    session_start();
    require 'vendor/autoload.php';

    if (!isset($_POST['signup-username']) || !isset($_POST['signup-password'])) {
        $_SESSION['signup_error'] = "Missing username or password";
        header("Location: sign-up.php");
        exit;
    }

    $username = trim($_POST['signup-username']);
    $password = trim($_POST['signup-password']);

    $mongoClient = new MongoDB\Client("mongodb+srv://admin:123@cluster0.tz018.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0");

    $db = $mongoClient->tienda_online;
    $collection = $db->users;

    $existingUser = $collection->findOne(['username' => $username]);
    if ($existingUser) {
        $_SESSION['signup_error'] = "Username already taken";
        header("Location: sign-up.php");
        exit;
    }

    $result = $collection->insertOne([
        'username' => $username,
        'password' => $password,
        'role' => 'user',
        'wishlist' => []
    ]);

    if ($result->getInsertedCount() === 1) {
        header("Location: login.php");
        exit;
    } else {
        $_SESSION['signup_error'] = "Registration failed. Please try again.";
        header("Location: sign-up.php");
        exit;
    }
    
?>