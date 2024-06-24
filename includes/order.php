<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit;
}
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $user_id = $_SESSION['user_id'];
    $quantity = $_POST['quantity'];

    $sql = "INSERT INTO orders (user_id, product_id, quantity) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id, $product_id, $quantity]);

    header('Location: ../pages/index.php');
    exit;
} else {
    header('Location: ../pages/index.php');
    exit;
}
?>
