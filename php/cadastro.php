<?php
    session_start();
    require_once("conexao.php");
    
    $email = strtolower(trim(filter_var($_POST['login'], FILTER_SANITIZE_EMAIL)));
    $senha = md5(filter_var($_POST['senha'], FILTER_SANITIZE_STRING));

    if (empty($email) && empty($senha)) {
        header('Location: ../login.php?error=invalid');
        exit;
    }
    
//
    require ("conexao.php");
    $sql="SELECT senha, adm, idusuario FROM usuarios WHERE excluido = 'false' and email = :email";
    $stmt = $conecta->prepare($sql);
    $stmt->execute();
    $retorno = $stmt -> fetchAll(PDO::FETCH_ASSOC)
    if ($retorno)
    {
        foreach ($retorno as $linha)
        {
            $_SESSION["logou"] = 'S';
            $_SESSION['adm'] = $resultado['adm'];
            $_SESSION['idusuario'] = $resultado['idusuario'];
        }
    } else
    {
        echo "Erro!";
    }
//

    if($stmt && $stmt->rowCount() > 0) {

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado['senha'] == $senha) {

            $_SESSION["logou"] = 'S';
            $_SESSION['adm'] = $resultado['adm'];
            $_SESSION['idusuario'] = $resultado['idusuario'];

            header('Location: ../index.php');
            exit;

        }
        header('Location: ../login.php?error=invalid');
        exit;
    }
    else	
    {
        header('Location: ../login.php?error=invalid');
        exit;
    }