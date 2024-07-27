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

// Eliminar curso y sus partes
if (isset($_POST['delete_course'])) {
    $course_id = $_POST['course_id'];
    // Eliminar todas las partes del curso
    $stmt_parts = $conn->prepare("DELETE FROM course_parts WHERE course_id = :course_id");
    $stmt_parts->bindParam(':course_id', $course_id);
    $stmt_parts->execute();
    
    // Eliminar el curso
    $stmt = $conn->prepare("DELETE FROM courses WHERE id = :course_id");
    $stmt->bindParam(':course_id', $course_id);
    $stmt->execute();
}

// Obtener la lista de cursos
$courses = $conn->query("SELECT * FROM courses")->fetchAll();

// Obtener partes del curso para un curso específico
function getCourseParts($course_id, $conn) {
    $stmt = $conn->prepare("SELECT * FROM course_parts WHERE course_id = :course_id");
    $stmt->bindParam(':course_id', $course_id);
    $stmt->execute();
    return $stmt->fetchAll();
}

// Editar curso y partes del curso
if (isset($_POST['edit_course'])) {
    $course_id = $_POST['course_id'];
    $course_name = $_POST['course_name'];
    $price_argentina = $_POST['price_argentina'];
    $price_international = $_POST['price_international'];
    
    // Editar el nombre del curso y los precios
    $stmt = $conn->prepare("UPDATE courses SET course_name = :course_name, price_argentina = :price_argentina, price_international = :price_international WHERE id = :course_id");
    $stmt->bindParam(':course_name', $course_name);
    $stmt->bindParam(':price_argentina', $price_argentina);
    $stmt->bindParam(':price_international', $price_international);
    $stmt->bindParam(':course_id', $course_id);
    $stmt->execute();
    
    // Editar partes del curso
    foreach ($_POST['parts'] as $part_id => $part_data) {
        $part_number = $part_data['part_number'];
        $title = $part_data['title'];
        $subtitle = $part_data['subtitle'];
        $description = $part_data['description'];
        
        $stmt_part = $conn->prepare("UPDATE course_parts SET part_number = :part_number, title = :title, subtitle = :subtitle, description = :description WHERE id = :part_id");
        $stmt_part->bindParam(':part_number', $part_number);
        $stmt_part->bindParam(':title', $title);
        $stmt_part->bindParam(':subtitle', $subtitle);
        $stmt_part->bindParam(':description', $description);
        $stmt_part->bindParam(':part_id', $part_id);
        $stmt_part->execute();
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Crear, Editar y Eliminar Cursos</title>
    <link rel="stylesheet" href="../css/dashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
        .editarCursosCard {
            margin-top: 20px;
        }
        .editarCursosCard form {
            margin-bottom: 20px;
        }
    </style>
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
        <div class="dashboardEditarCursos">
            <!-- Listado de cursos -->
            <div class="cursoExistenteCard">
                <h2>Cursos Existentes</h2>
                <table>
                    <?php foreach ($courses as $course): ?>
                        <tr>
                            <td class="textLabel"><?= htmlspecialchars($course['course_name']) ?></td>
                            <td>
                                <?php if ($course['image_path']): ?>
                                    <img src="../<?= htmlspecialchars($course['image_path']) ?>" alt="Imagen del curso" style="width: 100px; height: auto;">
                                <?php else: ?>
                                    No hay imagen
                                <?php endif; ?>
                            </td>
                            <td>
                                <!-- Botones de Editar y Eliminar -->
                                <form method="POST" action="">
                                    <div class="editarBtn">
                                        <input type="hidden" name="course_id" value="<?= htmlspecialchars($course['id']) ?>">
                                        <input class="editInput" type="submit" name="edit_form" value="Editar">
                                        <input class="deleteInput" type="submit" name="delete_course" value="Eliminar">
                                    </div>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <!-- Formulario de Edición -->
            <?php if (isset($_POST['edit_form'])): ?>
    <?php $edit_course_id = $_POST['course_id']; ?>
    <?php
    // Obtener los datos del curso para edición
    $stmt_course = $conn->prepare("SELECT * FROM courses WHERE id = :course_id");
    $stmt_course->bindParam(':course_id', $edit_course_id);
    $stmt_course->execute();
    $course = $stmt_course->fetch(PDO::FETCH_ASSOC);

    // Obtener partes del curso
    $course_parts = getCourseParts($edit_course_id, $conn);
    ?>
    <div class="editarCursosCard">
        <h2 class="editarCursosTitulo">Editar Curso</h2>
        <form method="POST" action="">
            <div class="formCont">
            <div class="editarCursoCont">
            <input type="hidden" name="course_id" value="<?= htmlspecialchars($edit_course_id) ?>">
            <label for="course_name_edit">Nombre del Curso:</label>
            <input type="text" id="course_name_edit" name="course_name" value="<?= htmlspecialchars($course['course_name']) ?>" required>
            </div>
            <div class="editarCursoCont">
            <label for="price_argentina">Precio en Argentina:</label>
            <input type="number" id="price_argentina" name="price_argentina" value="<?= htmlspecialchars($course['precio_argentina']) ?>" step="0.01" required>
            </div>
            <div class="editarCursoCont">
            <label for="price_international">Precio Internacional:</label>
            <input type="number" id="price_international" name="price_international" value="<?= htmlspecialchars($course['precio_internacional']) ?>" step="0.01" required>
            </div>
            </div>

            <h3 class="editarCursosTitulo">Partes del Curso</h3>
            <?php foreach ($course_parts as $part): ?>
                <div class="editarCursoCont">
                    <label for="part_number<?= htmlspecialchars($part['id']) ?>">Número de Parte:</label>
                    <input type="text" id="part_number<?= htmlspecialchars($part['id']) ?>" name="parts[<?= htmlspecialchars($part['id']) ?>][part_number]" value="<?= htmlspecialchars($part['part_number']) ?>" required>
                </div>
                <div class="editarCursoCont">
                    <label for="title<?= htmlspecialchars($part['id']) ?>">Título:</label>
                    <input type="text" id="title<?= htmlspecialchars($part['id']) ?>" name="parts[<?= htmlspecialchars($part['id']) ?>][title]" value="<?= htmlspecialchars($part['title']) ?>" required>
                </div>
                <div class="editarCursoCont">
                    <label for="subtitle<?= htmlspecialchars($part['id']) ?>">Subtítulo:</label>
                    <input type="text" id="subtitle<?= htmlspecialchars($part['id']) ?>" name="parts[<?= htmlspecialchars($part['id']) ?>][subtitle]" value="<?= htmlspecialchars($part['subtitle']) ?>" required>
                </div>
                <div class="editarCursoCont">
                    <label for="description<?= htmlspecialchars($part['id']) ?>">Descripción:</label>
                    <textarea id="description<?= htmlspecialchars($part['id']) ?>" name="parts[<?= htmlspecialchars($part['id']) ?>][description]" required><?= htmlspecialchars($part['description']) ?></textarea>
                </div>
            <?php endforeach; ?>

            <input class="submit_btn" type="submit" name="edit_course" value="Guardar Cambios">
        </form>
    </div>
<?php endif; ?>
        </div>
    </section>
</body>

</html>
