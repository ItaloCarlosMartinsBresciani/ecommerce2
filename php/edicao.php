
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edição de usuários</title>
    <script src="https://kit.fontawesome.com/8545ffdfda.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/form.css" />
</head>
<body>


<?php
        include "conexao.php";
        //dados enviados do script altera_prod.php
        $idusuario = strtolower(trim(filter_var($_GET['idusuario'], FILTER_SANITIZE_NUMBER_INT)));

        $sql="SELECT * FROM cursos WHERE idusuario = :idusuario;";
        $stmt = $conecta->prepare($sql);
        $stmt->bindValue(':idusuario', $idusuario);
        $stmt->execute();
        $resultado=pg_query($conecta,$sql);
        $qtde=pg_num_rows($resultado);
        if ( $qtde == 0 ){
            echo "<a class=\"aviso\">Usuário não encontrado  !!!</a><br><br>";
            exit;
        }
        $linha = pg_fetch_array($resultado);
    ?>
    
    <div id="login-container">
    <header>
        <h1>Alteração de usuário <i class="fas fa-user-edit"></i></h1><br>

    </header>   
    <form action="grava_alteracao_usu.php" method="post">
        <label>ID do usuário</label> <input type="text" name="idusuario" 
        value="<?php echo $linha[0]; ?>" readonly><br>
        <label>Nome</label> <input type="text" name="nome" 
        value="<?php echo $linha[1]; ?>" maxlength="50"><br>
        <label>Email</label> <input type="email" name="email" 
        value="<?php echo $linha[2]; ?>"><br>
        <label>CPF</label> <input type="text" name="cpf" 
        value="<?php echo $linha[3]; ?>" size="20" maxlength="20"><br>
        <label>CEP</label> <input type="text" name="cep" 
        value="<?php echo $linha[7]; ?>" size="9" maxlength="9"><br>
        <label>Telefone</label> <input type="text" name="telefone" 
        value="<?php echo $linha[8]; ?>" maxlength="16"><br>
        
        <input type="submit" value="Atualizar">
        </form>
        <form action='../tabelas_usu.php' method='POST'>
        <input type='submit' value='Voltar'>
        </form>
   



    </div>
</body>
</html>






