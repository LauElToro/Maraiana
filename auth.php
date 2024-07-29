<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Función para verificar si el usuario está logueado
function is_logged_in() {
    return isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
}

// Función para redirigir si el usuario no está logueado
function require_login() {
    if (!is_logged_in()) {
        header('Location: login.php');
        exit();
    }
}

// Función para cerrar sesión
function logout() {
    session_destroy();
    header('Location: login.php');
    exit();
}
?>
