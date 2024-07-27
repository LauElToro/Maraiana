<?php
session_start();
require_once '../vendor/autoload.php';

// Verifica que MercadoPagoConfig se haya cargado correctamente

// Importa las clases necesarias del SDK de MercadoPago
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;

// Agrega credenciales ACCESS_TOKEN
MercadoPagoConfig::setAccessToken("APP_USR-214004285591922-070212-07575a2c44625256a88a0f5965cfbbd2-71530083"); // Reemplaza con tu ACCESS_TOKEN válido

// Crea una instancia del cliente de preferencias de MercadoPago
$client = new PreferenceClient();

// Ejemplo de datos de producto
$items = [
    [
        "id" => "DEP-0001",
        "title" => "Curso",
        "quantity" => 1,
        "unit_price" => 50000
    ]
];

// Crea una preferencia de pago con los detalles del producto y otras configuraciones
try {
    $preference = $client->create([
        "items" => $items,
        "statement_descriptor" => "MI TIENDA",
        "external_reference" => "CDP001",
    ]);

    // Verifica si la preferencia se creó correctamente
    if ($preference instanceof MercadoPago\Resources\Preference) {
        $preference_id = $preference->id;
    } else {
        // Manejo de error si la preferencia no se creó correctamente
        echo "Error al crear la preferencia";
    }
} catch (Exception $e) {
    // Captura cualquier excepción lanzada durante la creación de la preferencia
    echo "Excepción capturada: " . $e->getMessage();
}
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
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <script>
    // Función para manejar el pago cuando se hace clic en el botón "PAGAR"
    function handlePayment(button) {
        // Oculta el botón al hacer clic
        button.style.display = 'none';

        // Lógica adicional para manejar el pago con MercadoPago
        const mp = new MercadoPago('APP_USR-89a1eb91-010b-4edd-a52d-fc9c99b5cb4f', {
            locale: 'es-AR'
        });

        // Obtén el ID de preferencia desde PHP y asegúrate de que esté disponible
        const preferenceId = '<?php echo $preference->id; ?>';

        mp.checkout({
            preference: {
                id: preferenceId
            },
            render: {
                container: '#wallet_container',
                label: 'PAGAR',
            }
        });
    }
</script>
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
        <!--     <li><a href="../Pages/cursos.php">Cursos</a></li> -->
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
                $valorDeCurso = "$50,000";
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
                    <img src="../img/Mercado pago.png" alt="">
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
                <div class="arsImg">
                    <img src="../img/Linea.png" alt="">
                </div>
                <div class="bgSubCont2Web">
                    <h4>TOTAL</h4>
                    <p class="valorArs"><?php  echo $valorDeCurso; ?></p>
                    </div><div id="wallet_container">
                     <button class="arsBtn" onclick="handlePayment(this)">PAGAR</button>
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