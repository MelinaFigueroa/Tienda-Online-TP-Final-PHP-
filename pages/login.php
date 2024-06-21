<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require '../includes/config.php';
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: index.php');
        exit;
    } else {
        $error = "Nombre de usuario o contraseña incorrectos";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - PinguiShop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<body class="bg-gray-100">
    <?php include '../includes/header.php'; ?>
    <div class="container mx-auto mt-8">
        <div class="max-w-md mx-auto bg-white rounded-lg overflow-hidden shadow-lg p-6">
            <h1 class="text-2xl font-bold mb-4 text-center">Iniciar Sesión</h1>
            <?php if (isset($error)): ?>
                <p class="error text-red-500 mb-4 text-center"><?php echo $error; ?></p>
            <?php endif; ?>
            <form method="POST" action="login.php" class="space-y-4">
                <div class="mb-4">
                    <label for="username" class="block text-sm font-medium text-gray-700">Usuario</label>
                    <input type="text" name="username" id="username" placeholder="Ingrese su correo" required class="input-field">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                    <input type="password" name="password" id="password" placeholder="Ingrese su clave" required class="input-field">
                </div>
                <button type="submit" class="btn-primary w-full py-2 px-4 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition duration-200">Login</button>
            </form>
            <p class="mt-4 text-center">
                ¿No tienes una cuenta? <a href="register.php" class="text-blue-500 hover:underline">Regístrate aquí</a>
            </p>
        </div>
    </div>
</body>
</html>
