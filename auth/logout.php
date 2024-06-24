<?php
session_start();
if (isset($_POST['confirm_logout'])) {
    session_destroy();
    $success = "Sesión cerrada exitosamente.";
    header('Refresh: 2; URL=login.php');
} elseif (isset($_POST['cancel_logout'])) {
    header('Location: ../pages/home.php');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cerrar Sesión - PinguiShop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<body class="bg-light">
    <?php include '../includes/header.php'; ?>
    <div class="container mt-5">
        <div class="max-w-md mx-auto bg-white rounded-lg overflow-hidden shadow-lg p-6 text-center">
            <h1 class="mb-4">Cerrar Sesión</h1>
            <?php if (isset($success)): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $success; ?>
                </div>
            <?php else: ?>
                <p>¿Estás seguro de que deseas cerrar sesión?</p>
                <form method="POST" action="logout.php">
                    <button type="submit" name="confirm_logout" class="btn btn-danger">Cerrar Sesión</button>
                    <button type="submit" name="cancel_logout" class="btn btn-secondary">Cancelar</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
