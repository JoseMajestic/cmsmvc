<?php
require_once __DIR__ . '/includes/config.php';

$pageTitle = 'Listado de usuarios';
$mensaxe = filter_input(INPUT_GET, 'mensaxe', FILTER_SANITIZE_SPECIAL_CHARS) ?: '';
$erro = filter_input(INPUT_GET, 'erro', FILTER_SANITIZE_SPECIAL_CHARS) ?: '';

// recuperar usuarios rexistrados
try {
    $stmt = $pdo->query('SELECT id, nome, email, data_nacemento FROM users ORDER BY id DESC');
    $usuarios = $stmt->fetchAll();
} catch (PDOException $e) {
    $erro = 'Erro ao cargar usuarios: ' . $e->getMessage();
    $usuarios = [];
}

require_once __DIR__ . '/includes/head.php';
?>
<section>
    <h2>Usuarios rexistrados</h2>
    <p style="color: var(--muted);">Listado simple de persoas almacenadas na base de datos.</p>

    <?php if ($mensaxe): ?>
        <div class="alert"><?= htmlspecialchars($mensaxe) ?></div>
    <?php endif; ?>

    <?php if ($erro): ?>
        <div class="alert" style="background:#fff4f4;"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <?php if (count($usuarios) === 0): ?>
        <p>Non hai usuarios rexistrados polo de agora.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Data nacemento</th>
                    <th>Accións</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?= (int)$usuario['id'] ?></td>
                    <td><?= htmlspecialchars($usuario['nome']) ?></td>
                    <td><?= htmlspecialchars($usuario['email']) ?></td>
                    <td><?= $usuario['data_nacemento'] ? htmlspecialchars($usuario['data_nacemento']) : '—' ?></td>
                    <td>
                        <div class="actions">
                            <a class="icon-link" title="Editar" href="/editar_usuario.php?id=<?= (int)$usuario['id'] ?>">&#9998;</a>
                            <a class="icon-link" title="Borrar" href="/borrar_usuario.php?id=<?= (int)$usuario['id'] ?>" onclick="return confirm('Seguro que queres eliminar este usuario?');">&#128465;</a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
