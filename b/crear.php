<?php
require_once __DIR__ . '/includes/config.php';
$pageTitle = 'Crear novo usuario';
require_once __DIR__ . '/includes/head.php';
?>
<section>
    <h2>Usuarios rexistrados</h2>
    <form action="/gardar_usuario.php" method="post">
        <div class="form-row">
            <label for="nome">Nome completo</label>
            <input type="text" name="nome" id="nome" required maxlength="150">
        </div>

        <div class="form-row">
            <label for="data_nacemento">Data nacemento</label>
            <input type="date" name="data_nacemento" id="data_nacemento">
        </div>

        <div class="form-row">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required maxlength="190">
        </div>

        <div style="display:flex;gap:0.5rem;">
            <button class="btn-simple" type="submit">Gardar</button>
        </div>
    </form>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
