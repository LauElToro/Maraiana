<?php
session_start();
include '../db/config.php';

if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 1) { // Verificar si el usuario es admin
    header("Location: ../index.php");
    exit();
}

// Consulta para obtener la cantidad de usuarios registrados
$stmt_usuarios = $conn->query("SELECT COUNT(*) AS total_usuarios FROM users");
$total_usuarios = $stmt_usuarios->fetch(PDO::FETCH_ASSOC)['total_usuarios'];

// Consulta para obtener la cantidad de cursos vendidos (debes ajustar según tu estructura de base de datos)
$stmt_cursos_vendidos = $conn->query("SELECT COUNT(*) AS total_cursos_vendidos FROM compras_cursos");
$total_cursos_vendidos = $stmt_cursos_vendidos->fetch(PDO::FETCH_ASSOC)['total_cursos_vendidos'];

// Consulta para obtener la cantidad de usuarios dados de baja (debes ajustar según tu estructura de base de datos)
$stmt_usuarios_baja = $conn->query("SELECT COUNT(*) AS total_usuarios_baja FROM usuarios_baja");
$total_usuarios_baja = $stmt_usuarios_baja->fetch(PDO::FETCH_ASSOC)['total_usuarios_baja'];

?>

<link rel="stylesheet" href="../css/dashboard.css">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

<nav>
    <div class="navCont">
        <div class="btn-menu">
			<label for="btn-menu">☰</label>
		</div>
        <p>Panel de control</p>
        <img src="../img/dashtitulo.png" alt="">
        <div class="navSubCont">
            <a href="../index.php">Ver Sitio</a>
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
    <div class="dashboardCursos">
        <div class="dashboardCards">
            <div class="infoCard">
                <h4>CANTIDAD DE USUARIOS</h4>
                <img src="../img/dbpersonas.png" alt="">
                <p><?php echo $total_usuarios; ?></p>
            </div>
            <div class="infoCard">
                <h4>CANTIDAD DE CURSOS VENDIDOS</h4>
                <img src="../img/dbcanasto.png" alt="">
                <p><?php echo $total_cursos_vendidos; ?></p>
            </div>
            <div class="infoCard">
                <h4>FECHA DE INICIO</h4>
                <img src="../img/dbcalendario.png" alt="">
                <p>10/07/2024</p>
            </div>
            <div class="infoCard">
                <h4>USUARIO BAJA</h4>
                <img src="../img/dbbajas.png" alt="">
                <p><?php echo $total_usuarios_baja; ?></p>
            </div>
        </div>
    </div>
</section>
