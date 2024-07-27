<?php
session_start();
include '../db/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username AND email = :email");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Establecer las variables de sesión
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role_id'] = $user['role_id'];
        
        // Enviar respuesta JSON con la información de la sesión
        echo json_encode([
            'status' => 'success',
            'user_id' => $user['id'],
            'username' => $user['username'],
            'email' => $user['email'],
            'role_id' => $user['role_id']
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Usuario o contraseña incorrectos']);
    }
}
?>
