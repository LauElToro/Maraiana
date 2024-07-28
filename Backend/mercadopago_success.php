<?php
include 'db/config.php';
use MercadoPago\SDK;

// Configura tu access token de Mercado Pago
SDK::setAccessToken("APP_USR-214004285591922-070212-07575a2c44625256a88a0f5965cfbbd2-71530083");

// Obtén el cuerpo de la notificación
$body = file_get_contents('php://input');
$notification = json_decode($body, true);

// Verifica si la notificación tiene el ID del pago
if (isset($notification['data']['id'])) {
    $payment_id = $notification['data']['id'];

    // Busca el pago en la API de Mercado Pago
    $payment = SDK::get("/v1/payments/$payment_id");

    if ($payment['status'] == 'approved') {
        // El pago fue aprobado, procesa la asignación del curso

        // Obtén el external_reference que contiene el user_id y el course_id
        $external_reference = $payment['external_reference'];
        list($user_id, $course_id) = explode('-', $external_reference);

        // Asigna el curso al usuario en la base de datos
        try {
            $stmt = $conn->prepare("INSERT INTO user_courses (user_id, course_id) VALUES (:user_id, :course_id)");
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':course_id', $course_id);
            $stmt->execute();

            // Responde con un 200 OK a Mercado Pago
            http_response_code(200);
        } catch (PDOException $e) {
            // Maneja el error y responde con un 500 Internal Server Error
            error_log("Error al asignar el curso: " . $e->getMessage());
            http_response_code(500);
        }
    } else {
        // El pago no fue aprobado, maneja según sea necesario
        http_response_code(400);
    }
} else {
    // Notificación inválida, responde con un 400 Bad Request
    http_response_code(400);
}
?>


