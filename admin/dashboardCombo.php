<?php
session_start();
include '../db/config.php';

if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 1) { // Verificar si el usuario es admin
    header("Location: ../index.php");
    exit();
}

// Establecer la ruta de la carpeta 'uploads'
$upload_dir = realpath(__DIR__ . '/../uploads');
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

// Crear curso
if (isset($_POST['create_course'])) {
    $course_name = $_POST['course_name'];
    $image_path = null;
    $precio_argentina = $_POST['precio_argentina'];
    $precio_internacional = $_POST['precio_internacional'];

    if (!empty($_FILES['image']['name'])) {
        $image_name = basename($_FILES['image']['name']);
        $image_target = $upload_dir . DIRECTORY_SEPARATOR . $image_name;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $image_target)) {
            $image_path = 'uploads/' . $image_name;
        } else {
            echo "Error al subir la imagen.";
            exit();
        }
    }

    $stmt = $conn->prepare("INSERT INTO courses (course_name, image_path, precio_argentina, precio_internacional) VALUES (:course_name, :image_path, :precio_argentina, :precio_internacional)");
    $stmt->bindParam(':course_name', $course_name);
    $stmt->bindParam(':image_path', $image_path);
    $stmt->bindParam(':precio_argentina', $precio_argentina);
    $stmt->bindParam(':precio_internacional', $precio_internacional);    
    $stmt->execute();
    echo "Curso creado exitosamente.";
}
?>

<link rel="stylesheet" href="../css/dashboard.css">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

<nav>
    <div class="navCont">
        <p>Panel de control</p>
        <img src="../img/dashtitulo.png" alt="">
        <div class="navSubCont">
            <a href="../index.php">Ver Sitio</a>
            <img src="../img/pc.png" alt="">
        </div>
    </div>
</nav>
<section class="dashboardSection">
<div class="capa"></div>
    <div class="dashboardLinks">
        <ul>
            <li><a href="./dashboard.php">CREAR CURSO</a></li>
            <li><a href="./dashboardEditarCurso.php">EDITAR CURSO</a></li>
            <li><a href="./dashboardDetallesDeCurso.php">DETALLES DE CURSO</a></li>
            <li><a href="./dashboardAlumnos.php">ALUMNOS</a></li>
            <li><a href="./dashboardCombo.php">COMBO</a></li>
            <li><a href="./dashboardComunidad.php">Comunidad</a></li>
            <li><a href="./dashboardCoaching.php">Coaching</a></li>
            <li><a href="./dashboardClasesGrupales.php">Clases grupales</a></li>
            <li><a href="./dashboardInformacion.php">INFO</a></li>
        </ul>
    </div>
    <div class="dashboardCursos">
        <div class="dashboardComboCursos">
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="formData1">
                    <label for="course_name">Nombre del curso:</label>
                    <input type="text" id="course_name" name="course_name" required>
                </div><br>
                <div class="formData1">
                    <label for="image">Cargar imagen del curso:</label>
                    <input type="file" id="image" name="image" accept="image/*">
                </div><br>
                <div class="formData2">
                    <label for="precio_argentina">Precio Argentino:</label>
                    <input id="precio_argentina" name="precio_argentina" type="number" step="0.01">
                </div><br>
                <div class="formData2">
                    <label for="precio_internacional">Precio Internacional:</label>
                    <input id="precio_internacional" name="precio_internacional" type="number" step="0.01">
                </div>
                <input class="formBtn" type="submit" name="create_course" value="Publicar">
            </form>
        </div>       
    </div>
</section>
