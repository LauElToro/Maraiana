<?php
require 'auth.php';

// Cerrar sesión
logout();

function logout() {
    session_start();
    session_unset();
    session_destroy();
    header('Location: ../index.php'); // Redirige a la página de inicio
    exit();
}
?>
