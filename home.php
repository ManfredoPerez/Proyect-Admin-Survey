<?php include('db_connect.php') ?>
<?php include('grafica_lineal.php') ?>
<link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
<?php
$sql = "SELECT firstname, contact, email, type FROM users";
$result = $conn->query($sql);

// Crear la tabla HTML
if ($result->num_rows > 0) {
  echo "<table class='table table-bordered'>";
  echo "<thead>";
  echo "<tr>";
  echo "<th>Firstname</th>";
  echo "<th>Contact</th>";
  echo "<th>Email</th>";
  echo "<th>Type</th>";
  echo "</tr>";
  echo "</thead>";
  echo "<tbody>";
  // Mostrar los datos de la tabla "users" en la tabla HTML
  while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row["firstname"] . "</td>";
    echo "<td>" . $row["contact"] . "</td>";
    echo "<td>" . $row["email"] . "</td>";
    echo "<td>" . $row["type"] . "</td>";
    echo "</tr>";
  }
  echo "</tbody>";
  echo "</table>";
} else {
  echo "No se encontraron resultados.";
}
// Cerrar la conexión a la base de datos
$conn->close();
?>
