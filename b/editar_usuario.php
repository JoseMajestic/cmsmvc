<?php
require_once __DIR__ . '/includes/config.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    die('ID non válida!');
}

try {
    $stmt = $pdo->prepare('SELECT id, nome, email, data_nacemento FROM users WHERE id = :id');
    $stmt->execute([':id' => $id]);
    $usuario = $stmt->fetch();
    if (!$usuario) {
        die('Usuario non atopado!');
    }
} catch (PDOException $e) {
    die('Erro ao cargar: ' . $e->getMessage());
}

$pageTitle = 'Editar usuario #' . $usuario['id'];
require_once __DIR__ . '/includes/head.php';
?>
<section class="card">
    <h2>Editar usuario</h2>
    <form action="/actualizar_usuario.php" method="post">
        <input type="hidden" name="id" value="<?= (int)$usuario['id'] ?>">

        <label for="nome">Nome completo</label>
        <input type="text" name="nome" id="nome" value="<?= htmlspecialchars($usuario['nome']) ?>" required>

        <div class="form-row">
            <label for="data_nacemento">Data nacemento</label>
            <input type="date" name="data_nacemento" id="data_nacemento" value="<?= htmlspecialchars($usuario['data_nacemento'] ?? '') ?>">
        </div>

        <label for="email">Correo electrónico</label>
        <input type="email" name="email" id="email" value="<?= htmlspecialchars($usuario['email']) ?>" required>

        <div style="display:flex;gap:0.5rem;">
            <button class="btn-simple" type="submit">Actualizar</button>
            <a class="btn-simple btn-muted" href="/index.php">Volver</a>
        </div>
    </form>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
