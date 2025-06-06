<?php
session_start();
if (!isset($_SESSION['correo'])) {
    header("Location: index.html");
    exit();
}

include 'db.php';

$correo = $_SESSION['correo'];

// Obtener los datos del formulario
$lunes_inicio = $_POST['lunes_inicio'];
$lunes_fin = $_POST['lunes_fin'];
$martes_inicio = $_POST['martes_inicio'];
$martes_fin = $_POST['martes_fin'];
// Puedes agregar más días aquí si los incluyes en el formulario

// Crear o actualizar los horarios
$sql = "INSERT INTO horarios (correo, lunes_inicio, lunes_fin, martes_inicio, martes_fin)
        VALUES ('$correo', '$lunes_inicio', '$lunes_fin', '$martes_inicio', '$martes_fin')
        ON DUPLICATE KEY UPDATE
            lunes_inicio='$lunes_inicio',
            lunes_fin='$lunes_fin',
            martes_inicio='$martes_inicio',
            martes_fin='$martes_fin'";

if ($conn->query($sql)) {
    echo "<script>alert('Horarios guardados correctamente'); window.location.href = 'configurar-horario.php';</script>";
} else {
    echo "<script>alert('Error al guardar horarios: " . $conn->error . "'); window.location.href = 'configurar-horarios.php';</script>";
}
?>
