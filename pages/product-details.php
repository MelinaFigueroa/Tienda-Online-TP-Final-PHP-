<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit;
}
require '../includes/config.php';

if (!isset($_GET['product_id'])) {
    header('Location: pages/home.php');
    exit;
}

$product_id = $_GET['product_id'];

$sql = 'SELECT * FROM products WHERE id = ?';
$stmt = $pdo->prepare($sql);
$stmt->execute([$product_id]);
$product = $stmt->fetch();

if (!$product) {
    header('Location: pages/index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/favicon.ico" type="image/x-icon">
    <title><?php echo htmlspecialchars($product['name']); ?> - Detalles del Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/styles.css">
</head>

<body class="bg-gray-100 font-Poppins">
    <?php include '../includes/header.php'; ?>
    <div class="container mx-auto px-4 py-8">
        <main>
            <section id="main" class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800"><?php echo htmlspecialchars($product['name']); ?></h2>
                <div class="flex flex-col md:flex-row items-center justify-center md:justify-start">
                    <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="rounded-lg mb-4 md:mr-8 md:max-w-md">
                    <div class="md:w-1/2">
                        <p class="text-gray-600"><?php echo htmlspecialchars($product['description']); ?></p>
                        <p class="text-gray-800 font-bold">Precio: $<?php echo htmlspecialchars($product['price']); ?></p>
                        <form action="../includes/order.php" method="POST" class="mt-4 flex items-center">
                            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
                            <label class="mr-2">Cantidad:</label>
                            <input type="number" name="quantity" value="1" min="1" class="w-16 px-2 py-1 border border-gray-300 rounded-md">
                            <button type="submit" class="ml-2 bg-blue-500 text-white px-4 py-2 hover:bg-blue-600 rounded-md">Agregar al Carrito</button>
                        </form>
                    </div>
                </div>
            </section>
        </main>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>

</html>