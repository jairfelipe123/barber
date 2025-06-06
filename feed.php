<?php
session_start();
if (!isset($_SESSION['nombre'])) {
  header("Location: index.html");
  exit();
}
$nombre = $_SESSION['nombre'];
$correo = $_SESSION['correo']; // Asegúrate de guardar también el correo en $_SESSION al iniciar sesión

include 'db.php';

// Consultar los horarios guardados para este usuario
$sql = "SELECT * FROM horarios WHERE correo = '$correo' LIMIT 1";
$result = $conn->query($sql);
$horario = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Configurar Horarios</title>
  <link rel="stylesheet" href="horarios.css" />
</head>
<body>

  <header class="navbar">
    <div class="logo">Barberia G20-4 / Pagina Principal Feed</div>
    <div class="user-info">Bienvenido <?php echo htmlspecialchars($nombre);?>|<a href="configurar-horario.php">Mis Horarios</a>|<a href="publicar.php">Crear</a> |<a href="index.html">Cerrar sesión</a></div>
  </header>

  <main class="main-content">
        <!-- FEED DE PUBLICACIONES -->
    <div class="card">
      <h2>Publicaciones</h2>
      <?php
        $sql = "SELECT * FROM publicaciones ORDER BY fecha DESC";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo '<div class="publicacion">';
            echo '<p><strong>' . htmlspecialchars($row['nombre_usuario']) . '</strong></p>';
            echo '<p>' . nl2br(htmlspecialchars($row['texto'])) . '</p>';
            echo '<img src="' . htmlspecialchars($row['imagen']) . '" alt="Imagen" style="max-width:100%; border-radius:10px; margin-top:10px;">';
            echo '<p class="fecha">' . date('d M Y, H:i', strtotime($row['fecha'])) . '</p>';
            echo '</div><hr>';
          }
        } else {
          echo "<p>NO HAY NINGUNA PUBLICACION</p>";
        }
      ?>
    </div>

</body>
</html>
