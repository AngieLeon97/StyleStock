<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Conexión a la base de datos
$servername = "sql312.infinityfree.com"; 
$username = "if0_38388597"; 
$password = "OaGlglbJ3G"; 
$dbname = "if0_38388597_style_stock"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Validar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);
    $apellidos = trim($_POST['apellidos']);
    $cedula = trim($_POST['cedula']);
    $fecha_nacimiento = trim($_POST['fecha_nacimiento']);
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];

    // Validaciones básicas
    if (empty($nombre) || empty($apellidos) || empty($cedula) || empty($fecha_nacimiento) || empty($username) || empty($password) || empty($confirm_password)) {
        die("Error: Todos los campos son obligatorios.");
    }

    if ($password !== $confirm_password) {
        die("Error: Las contraseñas no coinciden.");
    }

    // Encriptar la contraseña
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Usar consulta preparada para insertar datos
    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, apellidos, cedula, fecha_nacimiento, username, password) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $nombre, $apellidos, $cedula, $fecha_nacimiento, $username, $hashed_password);

    if ($stmt->execute()) {
        echo "Registro exitoso";
    } else {
        echo "Error al registrar el usuario: " . $stmt->error;
    }

    // Cerrar
    $stmt->close();
}

$conn->close();
?>

