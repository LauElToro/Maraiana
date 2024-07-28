<?php
session_start();
include '../db/config.php'; // Asegúrate de que este archivo contenga la configuración de tu conexión PDO
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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/d5da104675.js" crossorigin="anonymous"></script>
    <link href="../img/Ellipse 4.png" rel="icon">
    <title>Cursos</title>

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
                <a href="#"><img class="youtubeLink" src="../img/Youtube.png" alt=""></a>
                <a href="#"><img class="instagramLink" src="../img/Instagram.png" alt=""></a>
                <a href="#"><img class="wasapLink" src="../img/Wasap.png" alt=""></a>
                <a href="#"><img class="tiktokLink" src="../img/Tiktok.png" alt=""></a>
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
                echo '<ul>            
                    <li><a href="comunidad.php">Comunidad</a></li>
                    <li><a href="clasesGrupales.php">Clases grupales</a></li>
                    <li><a href="coachingIndividual.php">Coaching individual</a></li>
                    <li><a href="escritorioDelAlumno.php">Escritorio de alumno</a></li>
                    <li><a href="logout.php">Cerrar Sesión</a></li>
                </ul>';
            } else {
                echo '<ul>            
                    <li><a href="../index.php">Inicio</a></li>          
                    <li><a href="comunidad.php">Comunidad</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropbtn">Servicios</a>
                        <ul class="dropdown-content">
                            <li><a href="clasesGrupales.php">Clases grupales</a></li>
                            <li><a href="coachingIndividual.php">Coaching individual</a></li>
                        </ul>
                    </li>
                </ul>';
            }
            ?> 
        </nav>
    </header>
    <section>
        <div class="bgCont1">
            <div class="bgSubCont1">
                <div class="bgImgCont">
                    <img class="imgCursos1" src="../img/CursoWeb.png" alt="">
                    <img class="imgCursos2" src="../img/Cursos Bg.png" alt="">
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
            <button class="contratarBtn2"><a href="#">Ver este combo</a></button>
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
