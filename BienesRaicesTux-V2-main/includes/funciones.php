<?php
require 'app.php';

function incluirTemplate(string $nombre)
{
    include TEMPLATES_URL . '\\' . "${nombre}.php";
}

function estaAutenticado(): bool
{
    //manejar sesiones para ingresar
    session_start();
    $auth = $_SESSION['login'];
    if ($auth) {
        return true;
    }
    return false;
}

function esAdmin(): bool
{
    session_start();
    $admin = $_SESSION['admin'];
    if ($admin) {
        return true;
    }
    return false;
}
