<?php	
    $arquivocss = 'estilo'; // Não colocar extensão
    $titulo2 = "Categorias mais compradas";

    require "dados_relatorio2.php";
?>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart2);
      function drawChart2() {
        var data = google.visualization.arrayToDataTable([
          ['Categoria', 'Quantidade']
        
          <?php 
            if($qtde2>0)
                while($linha = pg_fetch_array($res2)) {
                    echo ",['".$linha['genero']."', ".$linha['QUANTIDADE']."]";
                }
          ?>
        ]);

        var options = {
          title: "<?php echo $titulo2; ?>",
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }

    </script>
  </head>
  <body>
    <div id="piechart_3d" style="width: 900px; height: 500px;"></div>
    <a href="javascript:print();">Imprimir</a>
  </body>
</html>