<?php
    session_start();
    include "conexao.php";
    
    $login = $_POST['login'];
    $senha = md5($_POST['senha']);

    $sql="SELECT senha, adm, idusuario FROM usuarios WHERE excluido = 'false' and email = '$login';";
    

    $resultado=pg_query($conecta,$sql);
    $qtde=pg_affected_rows($resultado);

    if ($qtde > 0)
    {
        $linha=pg_fetch_array($resultado);
        if ($senha == $linha['senha'])
        {
            //$_SESSION["email"] = $resultado['email'];

            
            $_SESSION["logou"] = 'S';
            $_SESSION['adm'] = (bool) pg_fetch_result($resultado,0,1);
            $_SESSION['idusuario'] = pg_fetch_result($resultado,0,2);

        }
        echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../index.php'>";
    }
    else	
    {
        echo "<script>alert('Erro no login, tente novamente!');</script>";
                    echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../login.php'>";
                    //echo "<p class=\"aviso\">Erro no registo!</p><br> Tente novamente!<br>";
                    //echo pg_last_error($resultado);


    }
    
    exit;
?>