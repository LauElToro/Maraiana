<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php.php");
    exit();
}
// Configuración de PayPal (esto es solo un ejemplo básico)
$paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
$business_email = 'tu_email_de_paypal@dominio.com';
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

// URL de retorno (página de éxito)
$return_url = 'http://tudominio.com/paypal_success.php?course_id=' . $course_id;

// URL de cancelación
$cancel_url = 'http://tudominio.com/paypal_cancel.php';

?>

<form action="<?= $paypal_url ?>" method="post">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="business" value="<?= $business_email ?>">
    <input type="hidden" name="item_name" value="<?= htmlspecialchars($course['course_name']) ?>">
    <input type="hidden" name="amount" value="precio_del_curso">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="return" value="<?= $return_url ?>">
    <input type="hidden" name="cancel_return" value="<?= $cancel_url ?>">
    <button type="submit">Pagar con PayPal</button>
</form>
