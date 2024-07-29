<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/navbar.css">
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <link rel="stylesheet" type="text/css" href="../css/compraComboCursos.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/d5da104675.js" crossorigin="anonymous"></script>
    <link href="../img/Ellipse 4.png" rel="icon">
    <title>Coaching individual</title>
    <script>
        function toggleDropdown() {
  var dropdown = document.getElementById("myDropdown");
  dropdown.classList.toggle("show");
}

window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

    </script>
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
        <li><a href="../Pages/logout.php">Cerrar Sesión</a></li>
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
      /*SCRIPT DE LOS POPUPS DE CURSOS*/
  function mostrarModal() {
    var modal = document.querySelector('.containerModal');
    modal.style.display = 'flex';
  }

  function cerrarModal() {
    var modal = document.querySelector('.containerModal');
    modal.style.display = 'none';
  }
  
  function mostrarModal2() {
    var modal = document.querySelector('.containerModal2');
    modal.style.display = 'flex';
  }

  function cerrarModal2() {
    var modal = document.querySelector('.containerModal2');
    modal.style.display = 'none';
  }
  
  function mostrarModal3() {
    var modal = document.querySelector('.containerModal3');
    modal.style.display = 'flex';
  }

  function cerrarModal3() {
    var modal = document.querySelector('.containerModal3');
    modal.style.display = 'none';
  }
</script>
<script>
    // Funciones para mostrar y ocultar popups
    function togglePopup(popupId) {
        var popup = document.getElementById(popupId);
        var overlay = document.getElementById('popupOverlay');
        if (popup.style.display === 'none' || !popup.style.display) {
            popup.style.display = 'flex';
            overlay.style.display = 'block';
        } else {
            popup.style.display = 'none';
            overlay.style.display = 'none';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('loginButton1').addEventListener('click', function() {
            togglePopup('popup');
        });

        document.getElementById('loginButton2').addEventListener('click', function() {
            togglePopup('popup');
        });

        document.getElementById('closeButton').addEventListener('click', function() {
            togglePopup('popup');
        });

        document.getElementById('closeButton2').addEventListener('click', function() {
            togglePopup('popup2');
        });

        document.getElementById('registerLink').addEventListener('click', function(e) {
            e.preventDefault();
            togglePopup('popup');
            togglePopup('popup2');
        });

        document.getElementById('loginLink').addEventListener('click', function(e) {
            e.preventDefault();
            togglePopup('popup2');
            togglePopup('popup');
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