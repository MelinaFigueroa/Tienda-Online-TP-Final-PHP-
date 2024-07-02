<?php
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require '../includes/config.php';
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validaciones de la contraseña
    if (strlen($password) < 6) {
        $error = "La contraseña debe tener al menos 6 caracteres.";
    } elseif (!preg_match('/[A-Za-z]/', $password)) {
        $error = "La contraseña debe contener al menos una letra.";
    } elseif (!preg_match('/\d/', $password)) {
        $error = "La contraseña debe contener al menos un número.";
    } elseif (!preg_match('/[!@#$%^&*()-,.?":{}|<>]/', $password) && !strpos($password, '-')) {
        $error = "La contraseña debe contener al menos un carácter especial (-, !@#$%^&*()-,.?\":{}|<>).";
    } else {
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$username, $password_hashed])) {
            $success = "Usuario registrado con éxito. Redirigiendo... Inicio de PinguiShop en 3 segundos...";
            echo "<meta http-equiv='refresh' content='3;url=../pages/home.php'>";
            exit;
        } else {
            $error = "Error al registrar el usuario.";
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
    <title>Registrarse - PinguiShop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/styles.css">
</head>

<body class="bg-light font-Poppins">
    <?php include '../includes/header.php'; ?>
    <div class="container mt-5">
        <div class="max-w-md mx-auto bg-white rounded-lg overflow-hidden shadow-lg p-6">
            <h1 class="text-center mb-4">Registrarse</h1>
            <?php if (!empty($error)) : ?>
                <div class="alert alert-danger text-center" role="alert">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            <?php if (!empty($success)) : ?>
                <div class="alert alert-success text-center" role="alert">
                    <?php echo $success; ?>
                </div>
            <?php endif; ?>
            <form method="POST" action="register.php">
                <div class="mb-4">
                    <label for="username" class="form-label">Usuario</label>
                    <input type="text" name="username" id="username" placeholder="Ingrese su correo" required class="form-control">
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Contraseña</label>
                    <div class="input-group">
                        <input type="password" name="password" id="password" placeholder="Ingrese su clave" required class="form-control" oninput="checkPasswordStrength(this.value)">
                        <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">Ver</button>
                    </div>
                    <small id="passwordHelp" class="form-text text-muted">La contraseña debe tener al menos 6 caracteres, una letra, un número y un carácter especial (-, !@#$%^&*()-,.?":{}|<>).</small>
                    <div id="passwordStrength" class="mt-2"></div>
                </div>
                <button type="submit" class="btn btn-primary w-100">Registrarse</button>
            </form>
            <p class="mt-4 text-center">
                ¿Ya tenes una cuenta? <a href="login.php" class="text-primary">Inicia sesión aquí</a>
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

        function checkPasswordStrength(password) {
            var passwordStrength = document.getElementById('passwordStrength');
            var strengthText = '';

            if (password.length < 6) {
                strengthText = "La contraseña debe tener al menos 6 caracteres.";
            } else if (!/[A-Za-z]/.test(password)) {
                strengthText = "La contraseña debe contener al menos una letra.";
            } else if (!/\d/.test(password)) {
                strengthText = "La contraseña debe contener al menos un número.";
            } else if (!/[!@#$%^&*()-,.?":{}|<>]/.test(password) && password.indexOf('-') === -1) {
                strengthText = "La contraseña debe contener al menos un carácter especial (-, !@#$%^&*()-,.?\":{}|<>).";
            } else {
                strengthText = "La contraseña cumple con los requisitos.";
            }

            passwordStrength.innerHTML = '<div class="alert alert-info" role="alert">' + strengthText + '</div>';
        }
    </script>
</body>

</html>