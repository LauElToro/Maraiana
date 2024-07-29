<?php
session_start();
include '../db/config.php';
// Verificar si el usuario está autenticado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../index.php');
    exit();
}

// Definir la URL base de tu aplicación
define('BASE_URL', '../'); // Asegúrate de ajustar esto según la URL base real de tu sitio

// Verificar si se han pasado todos los parámetros necesarios

if (isset($_GET['id'], $_GET['course_name'], $_GET['image_path'], $_GET['precio_argentina'], $_GET['precio_internacional'])) {
    $curso_id = $_GET['id'];
    $course_name = $_GET['course_name'];
    $imagenCurso = $_GET['image_path'];
    $precio_argentina = $_GET['precio_argentina'];
    $precio_internacional = $_GET['precio_internacional'];

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
    <link rel="stylesheet" type="text/css" href="../css/compraComboCursos.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/d5da104675.js" crossorigin="anonymous"></script>
    <link href="../img/Ellipse 4.png" rel="icon">
    <title>Ventana de compra</title>
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
            <img src="../img/Bars.png" alt="">
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
   
    
        </nav>
    </header>
    <section> 
        <div class="bgCompraCont">
                <?php
                $valorDeCurso = $precio_argentina;
                $valorDeCursoUSD = $precio_internacional;
                ?> 
           
            <div class="cursosCont">
                 <h2>CONTRATAR CURSO</h2>
                <div class="comprarCursoCont1">
                    <button>
                    <a href="../Pages/compraConArsCombo.php">
                    <p class="valorArs"><?php  echo $valorDeCurso; ?></p>
                    <p class="pData">Comprar en pesos argentinos</p>
                    </button>
                </div>            
                <div class="comprarCursoCont1">
                    <button>
                    <a href="../Pages/compraConUsdCombo.php">
                    <p class="valorUsd"><?php echo $valorDeCursoUSD; ?></p>
                    <p class="pData">Comprar en dolares</p>
                    </button>
                </div>
            </div>   
            <img class="cursoImg" src="<?php echo $image_path; ?>" alt="Imagen del curso">
        </div>
    </section> 
    <footer>
        <div class="footerCont">
            <div class="footerImg">
            <img src="../img/Logo Footer.png" alt="">
            </div>
            <div class="footerLinks">
                <h3>Links Importantes</h3>
                <!--   <a href="./Pages/cursos.php">Cursos</a> -->
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
</body>
</html>