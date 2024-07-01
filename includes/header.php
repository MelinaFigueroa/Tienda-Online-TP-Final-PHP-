<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require '../includes/config.php';

$categories = [
    ['id' => 1, 'name' => 'Otoño'],
    ['id' => 2, 'name' => 'Invierno'],
    ['id' => 3, 'name' => 'Primavera'],
    ['id' => 4, 'name' => 'Verano'],
    ['id' => 5, 'name' => 'Outlet/Ofertas']
];

$category_products = [];
foreach ($categories as $category) {
    $sql = 'SELECT * FROM products WHERE category_id = :category_id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['category_id' => $category['id']]);
    $category_products[$category['id']] = $stmt->fetchAll();
}
?>

<header id="header" class="bg-gray text-white py-4 px-6 flex justify-between items-center">
    <img src="../assets/logo-tienda.png" alt="logo de PinguiShop" class="logo">
    <div class="header-text">
        <h1>Bienvenido a PinguiShop</h1>
        <p>Tu tienda Online</p>
    </div>
    <nav class="navbar navbar-expand-lg">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active text-white" aria-current="page" href="../pages/home.php">Inicio</a>
                </li>
                <div class="dropdown">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Categorías
                    </a>
                    <ul class="dropdown-menu">
                        <?php foreach ($categories as $category): ?>
                            <li><a class="dropdown-item" href="../pages/categories.php?category_name=<?= $category['name'] ?>"><?= $category['name'] ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </ul>
        </div>
    </nav>
    <div class="nav-icons">
        <?php if (isset($_SESSION['user_id'])) : ?>
            <div class="icon-text">
                <a href="../pages/my-orders.php" class="text-white hover:text-gray-200 flex flex-col items-center">
                    Carrito de compras
                    <img src="../assets/icons/carrito.png" alt="Carrito de compras" class="w-6 h-6 mt-1"> <!-- Ruta al ícono del carrito -->
                </a>
            </div>
            <div class="icon-text">
                <a href="../admin/index.php" class="text-white hover:text-gray-200 flex flex-col items-center">
                    Panel de Administración
                    <img src="../assets/icons/upload.png" alt="Cargar/Modificar/Eliminar productos" class="w-6 h-6 mt-1"> <!-- Ruta al ícono del panel de administración -->
                </a>
            </div>
            <div class="icon-text">
                <a href="../auth/logout.php" class="text-white hover:text-gray-200 flex flex-col items-center">
                    Cerrar Sesión
                    <img src="../assets/icons/cerrar-sesion.png" alt="Cerrar Sesión" class="w-6 h-6 mt-1"> <!-- Ruta al ícono de cerrar sesión -->
                </a>
            </div>

        <?php else : ?>
            <div class="icon-text">
                <a href="login.php" class="text-white hover:text-gray-200 flex flex-col items-center">
                    Iniciar Sesión
                </a>
            </div>
            <div class="icon-text">
                <a href="register.php" class="text-white hover:text-gray-200 flex flex-col items-center">
                    Registrarse
                </a>
            </div>
        <?php endif; ?>
    </div>
</header>
