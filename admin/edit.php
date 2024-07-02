<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit;
}

require '../includes/config.php';

$id = $_GET['id'];
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Procesar la imagen solo si se ha cargado una nueva
    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array(strtolower($image_extension), $allowed_extensions)) {
            $image_path = '../uploads/' . $image_name;
            move_uploaded_file($image_tmp, $image_path);

            $sql = "UPDATE products SET name = ?, description = ?, price = ?, image_url = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$name, $description, $price, $image_path, $id]);
        } else {
            $error_message = "Solo se permiten archivos JPG, JPEG, PNG y GIF.";
        }
    } else {
        $sql = "UPDATE products SET name = ?, description = ?, price = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $description, $price, $id]);
    }

    header('Location: index.php');
    exit;
} else {
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $product = $stmt->fetch();
}

if (!$product) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/favicon.ico" type="image/x-icon">
    <title>Editar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/styles.css">
</head>

<body class="bg-gray-100 font-Poppins">
    <?php include '../includes/header.php'; ?>
    <div class="container mt-5">
        <div class="card mx-auto" style="max-width: 500px;">
            <div class="card-header bg-white">
                <h1 class="text-2xl font-bold mb-4">Editar Producto</h1>
            </div>
            <div class="card-body">
                <?php if (!empty($error_message)) : ?>
                    <div class="alert alert-danger mb-3">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>
                <form method="POST" action="edit.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre:</label>
                        <input type="text" id="name" name="name" required class="form-control" value="<?php echo htmlspecialchars($product['name']); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Imagen:</label>
                        <input type="file" id="image" name="image" accept="image/*" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descripción:</label>
                        <textarea id="description" name="description" required class="form-control"><?php echo htmlspecialchars($product['description']); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Precio:</label>
                        <input type="number" id="price" name="price" step="0.01" required class="form-control" value="<?php echo htmlspecialchars($product['price']); ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar Producto</button>
                </form>
                <a href="../admin/create.php" class="btn btn-link mt-2">Volver</a>
            </div>
        </div>
    </div>
    <?php include '../includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-fg6WAXJu0w61/3fC2G41xtJGKvVbz0jnWSZ+4KJO6Bh7jzAlN5K9fY6+qj5BcTEf" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>