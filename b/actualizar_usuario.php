<?php
require_once __DIR__ . '/includes/config.php';

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$nome = trim(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
$dataNacemento = filter_input(INPUT_POST, 'data_nacemento', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if ($dataNacemento === '') {
    $dataNacemento = null;
}

if ($dataNacemento) {
    $dt = DateTime::createFromFormat('Y-m-d', $dataNacemento);
    if (!$dt || $dt->format('Y-m-d') !== $dataNacemento) {
        header('Location: index.php?erro=Data%20non%20válida');
        exit;
    }
}

if (!$id || !$nome || !$email) {
    header('Location: index.php?erro=Datos%20inv%C3%A1lidos');
    exit;
}

try {
    $sql = 'UPDATE users SET nome = :nome, email = :email, data_nacemento = :data_nacemento WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nome' => $nome,
        ':email' => $email,
        ':data_nacemento' => $dataNacemento,
        ':id' => $id,
    ]);
    header('Location: index.php?mensaxe=Usuario%20actualizado');
    exit;
} catch (PDOException $e) {
    header('Location: index.php?erro=' . urlencode('Erro ao actualizar: ' . $e->getMessage()));
    exit;
}
