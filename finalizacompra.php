<?php
        session_start();
        if(!isset($_SESSION['carrinho']))
        {
            $_SESSION['carrinho'] = array();
        }
        require("php/conexao.php");
    if(count($_SESSION['carrinho']) == 0)
    {
        echo "<script> alert('Sessão expirada!'); </script>";
        header("location: produtos.php");
    }
    else{

        $idusuario = strtolower(trim(filter_var($_SESSION['idusuario'], FILTER_SANITIZE_NUMBER_INT)));
        $idcurso = strtolower(trim(filter_var($_SESSION['idcurso'], FILTER_SANITIZE_NUMBER_INT)));
    

        $total=0;
        $sql = "INSERT INTO vendas (IDVENDA, DATACOMPRA, EXCLUIDO, idusuario) VALUES (DEFAULT, NOW(), '0', :idusuario);";
        $stmt = $conecta->prepare($sql); //
        $stmt->bindValue(':idusuario', $idusuario);
        $stmt->execute();
        $res = pg_query($conecta, $sql);


            foreach ($_SESSION['carrinho'] as $idcurso => $qtd)
            {
                
                $sql = "SELECT * FROM cursos where idcurso = :idcurso and excluido = 'false' order by img";
                $stmt = $conecta->prepare($sql);//
                $stmt->bindValue(':idcurso', $idcurso);
                $stmt->execute();
                    $res = pg_query ($conecta, $sql);
                    $qtde=pg_num_rows($res);
                    $linha = pg_fetch_array($res);
                    $preco = $linha['preco'];
                    
                    $sql = "INSERT INTO itensvenda (IDVENDA, IdCurso, QUANTIDADE, Preco, EXCLUIDO) Values (CURRVAL('seq_venda'), :idcurso, ".$qtd.", ".$preco.", 'False')"; 
                    $res = pg_query ($conecta, $sql);
            }

                unset ($_SESSION['carrinho']);
                header("location: php/email/envEmail.php");
        }