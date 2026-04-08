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
    <link rel="stylesheet" href="/public/css/admin.css">
</head>

<body>
    <nav>
        <div class="nav-wrapper">
            <!-- logotipo -->
            <a href="/public/admin" class="brand-logo" title="Inicio"><img src="/public/img/logo.png" alt="Logotipo"></a>

            <?php if (isset($_SESSION['usuario'])) { ?>
                <!-- icono menu responsivo -->

                <a href="#" data-target="menu-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>

                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="/public/admin" title="Inicio">Inicio</a></li>

                    <?php if ($_SESSION['novas'] == 1) { ?>
                        <li><a href="/public/admin/novas">Novas</a></li>
                    <?php } ?>

                    <?php if ($_SESSION['usuarios'] == 1) { ?>
                        <li><a href="/public/admin/usuarios">Usuarios</a></li>
                    <?php } ?>

                    <li>
                        <a href="/public/admin/salir" title="Saír">Saír</a>
                    </li>

                </ul>
            <?php } ?>

        </div>
    </nav>


    <?php if (isset($_SESSION['usuario'])) { ?>
        <!-- menu mobil -->
        <ul id="menu-mobile" class="sidenav">
            <li><a href="/public/admin" title="Inicio">Inicio</a></li>

            <?php if ($_SESSION['novas'] == 1) { ?>
                <li><a href="/public/admin/novas">Novas</a></li>
            <?php } ?>

            <?php if ($_SESSION['usuarios'] == 1) { ?>
                <li><a href="/public/admin/usuarios">Usuarios</a></li>
            <?php } ?>

            <li>
                <a href="/public/admin/salir" title="Saír">Saír</a>
            </li>

        </ul>

    <?php } ?>


    <!-- Definir variables de sesión para el admin -->
    <?php 
    if (!isset($_SESSION['public'])) {
        $_SESSION['public'] = '/public/';
    }
    if (!isset($_SESSION['home'])) {
        $_SESSION['home'] = '/public/';
    }
    ?>


    <main>

        <header>
            <h1>Taboleiro de administración</h1>
            <?php if (isset($_SESSION['usuario'])) { ?>

                <h2>Usuario: <strong><?php echo $_SESSION['usuario'] ?></strong></h2>

            <?php } else { ?>

                <h2>Benvida, introduce usuario e contrasinal.</h2>
            <?php } ?>
        </header>

        <section class="container-fluid">