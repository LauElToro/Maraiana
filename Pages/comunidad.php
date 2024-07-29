<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/navbar.css">
    <link rel="stylesheet" type="text/css" href="../css/comunidad.css">
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="../img/Ellipse 4.png" rel="icon">
    <script src="https://kit.fontawesome.com/d5da104675.js" crossorigin="anonymous"></script>
    <link href="../img/Ellipse 4.png" rel="icon">
    <title>Comunidad</title>
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
    <script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault();
            
            var email = document.getElementById('loginEmail').value;
            var password = document.getElementById('loginPassword').value;

            fetch('./User/login.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({
      
                    'email': email,
                    'password': password
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    localStorage.setItem('user_id', data.user_id);
                    localStorage.setItem('username', data.username);
                    localStorage.setItem('email', data.email);
                    localStorage.setItem('role_id', data.role_id);
                    alert('Login exitoso');
                     window.location.href = 'escritorioDelAlumno.php';
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        });

        document.getElementById('registerForm').addEventListener('submit', function(event) {
            event.preventDefault();
            var username = document.getElementById('registerUsername').value;
            var email = document.getElementById('registerEmail').value;
            var password = document.getElementById('registerPassword').value;

            fetch('./User/register.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({
                    'username': username,
                    'email': email,
                    'password': password,
                    'role_id': 2 // Asumimos que el rol por defecto es "User"
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    localStorage.setItem('user_id', data.user_id);
                    localStorage.setItem('username', data.username);
                    localStorage.setItem('email', data.email);
                    localStorage.setItem('role_id', data.role_id);
                    alert('Registro exitoso');
                    // window.location.href = 'dashboard.html';
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    </script>

    <div class="bgCont1Web">
        <div class="bgSubCont1Web">
            <img class="logoComunidad1" src="../img/Logo Index.png" alt="">
            <div class="bgSubContH4">
                <h4>UNA COMUNIDAD PARA APRENDER A CANTAR Y REEDUCAR TU VOZ
                 A TU RITMO Y EN TUS TIEMPOS LIBRES
                </h4>
            </div>
            <div class="bgBtnCont3">
                <button>
                    <a href="./compraComunidad.php">Consultar</a>
                    <img src="../img/Wasap.png" alt="">
                </button>
            </div>
        </div>
        <div class="bgSubCont2Web">
        <iframe width="100%" height="515" src="https://www.youtube.com/embed/ApVbQqlNOzU?si=sXUvOmFuG0wHL9HI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
    </div>
    <div class="bgCont2">
        <div class="bgPCont2">
            <div class="bgH3Cont">
                <h3>¿Qué es?</h3>
            </div>
            <div class="bgPData">
                <p><strong>Es una comunidad exclusiva en whatsapp en la que todos los meses pongo a tu disposición herramientas y recursos muy valiosos para liberar tu voz.</strong></p>
            </div> 
            <div class="bgPData">        
                <p>Cada semana iré compartiendo distintas <strong>técnicas de relajación, respiración y vocalización,</strong>  con el fin de que liberes tu sonido sin tensiones y para que logres una <strong> voz sana, potente, con claridad, proyección y sin esfuerzo.</strong></p>
            </div>
            <div class="bgPData"> 
                <p>La Comunidad <strong>“Liberá tu voz”</strong> también te da la posibilidad de pertenecer a un grupo en donde compartimos experiencias, recomendaciones, logros, y podés hacer consultas directamente a Mariana.</p>
            </div>
        </div>
        <div class="comunidadImg">
            <img class="comunidadWebImg" src="../img/ComunidadWeb2.png" alt="">
        </div>       
    </div>
    <div class="bgCont3">
           <img class="mandala" src="../img/Mandala.png" alt="">
        <div class="bgH4Cont2">
           <h4>Sumándote obtenés:</h4> 
        </div>
        <ul class="ul1">
            <li class="liCont">
                <img src="../img/Tilde.png" alt="">
                <p>CONTACTO DIRECTO CON MARIANA PARA
                HACER CONSULTAS, ENVIAR TUS AUDIOS 
                Y RECIBIR CORRECCIONES.</p>
            </li>
            <li class="liCont">
                <img src="../img/Tilde.png" alt="">
                <p>EJERCICIOS EN FORMATO AUDIO Y VIDEOS</p>
            </li>
            <li class="liCont">
                <img src="../img/Tilde.png" alt="">
                <p>CLASES GRABADAS SEMANALES</p>
            </li>
            <li class="liCont">
                <img src="../img/Tilde.png" alt="">
                <p>UNA COMUNIDAD PARA COMPARTIR
                TUS AVANCES Y TUS LOGROS</p>
            </li>
        </ul>
        <div class="bgBtnCont2">
            <button>
                <a href="./compraComunidad.php">Consultar</a>
                <img src="../img/Wasap.png" alt="">
            </button>
        </div>
    </div>
    <div class="bgCont4">
        <div class="bgH4Cont3">
            <h4>Valores y métodos de pago:</h4>
        </div>
        <div class="bgPCont3">
            <p class="pCont">
                <strong>
                Se abona mediante efectivo, depósito/transferencia, Mercado Pago o Paypal.
                </strong>
            </p>
            <p class="pCont">
               <strong>
                Al momento de escribir por whatsapp,
                se te enviarán los datos correspondientes para el pago.
               </strong> 
            </p>
            <p class="pCont">
               <strong>
                Una vez que abones envianos tu comprobante
                de pago y te uniremos a la Comunidad.
               </strong> 
            </p>
            <p class="pCont">
                <strong>
                Toda información adicional que necesites,
                podés consultarla por whatsapp   
                </strong>
            </p>
        </div>
        <div class="bgSubCont4">
            <div class="bgH4Cont4">
                <h4>Si estás listo para aprender a cantar y a hablar sin forzar tu voz</h4>
            </div>
            <div class="bgPCont4">
                <p>Te espero en la comunidad exclusiva</p>
            </div>
            <div class="bgBtnCont">
                <button>
                    <img src="../img/Wasap.png" alt="">
                    <a href="./compraComunidad.php">Consultar</a>
                </button>
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
                <a href="./comunidad.php">Comunidad</a>
                <a href="./clasesGrupales.php">Clases grupales</a>
                <a href="./coachingIndividual.php">Coaching individual</a>
                <!-- a href="./Pages/escritorioDelAlumno.php">Escritorio de alumno</a 
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