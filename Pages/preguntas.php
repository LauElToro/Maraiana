<?php
session_start();

include '../db/config.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../index.php');
    exit();
}

// Obtener datos del usuario desde la base de datos
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT username, email FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if (!$user) {
    echo "Usuario no encontrado.";
    exit();
}

// Establecer las variables de sesión
$_SESSION['username'] = $user['username'];
$_SESSION['email'] = $user['email'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/navbar.css">
    <link rel="stylesheet" type="text/css" href="../css/preguntas.css">
    <link rel="stylesheet" type="text/css" href="../css/escritorioDeAlumnos.css">
    <script src="https://kit.fontawesome.com/d5da104675.js" crossorigin="anonymous"></script>
    <link href="../img/Ellipse 4.png" rel="icon">
    <title>Preguntas</title>
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
        <br>
        <div>
            <h1>hola <?php echo htmlspecialchars($_SESSION['username']); ?> </h1>
        </div>
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
    <section>
    <div class="bgPreguntas">
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
                <button><a href="../User/logout.php">Salir</a></button>
        </div>
        <div class="preguntasData">
            <div class="preguntasDataCont">
                <strong>¿Cómo me sumo a las clases?</strong>
                <p>Solo necesitás dar click al botón de WhatsApp para ponernos en contacto.Te preguntaremos si sos residente de argentina o del exterior y te enviaremos la información de los valores y formas de pago.</p>
            </div>
            <div class="preguntasDataCont">
            <strong>¿El pago es anticipado o se puede abonar después?</strong>
            <p>El pago es anticipado. Una vez que nos enviás tu comprobante de pago, te agregamos al grupo de Whatsapp y te enviamos la información de conexión</p>
            </div>
            <div class="preguntasDataCont">
            <strong>¿Qué pasa si falto a una clase?</strong>
            <p>Las clases se graban y se envían para que puedas verlas y hacer los ejercicios, siempre dentro del mes en curso. A través del grupo de whatsapp podés consultarle a Mariana lo que necesites.</p>
            </div>
            <div class="bgBtnCont">
                    <button>
                        <img src="../img/Wasap.png" alt=""><a href="https://api.whatsapp.com/send/?phone=5491140431611&text=%C2%A1Hola!%20Soy%20residente%20de%20Argentina,%20solicito%20informaci%C3%B3n%20del%20Coaching%20individual%20con%20la%20profesora%20Mariana%C2%A0Mastropietro." >Consultar</a>
                    </button>
                    
                </div>      

        </div>
    </div>
    </section>
</body>
</html>