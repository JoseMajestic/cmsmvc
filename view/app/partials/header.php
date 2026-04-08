<!DOCTYPE html>
<html lang="gl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="/public/img/favicon.ico" type="image/x-icon">
    <title>Dragon Ball Saga</title>

    <!-- fontes e estilos -->
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- css persoalizado -->
    <link rel="stylesheet" href="/public/css/app.css">
</head>

<body>
    <nav>
        <div class="nav-wrapper">
            <!-- logotipo -->
            <a href="/public/" class="brand-logo">
                <img src="/public/img/logo.png" alt="Logotipo">
            </a>

            <!-- botón menú móbiles -->
            <a href="#" data-target="mobile-menu" class="sidenav-trigger"><i class="material-icons">menu</i></a>

            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="/public/" title="Inicio">Inicio</a></li>
                <li><a href="/public/novas" title="Novas">Novas</a></li>
                <li><a href="/public/acercade" title="Acerca de">Acerca de</a></li>
                <li><a href="/public/contacto" title="Contacto">Contacto</a></li>
                <!-- enlace á administración -->
                <li><a href="/public/admin" class="grey-text" title="Administración" target="_blank">Admin</a></li>
            </ul>
        </div>
    </nav>

    <!-- menú de navegación móbil -->
    <ul id="mobile-menu" class="sidenav">
        <li><a href="/public/" title="Inicio">Inicio</a></li>
        <li><a href="/public/novas" title="Novas">Novas</a></li>
        <li><a href="/public/acercade" title="Acerca de">Acerca de</a></li>
        <li><a href="/public/contacto" title="Contacto">Contacto</a></li>
        <!-- enlace á administración -->
        <li><a href="/public/admin" class="grey-text" title="Administración" target="_blank">Admin</a></li>
    </ul>

    <main>
        <header>
            <h1>DragonBall Saga</h1>
            <h2>con POO, MVC, PHP e MySQL</h2>
        </header>
        <section class="container-fluid">