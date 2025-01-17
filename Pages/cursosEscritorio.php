<?php
session_start();
include '../db/config.php'; // Verificar si el usuario está autenticado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../index.php');
    exit();
}
define('BASE_URL', 'http://localhost/Cursos'); // Asegúrate de que esta es la URL correcta para tu proyecto

// Verifica si el usuario está autenticado y tiene un user_id en la sesión
if (!isset($_SESSION['user_id'])) {
    die('Acceso denegado. Debes iniciar sesión.');
}

$user_id = $_SESSION['user_id'];

// Obtener cursos contratados por el usuario con la ruta de la imagen
$stmt = $conn->prepare("
    SELECT c.image_path 
    FROM user_courses uc 
    JOIN courses c ON uc.course_id = c.id 
    WHERE uc.user_id = ?
");
$stmt->execute([$user_id]);
$user_courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/navbar.css">
    <link rel="stylesheet" type="text/css" href="../css/cursosEscritorio.css">
    <link rel="stylesheet" type="text/css" href="../css/escritorioDeAlumnos.css">
    <script src="https://kit.fontawesome.com/d5da104675.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="../img/Ellipse 4.png" rel="icon">
    <title>Cursos</title>
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
        <li style="float: right;"><button class="btn btn-outline-primary navBtn"><a href="../User/logout.php">Cerrar Sesión</a></button></li>
        <li><button class="btn btn-outline-primary navBtn2"><a href="../User/logout.php">Cerrar Sesión</a></button></li>
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
        <br>
        <div class="saludoEscritorio">
            <h1>Hola: <?php echo htmlspecialchars($_SESSION['username']); ?> ! </h1>
        </div>
    </header>
		<div class="btn-menu">
			<label for="btn-menu">☰</label>
		</div>
    <section>   
        <input type="checkbox" id="btn-menu">
<div class="container-menu">
	<div class="cont-menu">
    <p>Panel de control</p>
    <img src="../img/Linea.png" alt="">
    <ul class="ul1">
            <li><a href="./escritorioDelAlumno.php">Escritorio</a></li>
            <li><a href="./profile.php">Perfil</a></li>
            <li><a href="./cursosEscritorio.php">Cursos</a></li>
            <li><a href="./preguntas.php">Preguntas</a></li>
            <li><a href="./comunidad.php">Comunidad</a></li>
            <li><a href="./clasesGrupales.php">Clases grupales</a></li>
            <li><a href="./coachingIndividual.php">Coaching</a></li>
        </ul>
		<label for="btn-menu">✖️</label>
	</div>
</div>   
    <div class="bgCursosEscritorio">
        <div class="escritorioButtons">
            <button>
                <a href="./escritorioDelAlumno.php">Escritorio</a>
            </button>            
            <button>
                <a href="./profile.php">Perfil</a>
            </button>           
            <button>
                <a href="./cursosEscritorio.php">Cursos</a>
            </button>          
            <button>
                <a href="./preguntas.php">Preguntas</a>
            </button>        
            <button>
                <a href="./comunidad.php">Comunidad</a>
            </button>        
            <button>
                <a href="./clasesGrupales.php">Clases grupales</a>
            </button>        
            <button>
                <a href="./coachingIndividual.php">Coaching</a>
            </button>        

            <button><a href="../User/logout.php">Salir</a></button>

        </div>
        <div class="cursoEscritorioData">
    <?php if (!empty($user_courses)): ?>
        <div class="cursoList">
            <?php foreach ($user_courses as $course): ?>
                <div class="cursoData">
                    <a href="curso.php">
                        <div class="course">
                            <img width="250" src="<?php echo BASE_URL . '/' . htmlspecialchars($course['image_path']); ?>" alt="Curso">
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No hay cursos disponibles.</p>
    <?php endif; ?>
    <div class="cursoBtnData">
        <button>
            <a href="./cursos.php">Adquirir cursos</a>
        </button>
    </div>
</div>



    </div>
</body>
</html>