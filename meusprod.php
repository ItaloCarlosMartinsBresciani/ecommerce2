<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração de produtos</title>
    <script src="https://kit.fontawesome.com/8545ffdfda.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/tabelas.css" />
</head>
<body>

<div id="login-container">
    <header>
        <h1>Meus cursos<i class="fas fa-table"></i> </h1><br>

        <div style="text-align: left; float: left;"><a href="login.php"><i class="fas fa-arrow-circle-left"></i> Voltar</a></div> 
    
    </header>
    <?php
            session_start();
            include "php/conexao.php";
            
            
            $idusuario = strtolower(trim(filter_var($_SESSION['idusuario'], FILTER_SANITIZE_NUMBER_INT)));
            $sql="SELECT IDvenda, Datacompra, Idusuario FROM vendas WHERE idusuario = :idusuario";
            $stmt = $conecta->prepare($sql);
            $stmt->bindValue(':idusuario', $idusuario);
            $stmt->execute();
            $resultado= pg_query($conecta, $sql);
            $qtde=pg_num_rows($resultado);
            $linha = pg_fetch_array($resultado);
            $id= $linha['idvenda'];

            if($qtde>0){
                $sql="SELECT Idcurso FROM itensvenda WHERE $id = ".$linha['idvenda'];
                //$stmt = $conecta->prepare($sql);
                //$stmt->bindValue(':idvenda', $idusuario);
                //$stmt->execute();
                $resultado= pg_query($conecta, $sql);
                $qtde=pg_num_rows($resultado);
                $linha = pg_fetch_array($resultado);
                $idcurso= $linha['idcurso'];
                if($qtde>0){

                    $sql="SELECT * FROM cursos WHERE excluido ='false' and $id = ".$linha['idcurso'];

                    $resultado2= pg_query($conecta, $sql);
                    $qtde=pg_num_rows($resultado2);

            echo "<br><br><br><br><br><br><br><br><br><table class='content-table'>
            <thead>
                <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Aulas</th>
                <th>Gênero</th>
                <th>Criador</th>
                </tr>
            </thead>
           </table>";

            for ($cont=0; $cont < $qtde; $cont++) {
               $linha=pg_fetch_array($resultado2);

            echo "<table class='content-table'>";
            echo "<tbody>";
            echo "<tr>";
            
                echo "<td>".$linha['idcurso']."</td>"; 
                echo "<td>".$linha['nomecurso']."</td>";
                echo "<td>".$linha['preco']."</td>";
                echo "<td>".$linha['aulas']."</td>";
                echo "<td>".$linha['genero']."</td>";
                echo "<td>".$linha['criador']."</td>";
                 
                


                echo "</tr>";
                
                echo "</tbody>";
                echo "</table>";
            } 
              }
         }
 
                pg_close($conecta);
                ?>
                </div>
                </body>
                </html>
                    

              


            
            