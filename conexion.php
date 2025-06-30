<?php
$servername = "sql312.infinityfree.com"; // Hostname correcto de InfinityFree
$username = "if0_38388597"; // Usuario correcto
$password = "OaGlglbJ3G"; // Contraseña (verifica que sea correcta y sin espacios)
$database = "if0_38388597_style_stock"; // Nombre de la base de datos correcto

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("❌ Conexión fallida: " . $conn->connect_error);
} else {
    echo "✅ Conexión exitosa a la base de datos en InfinityFree";
}
?>
