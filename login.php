<?php
session_start();

$servername = "sql312.infinityfree.com";
$username = "if0_38388597";
$password = "0aG1g1bJ3G";
$dbname = "if0_38388597_style_stock";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        die("Error: Todos los campos son obligatorios.");
    }

    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $username, $hashed_password);
    $stmt->fetch();

    if ($stmt->num_rows > 0 && password_verify($password, $hashed_password)) {
        $_SESSION['username'] = $username;
        $_SESSION['loggedin'] = true;
        header("Location: welcome.php");
    } else {
        echo "Error: Usuario o contraseña incorrectos.";
    }

    $stmt->close();
}

$conn->close();
?>

