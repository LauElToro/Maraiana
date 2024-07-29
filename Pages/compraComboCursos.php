<?php
session_start();
include '../db/config.php';
// Verificar si el usuario está autenticado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../index.php');
    exit();
}

// Definir la URL base de tu aplicación
define('BASE_URL', 'http://localhost/Cursos/'); // Asegúrate de ajustar esto según la URL base real de tu sitio

// Obtener todos los cursos para el combo
$all_courses_query = $conn->query("SELECT * FROM courses");
$courses_data = $all_courses_query->fetchAll(PDO::FETCH_ASSOC);

// Verificar si se han pasado todos los parámetros necesarios
if (isset($_GET['course_id'], $_GET['learn'], $_GET['for'], $_GET['syllabus'], $_GET['image'])) {
    $curso_id = $_GET['course_id'];
    $learn = $_GET['learn'];
    $for = $_GET['for'];
    $syllabus = json_decode($_GET['syllabus']);
    $image = $_GET['image'];

    // Aquí podrías hacer consultas adicionales a la base de datos si es necesario

    // Datos del curso
    $stmt = $conn->prepare("SELECT * FROM courses WHERE id = :id");
    $stmt->bindParam(':id', $curso_id);
    $stmt->execute();
    $curso = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($curso) {
        $nombreCurso = $curso['course_name'];
        $imagenCurso = $curso['image_path'];
        $precioARS = $curso['precio_argentina'];
        $precioUSD = $curso['precio_internacional'];
    } else {
        echo "Curso no encontrado.";
        exit;
    }
} else {
    echo "No se han pasado todos los parámetros necesarios.";
    exit;
}

// Construir la ruta de la imagen
$image_path = BASE_URL . ltrim(htmlspecialchars($imagenCurso), '/');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/navbar.css">
    <link rel="stylesheet" type="text/css" href="../css/compra.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/d5da104675.js" crossorigin="anonymous"></script>
    <link href="../img/Ellipse 4.png" rel="icon">
    <title>Ventana de compra</title>
</head>
<body>   
    <header>
        <nav>
            <div class="redesNavbar">
                <a href="https://www.linkedin.com/in/mariana-mastropietro-artista?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=ios_app" target="_blank"><img class="linkedinLink" src="../img/linkedin1.png" alt=""></a>
                <a href="https://www.youtube.com/channel/UCxXlYyH8jRpGXeqQTe0PfhQ" target= "_blank"><img class="youtubeLink" src="../img/yout1.png" alt=""></a>
                <a href="https://www.instagram.com/mariana.profedecanto/" target="_blank"><img class="instagramLink" src="../img/Instagram.png" alt=""></a>
                <a href="https://api.whatsapp.com/send/?phone=5491140431611&text=Hola+me+interesan+las+clases+de+canto+%3A+Liber%C3%A1+tu+voz&type=phone_number&app_absent=0" target="_blank"><img class="wasapLink" src="../img/Wasap.png" alt=""></a>
                <a href="https://www.tiktok.com/@mariana.profedecanto" target="_blank"><img class="tiktokLink" src="../img/Tiktok.png" alt=""></a>
            </div>
            <input type="checkbox" id="check">
            <label for="check" class="checkbtn">
                <img src="../img/Bars.png" alt="">
            </label>
            <a href="../index.php" class="enlace">
                <img src="../img/Logo2.png" alt="" class="Logo2">
                <img src="../img/Logo.png" alt="" class="Logo">
            </a>
            <?php
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                echo '<ul>
                    <li><a href="../index.php">Inicio</a></li>
                    <li><a href="../Pages/cursos.php">Cursos</a></li>
                    <li><a href="../Pages/comunidad.php">Comunidad</a></li>
                    <li class="dropdown">
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
        </nav>
    </header>
    <section> 
        <div class="compra-container">
            <div class="cursoCont1">
                <div class="course-details">
                    <h2><?php echo htmlspecialchars($nombreCurso); ?></h2>
                    <p>Precio en ARS: $<?php echo htmlspecialchars($precioARS); ?></p>
                    <p>Precio en USD: $<?php echo htmlspecialchars($precioUSD); ?></p>
                </div>
                <div class="payment-options">
                    <form class="form1" action="compraConArs.php" method="POST">
                        <input type="hidden" name="course_id" value="<?php echo htmlspecialchars($curso_id); ?>">
                        <input type="hidden" name="course_name" value="<?php echo htmlspecialchars($nombreCurso); ?>">
                        <input type="hidden" name="image_path" value="<?php echo htmlspecialchars($imagenCurso); ?>">
                        <input type="hidden" name="precio" value="<?php echo htmlspecialchars($precioARS); ?>">
                        <button type="submit" class="btn btn-primary mp">Pagar con MercadoPago</button>
                    </form>
                    <form class="form2" action="compraConUsd.php" method="POST">
                        <input type="hidden" name="course_id" value="<?php echo htmlspecialchars($curso_id); ?>">
                        <input type="hidden" name="course_name" value="<?php echo htmlspecialchars($nombreCurso); ?>">
                        <input type="hidden" name="image_path" value="<?php echo htmlspecialchars($imagenCurso); ?>">
                        <input type="hidden" name="precio" value="<?php echo htmlspecialchars($precioUSD); ?>">
                        <button type="submit" class="btn btn-secondary pp">Pagar con PayPal</button>
                    </form>
                </div>
            </div>
            <img class="cursoImg" src="<?php echo $image_path; ?>" alt="Imagen del curso">
        </div>
    </section>
    <section class="comboCursosBg">
        <img src="../img/Combo3cursos.png" alt="">
        <button class="contratarBtn2">
            <a href="compraComboCursos.php?<?php 
                $combo_params = [];
                foreach ($courses_data as $course_item) {
                    $combo_params[] = 'id[]=' . urlencode($course_item['id']);
                    $combo_params[] = 'course_name[]=' . urlencode($course_item['course_name']);
                    $combo_params[] = 'image_path[]=' . urlencode($course_item['image_path']);
                    $combo_params[] = 'precio_argentina[]=' . urlencode($course_item['precio_argentina']);
                    $combo_params[] = 'precio_internacional[]=' . urlencode($course_item['precio_internacional']);
                }
                echo implode('&', $combo_params);
            ?>">Ver este combo</a>
        </button>
    </section>
</body>
<footer>
    <div class="footerCont">
        <div class="footerImg">
            <img src="../img/Logo Footer.png" alt="">
        </div>
        <div class="footerLinks">
            <h3>Links Importantes</h3>
            <a href="../Pages/comunidad.php">Comunidad</a>
            <a href="../Pages/clasesGrupales.php">Clases grupales</a>
            <a href="../Pages/coachingIndividual.php">Coaching individual</a>
            <a href="../Pages/escritorioDelAlumno.php">Escritorio de alumno</a>
            <a href="">Términos y condiciones</a>
        </div>
        <div class="footerRedes">
            <h3>Seguime</h3>
            <a href="">TikTok</a>
            <a href="">Instagram</a>
            <a href="">Youtube</a>
        </div>
        <div class="footerContacto">
            <h3>Contacto</h3>
            <a href="">Whatsapp</a>
        </div>
    </div>
</footer>
</html>
