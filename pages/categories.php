<?php
// categories.php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit;
}

require '../includes/config.php';

$categories = [
    ['id' => 1, 'name' => 'Categoría 1'],
    ['id' => 2, 'name' => 'Categoría 2'],
    ['id' => 3, 'name' => 'Categoría 3'],
    ['id' => 4, 'name' => 'Categoría 4'],
    ['id' => 5, 'name' => 'Ofertas']
];

$category_products = [];
foreach ($categories as $category) {
    $sql = 'SELECT * FROM products WHERE category_id = :category_id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['category_id' => $category['id']]);
    $category_products[$category['id']] = $stmt->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/favicon.ico" type="image/x-icon">
    <title>Categorías - PinguiShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/styles.css">
</head>

<body class="bg-light font-Poppins">
    <?php include '../includes/header.php'; ?>
    <div class="container mt-5">
        <h1 class="text-center">Categorías</h1>
        <?php foreach ($categories as $category): ?>
            <section id="categoria<?php echo $category['id']; ?>" class="mb-8">
                <h2><?php echo htmlspecialchars($category['name']); ?></h2>
                <div class="row">
                    <?php foreach ($category_products[$category['id']] as $product): ?>
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
        <?php endforeach; ?>
    </div>
    <?php include '../includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
