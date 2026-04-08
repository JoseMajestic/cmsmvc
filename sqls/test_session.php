<?php
// Script para verificar variables de sesión
session_start();

echo "<h2>Verificación de variables de sesión</h2>";

echo "Variables de sesión actuales:<br>";
echo "SESSION[home]: " . ($_SESSION['home'] ?? 'NO DEFINIDA') . "<br>";
echo "SESSION[public]: " . ($_SESSION['public'] ?? 'NO DEFINIDA') . "<br>";
echo "SESSION[usuario]: " . ($_SESSION['usuario'] ?? 'NO DEFINIDA') . "<br>";

echo "<hr>";

// Simular login manual
echo "<h3>Simulación de login manual</h3>";

// Definir variables como en public/index.php
$_SESSION['public'] = '/public/';
$_SESSION['home'] = '/public/';

echo "Variables definidas:<br>";
echo "SESSION[home]: " . $_SESSION['home'] . "<br>";
echo "SESSION[public]: " . $_SESSION['public'] . "<br>";

// Simular login exitoso
$_SESSION['usuario'] = 'admin';
$_SESSION['usuarios'] = 1;
$_SESSION['novas'] = 1;

echo "Login simulado:<br>";
echo "SESSION[usuario]: " . $_SESSION['usuario'] . "<br>";
echo "SESSION[usuarios]: " . $_SESSION['usuarios'] . "<br>";
echo "SESSION[novas]: " . $_SESSION['novas'] . "<br>";

echo "<hr>";
echo "<h3>Probar redirección</h3>";
$ruta = 'admin';
$location = $_SESSION["home"] . $ruta;
echo "URL de redirección: $location<br>";
echo "<a href='$location'>Ir a admin</a><br>";

echo "<hr>";
echo "<h3>Limpiar sesión</h3>";
echo "<a href='?clear=1'>Limpiar sesión</a>";

if (isset($_GET['clear'])) {
    session_destroy();
    header("Location: test_session.php");
    exit;
}
?>
