<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit;
}

require '../includes/config.php';

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    header('Location: index.php');
    exit;
} else {
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $product = $stmt->fetch();
    if (!$product) {
        header('Location: index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Producto</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<body class="bg-gray-100 font-Poppins">
    <?php include '../includes/header.php'; ?>
    <div class="container mt-5">
        <div class="card mx-auto" style="max-width: 500px;">
            <div class="card-header bg-white">
                <h1 class="text-2xl font-bold mb-4">Eliminar Producto</h1>
            </div>
            <div class="card-body">
                <p>¿Estás seguro de que quieres eliminar el siguiente producto?</p>
                <p><strong>Nombre:</strong> <?php echo htmlspecialchars($product['name']); ?></p>
                <p><strong>Descripción:</strong> <?php echo htmlspecialchars($product['description']); ?></p>
                <p><strong>Precio:</strong> <?php echo htmlspecialchars($product['price']); ?></p>
                <form method="POST" action="delete.php?id=<?php echo $id; ?>">
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                    <a href="../admin/edit.php" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
    <?php include '../includes/footer.php'; ?>
    <!-- Bootstrap JS y Popper.js (opcional) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-fg6WAXJu0w61/3fC2G41xtJGKvVbz0jnWSZ+4KJO6Bh7jzAlN5K9fY6+qj5BcTEf" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
