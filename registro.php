<?php
$servername = "sql312.infinityfree.com"; // Reemplázalo con el host de tu base de datos en InfinityFree
$username = "if0_38388597"; // Usuario de la base de datos
$password = "0aG1g1bJ3G"; // Reemplázalo con tu contraseña real
$dbname = "if0_38388597_style_stock"; // Reemplázalo con el nombre real de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Validar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validaciones básicas
    if (empty($username) || empty($email) || empty($password)) {
        die("Error: Todos los campos son obligatorios.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Error: El email no es válido.");
    }

    // Encriptar la contraseña
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Usar una consulta preparada para evitar inyecciones SQL
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    if ($stmt->execute()) {
        echo "Registro exitoso";
    } else {
        echo "Error al registrar el usuario: " . $conn->error;
    }

    // Cerrar la conexión
    $stmt->close();
}

$conn->close();
?>
