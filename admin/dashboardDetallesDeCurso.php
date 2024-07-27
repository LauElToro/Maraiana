<?php
// Configuración de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cursos_db";

// Variables para mensajes de estado
$message = '';
$error = '';

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Establecer conexión con la base de datos usando PDO
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Obtener y limpiar los datos del formulario
        $course_name = htmlspecialchars($_POST['course_name']);
        $what_you_will_learn = htmlspecialchars($_POST['what_you_will_learn']);
        $intended_for = htmlspecialchars($_POST['intended_for']);
        
        // Procesar el temario como una lista separada por saltos de línea
        $syllabus_items = $_POST['syllabus'];
        $syllabus = implode("\n", array_map('htmlspecialchars', $syllabus_items));

        // Obtener el ID del curso y la ruta de la imagen a partir del nombre del curso
        $stmt = $conn->prepare("SELECT id, image_path FROM courses WHERE course_name = :course_name");
        $stmt->bindParam(':course_name', $course_name);
        $stmt->execute();
        $course = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($course) {
            $course_id = $course['id'];
            $image_path = $course['image_path'];

            // Preparar la consulta de inserción
            $stmt = $conn->prepare("INSERT INTO course_details (course_id, what_you_will_learn, intended_for, syllabus, image_path) 
                                    VALUES (:course_id, :what_you_will_learn, :intended_for, :syllabus, :image_path)");

            // Bind parameters
            $stmt->bindParam(':course_id', $course_id);
            $stmt->bindParam(':what_you_will_learn', $what_you_will_learn);
            $stmt->bindParam(':intended_for', $intended_for);
            $stmt->bindParam(':syllabus', $syllabus);
            $stmt->bindParam(':image_path', $image_path);

            // Ejecutar la consulta de inserción
            $stmt->execute();

            // Mensaje de éxito
            $message = "Datos insertados correctamente para el curso: " . $course_name;
        } else {
            $error = "Curso no encontrado.";
        }
    } catch (PDOException $e) {
        // Error de conexión
        $error = "Error de conexión: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Detalles de Curso</title>
    <link rel="stylesheet" href="../css/dashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .message {
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
        }
        .success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }
        .syllabus-item {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }
        .syllabus-item input {
            flex: 1;
            margin-right: 5px;
        }
        .syllabus-item button {
            background-color: #dc3545;
            color: white;
            border: none;
            font-size: 20px;
            border-radius: 10px;
            padding: 5px 10px;
            cursor: pointer;
        }
        .syllabus-item button:hover {
            background-color: #c82333;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('addSyllabusItem').addEventListener('click', function() {
                var syllabusContainer = document.getElementById('syllabusContainer');
                var newItem = document.createElement('div');
                newItem.className = 'syllabus-item';
                newItem.innerHTML = '<input type="text" name="syllabus[]" required><button type="button" onclick="removeItem(this)">Eliminar</button>';
                syllabusContainer.appendChild(newItem);
            });
        });

        function removeItem(button) {
            var item = button.parentElement;
            item.remove();
        }
    </script>
</head>
<body>
    
<nav>
        <div class="navCont">
            <p>Panel de control</p>
            <img src="../img/dashtitulo.png" alt="">
            <div class="navSubCont">
                <a href="../index.php">Ver Sitio</a>
                <img src="../img/pc.png" alt="">
            </div>
        </div>
    </nav>
    <div class="dashboardSection">
        
    <div class="dashboardLinks">
            <ul>
                <li><a href="./dashboard.php">CREAR CURSO</a></li>
                <li><a href="./dashboardEditarCurso.php">EDITAR CURSO</a></li>
                <li><a href="./dashboardDetallesDeCurso.php">DETALLES DE CURSO</a></li>
                <li><a href="./dashboardAlumnos.php">ALUMNOS</a></li>
                <li><a href="./dashboardCombo.php">COMBO</a></li>
                <li><a href="./dashboardComunidad.php">Comunidad</a></li>
                <li><a href="./dashboardCoaching.php">Coaching</a></li>
                <li><a href="./dashboardClasesGrupales.php">Clases grupales</a></li>
                <li><a href="./dashboardInformacion.php">INFO</a></li>
            </ul>
        </div>
    <div class="dashboardCont">      
    <h2 class="detallesH2">Insertar Detalles de Curso</h2>
    <?php
    // Mostrar mensajes de éxito o error
    if (!empty($message)) {
        echo '<div class="message success">' . $message . '</div>';
    }
    if (!empty($error)) {
        echo '<div class="message error">' . $error . '</div>';
    }
    ?>
    <form class="detallesForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="course_name">Nombre del Curso:</label><br>
        <input type="text" id="course_name" name="course_name" required><br><br>

        <label for="what_you_will_learn">Lo que aprenderás:</label><br>
        <textarea id="what_you_will_learn" name="what_you_will_learn" rows="4" required></textarea><br><br>

        <label for="intended_for">Orientado para:</label><br>
        <textarea id="intended_for" name="intended_for" rows="4" required></textarea><br><br>

        <label for="syllabus">Temario del Curso:</label><br>
        <div id="syllabusContainer">
            <div class="syllabus-item">
                <input type="text" name="syllabus[]" required>
                <button type="button" onclick="removeItem(this)">Eliminar</button>
            </div>
        </div>
        <button class="detallesBtn" type="button" id="addSyllabusItem">Agregar Item</button><br><br>
        <input class="detallesBtn" type="submit" value="Insertar Detalles del Curso">
    </form>
        </div>
    </div>
</body>
</html>
