<?php 
include('db_connect.php');


?>
<link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="assets/dist/css/adminlte.min.css">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
          <div class="col-12 col-sm-4 col-md-3">
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
          <h2 class="col-6 col-sm-6 col-md-1"></h2>

          <div class="col-6 col-sm-6 col-md-4">
          <?php
            $query = "SELECT type, COUNT(*) as count FROM users GROUP BY type";
            $result = mysqli_query($conn, $query);
            $data = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $data[$row['type']] = $row['count'];
            }

            // Obtener los nombres correspondientes a cada tipo
            $names = array(
                1 => 'Admin',
                2 => 'Staff',
                3 => 'Usuarios'
            );

            // Combinar los datos y los nombres
            $combinedData = array();
            foreach ($data as $type => $count) {
                $combinedData[] = array(
                    'name' => $names[$type],
                    'count' => $count
                );
            }
            ?>
            <p> <center>USUARIOS</center> </p>

            

            <div id="bar-chart-container">
              <canvas id="bar-chart"></canvas>
            </div>

          <script>
              var data = <?php echo json_encode($combinedData); ?>;

              var labels = data.map(function(item) {
                  return item.name;
              });

              var values = data.map(function(item) {
                  return item.count;
              });

              var ctx = document.getElementById('bar-chart').getContext('2d');
              var chart = new Chart(ctx, {
                  type: 'bar',
                  data: {
                      labels: labels,
                      datasets: [{
                          label: 'Cantidad de Usuarios Generales',
                          data: values,
                          backgroundColor: 'rgba(4, 60, 255, 0.7)'
                      }]
                  },
                  options: {
                      scales: {
                          y: {
                              beginAtZero: true,
                              stepSize: 1
                          }
                      }
                  }
              });
          </script>
          </div>
          

          <!-- /.col -->
        </div>

      <div class="row">
      <div class="col-6 col-sm-6 col-md-1"></div>
      <div class="col-4 col-sm-4 col-md-4">
            <?php
              $query = "SELECT COUNT(*) as count FROM survey_set";
              $result = mysqli_query($conn, $query);
              $row = mysqli_fetch_assoc($result);
              $totalSurveys = $row['count'];
            ?>

            <h3> <center>Reporte</center> </h3>

            <div id="pie-chart1-container">
                    <canvas id="pie-chart1"></canvas>
                </div>

                <script>
                    var totalSurveys = <?php echo $totalSurveys; ?>;
                    var remainingSurveys = 100 - totalSurveys;

                    var ctx = document.getElementById('pie-chart1').getContext('2d');
                    var chart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: ['Pendientes', 'Completados'],
                            datasets: [{
                                label: 'Encuestas',
                                data: [totalSurveys, remainingSurveys],
                                backgroundColor: ['rgba(54, 12, 235, 0.7)', 'rgba(55, 9, 122, 0.7)']
                            }]
                        }
                    });
                </script>
          </div>
            
          
          <div class="col-6 col-sm-6 col-md-1"></div>
            <!-- GRAFICA DE PASTEL -->
          <div class="col-3 col-sm-4 col-md-4">
           <?php
              $query = "SELECT title, COUNT(*) as count FROM survey_set GROUP BY title";
              $result = mysqli_query($conn, $query);
              $data = array();
              while ($row = mysqli_fetch_assoc($result)) {
                  $data[$row['title']] = $row['count'];
              }

              // Obtener los nombres de las encuestas
              $surveyTitles = array_keys($data);
           ?>
            <h3> <center>Encuestas</center> </h3>
            <div id="pie-chart-container">
                <canvas id="pie-chart"></canvas>
            </div>

            <script>
                var data = <?php echo json_encode(array_values($data)); ?>;
                var labels = <?php echo json_encode($surveyTitles); ?>;

                var ctx = document.getElementById('pie-chart').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Encuestas',
                            data: data,
                            backgroundColor: [
                                'rgba(14, 12, 235, 0.5)',
                                'rgba(255, 99, 32, 0.5)',
                                'rgba(75, 192, 192, 0.7)',
                                'rgba(255, 206, 86, 0.7)',
                                'rgba(153, 102, 255, 0.7)',
                                'rgba(255, 159, 64, 0.7)',
                                'rgba(0, 255, 0, 0.7)',
                                'rgba(255, 0, 0, 0.7)',
                                'rgba(0, 0, 255, 0.7)'
                            ]
                        }]
                    }
                });
            </script>

          </div>

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
  echo "<th>Nombre</th>";
  echo "<th>No. Tel</th>";
  echo "<th>Correo</th>";
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