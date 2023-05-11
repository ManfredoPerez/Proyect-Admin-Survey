<?php 
include('db_connect.php');


?>
<link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
<?php if($_SESSION['login_type'] == 1): ?>
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">

            <div class="small-box bg-gradient-success">
              <div class="inner">
                <h3><?php echo $conn->query("SELECT * FROM users where type = 3")->num_rows; ?></h3>
                <p>Usuarios Totales</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-plus"></i>
              </div>
            
            </div>
            <!-- /.info-box -->

          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="small-box bg-gradient-warning">
              <div class="inner">
                <h3><?php echo $conn->query("SELECT * FROM survey_set")->num_rows; ?></h3>
                <p>Encuestas Totales</p>
              </div>
              <div class="icon">
                <i class="fas fa-poll-h"></i>
              </div>
            
            </div>

          </div>

          <!-- /.col -->

          
      </div>
      <canvas
  data-mdb-chart="doughnut"
  data-mdb-dataset-label="Traffic"
  data-mdb-labels="['Monday', 'Tuesday' , 'Wednesday' , 'Thursday' , 'Friday' , 'Saturday' , 'Sunday ']"
  data-mdb-dataset-data="[2112, 2343, 2545, 3423, 2365, 1985, 987]"
  data-mdb-dataset-background-color="['rgba(63, 81, 181, 0.5)', 'rgba(77, 182, 172, 0.5)', 'rgba(66, 133, 244, 0.5)', 'rgba(156, 39, 176, 0.5)', 'rgba(233, 30, 99, 0.5)', 'rgba(66, 73, 244, 0.4)', 'rgba(66, 133, 244, 0.2)']"
></canvas>

<?php else: ?>
	 <div class="col-12">
          <div class="card">
          	<div class="card-body">
          		Bienvenido <?php echo $_SESSION['login_name'] ?>!
          	</div>
          </div>
      </div>
      <div class="row">
          <div class="col-12 col-sm-6 col-md-3">

            <div class="small-box bg-gradient-success">
              <div class="inner">
                <h3>
                  <?php echo $conn->query("SELECT distinct(survey_id) FROM answers  where user_id = {$_SESSION['login_id']}")->num_rows; ?>
                </h3>
                <p>Total de encuestas realizadas</p>
              </div>
              <div class="icon">
                <i class="fas fa-poll-h"></i>
              </div>
            
            </div>

            <!-- /.info-box -->
          </div>
          <!-- /.col -->
      </div>
          
<?php endif; ?>
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
<?php  ?>