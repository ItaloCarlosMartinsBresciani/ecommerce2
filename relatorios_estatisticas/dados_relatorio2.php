<?php
	//require "conexao.php";

	$sql2 = "select c.IdCurso,
                   c.genero,
                   sum(iv. QUANTIDADE) as QUANTIDADE
              from VENDAS v
                   inner join ITENSVENDA iv
                on v.IDVENDA = iv.IDVENDA
                   inner join cursos c
                on c.IdCurso = iv.IdCurso 
             group by c.IdCurso,
                   c.genero
             order by QUANTIDADE desc, genero ";

	$res2 = pg_query($conecta, $sql2);
	$qtde2=pg_num_rows($res2);	 
?>