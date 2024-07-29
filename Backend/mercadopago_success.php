<?php
session_start();
require_once '../db/config.php'; 
require_once '../vendor/autoload.php';

// Verifica que el usuario está autenticado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../index.php');
    exit();
}

use MercadoPago\MercadoPagoConfig;

// Configura tu access token de Mercado Pago
MercadoPagoConfig::setAccessToken("APP_USR-214004285591922-070212-07575a2c44625256a88a0f5965cfbbd2-71530083");

// Recupera los parámetros de la URL
$course_id = $_GET['course_id'] ?? null;
$payment_id = $_GET['payment_id'] ?? null;
$external_reference = $_GET['external_reference'] ?? null;
$status = $_GET['status'] ?? null;

// Asigna el valor de external_reference a una variable para depuración
$external_reference_value = $external_reference;

var_dump($external_reference_value); // Añadir para depuración

$user_id = $_SESSION['user_id'];

if ($status === 'approved' && $payment_id && $external_reference) {
    error_log("External Reference: $external_reference_value");

    // Asigna el curso al usuario en la base de datos
    try {
         // Insertar en user_courses
        $stmt = $conn->prepare("INSERT INTO user_courses (user_id, course_id) VALUES (:user_id, :course_id)");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':course_id', $course_id);
        $stmt->execute();

        // Insertar en compras_cursos
        $stmt2 = $conn->prepare("INSERT INTO compras_cursos (user_id, course_id) VALUES (:user_id, :course_id)");
        $stmt2->bindParam(':user_id', $user_id);
        $stmt2->bindParam(':course_id', $course_id);
        $stmt2->execute();

        // Responde con un 200 OK
        http_response_code(200);

        // Redirige al usuario a escritorioDelAlumno.php
        header('Location: ../Pages/escritorioDelAlumno.php');
        exit();
    } catch (PDOException $e) {
        // Maneja el error y responde con un 500 Internal Server Error
        error_log("Error al asignar el curso: " . $e->getMessage());
        http_response_code(500);
        echo "Error al procesar el pago.";
    }
} else {
    // Notificación inválida o pago no aprobado
    http_response_code(400);
    echo "Pago no aprobado o parámetros inválidos.";
}
?>