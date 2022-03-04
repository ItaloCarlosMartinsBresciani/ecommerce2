<?php	
    $arquivocss = 'estilo'; // Não colocar extensão
    $titulo = "Cursos mais comprados";

    require "dados_relatorio.php";
?>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Cursos', 'Quantidade']
        
          <?php 
            if($qtde>0)
                while($linha = pg_fetch_array($res)) {
                    echo ",['".$linha['NomeCurso']."', ".$linha['QUANTIDADE']."]";
                }
          ?>
        ]);

        var options = {
          title: "<?php echo $titulo; ?>",
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('drawChart'));
        chart.draw(data, options);
      }

    </script>
  </head>
  <body>
    <div id="drawChart" style="width: 900px; height: 500px;"></div>
    <a href="javascript:print();">Imprimir</a>
  </body>
</html>