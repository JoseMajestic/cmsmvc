<?php
// Debug simple sin autoload
echo "<h2>Debug Simple del Login</h2>";

// Conexión directa a la BD
try {
    $pdo = new PDO('mysql:host=localhost; dbname=cmsmvc', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión a BD: OK<br>";
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage() . "<br>";
    exit;
}

// Probar usuarios
$usuarios = ['admin', 'operador1', 'operador2'];
$contraseñas = ['admin' => 'admin123', 'operador1' => 'dawm2026', 'operador2' => 'dawm2026'];

foreach ($usuarios as $usuario) {
    $contrasinal = $contraseñas[$usuario];
    
    echo "<h3>Probando: $usuario / $contrasinal</h3>";
    
    // Consulta SQL exacta
    $sql = "SELECT * FROM usuarios WHERE usuario='$usuario' AND activo=1 LIMIT 1";
    echo "SQL: $sql<br>";
    
    $stmt = $pdo->query($sql);
    $row = $stmt->fetch(PDO::FETCH_OBJ);
    
    if ($row) {
        echo "Usuario encontrado:<br>";
        echo "- ID: {$row->id}<br>";
        echo "- Usuario: {$row->usuario}<br>";
        echo "- Activo: {$row->activo}<br>";
        echo "- Hash: {$row->contrasinal}<br>";
        echo "- Permisos: usuarios={$row->usuarios}, novas={$row->novas}<br>";
        
        // Verificar contraseña
        if (password_verify($contrasinal, $row->contrasinal)) {
            echo "VERIFICACIÓN: <span style='color: green;'>CORRECTA</span><br>";
        } else {
            echo "VERIFICACIÓN: <span style='color: red;'>INCORRECTA</span><br>";
            
            // Generar hash correcto
            $hash_correcto = password_hash($contrasinal, PASSWORD_DEFAULT);
            echo "Hash correcto: $hash_correcto<br>";
            
            // Actualizar en BD
            $update_sql = "UPDATE usuarios SET contrasinal='$hash_correcto' WHERE usuario='$usuario'";
            $pdo->exec($update_sql);
            echo "Contraseña actualizada en BD<br>";
        }
    } else {
        echo "<span style='color: red;'>ERROR: Usuario no encontrado</span><br>";
    }
    echo "<hr>";
}

echo "<h3>Verificar todos los usuarios:</h3>";
$stmt = $pdo->query("SELECT usuario, activo, usuarios, novas FROM usuarios");
while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
    echo "- {$row->usuario} (activo: {$row->activo}, usuarios: {$row->usuarios}, novas: {$row->novas})<br>";
}

echo "<br><a href='/public/admin'>Ir al login</a>";
?>
