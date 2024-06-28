<?php
session_start();
$error = '';
$success = '';

// Verificar si el usuario está autenticado
if (isset($_SESSION['user_id'])) {
    // Si el usuario está autenticado, redirigir a la página de inicio
    header('Location: ../pages/home.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require '../includes/config.php'; // Incluir tu archivo de configuración

    // Manejar el inicio de sesión
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Verificar credenciales
        $sql_check_user = "SELECT * FROM users WHERE username = ?";
        $stmt_check_user = $pdo->prepare($sql_check_user);
        $stmt_check_user->execute([$username]);
        $user = $stmt_check_user->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header('Location: ../pages/home.php');
            exit;
        } else {
            $error = "Credenciales incorrectas. Por favor, intenta nuevamente.";
        }
    }

    // Manejar el registro de usuario
    if (isset($_POST['register'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Validaciones de la contraseña
        if (strlen($password) < 6) {
            $error = "La contraseña debe tener al menos 6 caracteres.";
        } elseif (!preg_match('/[A-Za-z]/', $password)) {
            $error = "La contraseña debe contener al menos una letra.";
        } elseif (!preg_match('/\d/', $password)) {
            $error = "La contraseña debe contener al menos un número.";
        } elseif (!preg_match('/[-!@#$%^&*(),.?":{}|<>]/', $password) && !strpos($password, '-')) {
            $error = "La contraseña debe contener al menos un carácter especial (-, !@#$%^&*()-,.?\":{}|<>).";
        } else {
            $password_hashed = password_hash($password, PASSWORD_DEFAULT);

            // Verificar si el usuario ya existe
            $sql_check_user = "SELECT * FROM users WHERE username = ?";
            $stmt_check_user = $pdo->prepare($sql_check_user);
            $stmt_check_user->execute([$username]);
            $existing_user = $stmt_check_user->fetch();

            if ($existing_user) {
                $error = "El usuario ya está registrado.";
            } else {
                // Insertar nuevo usuario
                $sql_insert_user = "INSERT INTO users (username, password) VALUES (?, ?)";
                $stmt_insert_user = $pdo->prepare($sql_insert_user);
                if ($stmt_insert_user->execute([$username, $password_hashed])) {
                    $success = "Usuario registrado con éxito. Redirigiendo... Inicio de PinguiShop en 3 segundos...";
                    $_SESSION['user_id'] = $pdo->lastInsertId(); // Guardar el ID del nuevo usuario
                    header('Location: ../pages/home.php');
                    exit;
                } else {
                    $error = "Error al registrar el usuario.";
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/favicon.ico" type="image/x-icon">
    <title>Bienvenido a PinguiShop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<body class="bg-light font-Poppins">
    <?php include '../includes/header.php'; ?>
    <div class="container mt-5">
        <div class="max-w-md mx-auto bg-white rounded-lg overflow-hidden shadow-lg p-6">
            <h1 class="text-center mb-4">¡Bienvenido a PinguiShop!</h1>
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger text-center" role="alert">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            <?php if (!empty($success)): ?>
                <div class="alert alert-success text-center" role="alert">
                    <?php echo $success; ?>
                </div>
            <?php endif; ?>
            <p class="text-center">
                Regístrate o inicia sesión para comenzar a disfrutar de nuestras increíbles ofertas y productos.
            </p>
            <div class="text-center">
                <!-- Botón para abrir modal de login -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">
                    Iniciar sesión
                </button>
                <!-- Botón para abrir modal de registro -->
                <button type="button" class="btn btn-outline-primary ms-2" data-bs-toggle="modal" data-bs-target="#registerModal">
                    Registrarse
                </button>
            </div>
        </div>
    </div>

    <!-- Incluir modals de registro y login desde modals.php -->
    <?php include '../includes/modals.php'; ?>

    <?php include '../includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../auth/script.js"></script> <!-- Ajusta la ruta según la ubicación real -->
</body>
</html>
