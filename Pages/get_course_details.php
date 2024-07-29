<?php
session_start();
include '../db/config.php'; 
// Verificar si el usuario está autenticado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../index.php');
    exit();
}
define('BASE_URL', 'http://localhost/Cursos/'); // Asegúrate de que esta es la URL correcta para tu proyecto

if (isset($_GET['course_id'])) {
    $course_id = $_GET['course_id'];

    // Obtener datos del curso
    $course_query = $conn->prepare("SELECT * FROM courses WHERE id = :id");
    $course_query->execute([':id' => $course_id]);
    $course = $course_query->fetch(PDO::FETCH_ASSOC);

    // Obtener detalles del curso
    $details_query = $conn->prepare("SELECT * FROM course_details WHERE course_id = :course_id");
    $details_query->execute([':course_id' => $course_id]);
    $course_details = $details_query->fetch(PDO::FETCH_ASSOC);

    // Verificar el contenido de $course_details
    if (!$course_details) {
        echo json_encode(['error' => 'Detalles del curso no encontrados.']);
        exit;
    }

    // Combinar datos del curso y detalles
    $response = [
        'id' => $course['id'],
        'course_id' => $course_details['course_id'],
        'what_you_will_learn' => $course_details['what_you_will_learn'],
        'intended_for' => $course_details['intended_for'],
        'syllabus' => $course_details['syllabus'],
        'image_path' => BASE_URL . ltrim($course_details['image_path'], '/')
    ];

    // Devolver JSON
    echo json_encode($response);
    exit;
}
?>

