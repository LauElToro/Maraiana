<?php
session_start();
include '../db/config.php'; // Verificar si el usuario está autenticado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../index.php');
    exit();
}
define('BASE_URL', 'http://localhost/Cursos/'); // Asegúrate de que esta es la URL correcta para tu proyecto

if (isset($_GET['course_id'])) {
    $curse_id = $_GET['course_id'];

    // Obtener datos del curso
    $course_query = $conn->prepare("SELECT * FROM courses WHERE id = :id");
    $course_query->execute([':id' => $course_id]);
    $course = $course_query->fetch(PDO::FETCH_ASSOC);

    // Obtener detalles del curso
    $details_query = $conn->prepare("SELECT * FROM course_details WHERE course_id = :course_id");
    $details_query->execute([':course_id' => $course_id]);
    $course_details = $details_query->fetch(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/navbar.css">
    <link rel="stylesheet" type="text/css" href="../css/cursos.css">
    <link rel="stylesheet" type="text/css" href="../css/popup.css">
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/d5da104675.js" crossorigin="anonymous"></script>
    <link href="../img/Ellipse 4.png" rel="icon">
    <title>Cursos</title>
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
        function mostrarModal(courseId) {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'get_course_details.php?course_id=' + courseId, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var courseDetails = JSON.parse(xhr.responseText);
                        console.log('Detalles del curso:', courseDetails);

                        if (courseDetails.error) {
                            console.error(courseDetails.error);
                            return;
                        }

                        // Actualiza el contenido del modal
                        document.getElementById('modalImg').src = courseDetails.image_path || '';
                        document.getElementById('learn').textContent = courseDetails.what_you_will_learn || 'No disponible';
                        document.getElementById('for').textContent = courseDetails.intended_for || 'No disponible';

                        // Limpiar la lista de temario antes de llenarla nuevamente
                        var syllabusList = document.getElementById('syllabus');
                        syllabusList.innerHTML = '';
                        
                        // Dividir el syllabus en elementos por cada salto de línea
                        var syllabusItems = (courseDetails.syllabus || '').split('\n');
                        syllabusItems.forEach(function (item) {
                            var li = document.createElement('li');
                            li.className = 'liModalCont';
                            li.innerHTML = '<img src="../img/Black icon.png" alt=""><p>' + item.trim() + '</p>';
                            syllabusList.appendChild(li);
                        });

                        // Actualizar el enlace 'Ver más' con los parámetros GET
                        var btnVerMas = document.getElementById('btnVerMas');
                        var syllabusParam = encodeURIComponent(JSON.stringify(syllabusItems));
                        btnVerMas.href = `compra.php?course_id=${courseId}&learn=${encodeURIComponent(courseDetails.what_you_will_learn)}&for=${encodeURIComponent(courseDetails.intended_for)}&syllabus=${syllabusParam}&image=${encodeURIComponent(courseDetails.image_path)}`;

                        // Mostrar el modal
                        var modal = document.querySelector('.containerModal');
                        if (modal) {
                            modal.style.display = 'flex';
                        } else {
                            console.error('Modal no encontrado.');
                        }
                    } else {
                        console.error('Error al obtener los detalles del curso:', xhr.status);
                    }
                }
            };
            xhr.send();
        }

        function cerrarModal() {
            var modal = document.querySelector('.containerModal');
            if (modal) {
                modal.style.display = 'none';
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
    
        <div class="bgCont1">
            <div class="bgSubCont1">
                <div class="bgImgCont">
                <iframe width="100%" height="515" src="https://www.youtube.com/embed/LF7sjXW5SZM?si=z9NqXq08np4xSOBS" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
            </div>
            <div class="bgSubCont2">
                <div class="bgH4Cont">
                    <h4>Cursos de canto y reeducación de la voz</h4>
                </div>
                <div class="bgPCont">
                    <p>Aprendé todo mi método de forma fácil, práctica y efectiva, con una modalidad flexible</p>
                </div>
                <button class="contratarBtn2">
                    <a href="./compra.php?course_id=<?php echo htmlspecialchars($course_id); ?>">COMENZAR</a>
                </button>
            </div>
            <div>
                <img class="mandalaCursos" src="../img/MandalaCursos.png" alt="">
            </div>
        </div>
        <div class="bgCont2">
            <div class="cursoBg">
                <?php
                // Obtener todos los cursos
                $all_courses_query = $conn->query("SELECT * FROM courses");
                while ($course_item = $all_courses_query->fetch(PDO::FETCH_ASSOC)) {
                    // Asegurarse de que no haya duplicación en la ruta de la imagen
                    $image_path = BASE_URL  . ltrim(htmlspecialchars($course_item['image_path']), '/');
                    echo '<div class="itemCurso" onclick="mostrarModal(' . htmlspecialchars($course_item['id']) . ')">
                            <img class="courseImg" src="' . $image_path . '" alt="Curso ">
                        </div>';
                }
                ?>
            </div>
        </div>
    </section>
    <div class="containerModal" style="display: none;">
        <div class="subContModal">
            <div class="closeIconModal">
                <i class="fas fa-times" onclick="cerrarModal()"></i>
            </div>
            <div class="contModal">
                <div class="divModalImg">
                    <img id="modalImg" src="" alt="">
                    <a id="btnVerMas" href="#" class="btn btn-info">Ver más</a>
                </div>
                <div class="modalContent">
                    <h2>En este curso aprenderas:</h2>
                    <p id="learn">No disponible</p>

                    <h2>Orientado para:</h2>
                    <p id="for">No disponible</p>

                    <h2>Temario:</h2>
                    <ul id="syllabus"></ul>
                </div>
            </div>
        </div>
    </div>
    <div class="comboCursosBg">
            <img src="../img/Combo3cursos.png" alt="">
            <button class="contratarBtn2"><a href="compraComboCursos.php">Ver este combo</a></button>
        </div>

</body>
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
</html>
