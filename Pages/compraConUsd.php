<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/navbar.css">
    <link rel="stylesheet" type="text/css" href="../css/compraConArs.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/d5da104675.js" crossorigin="anonymous"></script>
    <link href="../img/Ellipse 4.png" rel="icon">
    <title>Ventana de compra</title>
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
        <!--    <li><a href="../Pages/cursos.php">Cursos</a></li> -->
        <li><a href="../Pages/comunidad.php">Comunidad</a></li>
        <li><a href="../Pages/clasesGrupales.php">Clases grupales</a></li>
        <li><a href="../Pages/coachingIndividual.php">Coaching individual<a><li>
        <li><a href="../Pages/escritorioDelAlumno.php">Escritorio de alumno<a><li>

              </ul>';
    } else {
        // Si el usuario no está autenticado, mostrar enlaces de inicio de sesión y registro
        echo '<ul>            
        <li><a href="../index.php">Inicio</a></li>         
        <!--      <li><a href="../Pages/cursos.php">Cursos</a></li> -->
        <li><a href="../Pages/comunidad.php">Comunidad</a></li>
        <li class="dropdown">
            <a href="#" class="dropbtn">Servicios</a>
            <ul class="dropdown-content">
            <li><a href="../Pages/clasesGrupales.php">Clases grupales</a></li>
            <li><a href="../Pages/coachingIndividual.php">Coaching individual</a></li>
            </ul>
        </li>
        <!--   <li style="float: right;"><button class="btn btn-outline-primary navBtn" id="loginButton">INGRESAR</button></li>
        <li><button class="btn btn-outline-primary navBtn2" id="loginButton">INGRESAR</button></li> -->
      </ul>';
    }
    ?> 
        </nav>
    </header>
    <section>
        <div class="bgCont1">
                <?php
                $valorDeCurso = "80USD";
                ?> 
            <div class="subCont1">
                <form>
                <h4>CLIENTE</h4>
                <div class="inputCont">
                    <input type="text" placeholder="PAIS" requiered>
                </div>
                <div class="inputSubCont1">
                    <div class="inputCont2">
                        <input type="text" placeholder="NOMBRE" requiered>
                    </div>
                    <div class="inputCont2">
                        <input type="text" placeholder="APELLIDO" requiered>
                    </div>
                </div>
                <div class="inputCont">
                    <input type="number" placeholder="TELEFONO" requiered>
                </div>
                <div class="inputSubCont2">
                    <div class="inputCont2">
                        <input type="text" placeholder="TIPO DE DNI" requiered>
                    </div>
                    <div class="inputCont2">
                        <input type="number" placeholder="DNI" requiered>
                    </div>
                </div>
                </form>
                    <img src="../img/paypal.jpeg" width="250" alt="">
            </div>

            <div class="subCont2">
                <div class="bgSubCont1">
                    <h4>PAGO</h4>
                    <img src="../img/Curso1.png" alt="">
                </div>
                <div class="bgSubCont2">
                    <h4>TOTAL</h4>
                    <img src="../img/Linea.png" alt="">
                    <p class="valorArs"><?php  echo $valorDeCurso; ?></p>
                    <button>PAGAR</button>
                </div>
                <div class="usdImg">
                    <img src="../img/Linea.png" alt="">
                </div>
                <div class="bgSubCont2Web">
                    <h4>TOTAL</h4>
                    <p class="valorUsd"><?php  echo $valorDeCurso; ?></p>
                </div>
                    <button class="arsBtn">PAGAR</button>
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