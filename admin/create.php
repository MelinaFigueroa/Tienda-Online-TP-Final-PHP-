<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit;
}

require '../includes/config.php';

$error_message = '';

// Obtener todas las categorías disponibles
$sql_categories = 'SELECT * FROM categories';
$stmt_categories = $pdo->query($sql_categories);
$categories = $stmt_categories->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category']; 

    // Procesar la imagen
    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_size = $_FILES['image']['size'];
    $image_error = $_FILES['image']['error'];

    // Verificar que se haya cargado una imagen
    if ($image_error === UPLOAD_ERR_OK) {
        // Obtener la extensión del archivo
        $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);
        // Validar la extensión permitida
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array(strtolower($image_extension), $allowed_extensions)) {
            // Guardar la imagen en la carpeta de uploads
            $image_path = '../uploads/' . $image_name;
            move_uploaded_file($image_tmp, $image_path);

            // Insertar datos en la base de datos
            $sql = "INSERT INTO products (name, description, price, image_url, category_id) VALUES (?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            if ($stmt) {
                $stmt->execute([$name, $description, $price, $image_path, $category_id]);
                header('Location: index.php');
                exit; // Agregar exit para detener la ejecución después de redireccionar
            } else {
                $error_message = "Error al preparar la consulta SQL.";
            }
        } else {
            $error_message = "Solo se permiten archivos JPG, JPEG, PNG y GIF.";
        }
    } else {
        $error_message = "Hubo un error al cargar la imagen.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/favicon.ico" type="image/x-icon">
    <title>Crear Producto - PinguiShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/styles.css">
</head>

<body class="bg-light font-Poppins">
    <?php include '../includes/header.php'; ?>
    <div class="container mt-5">
        <div class="card mx-auto" style="max-width: 500px;">
            <div class="card-header bg-white">
                <h1 class="text-center mb-4">Agregar Producto</h1>
            </div>
            <div class="card-body">
                <?php if (!empty($error_message)) : ?>
                    <div class="alert alert-danger mb-3">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>
                <form method="POST" action="create.php" enctype="multipart/form-data" id="createForm">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre:</label>
                        <input type="text" id="name" name="name" required class="form-control" placeholder="Nombre del producto">
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Imagen:</label>
                        <input type="file" id="image" name="image" required accept="image/*" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descripción:</label>
                        <textarea id="description" name="description" required class="form-control" placeholder="Descripción del producto"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Precio:</label>
                        <input type="number" id="price" name="price" step="0.01" required class="form-control" placeholder="Precio del producto">
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Categoría:</label>
                        <select id="category" name="category" class="form-control" required>
                            <option value="" selected disabled>Selecciona una categoría</option>
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?php echo htmlspecialchars($category['id']); ?>"><?php echo htmlspecialchars($category['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Crear Producto</button>
                </form>
                <a href="index.php" class="btn btn-link mt-3">Volver</a>
            </div>
        </div>
    </div>
    <?php include '../includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        document.getElementById('image').addEventListener('change', function() {
            const imageInput = this;
            const imagePath = imageInput.value;
            const allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

            if (!allowedExtensions.exec(imagePath)) {
                alert('Solo se permiten archivos JPG, JPEG, PNG y GIF.');
                imageInput.value = '';
            }
        });
    </script>
</body>
</html>
