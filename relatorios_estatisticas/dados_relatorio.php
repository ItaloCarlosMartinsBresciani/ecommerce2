<?php
	require "conexao.php";
   
/*
	$sql = "select  p.codproduto,
                   p.descricao,
                   sum(iv.qtde) as qtdevendida
              from venda v
                   inner join itemvenda iv
                on v.codvenda = iv.codvenda
                   inner join produto p
                on p.codproduto = iv.codproduto 
             group by p.codproduto,
                   p.descricao
             order by qtdevendida desc, descricao ";
 */

	$sql = "select c.IdCurso,
           c.NomeCurso,         
           c.Img as descricao,
           sum(iv.QUANTIDADE) as QUANTIDADE
      from VENDAS v
     inner join ITENSVENDA iv
        on v.IDVENDA = iv.IDVENDA
     inner join cursos c
        on c.IdCurso = iv.IdCurso 
     group by c.IdCurso,
           c.NomeCurso, 
           c.Img
     order by QUANTIDADE ";

	$res = pg_query($conecta, $sql);
	$qtde=pg_num_rows($res);

?>