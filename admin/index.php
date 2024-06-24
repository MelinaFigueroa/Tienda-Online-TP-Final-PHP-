<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit;
}
require '../includes/config.php';

// Consulta para obtener todos los productos
$sql = 'SELECT * FROM products';
$stmt = $pdo->query($sql);
$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../assets/favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - PinguiShop</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<body class="bg-light font-Poppins">
    <?php include '../includes/header.php'; ?>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Panel de Administración</h1>
        <a href="create.php" class="bg-blue-500 text-white px-4 py-2 mb-4 hover:bg-blue-600 rounded-md inline-block">Crear Nuevo Producto</a>
        
        <h2 class="text-xl font-bold text-gray-800 mb-2">Listado de Productos</h2>
        <table class="min-w-full bg-white shadow-md rounded my-6">
            <thead>
                <tr class="text-gray-800 uppercase border-b border-gray-300 bg-gray-200">
                    <th class="text-left py-3 px-4 font-semibold">Nombre</th>
                    <th class="text-left py-3 px-4 font-semibold">Descripción</th>
                    <th class="text-left py-3 px-4 font-semibold">Precio</th>
                    <th class="text-left py-3 px-4 font-semibold">Imagen</th>
                    <th class="text-left py-3 px-4 font-semibold">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product) : ?>
                    <tr class="border-b border-gray-300">
                        <td class="text-left py-3 px-4"><?php echo htmlspecialchars($product['name']); ?></td>
                        <td class="text-left py-3 px-4"><?php echo htmlspecialchars($product['description']); ?></td>
                        <td class="text-left py-3 px-4">$<?php echo htmlspecialchars($product['price']); ?></td>
                        <td class="text-left py-3 px-4">
                            <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="w-32 h-32 object-cover rounded">
                        </td>
                        <td class="text-left py-3 px-4">
                            <a href="edit.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="text-blue-600 hover:text-blue-900 mr-2">Editar</a>
                            <a href="delete.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="text-red-600 hover:text-red-900">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>
</html>
