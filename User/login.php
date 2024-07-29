<?php
session_start();
include '../db/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitizar los datos de entrada
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    try {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Establecer las variables de sesión
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role_id'] = $user['role_id'];
            $_SESSION['loggedin'] = true;

            // Redirigir según el rol del usuario
            if ($user['role_id'] === 1) {
                $redirect_url = '../admin/dashboard.php';
            } else if ($user['role_id'] === 2) {
                $redirect_url = '../Pages/escritorioDelAlumno.php';
            }

            // Enviar respuesta JSON con la información de la sesión y la URL de redirección
            echo json_encode([
                'status' => 'success',
                'user_id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'role_id' => $user['role_id'],
                'redirect_url' => $redirect_url
            ]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Usuario o contraseña incorrectos']);
        }
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Error en la base de datos']);
    }
}
?>
