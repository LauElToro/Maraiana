<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/navbar.css">
    <link rel="stylesheet" type="text/css" href="../css/clasesGrupales.css">
    <link rel="stylesheet" type="text/css" href="../css/slider.css">
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    
    <link href="../img/Ellipse 4.png" rel="icon">
    <script src="https://kit.fontawesome.com/d5da104675.js" crossorigin="anonymous"></script>
    <title>Clases grupales</title>
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
        <li><a href="../Pages/cursos.php">Cursos</a></li> 
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
        <li style="float: right;">
                    <button class="btn btn-outline-primary navBtn" id="loginButton1">INGRESAR</button></li>
                    <li><button class="btn btn-outline-primary navBtn2" id="loginButton2">INGRESAR</button></li>
      </ul>';
    }
    ?> 
        </nav>
    </header>

    <script>
        function mostrarPopup() {
            var popup = document.getElementById("loginPopup");
            popup.style.display = "block";
        }

        function ocultarPopup() {
            var popup = document.getElementById("loginPopup");
            popup.style.display = "none";
        }
    </script>
<!-- Este script debe estar al final del archivo HTML, después de definir el popup -->




<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('..\db\config.php');

?>



<!--SCRIPT PARA EL BOTON DEL NAVBAR-->

<script>
        document.addEventListener('DOMContentLoaded', function() {
            // Abrir el popup
            document.getElementById('loginButton1').addEventListener('click', function() {
                document.getElementById('popup').style.display = 'flex';
                document.getElementById('popupOverlay').style.display = 'block';
            });

            document.getElementById('loginButton2').addEventListener('click', function() {
                document.getElementById('popup').style.display = 'flex';
                document.getElementById('popupOverlay').style.display = 'block';
            });

            // Cerrar el popup al hacer clic en el botón 'X'
            document.getElementById('closeButton').addEventListener('click', function() {
                document.getElementById('popup').style.display = 'none';
                document.getElementById('popupOverlay').style.display = 'none';
            });

            document.getElementById('closeButton2').addEventListener('click', function() {
                document.getElementById('popup2').style.display = 'none';
                document.getElementById('popupOverlay').style.display = 'none';
            });

        });
    </script>
<!--SCRIPT PARA CERRAR LOS POPUP-->
<script>
        // Función para cerrar el popup
        function cerrarPopup(popupId) {
            let popup = document.getElementById(popupId);
            popup.style.display = 'none';
            document.getElementById('popupOverlay').style.display = 'none';
        }

        // Agregar eventos a los botones
        document.getElementById('closeButton').addEventListener('click', function() {
            cerrarPopup('popup');
        });

        document.getElementById('closeButton2').addEventListener('click', function() {
            cerrarPopup('popup2');
        });

    
    </script>

<!--SCRIPT PARA EL SWITCH DE POPUP-->
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const registerLink = document.getElementById('registerLink');
        const loginLink = document.getElementById('loginLink');
        const popup = document.getElementById('popup');
        const popup2 = document.getElementById('popup2');
        const popupOverlay = document.getElementById('popupOverlay');

        registerLink.addEventListener('click', (e) => {
            e.preventDefault();
            popup.style.display = 'none';
            popup2.style.display = 'block';
            popupOverlay.style.display = 'block'; // Ensure the overlay remains visible
        });

        loginLink.addEventListener('click', (e) => {
            e.preventDefault();
            popup2.style.display = 'none';
            popup.style.display = 'block';
            popupOverlay.style.display = 'block'; // Ensure the overlay remains visible
        });
    });
