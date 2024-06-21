<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../pages/login.php');
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
    <title>Inicio - PinguiShop</title>
    <link rel="shortcut icon" href="../assets/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/styles.css">
    <!-- Agregar estilos para el carrusel -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@3.2.15/dist/css/splide.min.css">
</head>

<body class="bg-gray-100 font-sans">
    <?php include '../includes/header.php'; ?>
    <div class="container mx-auto px-4 py-8">
        <main>
            <section id="main" class="mb-8">
           <!--HTML CODE-->
      <div class="w-full relative">
      <div class="swiper progress-slide-carousel swiper-container relative">
      <div class="swiper-wrapper">
      <div class="swiper-slide">
        <div class="bg-indigo-50 rounded-2xl h-96 flex justify-center items-center">
          <span class="text-3xl font-semibold text-indigo-600">Slide 1 </span>
        </div>
      </div>
      <div class="swiper-slide">
        <div class="bg-indigo-50 rounded-2xl h-96 flex justify-center items-center">
          <span class="text-3xl font-semibold text-indigo-600">Slide 2 </span>
        </div>
      </div>
      <div class="swiper-slide">
        <div class="bg-indigo-50 rounded-2xl h-96 flex justify-center items-center">
          <span class="text-3xl font-semibold text-indigo-600">Slide 3 </span>
        </div>
      </div>
      </div>
      <div class="swiper-pagination !bottom-2 !top-auto !w-80 right-0 mx-auto bg-gray-100"></div>
      </div>
      </div>
                <h2 class="text-2xl font-bold text-gray-800 mt-8">Productos Destacados</h2>
                <p class="text-gray-600">Aquí puedes encontrar nuestras ofertas y productos destacados:</p>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                    <?php foreach ($products as $product) : ?>
                        <div class="product bg-white p-4 rounded-lg shadow">
                            <h3 class="text-xl font-semibold text-gray-800"><?php echo htmlspecialchars($product['name']); ?></h3>
                            <p class="text-gray-600"><?php echo htmlspecialchars($product['description']); ?></p>
                            <p class="text-gray-800 font-bold">Precio: $<?php echo htmlspecialchars($product['price']); ?></p>
                            <a href="../pages/product-details.php?product_id=<?php echo htmlspecialchars($product['id']); ?>" class="bg-blue-500 text-white px-4 py-2 mt-4 hover:bg-blue-600 rounded-md inline-block">Ver producto</a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>

            <section id="categoria1" class="mb-8">
                <h3 class="text-xl font-bold text-gray-800">Categoría 1</h3>
                <?php
                $sql_categoria1 = 'SELECT * FROM products WHERE category_id = 1'; // Ajusta según tu estructura de base de datos
                $stmt_categoria1 = $pdo->query($sql_categoria1);
                $productos_categoria1 = $stmt_categoria1->fetchAll();
                ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                    <?php foreach ($productos_categoria1 as $producto) : ?>
                        <section class="product bg-white p-4 rounded-lg shadow">
                            <h4 class="text-xl font-semibold text-gray-800"><?php echo htmlspecialchars($producto['name']); ?></h4>
                            <p class="text-gray-600"><?php echo htmlspecialchars($producto['description']); ?></p>
                            <p class="text-gray-800 font-bold">Precio: $<?php echo htmlspecialchars($producto['price']); ?></p>
                            <form action="../order.php" method="GET">
                                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($producto['id']); ?>">
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 mt-4 hover:bg-blue-600 rounded-md">Agregar al Carrito</button>
                            </form>
                        </section>
                    <?php endforeach; ?>
                </div>
            </section>

        </main>
    </div>
    <?php include '../includes/footer.php'; ?>
    <!-- Agregar script para el carrusel -->
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@3.2.15/dist/js/splide.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new Splide('#image-slider', {
                type: 'fade',
                perPage: 1,
                autoplay: true,
                interval: 3000, // Cambia la imagen cada 3 segundos
                pauseOnHover: false,
            }).mount();
        });
    </script>
</body>

</html>
