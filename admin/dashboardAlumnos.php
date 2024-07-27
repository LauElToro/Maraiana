<?php
session_start();
include '../db/config.php';

if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 1) { // Verificar si el usuario es admin
    header("Location: ../index.php");
    exit();
}

// Obtener la lista de usuarios con sus fechas de registro
$stmt_users = $conn->query("SELECT * FROM users")->fetchAll();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control - Usuarios</title>
    <link rel="stylesheet" href="../css/dashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<body>
    <nav>
    <div class="navCont">
        <div class="btn-menu">
			<label for="btn-menu">☰</label>
		</div>
        <p>Panel de control</p>
        <img src="../img/dashtitulo.png" alt="">
        <div class="navSubCont">
            <a href="">Ver Sitio</a>
            <img src="../img/pc.png" alt="">
        </div>
    </div>
</nav>
<section class="dashboardSection">
<div class="capa"></div>
<!--	--------------->
<input type="checkbox" id="btn-menu">
<div class="container-menu">
	<div class="cont-menu">
    <p>Panel de control</p>
    <img src="../img/Linea.png" alt="">
    <ul class="ul1">
            <li><a href="./dashboard.php">CREAR CURSO</a></li>
            <li><a href="./dashboardEditarCurso.php">EDITAR CURSO</a></li>
            <li><a href="./dashboardAlumnos.php">ALUMNOS</a></li>
            <li><a href="./dashboardCombo.php">COMBO</a></li>
            <li><a href="./dashboardComunidad.php">Comunidad</a></li>
            <li><a href="./dashboardCoaching.php">Coaching</a></li>
            <li><a href="./dashboardClasesGrupales.php">Clases grupales</a></li>
            <li><a href="./dashboardInformacion.php">INFORMACION</a></li>
        </ul>
		<label for="btn-menu">✖️</label>
	</div>
</div>
<div class="dashboardLinks">
        <ul>
            <li><a href="./dashboard.php">CREAR CURSO</a></li>
            <li><a href="./dashboardEditarCurso.php">EDITAR CURSO</a></li>
            <li><a href="./dashboardAlumnos.php">ALUMNOS</a></li>
            <li><a href="./dashboardCombo.php">COMBO</a></li>
            <li><a href="./dashboardComunidad.php">Comunidad</a></li>
            <li><a href="./dashboardCoaching.php">Coaching</a></li>
            <li><a href="./dashboardClasesGrupales.php">Clases grupales</a></li>
            <li><a href="./dashboardInformacion.php">INFORMACION</a></li>
        </ul>
</div>
        <div class="capa"></div>
        <!-- Menú lateral -->
        <!-- Tu menú lateral -->
        
        <!-- Contenido principal -->
        
        <div class="dashboardEditarCursos">
            <h2 class="registrosH2">Usuarios Registrados</h2>

            <!-- Listado de usuarios -->
            <div class="alumnosCard">
                <table>
                    <tr class="row1">
                        <td>NOMBRE</td>
                        <td>CORREO</td>
                        <td>FECHA DE ALTA</td>
                        <!-- Puedes agregar más columnas según sea necesario -->
                    </tr>
                    <?php foreach ($stmt_users as $user): ?>
                        <tr class="row2">
                            <td><?= isset($user['username']) ? htmlspecialchars($user['username']) : 'Nombre no disponible' ?></td>
                            <td><?= isset($user['email']) ? htmlspecialchars($user['email']) : 'Correo no disponible' ?></td>
                            <td><?= isset($user['registration_date']) ? htmlspecialchars($user['registration_date']) : 'Fecha no disponible' ?></td>
                            <!-- Aquí puedes agregar más datos según los campos nuevos en la base de datos -->
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </section>
</body>

</html>

<link rel="stylesheet" href="../css/dashboard.css">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

