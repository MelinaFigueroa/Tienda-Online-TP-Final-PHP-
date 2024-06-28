<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require '../includes/config.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validaciones de la contraseña
    if (strlen($password) < 6 || !preg_match('/[A-Za-z]/', $password) || !preg_match('/\d/', $password) || !preg_match('/[-!@#$%^&*(),.?":{}|<>]/', $password)) {
        $response = ['success' => false, 'error' => 'La contraseña no cumple con los requisitos mínimos. Debe tener al menos 6 caracteres, una letra, un número y un carácter especial (-!@#$%^&*(),.?":{}|<>).'];
        echo json_encode($response);
        exit;
    }

    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    // Verificar si el usuario ya existe
    $sql_check_user = "SELECT * FROM users WHERE username = ?";
    $stmt_check_user = $pdo->prepare($sql_check_user);
    $stmt_check_user->execute([$username]);
    $existing_user = $stmt_check_user->fetch();

    if ($existing_user) {
        $response = ['success' => false, 'error' => 'El usuario ya está registrado.'];
        echo json_encode($response);
        exit;
    }

    // Insertar nuevo usuario
    $sql_insert_user = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt_insert_user = $pdo->prepare($sql_insert_user);
    $stmt_insert_user->execute([$username, $password_hashed]);

    if ($stmt_insert_user) {
        $_SESSION['username'] = $username;
        $response = ['success' => true, 'message' => 'Registro exitoso. Redireccionando a la página de inicio.'];
    } else {
        $response = ['success' => false, 'error' => 'Error al registrar el usuario. Por favor, intenta nuevamente.'];
    }

    echo json_encode($response);
}
?>
