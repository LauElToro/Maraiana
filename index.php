<?php
// Asegúrate de que esta línea esté en el principio del archivo
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" type="text/css" href="./css/navbar.css">
    <link rel="stylesheet" type="text/css" href="./css/index.css">
    <link rel="stylesheet" type="text/css" href="./css/popup.css">
    <link rel="stylesheet" type="text/css" href="./css/slider.css">
    <link rel="stylesheet" type="text/css" href="./css/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="img/ellipse 4.png" rel="icon">
    <title>Aprende a cantar</title>
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
</head>
<body>
    <header>
    <nav>
            <div class="redesNavbar">
                <a href="https://www.linkedin.com/in/mariana-mastropietro-artista?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=ios_app" target="_blank"><img  class="linkedinLink"  src="./img/linkedin1.png" alt=""></a>
                <a href="https://www.youtube.com/channel/UCxXlYyH8jRpGXeqQTe0PfhQ" target= "_blank"><img  class="youtubeLink"  src="./img/yout1.png" alt=""></a>
                <a href="https://www.instagram.com/mariana.profedecanto/" target="_blank"><img  class="instagramLink"  src="./img/Instagram.png" alt=""></a>
                <a href="https://api.whatsapp.com/send/?phone=5491140431611&text=Hola+me+interesan+las+clases+de+canto+%3A+Liber%C3%A1+tu+voz&type=phone_number&app_absent=0" target="_blank"><img  class="wasapLink"  src="./img/Wasap.png" alt=""></a>
                <a href="https://www.tiktok.com/@mariana.profedecanto" target="_blank"><img  class="tiktokLink"  src="./img/Tiktok.png" alt=""></a>
                </div>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <img src="./img/menu.png" alt="">
        </label>
        <a href="index.php" class="enlace">
            <img src="./img/Logo2.png" alt="" class="Logo2">
            <img src="./img/Logo.png" alt="" class="Logo">
        </a>
        
        <div id="loginPopup" class="loginPopup" style="display: none;">
        <?php include "./User/login.php"; ?> 
    </div>
  <!-- JavaScript para mostrar y ocultar el popup  -->
  <?php
require 'auth.php';

