<?php
   $arquivocss = 'estilo'; // Não colocar extensão
   $titulo = "Cursos mais comprados";
   $titulo2 = "Categorias mais compradas";

   require "relatorios_estatisticas/dados_relatorio.php";
   require "relatorios_estatisticas/dados_relatorio2.php";
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <link rel="icon" href="imagem/icon.png">
  <title>Estatísticas</title>
  <link rel="stylesheet" type="text/css" href="css/estilos.css" />
  <script src="https://kit.fontawesome.com/8545ffdfda.js" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">

<!-- -->

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart); //1
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Cursos', 'Quantidade']
        
          <?php 
            if($qtde>0)
                echo "passei";
                echo $sql;
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
<?php
   require "relatorios_estatisticas/dados_relatorio2.php";
?>
<script>
      //2
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

        var chart = new google.visualization.PieChart(document.getElementById('drawChart2'));
        chart.draw(data, options);
      }

      
    </script>
</head>

<body>

  <center>
    <div id="mae">

      <br>
      <a name="topo"></a>

      <div id="camada1">
        <br>

        <a href="index.php"><img id="user" src="imagem/user.png"></a>
        <br><br>
        
        <?php 
                    session_start();
                    include "php/adm.php";
                    $adm = isMaster();
                    if($adm){
                        echo "<a href='tabelas_usu.php'><i class='fas fa-cogs'></i></a>";
                         }
                ?> 
        <a class="um" href="index.php">Home <i class="fas fa-home"></i></a>&nbsp;&nbsp;
        <a class="um" href="produtos.php">Produtos <i class="fas fa-desktop"></i></a>&nbsp;&nbsp;
        
        <?php
        
                        if (!isset($_SESSION["logou"]))
                        {
                        echo '<a class="um" href="login.php">Carrinho <i class="fas fa-shopping-cart"></i></a>&nbsp;&nbsp;';
                        }
                        else{
                            echo '<a class="um" href="carrinho.php">Carrinho <i class="fas fa-shopping-cart"></i></a>&nbsp;&nbsp;';
                        }
                ?> 
        <a class="oito" href="estatisticas.php">Estatísticas <i class="fas fa-chart-bar"></i></a>&nbsp;&nbsp;
        <a class="um" href="devs.php">Desenvolvedores <i class="fab fa-dev"></i></a>&nbsp;&nbsp;
       
        
        <?php
                    
                    if (!isset($_SESSION["logou"]))
                    {
                        echo "<a class='um' href='login.php'>Login <i class='fas fa-sign-in-alt'></i></a>&nbsp;&nbsp;
                        <br><br><br>";
                    }
                    else{
                        echo "<a class='um' href='login.php'>Logado <i class='fas fa-info'></i></a>&nbsp;&nbsp;
                        <br><br><br>";
                    }
                    
                    ?> 
      </div>


      <br> <br>

      <div id="camada_especial2">
        <div id="texto_imagem1">

          <br><br><br>
          <h2>
            Venha conhecer quais são os resultados em gráficos e relatórios estatisticos da Fleasy!!!!
          </h2>
          <br><br><br><br><br><br>
        </div>

        <div id="texto_imagem2">
          <img src="imagem/logo.png" width="300px" height="240px">
        </div>
        <br>
      </div>
      <br><br>

      <!--- -->
      <div id="camada_especial5">
        <div id="drawChart" style="width:700px; height:400px;">   
        </div> 
          <div id="relatorio">
            <a href="relatorios_estatisticas/relatorio_pdf.php">Gerar relatório Teste</a>
          </div>
        <div id="drawChart2" style="width:700px; height:400px;">
        </div>
          <div id="relatorio">
              <a href="relatorios_estatisticas/relatorio_pdf2.php">Gerar relatório</a>
          </div>   
         <br><br> 
        <div id="imprimir">
          <a class="imprimir" href="javascript:print();">Imprimir Gráficos</a>
        </div>
      </div>
      <!--- -->

      <br><br>
      <div id="camada3">
        <br>
        <a class="dois" href="index.php">Home</a>&nbsp;&nbsp;
        <a class="dois" href="produtos.php">Produtos</a>&nbsp;&nbsp;
        
          <?php
        
                            if (!isset($_SESSION["logou"]))
                            {
                            echo '<a class="dois" href="login.php">Carrinho </a>&nbsp;&nbsp;';
                            }
                            else{
                                echo '<a class="dois" href="carrinho.php">Carrinho </a>&nbsp;&nbsp;';
                            }
                            ?> 
        <a class="dois" href="estatisticas.php">Estatísticas</a>&nbsp;&nbsp;
        <a class="dois" href="devs.php">Desenvolvedores</a>&nbsp;&nbsp;
       

        
          <?php
                    
                    if (!isset($_SESSION["logou"]))
                    {
                        echo "<a class='dois' href='login.php'>Login</a>&nbsp;&nbsp;
                        <br><br>";
                    }
                    else{
                        echo "<a class='dois' href='login.php'>Logado</a>&nbsp;&nbsp;
                        <br><br>";
                    }
                    ?>



        <a class="tres" href="#topo">Clique para voltar ao topo</a>
        <br> <br>
      </div>
      <br>
      <p id="nomes">
      05 - Ellen Lorenz Vieira Antonetti 13 - Italo C. Martins Bresciani 18 - Laura Lima Denardi 26 - Nathan
      Braian Mariano Anunciação 34 - Ulisses Rodrigues Barreto
     </p>
      <br>

    </div>


  </center>

</body>

</html>