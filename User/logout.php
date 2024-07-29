<?php
// Iniciar la sesión
session_start();

// Eliminar todas las variables de sesión
$_SESSION = array();

// Si se usa una cookie de sesión, eliminar

// Destruir la sesión
session_destroy();

// Redirigir al usuario a la página de inicio o de inicio de sesión
header("Location: ../index.php");
exit();
?>