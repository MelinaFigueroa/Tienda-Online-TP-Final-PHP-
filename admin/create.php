<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'config.php';
    
    // Obtener los datos del formulario
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

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
            $sql = "INSERT INTO products (name, description, price, image_url) VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$name, $description, $price, $image_path]);

            header('Location: index.php');
        } else {
            echo "Solo se permiten archivos JPG, JPEG, PNG y GIF.";
        }
    } else {
        echo "Hubo un error al cargar la imagen.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Crear Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white p-8 rounded shadow-lg w-96">
        <h1 class="text-2xl font-bold mb-4">Crear Producto</h1>
        <form method="POST" action="create.php" enctype="multipart/form-data">
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="name">Nombre:</label>
                <input type="text" id="name" name="name" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" placeholder="Nombre del producto">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="description">Descripción:</label>
                <textarea id="description" name="description" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" placeholder="Descripción del producto"></textarea>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="price">Precio:</label>
                <input type="number" id="price" name="price" step="0.01" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" placeholder="Precio del producto">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="image">Imagen:</label>
                <input type="file" id="image" name="image" required accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
            </div>
            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md">Crear Producto</button>
        </form>
        <a href="index.php" class="block text-center mt-2 text-blue-500 hover:underline">Volver</a>
    </div>
</div>
</body>
</html>
