<?php
session_start();
include '../db/config.php';

// Definir la URL base de tu aplicación
define('BASE_URL', 'http://localhost/Cursos/'); // Asegúrate de ajustar esto según la URL base real de tu sitio

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
                <a href="###"><img class="youtubeLink" src="../img/Youtube.png" alt=""></a>
                <a href="###"><img class="instagramLink" src="../img/Instagram.png" alt=""></a>
                <a href="###"><img class="wasapLink" src="../img/Wasap.png" alt=""></a>
                <a href="###"><img class="tiktokLink" src="../img/Tiktok.png" alt=""></a>
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
        <li><a href="../Pages/comunidad.php">Comunidad</a></li><li class="dropdown">
            <a href="#" class="dropbtn">Servicios</a>
            <ul class="dropdown-content">
                <li><a href="../Pages/clasesGrupales.php">Clases grupales</a></li>
                <li><a href="../Pages/coachingIndividual.php">Coaching individual</a></li>
            </ul>
        </li>
        <li><a href="../Pages/escritorioDelAlumno.php">Escritorio de alumno</a></li>
        <li><a href="../Pages/logout.php">Cerrar Sesión</a></li>
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
