<?php
session_start();
include '../db/config.php';


// Verificar si el usuario está autenticado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../index.php');
    exit();
}

// Obtener datos del usuario desde la base de datos
$user_id = $_SESSION['user_id'];

// Consulta para obtener datos del usuario
$stmt = $conn->prepare("SELECT username, email FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if (!$user) {
    echo "Usuario no encontrado.";
    exit();
}

// Consulta para contar la cantidad de cursos contratados por el usuario
$stmt = $conn->prepare("SELECT COUNT(course_id) AS course_count FROM user_courses WHERE user_id = ?");
$stmt->execute([$user_id]);
$course_count = $stmt->fetchColumn();

// Establecer las variables de sesión
$_SESSION['username'] = $user['username'];
$_SESSION['email'] = $user['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/navbar.css">
    <link rel="stylesheet" type="text/css" href="../css/escritorioDeAlumnos.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/d5da104675.js" crossorigin="anonymous"></script>
    <link href="../img/Ellipse 4.png" rel="icon">
    <title>Escritorio de alumno</title>
</head>
<body>
    <header>
        <nav>
        <div class="redesNavbar">
                <a href="https://youtube.com"><img class="youtubeLink" src="../img/Youtube.png" alt="YouTube"></a>
                <a href="https://instagram.com"><img class="instagramLink" src="../img/Instagram.png" alt="Instagram"></a>
                <a href="https://wa.me"><img class="wasapLink" src="../img/Wasap.png" alt="WhatsApp"></a>
                <a href="https://tiktok.com"><img class="tiktokLink" src="../img/Tiktok.png" alt="TikTok"></a>
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
        <li><a href="../User/logout.php">Cerrar Sesión</a></li>
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
        <div>
            <h1>hola <?php echo htmlspecialchars($_SESSION['username']); ?> </h1>
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
                <img src="../img/Linea.png" alt="Linea">
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
    <div class="bgEscritorio">
        <div class="escritorioButtons">
                <button><a href="./escritorioDelAlumno.php">Escritorio</a></button>            
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
                <button>   
                <a href="../User/logout.php">Salir</a>
                </button>
        </div>
        <div class="escritorioData">
            <div class="data1">
                <img src="../img/Libro.png" alt=""> 
                <p><?php echo htmlspecialchars($course_count); ?><br>Cursos Inscriptos</p>             
            </div>
            <div class="data2">
                <img src="../img/Persona2.png" alt=""> 
                <p><?php echo htmlspecialchars($course_count); ?><br>Cursos en proceso</p>             
            </div>
            <div class="data3">
                <img src="../img/Trofeo.png" alt=""> 
                <p>0<br>Finalizados</p>             
            </div>
        </div>
    </div>
</section>
</body>
</html>