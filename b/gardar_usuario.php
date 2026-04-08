<?php
require_once __DIR__ . '/includes/config.php';

// recoller e validar datos
$nome = trim(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
$dataNacemento = filter_input(INPUT_POST, 'data_nacemento', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if ($dataNacemento === '') {
    $dataNacemento = null;
}

if ($dataNacemento) {
    $dt = DateTime::createFromFormat('Y-m-d', $dataNacemento);
    if (!$dt || $dt->format('Y-m-d') !== $dataNacemento) {
        header('Location: crear.php?erro=Data%20non%20válida');
        exit;
    }
}

if (!$nome || !$email) {
    header('Location: index.php?erro=Datos%20inv%C3%A1lidos');
    exit;
}

try {
    $sql = 'INSERT INTO users (nome, email, data_nacemento) VALUES (:nome, :email, :data_nacemento)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nome' => $nome,
        ':email' => $email,
        ':data_nacemento' => $dataNacemento,
    ]);
    header('Location: index.php?mensaxe=Usuario%20creado%20correctamente');
    exit;
} catch (PDOException $e) {
    header('Location: index.php?erro=' . urlencode('Erro ao gardar: ' . $e->getMessage()));
    exit;
}
