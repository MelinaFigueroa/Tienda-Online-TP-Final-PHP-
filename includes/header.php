<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/favicon.ico" type="image/x-icon">
    <title>PinguiShop - Tienda Online</title>
    <link rel="stylesheet" href="../assets/styles.css"> <!-- Ajusta la ruta según la estructura de tu proyecto -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100" >
    <header id="header" class="bg-secondary text-white py-4 px-6 flex justify-between items-center">
        <img src="../assets/logo-tienda.png" alt="logo de PinguiShop" class="max-w-32 h-auto w-16 md:w-32 lg:w-48">
        <div>
            <h1 class="text-title text-lg">Bienvenido a PinguiShop</h1>
            <p class="text-body">Tu tienda Online</p>
        </div>
        <nav>
            <ul class="flex space-x-4 items-center">
                <li><a href="../pages/home.php" class="text-white hover:text-gray-200">Inicio</a></li>
                <li class="relative group">
                    <a href="#" class="text-white hover:text-gray-200">Categorías</a>
                    <div class="absolute hidden group-hover:block bg-white shadow-lg mt-2 rounded-md">
                        <?php foreach ($categories as $category_id): ?>
                            <?php if (isset($categorias[$category_id])) : ?>
                                <a href="../pages/categoria.php?categoria=<?php echo $categorias[$category_id]; ?>" class="block px-4 py-2 text-gray-800 hover:bg-gray-200"><?php echo $categorias[$category_id]; ?></a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </li>
            </ul>
        </nav>
        <div class="flex items-center space-x-4">
            <?php if (isset($_SESSION['user_id'])) : ?>
                <div>
                    <a href="../pages/my-orders.php" class="text-white hover:text-gray-200 flex items-center">
                        Ir al carrito de compras
                        <img src="../assets/icons/carrito.png" alt="Carrito de compras" class="w-6 h-6 ml-1"> <!-- Ruta al ícono del carrito -->
                    </a>
                </div>
                <div>
                    <a href="../auth/logout.php" class="text-white hover:text-gray-200">Cerrar Sesión</a>
                </div>
                <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') : ?>
                    <div>
                        <a href="../admin/index.php" class="text-white hover:text-gray-200">Panel de Administración</a>
                    </div>
                <?php endif; ?>
            <?php else : ?>
                <a href="login.php" class="text-white hover:text-gray-200">Iniciar Sesión</a>
                <a href="register.php" class="text-white hover:text-gray-200">Registrarse</a>
            <?php endif; ?>
        </div>
    </header>
</body>
</html>
