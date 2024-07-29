<?php
session_start();
include '../db/config.php';


if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 1) { // Verificar si el usuario es admin
    header("Location: ../index.php");
    exit();
}

// Establecer la ruta de la carpeta 'uploads'
$upload_dir = __DIR__ . '/../uploads';
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

// Crear curso
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create_course'])) {
    $course_name = $_POST['course_name'];
    $precio_argentina = $_POST['precio_argentina'];
    $precio_internacional = $_POST['precio_internacional'];
    $image_path = null;

    if (!empty($_FILES['image']['name'])) {
        $image_path = $upload_dir . '/' . basename($_FILES['image']['name']);
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
            echo json_encode(["error" => "Error al subir la imagen."]);
            exit();
        }
        $image_path = 'uploads/' . basename($_FILES['image']['name']);
    }

    $stmt = $conn->prepare("INSERT INTO courses (course_name, image_path, precio_argentina, precio_internacional) VALUES (:course_name, :image_path, :precio_argentina, :precio_internacional)");
    $stmt->bindParam(':course_name', $course_name);
    $stmt->bindParam(':image_path', $image_path);
    $stmt->bindParam(':precio_argentina', $precio_argentina);
    $stmt->bindParam(':precio_internacional', $precio_internacional);
    $stmt->execute();
}

// Crear parte del curso
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create_part'])) {
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

// Obtener la lista de cursos
$courses = $conn->query("SELECT * FROM courses")->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Crear Curso y Parte del Curso</title>
    <link rel="stylesheet" href="../css/dashboard.css">
    <link href="../img/Ellipse 4.png" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<body>
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
        <!-- Contenido principal -->
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
        <div class="dashboardCont">
        <div class="dashboardCursos">
            <div class="dashboardCursosSubCont">
                <h2 class="cursoH2">Crear Curso:</h2>
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="formSubCont1">
                        <label for="image">Imagen del Curso:</label>
                        <input type="file" id="image" name="image" accept="image/*">
                    </div>
                    <div class="formSubCont2">
                        <label for="course_name">Nombre del Curso:</label>
                        <div class="formSubCont2Titulo">
                            <input type="text" id="course_name" name="course_name" required>
                            <input class="submit_btn" type="submit" name="create_course" value="Crear Curso">
                        </div>
                    </div>
                    <div class="precioCont">
                        <div class="precioCard">
                            <p>PRECIO ARGENTINA:</p>
                            <div class="precioData">
                                <input type="number" id="precio_argentina" name="precio_argentina" required>
                            </div>
                        </div>
                        <div class="precioCard">
                            <p>PRECIO INTERNACIONAL:</p>
                            <div class="precioData">
                                <input type="number" id="precio_internacional" name="precio_internacional" required>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="dashboardCursos">
            <div class="dashboardCursosSubCont">
                <h2 class="cursoH2">Crear Parte del Curso:</h2>
                <form method="POST" action="" enctype="multipart/form-data">
                    <!-- Selector de curso -->
                    <div class="cursoInput">
                        <label class="textLabel" for="course_id">Seleccionar Curso:</label>
                        <select id="course_id" name="course_id" required>
                            <?php foreach ($courses as $course) : ?>
                                <option value="<?php echo $course['id']; ?>"><?php echo $course['course_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Número de parte -->
                    <div class="cursoInput">
                        <label class="textLabel" for="part_number">Numero de parte:</label>
                        <input type="number" id="part_number" name="part_number" required>
                    </div>

                    <!-- Título -->
                    <div class="cursoInput">
                        <label class="textLabel" for="title">Título:</label>
                        <input type="text" id="title" name="title" required>
                    </div>

                    <!-- Subtítulo -->
                    <div class="cursoInput">
                        <label class="textLabel" for="subtitle">Subtítulo:</label>
                        <input type="text" id="subtitle" name="subtitle" required>
                    </div>

                    <!-- Descripción -->
                    <div class="cursoInput">
                        <label class="textLabel" for="description">Descripción:</label>
                        <textarea id="description" name="description" required></textarea>
                    </div>

                    <!-- Cargar Video -->
                    <div>
                        <label class="textLabel" for="video">Cargar Video:</label>
                        <input type="file" id="video" name="video" accept="video/*">
                    </div>

                    <!-- Cargar Material (PDF) -->
                    <div>
                        <label class="textLabel" for="material">Cargar Material (PDF):</label>
                        <input type="file" id="material" name="material" accept="application/pdf">
                    </div>

                    <!-- Botón de enviar para la parte del curso -->
                    <div class="btnCont">
                        <input class="submit_btn" type="submit" name="create_part" value="Publicar">
                    </div>
                </form>
            </div>
        </div>
        </div>
    </section>
</body>

</html>
