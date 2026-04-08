<div class="row">
    <div class="col s12">
        <h4 class="header">Taboleiro de Administración</h4>
        <p class="grey-text">Benvenido ao panel de control do CMS Dragon Ball Saga. Desde aquí pode xestionar todo o contido do sitio web.</p>
    </div>
</div>

<div class="row">
    <!-- Estadísticas rápidas -->
    <div class="col s12 m6 l3">
        <div class="card stats-card">
            <div class="card-content center-align">
                <i class="material-icons large">article</i>
                <h5>Total Novas</h5>
                <h3>10</h3>
            </div>
        </div>
    </div>
    
    <div class="col s12 m6 l3">
        <div class="card stats-card">
            <div class="card-content center-align">
                <i class="material-icons large">visibility</i>
                <h5>Novas Activas</h5>
                <h3>9</h3>
            </div>
        </div>
    </div>
    
    <div class="col s12 m6 l3">
        <div class="card stats-card">
            <div class="card-content center-align">
                <i class="material-icons large">home</i>
                <h5>Novas Home</h5>
                <h3>4</h3>
            </div>
        </div>
    </div>
    
    <div class="col s12 m6 l3">
        <div class="card stats-card">
            <div class="card-content center-align">
                <i class="material-icons large">people</i>
                <h5>Usuarios</h5>
                <h3>3</h3>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Acciones rápidas -->
    <div class="col s12 m6">
        <div class="card">
            <div class="card-content">
                <span class="card-title">
                    <i class="material-icons left">article</i>
                    Xestión de Novas
                </span>
                <p>Crea, edita e xestiona todas as noticias do sitio web.</p>
            </div>
            <div class="card-action">
                <a href="/public/admin/novas" class="btn waves-effect waves-light red">
                    <i class="material-icons left">list</i>
                    Ver Todas
                </a>
                <a href="/public/admin/novas/editar/nuevo" class="btn waves-effect waves-light">
                    <i class="material-icons left">add</i>
                    Nova Nova
                </a>
            </div>
        </div>
    </div>
    
    <?php if ($_SESSION['usuarios'] == 1): ?>
    <div class="col s12 m6">
        <div class="card">
            <div class="card-content">
                <span class="card-title">
                    <i class="material-icons left">people</i>
                    Xestión de Usuarios
                </span>
                <p>Administra os usuarios e os seus permisos de acceso.</p>
            </div>
            <div class="card-action">
                <a href="/public/admin/usuarios" class="btn waves-effect waves-light red">
                    <i class="material-icons left">list</i>
                    Ver Todos
                </a>
                <a href="/public/admin/usuarios/editar/nuevo" class="btn waves-effect waves-light">
                    <i class="material-icons left">person_add</i>
                    Novo Usuario
                </a>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<div class="row">
    <!-- Enlaces rápidos -->
    <div class="col s12">
        <div class="card">
            <div class="card-content">
                <span class="card-title">
                    <i class="material-icons left">link</i>
                    Enlaces Rápidos
                </span>
                <div class="row">
                    <div class="col s12 m6 l3">
                        <a href="/public/" target="_blank" class="btn waves-effect waves-light blue-grey full-width">
                            <i class="material-icons left">public</i>
                            Ver Web
                        </a>
                    </div>
                    <div class="col s12 m6 l3">
                        <a href="/public/novas" target="_blank" class="btn waves-effect waves-light blue-grey full-width">
                            <i class="material-icons left">article</i>
                            Noticias
                        </a>
                    </div>
                    <div class="col s12 m6 l3">
                        <a href="/public/acercade" target="_blank" class="btn waves-effect waves-light blue-grey full-width">
                            <i class="material-icons left">info</i>
                            Acerca de
                        </a>
                    </div>
                    <div class="col s12 m6 l3">
                        <a href="/public/contacto" target="_blank" class="btn waves-effect waves-light blue-grey full-width">
                            <i class="material-icons left">contact_mail</i>
                            Contacto
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Información del usuario -->
    <div class="col s12">
        <div class="card blue-grey lighten-5">
            <div class="card-content">
                <span class="card-title">
                    <i class="material-icons left">account_circle</i>
                    Información da Sesión
                </span>
                <div class="row">
                    <div class="col s12 m6">
                        <p><strong>Usuario:</strong> <?php echo $_SESSION['usuario']; ?></p>
                        <p><strong>Permisos:</strong></p>
                        <ul>
                            <li>Gestión de Usuarios: <span class="<?php echo $_SESSION['usuarios'] == 1 ? 'green-text' : 'red-text'; ?>">
                                <?php echo $_SESSION['usuarios'] == 1 ? 'Sí' : 'No'; ?>
                            </span></li>
                            <li>Gestión de Novas: <span class="<?php echo $_SESSION['novas'] == 1 ? 'green-text' : 'red-text'; ?>">
                                <?php echo $_SESSION['novas'] == 1 ? 'Sí' : 'No'; ?>
                            </span></li>
                        </ul>
                    </div>
                    <div class="col s12 m6">
                        <p><strong>Accións dispoñibles:</strong></p>
                        <a href="/public/admin/salir" class="btn waves-effect waves-light red">
                            <i class="material-icons left">exit_to_app</i>
                            Pechar Sesión
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>