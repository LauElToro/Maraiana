<?php
require 'vendor/autoload.php'; // Asegúrate de que tienes el SDK de Mercado Pago instalado

// Configuración de Mercado Pago
MercadoPago\SDK::setAccessToken('TU_ACCESS_TOKEN_DE_MERCADOPAGO');
$course_id = $_GET['course_id'];

// Obtener información del curso
$stmt = $conn->prepare("SELECT * FROM courses WHERE id = :course_id");
$stmt->bindParam(':course_id', $course_id);
$stmt->execute();
$course = $stmt->fetch(PDO::FETCH_ASSOC);

// Verificar si el curso existe
if (!$course) {
    echo "Curso no encontrado.";
    exit();
}

// Crear preferencia de pago
$preference = new MercadoPago\Preference();
$item = new MercadoPago\Item();
$item->title = htmlspecialchars($course['course_name']);
$item->quantity = 1;
$item->unit_price = 100; // Precio del curso
$preference->items = array($item);

// URLs de retorno
$preference->back_urls = array(
    "success" => "http://tudominio.com/mercadopago_success.php?course_id=$course_id",
    "failure" => "http://tudominio.com/mercadopago_failure.php",
    "pending" => "http://tudominio.com/mercadopago_pending.php"
);
$preference->save();
?>

<a href="<?= $preference->init_point ?>">Pagar con Mercado Pago</a>
