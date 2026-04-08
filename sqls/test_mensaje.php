<?php
// Script para probar mensajes de error en el login
session_start();

echo "<h2>Test de Mensajes de Login</h2>";

// Crear un mensaje de error de prueba
if (!isset($_GET['clear'])) {
    $_SESSION['mensaxe'] = array(
        "tipo" => "red", 
        "texto" => "Este es un mensaje de error de prueba"
    );
    echo "<h3>Mensaje de error creado</h3>";
    echo "<p>Tipo: " . $_SESSION['mensaxe']['tipo'] . "</p>";
    echo "<p>Texto: " . $_SESSION['mensaxe']['texto'] . "</p>";
    echo "<a href='/public/admin'>Ir al login para ver el mensaje</a><br>";
    echo "<a href='?clear=1'>Limpiar mensaje</a>";
} else {
    unset($_SESSION['mensaxe']);
    echo "<h3>Mensaje limpiado</h3>";
    echo "<a href='?'>Crear mensaje de prueba</a><br>";
    echo "<a href='/public/admin'>Ir al login</a>";
}

echo "<hr>";
echo "<h3>Variables de sesión actuales:</h3>";
echo "SESSION[mensaxe]: " . (isset($_SESSION['mensaxe']) ? 'EXISTS' : 'NOT EXISTS') . "<br>";
if (isset($_SESSION['mensaxe'])) {
    echo "Tipo: " . $_SESSION['mensaxe']['tipo'] . "<br>";
    echo "Texto: " . $_SESSION['mensaxe']['texto'] . "<br>";
}
?>
