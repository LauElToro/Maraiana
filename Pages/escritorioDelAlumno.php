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
</body>
</html>