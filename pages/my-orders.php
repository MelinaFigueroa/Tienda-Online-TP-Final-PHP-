<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit;
}
require '../includes/config.php';
$user_id = $_SESSION['user_id'];

// Consulta para obtener las órdenes del usuario actual
$sql = 'SELECT orders.id, products.name, products.image_url, orders.quantity, orders.order_date 
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/styles.css">
</head>

<body class="bg-gray-100 font-Poppins">
    <?php include '../includes/header.php'; ?>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Mis Órdenes</h1>
        <div class="row">
            <?php foreach ($orders as $order) : ?>
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm">
                        <img src="<?php echo htmlspecialchars($order['image_url']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($order['name']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($order['name']); ?></h5>
                            <p class="card-text">Cantidad: <?php echo htmlspecialchars($order['quantity']); ?></p>
                            <p class="card-text">Fecha de Orden: <?php echo htmlspecialchars($order['order_date']); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <a href="../pages/home.php" class="btn btn-primary mt-4">Volver</a>
    </div>
    <?php include '../includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>