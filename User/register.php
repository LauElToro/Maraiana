<?php
session_start();
include '../db/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role_id = $_POST['role_id'];
    
    // Obtener la fecha actual
    $registration_date = date('Y-m-d H:i:s');

    $stmt = $conn->prepare("INSERT INTO users (username, email, password, role_id, registration_date) VALUES (:username, :email, :password, :role_id, :registration_date)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':role_id', $role_id);
    $stmt->bindParam(':registration_date', $registration_date);

    if ($stmt->execute()) {
        // Obtener el ID del usuario recién registrado
        $user_id = $conn->lastInsertId();

        // Establecer las variables de sesión
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['role_id'] = $role_id;
        
        // Enviar respuesta JSON con la información de la sesión
        echo json_encode([
            'status' => 'success',
            'user_id' => $user_id,
            'username' => $username,
            'email' => $email,
            'role_id' => $role_id
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al registrar el usuario']);
    }
}
?>
