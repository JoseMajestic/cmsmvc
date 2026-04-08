<?php
// Script simple para probar login
session_start();

echo "<h2>Test Login Simple</h2>";

// Limpiar sesión
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: test_login_simple.php");
    exit;
}

// Simular login
if (isset($_GET['login'])) {
    $usuario = $_GET['login'];
    
    // Datos de usuarios
    $usuarios = [
        'admin' => ['password' => 'admin123', 'usuarios' => 1, 'novas' => 1],
        'operador1' => ['password' => 'dawm2026', 'usuarios' => 0, 'novas' => 1],
        'operador2' => ['password' => 'dawm2026', 'usuarios' => 0, 'novas' => 1]
    ];
    
    if (isset($usuarios[$usuario])) {
        $_SESSION['usuario'] = $usuario;
        $_SESSION['usuarios'] = $usuarios[$usuario]['usuarios'];
        $_SESSION['novas'] = $usuarios[$usuario]['novas'];
        $_SESSION['public'] = '/public/';
        $_SESSION['home'] = '/public/';
        
        echo "<h3>Login exitoso: $usuario</h3>";
        echo "SESSION[usuario]: " . $_SESSION['usuario'] . "<br>";
        echo "SESSION[usuarios]: " . $_SESSION['usuarios'] . "<br>";
        echo "SESSION[novas]: " . $_SESSION['novas'] . "<br>";
        echo "SESSION[public]: " . $_SESSION['public'] . "<br>";
        echo "SESSION[home]: " . $_SESSION['home'] . "<br>";
        
        echo "<h3>Probar método permisos:</h3>";
        
        // Simular el método permisos
        function test_permisos($permiso = null) {
            if (isset($_SESSION['usuario']) and ($permiso == null or (isset($_SESSION[$permiso]) and $_SESSION[$permiso] == 1))) {
                return true;
            } else {
                return false;
            }
        }
        
        echo "permisos(): " . (test_permisos() ? 'OK' : 'ERROR') . "<br>";
        echo "permisos('usuarios'): " . (test_permisos('usuarios') ? 'OK' : 'ERROR') . "<br>";
        echo "permisos('novas'): " . (test_permisos('novas') ? 'OK' : 'ERROR') . "<br>";
        
        echo "<hr>";
        echo "<a href='/public/admin'>Ir al admin</a><br>";
        echo "<a href='?logout=1'>Cerrar sesión</a>";
        
    } else {
        echo "Usuario no encontrado";
    }
} else {
    echo "<h3>Selecciona un usuario para probar:</h3>";
    echo "<a href='?login=admin'>Login como admin</a><br>";
    echo "<a href='?login=operador1'>Login como operador1</a><br>";
    echo "<a href='?login=operador2'>Login como operador2</a><br>";
}

echo "<hr>";
if (isset($_SESSION['usuario'])) {
    echo "<a href='?logout=1'>Cerrar sesión</a>";
}
?>
