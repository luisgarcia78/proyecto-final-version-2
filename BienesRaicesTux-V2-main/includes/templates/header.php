<?php

if (!isset($_SESSION)) {
    session_start();
}
$auth = $_SESSION['login'] ?? false;
$admin = $_SESSION['admin'] ?? false;

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- mandamos a llamar un API de google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Krub:wght@400;700&display=swap" rel="stylesheet">
    <!-- mandamos a llamar la hoja de estilos y la hoja de normalize -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/normalize.css">
    <title>BienesRaicesTux</title>
</head>

<body>
    <!-- header -->
    <header>
        <div class="head">
            <div class="head-title">
                <h1>Bienes<span>Raices</span>Tux</h1>
            </div>
            <div class="head-text">
                <p></p>
                Venta de Casas y Departamentos en Tuxtla Gutierrez, Chiapas.
                </p>
            </div>
            <!-- boton -->
            <a href="contacto.php" class="boton">Contactame</a>
        </div>
    </header>
    <!-- barra menu -->
    <section class="container container-menu menu">
        <div class="logo">
            <a href="index.php">BienesRaicesTux</a>
        </div>
        <!-- botones para activar o desactivar el menu -->
        <div class="botones ocultar">
            <!-- estrella para favoritos -->
            <a href="favoritos.php">
                <svg class="favorito" xmlns=" http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" />
                </svg>
            </a>
            <buttton class="menu-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M4 6H20V8H4zM4 11H20V13H4zM4 16H20V18H4z" />
                </svg>
                <svg class="none" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M16.192 6.344L11.949 10.586 7.707 6.344 6.293 7.758 10.535 12 6.293 16.242 7.707 17.656 11.949 13.414 16.192 17.656 17.606 16.242 13.364 12 17.606 7.758z" />
                </svg>
            </buttton>
        </div>
        <!-- menu de contenido -->
        <nav class="bar-nav">
            <ul class="bar-menu" id="bar-menu">
                <li class="menu--item">
                    <a class="home ocultar menu--link" href="index.php">Home</a>
                    <a class="menu--link none" href="favoritos.php">
                        <svg class="none favorito" xmlns=" http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" />
                        </svg>
                    </a>
                </li>
                <li class="menu--item contenedor-menu">
                    <a class="menu--link submenu-btn" href="#">Cuenta
                        <svg xmlns="http://www.w3.org/2000/svg" class="ocultar icon icon-tabler icon-tabler-chevron-down" width="30" height="30" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <polyline points="6 9 12 15 18 9" />
                        </svg>
                    </a>
                    <!-- usamos un submenu para las partes desplegables -->
                    <ul class="submenu">
                        <li class="menu--item">
                            <a class="menu--link" href="login.php">Iniciar Sesión</a>
                        </li>
                        <li class="menu--item">
                            <a class="menu--link" href="cuenta.php">Crear Cuenta</a>
                        </li>
                    </ul>
                </li>
                <li class="menu--item">
                    <a class="menu--link" href="publicar.php">Publicar</a>
                </li>
                <li class="menu--item contenedor-menu">
                    <a class="menu--link submenu-btn" href="#">Catalago
                        <svg xmlns="http://www.w3.org/2000/svg" class="ocultar icon icon-tabler icon-tabler-chevron-down" width="30" height="30" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <polyline points="6 9 12 15 18 9" />
                        </svg>
                    </a>
                    <!-- usamos un submenu para las partes desplegables -->
                    <ul class="submenu">
                        <li class="menu--item">
                            <a class="menu--link" href="venta.php">Venta</a>
                        </li>
                        <li class="menu--item">
                            <a class="menu--link" href="renta.php">Renta</a>
                        </li>
                    </ul>
                </li>
                <li class="menu--item">
                    <a class="menu--link" href="contacto.php">Contacto</a>
                </li>
                <li class="menu--item">
                    <a class="menu--link" href="nosotros.php">Nosotros</a>
                </li>
                <li class="menu--item">
                    <a class="menu--link" href="dudas.php">Dudas</a>
                </li>
                <?php if ($admin) : ?>
                    <li class="menu--item">
                        <a class="menu--link" href="admin.php">Administacón</a>
                    </li>
                <?php endif; ?>
                <?php if ($auth || $admin) : ?>
                    <li class="menu--item">
                        <a class="menu--link" href="cerrar-sesion.php">Cerrar Sesion</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </section>