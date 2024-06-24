<!-- Archivo para el ingreso de usuarios -->
<?php
session_start();
$error = '';
$success = '';

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
        $success = "Inicio de sesión exitoso. Redirigiendo...";
        header('Refresh: 2; URL=../pages/home.php');
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
    <link rel="shortcut icon" href="../assets/favicon.ico" type="image/x-icon">
    <title>Iniciar Sesión - PinguiShop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/styles.css">

</head>
<body class="bg-light font-Poppins">
    <?php include '../includes/header.php'; ?>
    <div class="container mt-5">
        <div class="max-w-md mx-auto bg-white rounded-lg overflow-hidden shadow-lg p-6">
            <h1 class="text-center mb-4">Iniciar Sesión</h1>
            <?php if (!empty($success)): ?>
                <div class="alert alert-success text-center" role="alert">
                    <?php echo $success; ?>
                </div>
            <?php endif; ?>
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger text-center" role="alert">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            <form method="POST" action="login.php" id="loginForm">
                <div class="mb-4 form-group">
                    <label for="username" class="form-label">Usuario</label>
                    <input type="text" name="username" id="username" placeholder="Ingrese su correo" required class="form-control">
                    <div class="invalid-feedback"></div>
                </div>
                <div class="mb-4 form-group">
                    <label for="password" class="form-label">Contraseña</label>
                    <div class="input-group">
                        <input type="password" name="password" id="password" placeholder="Ingrese su clave" required class="form-control">
                        <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">Ver</button>
                    </div>
                    <small id="passwordHelp" class="form-text text-muted">Haga clic en 'Ver' para mostrar la contraseña.</small>
                    <div class="invalid-feedback"></div>
                </div>
                <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
            </form>
            <p class="mt-4 text-center">
                ¿No tienes una cuenta? <a href="register.php" class="text-primary">Regístrate aquí</a>
            </p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword() {
            var passwordInput = document.getElementById('password');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('loginForm');
            form.addEventListener('submit', function(event) {
                const username = document.getElementById('username');
                const password = document.getElementById('password');
                let valid = true;

                if (!username.value.trim()) {
                    setInvalid(username, 'Por favor, ingrese su usuario.');
                    valid = false;
                }

                if (!password.value.trim()) {
                    setInvalid(password, 'Por favor, ingrese su contraseña.');
                    valid = false;
                }

                if (!valid) {
                    event.preventDefault();
                }
            });

            function setInvalid(field, message) {
                const feedback = field.nextElementSibling;
                feedback.textContent = message;
            }
        });
    </script>
</body>
</html>
