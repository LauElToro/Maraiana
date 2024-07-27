<?php
session_start();
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
                <a href="###"><img  class="youtubeLink"  src="../img/Youtube.png" alt=""></a>
                <a href="###"><img  class="instagramLink"  src="../img/Instagram.png" alt=""></a>
                <a href="###"><img  class="wasapLink"  src="../img/Wasap.png" alt=""></a>
                <a href="###"><img  class="tiktokLink"  src="../img/Tiktok.png" alt=""></a>
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
        <!--         <li><a href="../Pages/cursos.php">Cursos</a></li> -->
                <li><a href="../Pages/comunidad.php">Comunidad</a></li>
                <li><a href="../Pages/clasesGrupales.php">Clases grupales</a></li>
                <li><a href="../Pages/coachingIndividual.php">Coaching individual<a><li>
                <li><a href="../Pages/escritorioDelAlumno.php">Escritorio de alumno<a><li>
              </ul>';
    } else {
        // Si el usuario no está autenticado, mostrar enlaces de inicio de sesión y registro
      
        echo '<ul>            
        <li><a href="../index.php">Inicio</a></li>         
        <!--     <li><a href="../Pages/cursos.php">Cursos</a></li> -->
        <li><a href="../Pages/comunidad.php">Comunidad</a></li>
        <li class="dropdown">
            <a href="#" class="dropbtn">Servicios</a>
            <ul class="dropdown-content">
            <li><a href="../Pages/clasesGrupales.php">Clases grupales</a></li>
            <li><a href="../Pages/coachingIndividual.php">Coaching individual</a></li>
            </ul>
        </li>
        <!--      <li style="float: right;"><button class="btn btn-outline-primary navBtn" id="loginButton">INGRESAR</button></li>
        <li><button class="btn btn-outline-primary navBtn2" id="loginButton">INGRESAR</button></li> -->
      </ul>';
    }
    ?> 
        </nav>
    </header>
    <section>
    <div class="bgEscritorio">
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
                <button>
                    Salir
                </button>
                
        </div>
        <div class="escritorioData">
            <div class="data1">
                <img src="../img/Libro.png" alt=""> 
                <p>0<br>Cursos Inscriptos</p>             
            </div>
            <div class="data2">
                <img src="../img/Persona2.png" alt=""> 
                <p>0<br>Cursos Inscriptos</p>             
            </div>
            <div class="data3">
                <img src="../img/Trofeo.png" alt=""> 
                <p>0<br>Cursos Inscriptos</p>             
            </div>
        </div>
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