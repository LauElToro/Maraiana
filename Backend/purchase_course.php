<?php
session_start();
include 'db/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php.php");
    exit();
}

$course_id = $_POST['course_id'];
$payment_method = $_POST['payment_method'];

if ($payment_method == 'paypal') {
    // Redirigir a la página de PayPal
    header("Location: paypal_payment.php?course_id=$course_id");
} elseif ($payment_method == 'mercadopago') {
    // Redirigir a la página de Mercado Pago
    header("Location: mercadopago_payment.php?course_id=$course_id");
} else {
    echo "Método de pago no válido.";
}
?>
