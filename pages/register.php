<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'config.php';
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$username, $password])) {
        echo "Usuario registrado con éxito. <a href='login.php'>Iniciar Sesión</a>";
    } else {
        echo "Error al registrar el usuario.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse - PinguiShop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<body class="bg-gray-100">
    <?php include '../includes/header.php'; ?>
    <div class="container mx-auto mt-8">
        <div class="max-w-md mx-auto bg-white rounded-lg overflow-hidden shadow-lg p-6">
            <h1 class="text-2xl font-bold mb-4 text-center">Registrarse</h1>
            <form method="POST" action="register.php" class="space-y-4">
                <div class="mb-4">
                    <label for="username" class="block text-sm font-medium text-gray-700">Usuario</label>
                    <input type="text" name="username" id="username" placeholder="Ingrese su correo" required class="input-field">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                    <input type="password" name="password" id="password" placeholder="Ingrese su clave" required class="input-field">
                </div>
                <button type="submit" class="btn-primary w-full py-2 px-4 bg-green-500 text-white rounded-md hover:bg-green-600 transition duration-200">Registrarse</button>
            </form>
            <p class="mt-4 text-center">
                ¿Ya tienes una cuenta? <a href="login.php" class="text-blue-500 hover:underline">Inicia sesión aquí</a>
            </p>
        </div>
    </div>
</body>
</html>
