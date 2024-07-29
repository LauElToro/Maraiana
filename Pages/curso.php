<?php
session_start();
include '../db/config.php';
// Verificar si el usuario está autenticado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../index.php');
    exit();
}

// Obtener la lista de cursos
$courses = $conn->query("SELECT * FROM courses")->fetchAll();

// Obtener el ID del curso y de la parte seleccionada, si se ha enviado
$course_id = isset($_GET['course_id']) ? $_GET['course_id'] : null;
$part_number = isset($_GET['part_number']) ? $_GET['part_number'] : null;

// Obtener el nombre del curso seleccionado, si se ha enviado un curso
$course_name = null;
if ($course_id) {
    $stmt = $conn->prepare("SELECT * FROM courses WHERE id = :course_id");
    $stmt->bindParam(':course_id', $course_id);
    $stmt->execute();
    $course = $stmt->fetch(PDO::FETCH_ASSOC);
    $course_name = $course ? $course['course_name'] : null;
}

// Obtener las partes del curso seleccionado, si se ha enviado un curso
$parts = [];
if ($course_id) {
    $stmt = $conn->prepare("SELECT * FROM course_parts WHERE course_id = :course_id ORDER BY part_number");
    $stmt->bindParam(':course_id', $course_id);
    $stmt->execute();
    $parts = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Obtener los detalles de la parte seleccionada
$part_details = null;
if ($course_id && $part_number) {
    $stmt = $conn->prepare("SELECT * FROM course_parts WHERE course_id = :course_id AND part_number = :part_number");
    $stmt->bindParam(':course_id', $course_id);
    $stmt->bindParam(':part_number', $part_number);
    $stmt->execute();
    $part_details = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Curso y Parte del Curso</title>
    <link rel="stylesheet" type="text/css" href="../css/navbar.css">
    <link rel="stylesheet" type="text/css" href="../css/verCurso.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
<header>
    <nav>      
        <div class="redesNavbar">
            <a href="https://www.linkedin.com/in/mariana-mastropietro-artista?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=ios_app" target="_blank"><img  class="linkedinLink"  src="../img/linkedin1.png" alt=""></a>
            <a href="https://www.youtube.com/channel/UCxXlYyH8jRpGXeqQTe0PfhQ" target= "_blank"><img  class="youtubeLink"  src="../img/yout1.png" alt=""></a>
                <a href="https://www.instagram.com/mariana.profedecanto/" target="_blank"><img  class="instagramLink"  src="../img/Instagram.png" alt=""></a>
                <a href="https://api.whatsapp.com/send/?phone=5491140431611&text=Hola+me+interesan+las+clases+de+canto+%3A+Liber%C3%A1+tu+voz&type=phone_number&app_absent=0" target="_blank"><img  class="wasapLink"  src="../img/Wasap.png" alt=""></a>
                <a href="https://www.tiktok.com/@mariana.profedecanto" target="_blank"><img  class="tiktokLink"  src="../img/Tiktok.png" alt=""></a>
        </div>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <img src="../img/menu.png" alt="">
        </label>
        <a href="../index.php" class="enlace">
            <img src="../img/Logo2.png" alt="" class="Logo2">
            <img src="../img/Logo.png" alt="" class="Logo">
        </a>
    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        // Si el usuario está autenticado, mostrar enlace al perfil y al cierre de sesión
        echo '<ul>
        <li><a href="../index.php">Inicio</a></li>
        <li><a href="../Pages/cursos.php">Cursos</a></li>
        <li><a href="../Pages/comunidad.php">Comunidad</a></li><li class="dropdown">
            <a href="#" class="dropbtn">Servicios</a>
            <ul class="dropdown-content">
                <li><a href="../Pages/clasesGrupales.php">Clases grupales</a></li>
                <li><a href="../Pages/coachingIndividual.php">Coaching individual</a></li>
            </ul>
        </li>
        <li><a href="../Pages/escritorioDelAlumno.php">Escritorio de alumno</a></li>
        <li style="float: right;"><button class="btn btn-outline-primary navBtn" id="loginButton1"><a href="../User/logout.php">Cerrar Sesión</a></button></li>
        <li><button class="btn btn-outline-primary navBtn2" id="loginButton2"><a href="../User/logout.php">Cerrar Sesión</a></button></li>
    </ul>';
    } else {
        // Si el usuario no está autenticado, mostrar enlaces de inicio de sesión y registro
        echo '<ul>
        <li><a href="../index.php">Inicio</a></li>
        <li><a href="../Pages/comunidad.php">Comunidad</a></li>
        <li class="dropdown">
            <a href="#" class="dropbtn">Servicios</a>
            <ul class="dropdown-content">
                <li><a href="../Pages/clasesGrupales.php">Clases grupales</a></li>
                <li><a href="../Pages/coachingIndividual.php">Coaching individual</a></li>
            </ul>
        </li>
        <li style="float: right;"><button class="btn btn-outline-primary navBtn" id="loginButton1">INGRESAR</button></li>
        <li><button class="btn btn-outline-primary navBtn2" id="loginButton2">INGRESAR</button></li>
    </ul>';
    }
    ?> 
        </nav><br>
        <div class="saludoEscritorio">
            <h1>Hola: <?php echo htmlspecialchars($_SESSION['username']); ?> ! </h1>
        </div>
    </header>
    <div class="verCursoSection">
        <div class="verCursoSubCont1">
            <h2>Seleccionar Curso y Parte del Curso</h2>
            <form class="form1" method="GET" action="">
                <label for="course_id">Curso:</label>
                <select id="course_id" name="course_id" onchange="this.form.submit()" required>
                <option class="formOption" value="">Seleccione un curso</option>
                <?php foreach ($courses as $course): ?>
                <option value="<?= htmlspecialchars($course['id']) ?>" <?= $course['id'] == $course_id ? 'selected' : '' ?>><?= htmlspecialchars($course['course_name']) ?></option>
                <?php endforeach; ?>
                </select>
            </form>
    <?php if ($course_id): ?>
        <h3>Partes del Curso: <?= htmlspecialchars($course_name) ?></h3>
            <ul>
            <?php foreach ($parts as $part): ?>
                <li class="cursoItem">
                    <a href="?course_id=<?= htmlspecialchars($course_id) ?>&part_number=<?= htmlspecialchars($part['part_number']) ?>">
                        Parte <?= htmlspecialchars($part['part_number']) ?>: <?= htmlspecialchars($part['title']) ?>
                    </a>
                </li>
            <?php endforeach; ?>
            </ul>
    <?php endif; ?>
    </div>
    <div class="verCursoSubCont2">   
    <?php if ($part_details): ?>
            <video class="courseVid" controls>
                <source src="../<?= htmlspecialchars($part_details['video_path']) ?>" type="video/mp4">
                Tu navegador no soporta el elemento de video.
            </video>
            <div class="subContVid">
        <h3>Curso: <?= htmlspecialchars($course_name) ?></h3>
        <p><label class="descripcionItem">Título:</label> <?= htmlspecialchars($part_details['title']) ?></p>
        <p><label class="descripcionItem">Subtítulo: </label><?= htmlspecialchars($part_details['subtitle']) ?></p>
        <p><label class="descripcionItem">Descripción:</label> <?= htmlspecialchars($part_details['description']) ?></p>
        <?php if ($part_details['video_path']): ?>
        <?php endif; ?>
        <?php if ($part_details['material_path']): ?>
            <p>Material (PDF): <a href="../<?= htmlspecialchars($part_details['material_path']) ?>">Descargar Material</a></p>
        <?php endif; ?>
    <?php endif; ?>

            </div>
    </div>
</div>
</body>
</html>
