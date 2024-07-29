<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../index.php');
    exit();
}

// Definir la URL base de tu aplicación
define('BASE_URL', 'http://localhost/Cursos/'); // Asegúrate de ajustar esto según la URL base real de tu sitio

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['course_id'], $_POST['course_name'], $_POST['image_path'], $_POST['precio'])) {
        $course_id = htmlspecialchars($_POST['course_id']);
        $course_name = htmlspecialchars($_POST['course_name']);
        $imagenCurso = htmlspecialchars($_POST['image_path']);
        $precio = floatval($_POST['precio']);
    } else {
        echo "Faltan parámetros en la solicitud.";
        exit;
    }
} else {
    echo "Método de solicitud no permitido.";
    exit;
}

$endpoint =  /* //"https://api-3t.sandbox.paypal.com/nvp"; Usa  */"https://api-3t.paypal.com/nvp"; // para producción
$version = "204.0";
$method = "SetExpressCheckout";

// Datos para la solicitud
$data = [
    'METHOD' => $method,
    'VERSION' => $version,
    'USER' => 'mariana.mastropietro.eventos_api1.gmail.com',
    'PWD' => 'AHMMWVDUXZL8BFG2',
    'SIGNATURE' => 'AivkqA-4YffFBBGV3wGe3au-MPQxABr91Vusm2sIZ7iH2sOcWeW7mBbI',
    'RETURNURL' => 'http://localhost/maraiana-main/maraiana/Backend/paypal_success.php',
    'CANCELURL' => 'http://localhost/maraiana-main/maraiana/Backend/cancel.php',
    'PAYMENTREQUEST_0_AMT' => $precio,
    'PAYMENTREQUEST_0_CURRENCYCODE' => 'USD'
];

$queryString = http_build_query($data);

// Enviar solicitud
$response = file_get_contents($endpoint . '?' . $queryString);
parse_str($response, $parsedResponse);

// Redirigir al usuario a PayPal
if (isset($parsedResponse['TOKEN'])) {
    $approvalUrl = "https://www.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=" . $parsedResponse['TOKEN'];
    header("Location: $approvalUrl");
    exit();
} else {
    echo "Error en la respuesta de PayPal: " . $response;
}

// Construir la ruta de la imagen
$image_path = BASE_URL . ltrim(htmlspecialchars($imagenCurso), '/');
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
<<<<<<< HEAD
            <div class="redesNavbar">
                <a href="###"><img class="youtubeLink" src="../img/Youtube.png" alt=""></a>
                <a href="###"><img class="instagramLink" src="../img/Instagram.png" alt=""></a>
                <a href="###"><img class="wasapLink" src="../img/Wasap.png" alt=""></a>
                <a href="###"><img class="tiktokLink" src="../img/Tiktok.png" alt=""></a>
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
                <li><a href="../index.php">Inicio</a></li>
                <li><a href="../Pages/cursos.php">Cursos</a></li>
                <li><a href="../Pages/comunidad.php">Comunidad</a></li>
                <li class="dropdown">
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
=======
            
        <div class="redesNavbar">
            <a href="https://www.linkedin.com/in/mariana-mastropietro-artista?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=ios_app" target="_blank"><img  class="linkedinLink"  src="../img/linkedin1.png" alt=""></a>
            <a href="https://www.youtube.com/channel/UCxXlYyH8jRpGXeqQTe0PfhQ" target= "_blank"><img  class="youtubeLink"  src="../img/yout1.png" alt=""></a>
                <a href="https://www.instagram.com/mariana.profedecanto/" target="_blank"><img  class="instagramLink"  src="../img/Instagram.png" alt=""></a>
                <a href="https://api.whatsapp.com/send/?phone=5491140431611&text=Hola+me+interesan+las+clases+de+canto+%3A+Liber%C3%A1+tu+voz&type=phone_number&app_absent=0" target="_blank"><img  class="wasapLink"  src="../img/Wasap.png" alt=""></a>
                <a href="https://www.tiktok.com/@mariana.profedecanto" target="_blank"><img  class="tiktokLink"  src="../img/Tiktok.png" alt=""></a>
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
        <li style="float: right;"><button class="btn btn-outline-primary navBtn" id="loginButton1"><a href="../User/logout.php">Cerrar Sesión</a></button></li>
        <li><button class="btn btn-outline-primary navBtn2" id="loginButton2"><a href="../User/logout.php">Cerrar Sesión</a></button></li>
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
>>>>>>> ec04df2785cf41159ab0447a9cd8b9f645726153
        </nav>
    </header>
    <section>
        <div class="bgCont1">
        <?php
            $valorDeCurso = $precio;
            ?> 
            <div class="subCont1">
                <form>
                    <h4>CLIENTE</h4>
                    <div class="inputCont">
                        <input type="text" placeholder="PAIS" required>
                    </div>
                    <div class="inputSubCont1">
                        <div class="inputCont2">
                            <input type="text" placeholder="NOMBRE" required>
                        </div>
                        <div class="inputCont2">
                            <input type="text" placeholder="APELLIDO" required>
                        </div>
                    </div>
                    <div class="inputCont">
                        <input type="number" placeholder="TELEFONO" required>
                    </div>
                    <div class="inputSubCont2">
                        <div class="inputCont2">
                            <input type="text" placeholder="TIPO DE DNI" required>
                        </div>
                        <div class="inputCont2">
                            <input type="number" placeholder="DNI" required>
                        </div>
                    </div>
                </form>
                <img src="../img/paypal.jpeg" width="250" alt="">
            </div>

            <div class="subCont2">
            <div class="bgSubCont1">
                    <h4>PAGO</h4>
                    <img src="<?php echo $image_path; ?>" alt="Imagen del curso">
                </div>
                <div class="bgSubCont2">
                    <h4>TOTAL</h4>
                    <img src="../img/Linea.png" alt="">
                    <p class="valorArs"><?php echo htmlspecialchars($valorDeCurso); ?></p>
                    <button>PAGAR</button>
                </div>
                <div class="usdImg">
                    <img src="../img/Linea.png" alt="">
                </div>
                <div class="bgSubCont2Web">
                    <h4>TOTAL</h4>
                    <p class="valorUsd"><?php echo htmlspecialchars($valorDeCurso); ?></p>
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
