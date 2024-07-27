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

    $stmt = $conn->prepare("INSERT INTO courses (course_name, image_path) VALUES (:course_name, :image_path)");
    $stmt->bindParam(':course_name', $course_name);
    $stmt->bindParam(':image_path', $image_path);
    $stmt->execute();
}

// Crear parte del curso
if (isset($_POST['create_part'])) {
    $course_id = $_POST['course_id'];
    $part_number = $_POST['part_number'];
    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $description = $_POST['description'];

    $video_path = null;
    $material_path = null;

    if (!empty($_FILES['video']['name'])) {
        $video_name = basename($_FILES['video']['name']);
        $video_target = $upload_dir . DIRECTORY_SEPARATOR . $video_name;

        if (move_uploaded_file($_FILES['video']['tmp_name'], $video_target)) {
            $video_path = 'uploads/' . $video_name;
        } else {
            echo "Error al subir el video.";
            exit();
        }
    }

    if (!empty($_FILES['material']['name'])) {
        $material_name = basename($_FILES['material']['name']);
        $material_target = $upload_dir . DIRECTORY_SEPARATOR . $material_name;

        if (move_uploaded_file($_FILES['material']['tmp_name'], $material_target)) {
            $material_path = 'uploads/' . $material_name;
        } else {
            echo "Error al subir el material.";
            exit();
        }
    }

    $stmt = $conn->prepare("INSERT INTO course_parts (course_id, part_number, title, subtitle, description, video_path, material_path) VALUES (:course_id, :part_number, :title, :subtitle, :description, :video_path, :material_path)");
    $stmt->bindParam(':course_id', $course_id);
    $stmt->bindParam(':part_number', $part_number);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':subtitle', $subtitle);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':video_path', $video_path);
    $stmt->bindParam(':material_path', $material_path);
    $stmt->execute();
}

// Eliminar curso
if (isset($_POST['delete_course'])) {
    $course_id = $_POST['course_id'];
    $stmt = $conn->prepare("DELETE FROM courses WHERE id = :course_id");
    $stmt->bindParam(':course_id', $course_id);
    $stmt->execute();
}

// Obtener la lista de cursos
$courses = $conn->query("SELECT * FROM courses")->fetchAll();
?>


<link rel="stylesheet" href="../css/dashboard.css">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

<nav>
    <div class="navCont">
        <div class="btn-menu">
			<label for="btn-menu">☰</label>
		</div>
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
<!--	--------------->
<input type="checkbox" id="btn-menu">
<div class="container-menu">
	<div class="cont-menu">
    <p>Panel de control</p>
    <img src="../img/Linea.png" alt="">
    <ul class="ul1">
            <li><a href="./dashboard.php">CREAR CURSO</a></li>
            <li><a href="./dashboardEditarCurso.php">EDITAR CURSO</a></li>
            <li><a href="./dashboardAlumnos.php">ALUMNOS</a></li>
            <li><a href="./dashboardCombo.php">COMBO</a></li>
            <li><a href="./dashboardComunidad.php">Comunidad</a></li>
            <li><a href="./dashboardCoaching.php">Coaching</a></li>
            <li><a href="./dashboardClasesGrupales.php">Clases grupales</a></li>
            <li><a href="./dashboardInformacion.php">INFORMACION</a></li>
        </ul>
		<label for="btn-menu">✖️</label>
	</div>
</div>
		
    <div class="dashboardLinks">
    <ul>
    <li><a href="./dashboard.php">CREAR CURSO</a></li>
            <li><a href="./dashboardEditarCurso.php">EDITAR CURSO</a></li>
            <li><a href="./dashboardAlumnos.php">ALUMNOS</a></li>
            <li><a href="./dashboardCombo.php">COMBO</a></li>
            <li><a href="./dashboardComunidad.php">Comunidad</a></li>
            <li><a href="./dashboardCoaching.php">Coaching</a></li>
            <li><a href="./dashboardClasesGrupales.php">Clases grupales</a></li>
            <li><a href="./dashboardInformacion.php">INFORMACION</a></li>
        </ul>
    </div>
    <div>
        
    </div>
    <div class="dashboardCursos">
        <div class="dashboardComboCursos">
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="formData1">
                    <label for="image">Cargar imagen de clases grupales:</label>
                    <input type="file" id="image" name="image" accept="image/*">
                </div>
                <div class="formData2">
                    <label for="precio_combo">Precio del combo:</label>
                    <input id="precio_combo" name="precio_combo" type="number">
                </div>
                    <input class="formBtn" type="submit" name="precio_combo_submit" value="Publicar">
            </form>
        </div>       
    </div>
</section>


