<?php
// Debug del login real paso a paso
// Cambiar al directorio raíz para que funcione el autoload
chdir(dirname(__DIR__));
require_once 'vendor/autoload.php';

use App\Helper\DbHelper;
use App\Model\Usuario;

$db = new DbHelper();

echo "<h2>Debug del Login Real</h2>";

// Simular el proceso exacto del login
$campo_usuario = 'admin';
$campo_contrasinal = 'admin123';

echo "<h3>Simulando login con: $campo_usuario / $campo_contrasinal</h3>";

// Paso 1: La consulta exacta del controller
echo "<h4>Paso 1: Consulta SQL</h4>";
$sql = "SELECT * FROM usuarios WHERE usuario='$campo_usuario' AND activo=1 LIMIT 1";
echo "SQL: $sql<br>";

$rowset = $db->query($sql);
$row_count = $rowset->rowCount();
echo "Filas encontradas: $row_count<br>";

$row = $rowset->fetch(PDO::FETCH_OBJ);
if ($row) {
    echo "Usuario encontrado en BD:<br>";
    echo "- ID: {$row->id}<br>";
    echo "- Usuario: {$row->usuario}<br>";
    echo "- Activo: {$row->activo}<br>";
    echo "- Hash: {$row->contrasinal}<br>";
    echo "- Permisos: usuarios={$row->usuarios}, novas={$row->novas}<br>";
    
    // Paso 2: Crear objeto Usuario
    echo "<h4>Paso 2: Crear objeto Usuario</h4>";
    try {
        $usuario = new Usuario($row);
        echo "Objeto Usuario creado correctamente<br>";
        echo "- Usuario: {$usuario->usuario}<br>";
        echo "- Contraseña: " . substr($usuario->contrasinal, 0, 20) . "...<br>";
        
        // Paso 3: Verificar contraseña
        echo "<h4>Paso 3: Verificar contraseña</h4>";
        echo "Contraseña introducida: $campo_contrasinal<br>";
        echo "Hash en BD: {$usuario->contrasinal}<br>";
        
        if (password_verify($campo_contrasinal, $usuario->contrasinal)) {
            echo "VERIFICACIÓN: CORRECTA<br>";
        } else {
            echo "VERIFICACIÓN: INCORRECTA<br>";
            
            // Probar con hash nuevo
            echo "<h4>Probando con hash nuevo:</h4>";
            $nuevo_hash = password_hash($campo_contrasinal, PASSWORD_DEFAULT);
            echo "Nuevo hash: $nuevo_hash<br>";
            
            if (password_verify($campo_contrasinal, $nuevo_hash)) {
                echo "Nuevo hash VERIFICACIÓN: CORRECTA<br>";
            }
        }
        
    } catch (Exception $e) {
        echo "ERROR al crear objeto Usuario: " . $e->getMessage() . "<br>";
    }
} else {
    echo "ERROR: No se encontró el usuario en la BD<br>";
}

echo "<hr>";

// Probar con operadores
echo "<h3>Probando con operador1</h3>";
$campo_usuario = 'operador1';
$campo_contrasinal = 'dawm2026';

$sql = "SELECT * FROM usuarios WHERE usuario='$campo_usuario' AND activo=1 LIMIT 1";
$rowset = $db->query($sql);
$row = $rowset->fetch(PDO::FETCH_OBJ);

if ($row) {
    echo "Usuario encontrado: {$row->usuario}<br>";
    if (password_verify($campo_contrasinal, $row->contrasinal)) {
        echo "VERIFICACIÓN: CORRECTA<br>";
    } else {
        echo "VERIFICACIÓN: INCORRECTA<br>";
    }
} else {
    echo "ERROR: No se encontró el usuario<br>";
}

echo "<hr>";
echo "<a href='/public/admin'>Ir al login real</a>";
?>