if (is_logged_in()) {
    echo '<ul>
        <li><a href="./index.php">Inicio</a></li>
        <li><a href="./Pages/cursos.php">Cursos</a></li>
        <li><a href="./Pages/comunidad.php">Comunidad</a></li><li class="dropdown">
            <a href="#" class="dropbtn">Servicios</a>
            <ul class="dropdown-content">
                <li><a href="./Pages/clasesGrupales.php">Clases grupales</a></li>
                <li><a href="./Pages/coachingIndividual.php">Coaching individual</a></li>
            </ul>
        </li>
        <li><a href="./Pages/escritorioDelAlumno.php">Escritorio de alumno</a></li>
        <li style="float: right;"><button class="btn btn-outline-primary navBtn"><a href="user/logout.php">Cerrar Sesión</a></button></li>
        <li><button class="btn btn-outline-primary navBtn2"><a href="user/logout.php">Cerrar Sesión</a></button></li>
    </ul>';
} else {
    echo '<ul>
        <li><a href="./index.php">Inicio</a></li>
        <li><a href="./Pages/comunidad.php">Comunidad</a></li>
        <li class="dropdown">
            <a href="#" class="dropbtn">Servicios</a>
            <ul class="dropdown-content">
                <li><a href="./Pages/clasesGrupales.php">Clases grupales</a></li>
                <li><a href="./Pages/coachingIndividual.php">Coaching individual</a></li>
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
                <img src="./img/Linea.png" alt="">
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
                <img src="./img/Linea.png" alt="">
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
                     window.location.href = './pages/escritorioDelAlumno.php';
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
    
    <div class="bgCont1">
        <div class="bgImgCont">
        <iframe width="100%" height="515" style="margin-left: -20px;" src="https://www.youtube.com/embed/LF7sjXW5SZM?si=z9NqXq08np4xSOBS" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
        <div class="bgCont1Data">
            <div class="bgSubCont1">
                <img class="logoTittle"  src="./img/Logo Index.png" alt="">
                <div class="bgH2Cont">
                    <h2>ESCUELA DE CANTO Y REEDUCACIÓN DE LA VOZ</h2>
                </div>
                <div class="bgH4Cont">
                    <h4 class="h4Data1">¡Cantá y hablá sin forzar tu voz!</h4>
                    <h4 class="h4Data2">!Aprendé a cantar desde cero!</h4>
                </div>
                <div class="bgPCont">
                    <p class="pData1">Lográ agudos con potencia con proyección y sin esfuerzo.</p>
                    <p class="pData2">Desbloqueo del área de la comunicación. <br>Agudos con potencia y sin esfuerzo. <br>Reeducación para docentes y profesionales de la voz.</p>
                </div>
                <div class="bgBtnCont">
                  <button class="comboBtn">
                    <a href="./Pages/clasesGrupales.php">Comenzar</a>
                  </button>
                </div>
            </div>
        </div>
    </div>
    <div class="bgCont2">
        <img class="mandala" src="./img/Mandala.png" alt="">
        <img class="mandala2" src="./img/Mandala.png" alt="">
        <div class="bgH4Cont2">
            <h4>CÓMO TENER UNA VOZ SANA, PROFESIONAL Y EFICAZ</h4>
        </div>
        <div class="bgPCont2">
            <p>¿Querés cantar bien, lindo, colocado y sin forzar?</p>
        </div>
            <ul>
                <li class="liCont">
                    <img src="./img/Persona2.png" alt="">
                    <p>Con un verdadero método de aprendizaje que te funcione a VOS!</p>
                </li>
                <li class="liCont" >
                    <img src="./img/Bandera.png" alt="">
                    <p>Con resultados reales</p>
                </li>
                <li class="liCont">
                    <img src="./img/Mic.png" alt="">
                    <p>Con herramientas actuales</p>
                </li>
                <li class="liCont">
                    <img src="./img/Persona.png" alt="">
                    <p>Con explicaciones claras</p>
                </li>
                <li class="liCont">
                    <img src="./img/Tilde.png" alt="">
                    <p>Viendo los avances clase a clase</p>
                </li>
                <li class="liCont">
                    <img src="./img/Oreja.png" alt="">
                    <p>Escuchándote cantar cada vez mejor</p>
                </li>
            </ul>
            <div class="bgCont2Btn">
                <button>
                  <a href="./Pages/Cursos.php">EMPEZAR YA</a>
                </button>
            </div>
    </div>

     <div class="testimonials">
      <div class="container">
        <img class="contMandala" src="./img/MandalaSlider.png" alt="">
        <div class="section-header">
          <h2 class="title">Qué dicen de mi:</h2>
        </div>
          <div class="testimonials-content">
            <div class="swiper testimonials-slider js-testimonials-slider">
              <div class="swiper-wrapper">
                <div class="swiper-slide testimonials-item">
                  <img class="comillasImg" src="./img/Comillas.png" alt="">
                  <div class="info"></div>
                  <p>Su dinámica me encanta y cada sesión resulta terapéutica y sanadora para mí; me llena de energía muy positiva. 
                  Realmente noto un avance enorme en mi forma de cantar, y en muy poco tiempo. 
                  Destaco la escucha a cada alumno, el resaltar lo lindo de cada uno y las correcciones, que las hace con amor.</p>                    
                    <div class="text-box">
                    <img src="./img/Mandalita.png" alt="img">
                      <h3 class="name">Julia Petralli</h3>
                    </div>
                </div>
                <div class="swiper-slide testimonials-item">
                  <img class="comillasImg" src="./img/Comillas.png" alt="">
                  <div class="info"></div>
                  <p>Este espacio me brindó y me brinda seguridad, confianza, un ambiente agradable, un lugar donde puedo ser libre y disfrutar de cantar.
                  Aprendemos técnicas no solo para cantar mejor, sino para cantar sin dañarnos la voz. Es importante el acompañamiento de tu profesor y eso lo tenemos y lo valoramos muchísimo. Por eso y mucho más seguiría tomando clases con Mariana.</p>
                    <div class="text-box">
                    <img src="./img/Mandalita.png" alt="img">
                      <h3 class="name">Luis Tambuscio</h3>
                    </div>
                  <div class="rating"></div>
                </div>
                <div class="swiper-slide testimonials-item">
                  <img class="comillasImg" src="./img/Comillas.png" alt="">
                  <div class="info"></div>
                  <p>Mariana es una persona muy especial. No solo nos guia a  través de las técnicas vocales, sino que nos enseña tambien a escucharnos, a observarnos... nos brinda un espacio de sanación a través de la voz.</p>
                    <div class="text-box">
                    <img src="./img/Mandalita.png" alt="img">
                      <h3 class="name">Marina Leporace</h3>
                    </div>
                  <div class="rating"></div>
                </div>
                <div class="swiper-slide testimonials-item">
                  <img class="comillasImg" src="./img/Comillas.png" alt="">
                  <div class="info"></div>
                  <p>La calidez, sabiduría y didáctica para transmitir de Mariana es grandiosa! La linda energía, todas las explicaciones, los consejos, los ejercicios... Me brindó infinidad de recursos y herramientas para conocer el potencial de mi voz y así afianzar la confianza en mi misma.</p>
                    <div class="text-box">
                    <img src="./img/Mandalita.png" alt="img">
                      <h3 class="name">Alejandra Braggio</h3>
                    </div>
                  <div class="rating"></div>
                </div>
                <div class="swiper-slide testimonials-item">
                  <img class="comillasImg" src="./img/Comillas.png" alt="">
                  <div class="info"></div>
                  <p>Mariana me cambió la forma general de cantar, la colocación general de mi voz. Las clases me brindan motivación, ganas de ponerme a practicar, acompañamiento. Ella siempre está atenta a mis necesidades y respeta mis tiempos y ritmo de aprendizaje, ¡Súper recomendable!.</p>
                    <div class="text-box">
                    <img src="./img/Mandalita.png" alt="img">
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

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
</body>
    <footer>
        <div class="footerCont">
            <div class="footerImg">
            <img src="./img/Logo Footer.png" alt="">
            </div>
            <div class="footerLinks">
                <h3>Links Importantes</h3>
             <!--   <a href="./Pages/cursos.php">Cursos</a> -->
                <a href="./Pages/comunidad.php">Comunidad</a>
                <a href="./Pages/clasesGrupales.php">Clases grupales</a>
                <a href="./Pages/coachingIndividual.php">Coaching individual</a>
                <!--a href="./Pages/escritorioDelAlumno.php">Escritorio de alumno</a> 
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
</html>
