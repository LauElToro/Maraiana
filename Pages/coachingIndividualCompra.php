<?php
session_start();
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
    <title>Coaching individual</title>
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
        <!--   <li><a href="../Pages/cursos.php">Cursos</a></li> -->
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
        <!--    <li style="float: right;"><button class="btn btn-outline-primary navBtn" id="loginButton">INGRESAR</button></li>
        <li><button class="btn btn-outline-primary navBtn2" id="loginButton">INGRESAR</button></li> -->
      </ul>';
    }
    ?> 
   
    
        </nav>
    </header>
    <section> 
        <div class="bgCompraCont">
                <?php
                $valorDe1Clase = "$25,000";
                $valorDe2Clases = "$40.000";
                $valorDe3Clases = "$74,000";
                ?> 
           
            <div class="cursosCont">
                 <h2>Coaching individual</h2>
                <div class="comprarCursoCont2">
                    <!--p class="valorArs">1 Clase  <?php  echo $valorDe1Clase; ?><p>
                    <p class="valorArs">2 Clases <?php  echo $valorDe2Clases; ?></p>
                    <p class="valorArs">3 Clases <?php  echo $valorDe3Clases; ?></p -->
                    <p class="pData">Residentes de Argentina</p>
                </div>    
                <div class="bgBtnCont">
                    <button>
                        <a href="https://api.whatsapp.com/send/?phone=5491140431611&text=%C2%A1Hola!%20Soy%20residente%20de%20Argentina,%20solicito%20informaci%C3%B3n%20del%20Coaching%20individual%20con%20la%20profesora%20Mariana%C2%A0Mastropietro." >Consultar</a>
                    </button>
                    <img src="../img/Wasap.png" alt="">
                </div>      
                <div class="comprarCursoCont2">
                    <p class="pData">Residentes del exterior</p>
                </div>
                <div class="bgBtnCont">
                    <button>
                        <a href="https://api.whatsapp.com/send/?phone=5491140431611&text=%C2%A1Hola!%20Soy%20residente%20del%20exterior,%20solicito%20informaci%C3%B3n%20del%20Coaching%20individual%20con%20la%20profesora%20Mariana%C2%A0Mastropietro.">Consultar</a>
                    </button>
                    <img src="../img/Wasap.png" alt="">
                </div>
            </div>   
            <img class="imgCompra" src="../img/coachingIndividualCompra.png" alt="">
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
                <a href="./comunidad.php">Comunidad</a>
                <a href="./clasesGrupales.php">Clases grupales</a>
                <a href="./coachingIndividual.php">Coaching individual</a>
                <!--a href="./Pages/escritorioDelAlumno.php">Escritorio de alumno</a 
                <a href="">Términos y condiciones</a> -->
            </div>
            <div class="footerRedes">
                <h3>Seguime</h3>
                <a href="https://www.tiktok.com/@mariana.profedecanto" target="_blank">TikTok</a>
                <a href="https://www.instagram.com/mariana.profedecanto/" target="_blank">Instagram</a>
                <a  href="https://www.youtube.com/channel/UCxXlYyH8jRpGXeqQTe0PfhQ" target= "_blank">Youtube</a>
                <a  href="https://www.linkedin.com/in/mariana-mastropietro-artista?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=ios_app" target= "_blank">Linkedin</a>
            </div>
            <div class="footerContacto">
                <h3>Contacto</h3>
                <a href="https://api.whatsapp.com/send/?phone=5491140431611&text=Hola+me+interesan+las+clases+de+canto+%3A+Liber%C3%A1+tu+voz&type=phone_number&app_absent=0" target="_blank">Whatsapp</a>
            </div>
        </div>
    </footer> 
</body>
</html>