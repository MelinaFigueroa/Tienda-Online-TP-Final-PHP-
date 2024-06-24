<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit;
}
require '../includes/config.php';
$user_id = $_SESSION['user_id'];

// Consulta para obtener las órdenes del usuario actual
$sql = 'SELECT orders.id, products.name, orders.quantity, orders.order_date 
        FROM orders 
        JOIN products ON orders.product_id = products.id 
        WHERE orders.user_id = ?';
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$orders = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/favicon.ico" type="image/x-icon">
    <title>Mis Pedidos - PinguiShop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<body class="bg-gray-100 font-Poppins">
    <?php include '../includes/header.php'; ?>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Mis Órdenes</h1>
        <ul class="space-y-4">
            <?php foreach ($orders as $order): ?>
                <li class="bg-white p-4 rounded-lg shadow">
                    <h2 class="text-xl font-semibold text-gray-800">Producto: <?php echo htmlspecialchars($order['name']); ?></h2>
                    <p class="text-gray-600">Cantidad: <?php echo htmlspecialchars($order['quantity']); ?></p>
                    <p class="text-gray-600">Fecha de Orden: <?php echo htmlspecialchars($order['order_date']); ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
        <a href="../pages/home.php" class="text-blue-500 hover:underline mt-6 inline-block">Volver</a>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>
</html>
