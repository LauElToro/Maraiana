<?php
session_start();
include 'db/config.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php.php");
    exit();
}

$course_id = $_GET['course_id'];
$user_id = $_SESSION['user_id'];

// Aquí deberías validar la transacción con PayPal IPN (no mostrado por simplicidad)

// Asignar el curso al usuario
$stmt = $conn->prepare("INSERT INTO user_courses (user_id, course_id) VALUES (:user_id, :course_id)");
$stmt->bindParam(':user_id', $user_id);
$stmt->bindParam(':course_id', $course_id);
$stmt->execute();

echo "Compra exitosa. El curso ha sido asignado a tu cuenta.";
?>

