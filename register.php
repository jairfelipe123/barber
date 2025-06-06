<?php
include 'db.php';

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios (nombre, correo, contraseña) VALUES ('$nombre', '$correo', '$contraseña')";

if ($conn->query($sql)) {
    echo "<script>alert('REGISTRO EXITOSO'); window.location.href = 'index.html';</script>";
} else {
    echo "<script>alert('Error al registrar: " . $conn->error . "'); window.location.href = 'register.html';</script>";
}
?>

