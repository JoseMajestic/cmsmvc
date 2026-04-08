<?php
// Script para verificar las contraseñas hash
require_once '../vendor/autoload.php';

use App\Helper\DbHelper;

$db = new DbHelper();

// Usuarios y contraseñas
$usuarios = [
    'admin' => 'admin123',
    'operador1' => 'dawm2026',
    'operador2' => 'dawm2026'
];

echo "<h2>Verificación de contraseñas</h2>";

foreach ($usuarios as $usuario => $contrasinal) {
    // Buscar usuario en BD
    $rowset = $db->query("SELECT * FROM usuarios WHERE usuario='$usuario' LIMIT 1");
    $row = $rowset->fetch(PDO::FETCH_OBJ);
    
    if ($row) {
        echo "<h3>Usuario: $usuario</h3>";
        echo "Hash en BD: " . $row->contrasinal . "<br>";
        echo "Contraseña a probar: $contrasinal<br>";
        
        if (password_verify($contrasinal, $row->contrasinal)) {
            echo "<span style='color: green;'>** CONTRASEÑA CORRECTA **</span><br>";
        } else {
            echo "<span style='color: red;'>** CONTRASEÑA INCORRECTA **</span><br>";
            
            // Generar nuevo hash
            $nuevo_hash = password_hash($contrasinal, PASSWORD_DEFAULT);
            echo "Nuevo hash generado: $nuevo_hash<br>";
            
            // Actualizar en BD
            $db->exec("UPDATE usuarios SET contrasinal='$nuevo_hash' WHERE usuario='$usuario'");
            echo "Actualizado en BD<br>";
        }
        echo "<hr>";
    } else {
        echo "<h3>Usuario: $usuario - NO ENCONTRADO</h3><hr>";
    }
}

echo "<h2>Probando login</h2>";
echo "<a href='/public/admin'>Ir al login</a>";
?>
