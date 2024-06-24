<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit;
}

require '../includes/config.php';

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
    <title>Inicio - PinguiShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/styles.css">
</head>

<body class="bg-light font-Poppins">
    <?php include '../includes/header.php'; ?>
    <div class="container mt-5">
        <main>
            <section id="main" class="mb-8">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
                    <div class="carousel-inner">
                        <?php
                        $sql_ofertas = 'SELECT * FROM products WHERE category_id = 5'; // Ofertas
                        $stmt_ofertas = $pdo->query($sql_ofertas);
                        $productos_ofertas = $stmt_ofertas->fetchAll();

                        $first = true;
                        foreach ($productos_ofertas as $producto) : ?>
                            <div class="carousel-item <?php if ($first) { echo 'active'; $first = false; } ?>">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">No te pierdas estas ofertas!</h5>
                                                <img src="../assets/carrousel/carrusel-ofertas.png" class="d-block w-100 card-slider" alt="<?php echo htmlspecialchars($producto['name']); ?>">
                                                <p class="card-text">Visita la seccion de ofertas y disfruta de excelentes prendas a precios INCREIBLES!.</p>
                                                <a href="#categoria4" class="btn btn-primary">Ver Ofertas</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        
                        <div class="carousel-item">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Carga Productos de manera facil y sencilla</h5>
                                            <img src="../assets/carrousel/carrusel-cargar-productos.png" alt="Cargar productos">
                                            <p class="card-text">Accede al panel de administración para agregar nuevos productos a tu tienda.</p>
                                            <a href="../admin/create.php" class="btn btn-primary">Ir al Panel Admin</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="carousel-item">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Suscripción a Boletín</h5>
                                            <img src="../assets/carrousel/carrusel-contacto.png" alt="Contactanos">
                                            <p class="card-text">Suscríbete a nuestro boletín para recibir las últimas ofertas y novedades.</p>
                                            <a href="../pages/contact.php" class="btn btn-primary">Contactanos</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Botones de navegación -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Siguiente</span>
                    </button>
                </div>
                <h2 class="mt-5 text-center">Productos Destacados</h2>
                <p class="text-center">Aquí puedes encontrar nuestros productos más vendidos:</p>
                <div class="row align-items-center justify-content-start">
                    <?php foreach ($products as $product) : ?>
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <img src="../uploads/<?php echo htmlspecialchars($product['image_url']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['name']); ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                                    <p class="card-text"><?php echo htmlspecialchars($product['description']); ?></p>
                                    <p class="card-text"><strong>Precio: $<?php echo htmlspecialchars($product['price']); ?></strong></p>
                                    <a href="../pages/product-details.php?product_id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-primary">Ver producto</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>

            <section id="categoria4" class="mb-8">
                <h3>Outlet y Ofertas</h3>
                <p>Excelentes prendas en muy buenos precios</p>
                <?php
                $sql_categoria5 = 'SELECT * FROM products WHERE category_id = 5'; // Ajusta según tu estructura de base de datos
                $stmt_categoria5 = $pdo->query($sql_categoria5);
                $productos_categoria5 = $stmt_categoria5->fetchAll();
                ?>
                <div class="row align-items-center justify-content-center">
                    <?php foreach ($productos_categoria5 as $producto) : ?>
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <img src="../uploads/<?php echo htmlspecialchars($producto['image_url']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($producto['name']); ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($producto['name']); ?></h5>
                                    <p class="card-text"><?php echo htmlspecialchars($producto['description']); ?></p>
                                    <p class="card-text"><strong>Precio: $<?php echo htmlspecialchars($producto['price']); ?></strong></p>
                                    <form action="../order.php" method="GET">
                                        <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($producto['id']); ?>">
                                        <button type="submit" class="btn btn-primary">Agregar al Carrito</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>

        </main>
    </div>
    <?php include '../includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
