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
    <div class="logo">Horarios Configuracion</div>
    <div class="user-info">Bienvenido, <?php echo htmlspecialchars($nombre);?> | <a href="feed.php">Volver al Feed</a></div>
  </header>

    <div class="card">
      <h2>Configura tus Horarios de Atención</h2>
      <form action="guardar-horarios.php" method="POST">
        <div class="dia">
          <label>Lunes:</label>
          <input type="time" name="lunes_inicio" value="<?php echo $horario['lunes_inicio'] ?? ''; ?>" required>
          <span>a</span>
          <input type="time" name="lunes_fin" value="<?php echo $horario['lunes_fin'] ?? ''; ?>" required>
        </div>

        <div class="dia">
          <label>Martes:</label>
          <input type="time" name="martes_inicio" value="<?php echo $horario['martes_inicio'] ?? ''; ?>" required>
          <span>a</span>
          <input type="time" name="martes_fin" value="<?php echo $horario['martes_fin'] ?? ''; ?>" required>
        </div>

        <button type="submit" class="btn-guardar">Guardar Horarios</button>
      </form>
    </div>
  </main>
<?php if ($horario): ?>
  <div class="horarios-guardados">
    <h3>Horarios guardados</h3>
    <ul>
      <li><strong>Lunes:</strong> <?php echo $horario['lunes_inicio'] . ' a ' . $horario['lunes_fin']; ?></li>
      <li><strong>Martes:</strong> <?php echo $horario['martes_inicio'] . ' a ' . $horario['martes_fin']; ?></li>
      <!-- Agrega más días si los tienes -->
    </ul>
  </div>
<?php else: ?>
  <p>Aún no has configurado tus horarios.</p>
<?php endif; ?>

</body>
</html>
