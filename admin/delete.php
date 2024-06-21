<!-- Delete - Eliminar productos -->
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
require 'config.php';
$id = $_GET['id'];

$sql = "DELETE FROM products WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

header('Location: index.php');
?>
