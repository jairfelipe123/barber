<?php
session_start(); // Iniciar sesión
include 'db.php';

$correo = $_POST['correo'];
$contraseña = $_POST['contraseña'];

$sql = "SELECT * FROM usuarios WHERE correo='$correo'";
$result = $conn->query($sql);

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    if (password_verify($contraseña, $row['contraseña'])) {
        $_SESSION['nombre'] = $row['nombre'];
        $_SESSION['correo'] = $row['correo'];
        header("Location: feed.php");
        exit();
    } else {
        echo "<script>alert('Contraseña incorrecta'); window.location.href='index.html';</script>";
    }
} else {
    echo "<script>alert('USUARIO NO EXISTE'); window.location.href='index.html';</script>";
}
?>
