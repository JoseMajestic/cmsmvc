<?php
// Script para verificar usuarios y permisos
require_once '../vendor/autoload.php';

use App\Helper\DbHelper;

$db = new DbHelper();

echo "<h2>Usuarios en la base de datos</h2>";

$usuarios_db = $db->query("SELECT * FROM usuarios");
echo "<table border='1'>";
echo "<tr><th>Usuario</th><th>Activo</th><th>Permisos Usuarios</th><th>Permisos Novas</th><th>Último Acceso</th></tr>";

while ($user = $usuarios_db->fetch(PDO::FETCH_OBJ)) {
    echo "<tr>";
    echo "<td>{$user->usuario}</td>";
    echo "<td>{$user->activo}</td>";
    echo "<td>{$user->usuarios}</td>";
    echo "<td>{$user->novas}</td>";
    echo "<td>" . ($user->data_acceso ?? 'Nunca') . "</td>";
    echo "</tr>";
}
echo "</table>";

echo "<hr>";

// Probar login para cada usuario
$usuarios_test = [
    'admin' => 'admin123',
    'operador1' => 'dawm2026',
    'operador2' => 'dawm2026'
];

foreach ($usuarios_test as $usuario => $contrasinal) {
    echo "<h3>Probando login: $usuario</h3>";
    
    // Buscar usuario
    $rowset = $db->query("SELECT * FROM usuarios WHERE usuario='$usuario' AND activo=1 LIMIT 1");
    $row = $rowset->fetch(PDO::FETCH_OBJ);
    
    if ($row) {
        echo "Usuario encontrado: " . $row->usuario . "<br>";
        echo "Activo: " . $row->activo . "<br>";
        echo "Permisos - Usuarios: " . $row->usuarios . ", Novas: " . $row->novas . "<br>";
        
        // Verificar contraseña
        if (password_verify($contrasinal, $row->contrasinal)) {
            echo "Contraseña: CORRECTA<br>";
            
            // Simular login
            session_start();
            $_SESSION['usuario'] = $row->usuario;
            $_SESSION['usuarios'] = $row->usuarios;
            $_SESSION['novas'] = $row->novas;
            $_SESSION['public'] = '/public/';
            $_SESSION['home'] = '/public/';
            
            echo "Sesión creada:<br>";
            echo "SESSION[usuario]: " . $_SESSION['usuario'] . "<br>";
            echo "SESSION[usuarios]: " . $_SESSION['usuarios'] . "<br>";
            echo "SESSION[novas]: " . $_SESSION['novas'] . "<br>";
            
            // Verificar permisos para admin
            echo "Permisos de acceso:<br>";
            echo "- Puede ver admin: " . (isset($_SESSION['usuario']) ? 'SÍ' : 'NO') . "<br>";
            echo "- Puede gestionar usuarios: " . ($_SESSION['usuarios'] == 1 ? 'SÍ' : 'NO') . "<br>";
            echo "- Puede gestionar noticias: " . ($_SESSION['novas'] == 1 ? 'SÍ' : 'NO') . "<br>";
            
        } else {
            echo "Contraseña: INCORRECTA<br>";
        }
    } else {
        echo "Usuario NO encontrado o inactivo<br>";
    }
    echo "<hr>";
}

echo "<h3>Enlaces de prueba:</h3>";
echo "<a href='/public/admin'>Ir al admin</a><br>";
echo "<a href='?clear=1'>Limpiar sesión</a>";

if (isset($_GET['clear'])) {
    session_destroy();
    header("Location: ver_usuarios.php");
    exit;
}
?>
