<!DOCTYPE html>
<html>
<head>
  <title>Gráfica de Pastel</title>
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <canvas id="pie-chart"></canvas>
      </div>
    </div>
  </div>

  <script src="assets/plugins/jquery/jquery.min.js"></script>
  <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
  <script src="assets/dist/js/adminlte.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <?php include('db_connect.php') ?>
  <?php

    // Consulta SQL para obtener los datos
    $sql = "SELECT title, description FROM survey_set";
    $result = mysqli_query($conn, $sql);

    // Almacenar los datos en un arreglo asociativo
    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
      $data[] = $row;
    }

    // Cerrar la conexión a la base de datos
   
  ?>

  <script>
    var data = <?php echo json_encode($data); ?>;

    // Obtener los valores de la columna 'title' y 'description'
    var titles = data.map(function(d) { return d.title; });
    var descriptions = data.map(function(d) { return d.description; });

    // Crear la gráfica de pastel
    var ctx = document.getElementById('pie-chart').getContext('2d');
    var chart = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: titles,
        datasets: [{
          data: descriptions,
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)'
          ],
          borderColor: [
            'rgba(255,99,132,1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)', 
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
            }]
            },
            options: {
            responsive: true,
            maintainAspectRatio: false
            }
            });
</script>

</body>
</html>