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
                <div class="password-wrapper">
                    <input id="contrasinal" type="password" name="contrasinal" value="">
                    <label for="contrasinal">Contrasinal</label>
                    <button type="button" class="password-toggle" onclick="togglePassword()">
                        <i class="material-icons" id="eye-icon">visibility</i>
                    </button>
                </div>
            </div>
            <div class="input-field col s12">
                <button class="btn waves-effect waves-light" type="submit" name="acceder">Acceder
                    <i class="material-icons right">person</i>
                </button>
            </div>
        </div>
    </form>
</div>

<style>
.password-wrapper {
    position: relative;
}

.password-toggle {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    cursor: pointer;
    padding: 5px;
    border-radius: 50%;
    transition: background-color 0.3s ease;
}

.password-toggle:hover {
    background-color: rgba(0, 0, 0, 0.05);
}

.password-toggle i {
    color: #666;
    font-size: 20px;
}

.password-toggle:hover i {
    color: #d32f2f;
}

/* Ajustar el input para que no se solape con el botón */
.password-wrapper input {
    padding-right: 45px !important;
}

/* Ajustar la etiqueta cuando está activa */
.password-wrapper input:focus + label,
.password-wrapper input:not([value=""]) + label {
    transform: translateY(-25px) scale(0.8);
}
</style>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('contrasinal');
    const eyeIcon = document.getElementById('eye-icon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.textContent = 'visibility_off';
    } else {
        passwordInput.type = 'password';
        eyeIcon.textContent = 'visibility';
    }
}

// Inicializar el botón cuando el documento esté listo
document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('contrasinal');
    const eyeIcon = document.getElementById('eye-icon');
    
    // Asegurar que el icono inicial sea correcto
    if (passwordInput.type === 'password') {
        eyeIcon.textContent = 'visibility';
    } else {
        eyeIcon.textContent = 'visibility_off';
    }
});
</script>