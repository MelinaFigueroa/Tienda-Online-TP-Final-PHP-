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
        <img src="../assets/logo-tienda.png" alt="logo de PinguiShop" class="max-w-32 h-auto w-16 md:w-32 lg:w-48">
        <div class="'text-color">
            <h1>Bienvenido a PinguiShop</h1>
            <p>Tu tienda Online</p>
        </div>
        <nav class="navbar navbar-expand-lg ">
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
                            <li><a class="dropdown-item" href="../pages/categories.php?category_name=Otoño">Otoño</a></li>
                            <li><a class="dropdown-item" href="../pages/categories.php?category_name=Invierno">Invierno</a></li>
                            <li><a class="dropdown-item" href="../pages/categories.php?category_name=Primavera">Primavera</a></li>
                            <li><a class="dropdown-item" href="../pages/categories.php?category_name=Verano">Verano</a></li>
                            <li><a class="dropdown-item" href="../pages/categories.php?category_name=Outlet/Ofertas">Outlet/Ofertas</a></li>
                        </ul>
                    </div>
                </ul>
            </div>
        </nav>
        <div class="d-flex align-items-center space-x-4 nav-icons">
            <?php if (isset($_SESSION['user_id'])) : ?>
                <div>
                    <a href="../pages/my-orders.php" class="text-white d-flex align-items-center">
                        Carrito de compras
                        <img src="../assets/icons/carrito-compras.png" alt="Carrito de compras"> <!-- Ruta al ícono del carrito -->
                    </a>
                </div>
                <div>
                    <a href="../auth/logout.php" class="text-white d-flex align-items-center">
                        Cerrar Sesión
                    <img src="../assets/icons/cerrar-sesion.png" alt="Cerrar sesion"> <!-- Ruta al ícono del carrito -->
                    </a>
                </div>
                <?php else : ?>
            <a href="../auth/login.php" class="text-white" data-bs-toggle="modal" data-bs-target="#loginModal">Iniciar Sesión</a>
            <a href="../auth/register.php" class="text-white" data-bs-toggle="modal" data-bs-target="#registerModal">Registrarse</a>
        <?php endif; ?>
        </div>
    </header>
    <?php include '../includes/modals.php'; ?>
