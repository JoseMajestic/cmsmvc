<?php
require_once __DIR__ . '/includes/config.php';

// recoller e validar id
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    die('ID non válida!');
}

try {
    // consulta preparada para DELETE
    $sql = 'DELETE FROM users WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);

    // redirixir ao listado de usuarios
    header('Location: index.php?mensaxe=Usuario%20eliminado!');
    exit;
} catch (PDOException $e) {
    // se algo falla
    die('Erro ao eliminar: ' . $e->getMessage());
}
