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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/favicon.ico" type="image/x-icon">
    <title>Panel de Administración - PinguiShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/styles.css">
</head>

<body class="bg-light font-Poppins">
    <?php include '../includes/header.php'; ?>
    <div class="container py-8">
        <h1 class="text-dark mb-4">Panel de Administración</h1>
        <a href="create.php" class="btn btn-primary mb-4">Crear Nuevo Producto</a>

        <h2 class="mb-2">Listado de Productos</h2>
        <table class="table table-striped table-hover shadow-sm rounded">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product['name']); ?></td>
                        <td><?php echo htmlspecialchars($product['description']); ?></td>
                        <td>$<?php echo htmlspecialchars($product['price']); ?></td>
                        <td>
                            <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="img-thumbnail" style="max-width: 100px;">
                        </td>
                        <td>
                            <a href="edit.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-sm btn-outline-primary me-2">Editar</a>
                            <a href="delete.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-sm btn-outline-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php include '../includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>