<!-- Update - Editar productos -->
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
require 'config.php';
$id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $sql = "UPDATE products SET name = ?, description = ?, price = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $description, $price, $id]);

    header('Location: index.php');
} else {
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $product = $stmt->fetch();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Editar Producto</title>
</head>
<body>
<h1>Editar Producto</h1>
<form method="POST" action="edit.php?id=<?php echo $id; ?>">
    <label>Nombre: </label><input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
    <label>Descripción: </label><textarea name="description" required><?php echo htmlspecialchars($product['description']); ?></textarea>
    <label>Precio: </label><input type="number" step="0.01" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" required>
    <button type="submit">Actualizar</button>
</form>
<a href="index.php">Volver</a>
</body>
</html>
