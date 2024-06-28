<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require '../includes/config.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verificar si el usuario existe
    $sql_check_user = "SELECT * FROM users WHERE username = ?";
    $stmt_check_user = $pdo->prepare($sql_check_user);
    $stmt_check_user->execute([$username]);
    $user = $stmt_check_user->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $username;
        $response = ['success' => true];
    } else {
        $response = ['success' => false, 'error' => 'Usuario o contraseña incorrectos.'];
    }

    echo json_encode($response);
}
?>
