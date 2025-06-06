<?php
session_start();
include 'db.php';

$nombre = $_SESSION['nombre'];
$texto = $_POST['texto'];

// Guardar imagen
$carpeta = "uploads/";
if (!file_exists($carpeta)) {
    mkdir($carpeta, 0777, true);
}

$nombreImagen = basename($_FILES["imagen"]["name"]);
$nombreUnico = uniqid() . "_" . $nombreImagen;
$rutaDestino = $carpeta . $nombreUnico;

if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaDestino)) {
    $sql = "INSERT INTO publicaciones (nombre_usuario, texto, imagen) VALUES ('$nombre', '$texto', '$rutaDestino')";
    if ($conn->query($sql)) {
        echo "<script>alert('Publicación guardada exitosamente.'); window.location.href='feed.php';</script>";
    } else {
        echo "Error en la base de datos: " . $conn->error;
    }
} else {
    echo "Error al subir la imagen.";
}
?>