</script>

    <section>
    <div class="popup-overlay" id="popupOverlay">
        <div class="popup" id="popup">
            <button class="closeButton" id="closeButton">X</button>
            <div class="loginData">
                <h2>Inicia sesión</h2>
                <img src="../img/Linea.png" alt="">
                <form method="POST" id="loginForm">

                    <label for="email">Email:</label>
                    <input class="inputEmail" type="text" id="loginEmail" name="email" required><br>
                    <label for="password">Contraseña:</label>
                    <input class="inputPassword" type="password" id="loginPassword" name="password" required><br>
                    <input class="inputSubmit" type="submit" value="Iniciar sesión">
                </form>
                <p>No tienes una cuenta? <a href="#" id="registerLink">Regístrate</a></p>
            </div>
        </div>
        <div class="popup2" id="popup2">
            <button class="closeButton" id="closeButton2">X</button>
            <div class="registerData">
                <h2>Regístrate</h2>
                <img src="../img/Linea.png" alt="">
                <form method="POST" id="registerForm">
                    <label for="username">Usuario:</label>
                    <input class="inputName" type="text" id="registerUsername" name="username" required><br>
                    <label for="email">Email:</label>
                    <input class="inputEmail" type="text" id="registerEmail" name="email" required><br>
                    <label for="password">Contraseña:</label>
                    <input class="inputPassword" type="password" id="registerPassword" name="password" required><br>
                    <input type="number" value="2" name="role_id" id="role_id" style="display:none">
                    <input class="inputSubmit" type="submit" value="Registrar">
                </form>
                <p>¿Ya tienes una cuenta? <a href="#" id="loginLink">Inicia Sesión</a></p>
            </div>
        </div>
    </div>
        <div class="bgCont1">
            <div class="bgSubCont1">
                <img src="../img/ClasesGrupalesCompra.png" alt="">
            </div>
            <div class="bgSubCont2">
                <div class="h4Cont1">
                    <h4>¡Canto grupal!</h4>
                </div>
                <div class="bgSubCont3">
                    <div class="subContP">
                        <p>¿Te gustaría aprender a cantar bien, sin forzar tu voz?</p>
                    </div>
                    <div class="subContP">
                        <p>¿Querés liberar emociones
                        y ganar confianza en vos mismo/a?</p>
                    </div>
                    <div class="subContP">
                        <p>¿Querés aprender una técnica vocal para reeducar tu voz y cantar sin tensiones?</p>
                    </div>
                </div>
                    <div class="subContP2">
                        <p>Si respondiste que SÍ a alguna de las preguntas anteriores te invito a consultar por las clases regulares. Estas clases, te darán herramientas y recursos para mejorar tu voz, y al mismo tiempo te brindarán un espacio de expresión 
                        y disfrute personal.</p>
                    </div>
                <div class="bgBtnCont">
                <button>
                    <a href="./clasesGrupalesCompra.php">Consultar</a>
                    <img src="../img/Wasap.png" alt="">
                </button>
                </div>                    
            </div>
            <div class="bgSubCont4">
                <img src="../img/ClasesGrupalesCompra.png" alt="">
            </div>
        </div>
        <div class="bgCont2">
            <div>
                <h3>¿Qué vas a aprender?</h3>
            </div>
            <ul class="ul1">
                <li class="liCont">
                    <img src="../img/Tilde2.png" alt="">
                    <p>A tener dominio y control del aire y del sonido,
                    respirando libre de ansiedad.
                    </p>
                </li>
                <li class="liCont">
                    <img src="../img/Tilde2.png" alt="">
                    <p>Herramientas y recursos vocales para liberar tu voz, 
                    sin tensiones.</p>
                </li>
                <li class="liCont">
                    <img src="../img/Tilde2.png" alt="">
                    <p>A hacer uso de tu voz de una forma sana.</p>
                </li>
                <li class="liCont">
                    <img src="../img/Tilde2.png" alt="">
                    <p>A proyectar tu voz ganando seguridad y confianza.</p>
                </li>
            </ul>
        </div>
        <div class="bgCont3">
            <div class="h4Cont2">
                <h4>¿Cómo son las clases?</h4>
            </div>
            <ul class="ul2">
                <li class="liCont2">
                    <img src="../img/Tilde2.png" alt="">
                    <p>Personalizadas y en grupos reducidos:
                    te escucho cantar y te corrijo todas las clases.</p>
                </li>
                <li class="liCont2">
                    <img src="../img/Tilde2.png" alt="">
                    <p>Regulares: te acompaño en tu proceso de toma de conciencia de hábitos fonatorios para corregirlos mediante ejercicios adaptados a tus necesidades.</p>
                </li>
                <li class="liCont2">
                    <img src="../img/Tilde2.png" alt="">
                    <p>Por la plataforma ZOOM: nos encontramos por zoom una vez por semana durante 2 hs. La clase de divide en dos momentos: relajación y técnica vocal, e interpretación de canciones.</p>
                </li>
            </ul>
            <div class="bgCont3Box1">
                <p>EJERCICIOS DE RELAJACIÓN Y TÉCNICA VOCAL:</p>
                <p>Entrenamos la voz de manera grupal e individual, atendiendo las necesidades de cada alumno. Los ejercicios de vocalización están especialmente diseñados para la reeducación la voz, y están planificados y pensados para las necesidades de todos los integrantes del grupo.</p>
            </div>
            <div class="bgCont3Box2">
                <p>INTERPRETACIÓN DE CANCIONES:</p>
                <p>Los alumnos cantan integrando la técnica vocal, la expresión y la liberación de su voz. Priorizamos la salud de las cuerdas vocales y el uso correcto del aparato fonador. Se respeta siempre el proceso individual.</p>
            </div>
            <div class="h4Cont3">
                <h4>¡Podés empezar en cualquier momento del año!</h4>
            </div>
            <div class="bgBtnCont">
                <button>
                    <a href="./clasesGrupalesCompra.php">Consultar</a>
                    <img src="../img/Wasap.png" alt="">
                </button>
            </div>                    
        </div>
        <div class="bgCont4">
            <div class="h4Cont4">
                <h4>¿Qué otros beneficios tenés?</h4>
            </div>
            <ul class="ul3">
                <li class="liCont3">
                    <img src="../img/Tilde2.png" alt="">
                    <p>Las clases se graban y se envían, por lo que podés verlas después y también podés seguir practicando en tus tiempos libres.</p>
                </li>
                <li class="liCont3">
                    <img src="../img/Tilde2.png" alt="">
                    <p>Tenés acceso a la Comunidad de Canto de WhatsApp, en donde recibís todo el material de las clases, vocalizaciones, podés hacer consultas y compartir tus avances y progresos.</p>
                </li>
            </ul>
        </div>
        <div class="bgCont6">
            <div class="h4Cont5">
                <h4>Valores y métodos de pago:</h4>
            </div>
            <div class="subContP3">
                <p>Se abona mediante efectivo, depósito/transferencia, Mercado Pago o Paypal.</p>
                <p>Al momento de escribir por whatsapp,
                se te enviarán los datos correspondientes para el pago.</p>
                <p>Toda información adicional que necesites,
                podés consultarla por whatsapp.</p>
            </div>
            <div class="bgBtnCont">
                <button>
                    <a href="./clasesGrupalesCompra.php">Consultar</a>
                    <img src="../img/Wasap.png" alt="">
                </button>
            </div>       
        </div>

    <div class="testimonials">
      <div class="container">
        <img class="contMandala" src="../img/MandalaSlider.png" alt="">
        <div class="section-header">
          <h2 class="title">Qué dicen de mi:</h2>
        </div>
          <div class="testimonials-content">
            <div class="swiper testimonials-slider js-testimonials-slider">
              <div class="swiper-wrapper">
                <div class="swiper-slide testimonials-item">
                  <img class="comillasImg" src="../img/Comillas.png" alt="">
                  <div class="info"></div>
                  <p>Su dinámica me encanta y cada sesión resulta terapéutica y sanadora para mí; me llena de energía muy positiva. 
                  Realmente noto un avance enorme en mi forma de cantar, y en muy poco tiempo. 
                  Destaco la escucha a cada alumno, el resaltar lo lindo de cada uno y las correcciones, que las hace con amor.</p>                    
                    <div class="text-box">
                    <img src="../img/Mandalita.png" alt="img">
                      <h3 class="name">Julia Petralli</h3>
                    </div>
                </div>
                <div class="swiper-slide testimonials-item">
                  <img class="comillasImg" src="../img/Comillas.png" alt="">
                  <div class="info"></div>
                  <p>Este espacio me brindó y me brinda seguridad, confianza, un ambiente agradable, un lugar donde puedo ser libre y disfrutar de cantar.
                  Aprendemos técnicas no solo para cantar mejor, sino para cantar sin dañarnos la voz. Es importante el acompañamiento de tu profesor y eso lo tenemos y lo valoramos muchísimo. Por eso y mucho más seguiría tomando clases con Mariana.</p>
                    <div class="text-box">
                    <img src="../img/Mandalita.png" alt="img">
                      <h3 class="name">Luis Tambuscio</h3>
                    </div>
                  <div class="rating"></div>
                </div>
                <div class="swiper-slide testimonials-item">
                  <img class="comillasImg" src="../img/Comillas.png" alt="">
                  <div class="info"></div>
                  <p>Mariana es una persona muy especial. No solo nos guia a  través de las técnicas vocales, sino que nos enseña tambien a escucharnos, a observarnos... nos brinda un espacio de sanación a través de la voz.</p>
                    <div class="text-box">
                    <img src="../img/Mandalita.png" alt="img">
                      <h3 class="name">Marina Leporace</h3>
                    </div>
                  <div class="rating"></div>
                </div>
                <div class="swiper-slide testimonials-item">
                  <img class="comillasImg" src="../img/Comillas.png" alt="">
                  <div class="info"></div>
                  <p>La calidez, sabiduría y didáctica para transmitir de Mariana es grandiosa! La linda energía, todas las explicaciones, los consejos, los ejercicios... Me brindó infinidad de recursos y herramientas para conocer el potencial de mi voz y así afianzar la confianza en mi misma.</p>
                    <div class="text-box">
                    <img src="../img/Mandalita.png" alt="img">
                      <h3 class="name">Alejandra Braggio</h3>
                    </div>
                  <div class="rating"></div>
                </div>
                <div class="swiper-slide testimonials-item">
                  <img class="comillasImg" src="../img/Comillas.png" alt="">
                  <div class="info"></div>
                  <p>Mariana me cambió la forma general de cantar, la colocación general de mi voz. Las clases me brindan motivación, ganas de ponerme a practicar, acompañamiento. Ella siempre está atenta a mis necesidades y respeta mis tiempos y ritmo de aprendizaje, ¡Súper recomendable!.</p>
                    <div class="text-box">
                    <img src="../img/Mandalita.png" alt="img">
                      <h3 class="name">Veronica Herrera</h3>
                    </div>
                  <div class="rating"></div>
                </div>
              </div>
            </div>
            <div class="swiper-pagination js-testimonials-pagination"></div>
          </div>
      </div>
    </div>   

        <div class="bgCont8">
            <div class="h4Cont6">
                <h4>Preguntas frecuentes:</h4>
            </div>
            <div class="subContP4">
                <h4>¿Cómo me sumo a las clases?</h4>
                <p>Solo necesitás dar click al botón de whatsapp para ponernos en contacto. Te preguntaremos si sos residente de Argentina o del exterior y te enviaremos la información de los valores y formas de pago.</p>
            </div>
            <div class="subContP4">
                <h4>¿El pago es anticipado o se puede abonar después?</h4>
                <p>El pago es anticipado. Una vez que nos enviás tu comprobante de pago, te agregamos al grupo de whatsaap y te enviamos la información de conexión.</p>
            </div>
            <div class="subContP4">
                <h4>¿Qué pasa si falto a una clase?</h4>
                <p>Las clases se graban y se envían dentro del mes para que puedas participar de forma asincrónica a las clases que no asististe. A través del grupo de whatsapp podés consultarle a Mariana lo que necesites, incluso enviar un video cantando para recibir correcciones.</p>
            </div>
        </div> 
        </div>
    </section>
    
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


<script>
  const swiper = new Swiper('.js-testimonials-slider', {
    grabCursor: true,
    spaceBetween:30,
    pagination:{
      el: '.js-testimonials-pagination',
      clickable: true
    },
    breakpoints: {
      767:{
        slidesPerView: 2
      }
    }
  });
</script>
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