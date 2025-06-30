<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Conexión
$servername = "sql312.infinityfree.com";
$username = "if0_38388597";
$password = "OaGlglbJ3G";
$dbname = "if0_38388597_style_stock";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username_input = trim($_POST['username']);
    $password_input = $_POST['password'];

    $stmt = $conn->prepare("SELECT password FROM usuarios WHERE username = ?");
    $stmt->bind_param("s", $username_input);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();

    if ($stmt->num_rows > 0 && password_verify($password_input, $hashed_password)) {
        $_SESSION["username"] = $username_input;
        $_SESSION["loggedin"] = true;
        header("Location: pagina-principal.html"); // Redirige si es exitoso
        exit();
    } else {
        echo "<h2>⚠️ Usuario o contraseña incorrectos.</h2>";
        echo "<a href='inicio_sesion.html'>Volver al login</a>";
    }

    $stmt->close();
}
$conn->close();
?>
