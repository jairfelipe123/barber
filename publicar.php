<?php
session_start();
if (!isset($_SESSION['nombre'])) {
  header("Location: index.html");
  exit();
}
$nombre = $_SESSION['nombre'];

include 'db.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Crear Publicacion</title>
  <link rel="stylesheet" href="horarios.css" />
</head>
<body>

  <header class="navbar">
    <div class="logo">Crear Publicacion</div>
    <div class="user-info">
    </div>
  </header>

  <main class="main-content">
    <div class="card">
      <h2>Crear nueva publicación</h2>
      <form action="guardar-publicacion.php" method="POST" enctype="multipart/form-data">
        <textarea name="texto" placeholder="¿Qué estás pensando?" required></textarea>
        <input type="file" name="imagen" accept="image/*" required>
        <button type="submit" class="btn-guardar">Publicar</button>
      </form>
    </div>
  </main>


</body>
</html>
