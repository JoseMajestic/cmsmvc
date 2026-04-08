<h3>Acceso</h3>

<div class="row">
    <form class="col m12 l6" method="POST">
        <?php 
        // Iniciar sesión si no está iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['mensaxe'])): 
            $mensaje = $_SESSION['mensaxe'];
            $tipo = $mensaje['tipo'];
            $texto = $mensaje['texto'];
            
            // Determinar colores según tipo
            $card_class = $tipo === 'green' ? 'green' : ($tipo === 'red' ? 'red' : 'orange');
            $text_class = $tipo === 'green' ? 'green-text' : ($tipo === 'red' ? 'red-text' : 'orange-text');
            $icon = $tipo === 'green' ? 'check_circle' : ($tipo === 'red' ? 'error' : 'warning');
        ?>
            <div class="row">
                <div class="col m12 l6">
                    <div class="card <?php echo $card_class; ?> lighten-4">
                        <div class="card-content">
                            <i class="material-icons left"><?php echo $icon; ?></i>
                            <span class="<?php echo $text_class; ?>">
                                <strong><?php echo $texto; ?></strong>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <?php unset($_SESSION['mensaxe']); ?>
        <?php endif; ?>
        <div class="row">
            <div class="input-field col s12">
                <input id="usuario" type="text" name="usuario" value="<?php echo isset($_POST['usuario']) ? htmlspecialchars($_POST['usuario']) : ''; ?>">
                <label for="usuario">Usuario</label>
            </div>
            <div class="input-field col s12">
                <input id="contrasinal" type="password" name="contrasinal" value="">
                <label for="contrasinal">Contrasinal</label>
            </div>
            <div class="input-field col s12">
                <button class="btn waves-effect waves-light" type="submit" name="acceder">Acceder
                    <i class="material-icons right">person</i>
                </button>
            </div>
        </div>
    </form>
</div>

<!-- Información de usuarios para testing -->
<div class="row">
    <div class="col m12 l6">
        <div class="card blue-grey lighten-5">
            <div class="card-content">
                <span class="card-title">Usuarios de prueba:</span>
                <ul class="browser-default">
                    <li><strong>admin</strong> / <strong>admin123</strong> (Acceso completo)</li>
                    <li><strong>operador1</strong> / <strong>dawm2026</strong> (Solo noticias)</li>
                    <li><strong>operador2</strong> / <strong>dawm2026</strong> (Solo noticias)</li>
                </ul>
            </div>
        </div>
    </div>
</div>