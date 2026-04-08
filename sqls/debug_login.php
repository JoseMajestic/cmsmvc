<?php
// Script para debug del login
require_once '../vendor/autoload.php';

use App\Helper\DbHelper;
use App\Model\Usuario;

$db = new DbHelper();

// Simular el proceso de login
echo "<h2>Debug del proceso de login</h2>";

// 1. Verificar que el usuario existe en BD
$campo_usuario = 'admin';
$campo_contrasinal = 'admin123';

echo "<h3>Paso 1: Verificar usuario en BD</h3>";
$rowset = $db->query("SELECT * FROM usuarios WHERE usuario='$campo_usuario' AND activo=1 LIMIT 1");
$row = $rowset->fetch(PDO::FETCH_OBJ);

if ($row) {
    echo "Usuario encontrado en BD<br>";
    echo "Usuario: " . $row->usuario . "<br>";
    echo "Activo: " . $row->activo . "<br>";
    echo "Hash: " . $row->contrasinal . "<br>";
    
    echo "<h3>Paso 2: Crear objeto Usuario</h3>";
    $usuario = new Usuario($row);
    
    if ($usuario) {
        echo "Objeto Usuario creado correctamente<br>";
        echo "Usuario objeto: " . $usuario->usuario . "<br>";
        echo "Permisos usuarios: " . $usuario->usuarios . "<br>";
        echo "Permisos novas: " . $usuario->novas . "<br>";
        
        echo "<h3>Paso 3: Verificar contraseña</h3>";
        if (password_verify($campo_contrasinal, $usuario->contrasinal)) {
            echo "Contraseña verificada: CORRECTA<br>";
            
            echo "<h3>Paso 4: Variables de sesión</h3>";
            session_start();
            $_SESSION['usuario'] = $usuario->usuario;
            $_SESSION['usuarios'] = $usuario->usuarios;
            $_SESSION['novas'] = $usuario->novas;
            
            echo "Sesión creada:<br>";
            echo "SESSION[usuario]: " . $_SESSION['usuario'] . "<br>";
            echo "SESSION[usuarios]: " . $_SESSION['usuarios'] . "<br>";
            echo "SESSION[novas]: " . $_SESSION['novas'] . "<br>";
            
            echo "<h3>Paso 5: Verificar redirección</h3>";
            echo "<a href='/public/admin'>Ir al admin</a><br>";
            
        } else {
            echo "Contraseña verificada: INCORRECTA<br>";
        }
    } else {
        echo "Error al crear objeto Usuario<br>";
    }
} else {
    echo "Usuario NO encontrado en BD<br>";
}

echo "<hr>";
echo "<h3>Verificar todos los usuarios en BD:</h3>";
$usuarios_db = $db->query("SELECT usuario, activo, usuarios, novas FROM usuarios");
while ($user = $usuarios_db->fetch(PDO::FETCH_OBJ)) {
    echo "- {$user->usuario} (activo: {$user->activo}, usuarios: {$user->usuarios}, novas: {$user->novas})<br>";
}
?>
