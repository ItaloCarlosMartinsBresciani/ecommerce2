
<?php
            session_start();
           
            date_default_timezone_set('Etc/UTC');

            
            require './PHPMailer/PHPMailerAutoload.php';

            
            $mail = new PHPMailer;

            
            $mail->isSMTP();

            //Enable SMTP debugging
            // 0 = off (for production use)
            // 1 = client messages
            // 2 = client and server messages
            $mail->SMTPDebug = 0;

            //Ask for HTML-friendly debug output
            $mail->Debugoutput = 'html';

            //Set the hostname of the mail server
            $mail->Host = 'smtp.gmail.com';

            //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
            $mail->Port = 587;

            //Set the encryption system to use - ssl (deprecated) or tls
            $mail->SMTPSecure = 'tls';

            //Whether to use SMTP authentication
            $mail->SMTPAuth = true;

            //Username to use for SMTP authentication - use full email address for gmail
            $mail->Username = 'cti.ecommerce@gmail.com'; //Preencher com o usuário da sua conta Gmail

            //Password to use for SMTP authentication
            $mail->Password = '@1234cti'; //Preencher com a senha do usuário da sua conta Gmail

            //Set who the message is to be sent from
            $mail->From='cti.ecommerce@gmail.com'; //Preencher com a sua conta Gmail
            $mail->FromName='Fleazy cursos'; //Preencher com o nome do remetente

            //Set who the message is to be sent to

            require("../conexao.php");
                

                $sql="SELECT nome, email FROM usuarios WHERE idusuario = ".$_SESSION["idusuario"];
            
                $res = pg_query($conecta, $sql);
                $linha = pg_fetch_array($res); 

                $nome = $_POST['nome'];
                $email = $linha['email'];
                
                $mail->addAddress($email); //Preencher com o email e nome de quem receberá a mensag


            //Set the subject line

//--------------------------------------------------------------------------------------------------------------------------
$sql3= "SELECT max(idvenda) as ultimavenda FROM Vendas WHERE idusuario = ".$_SESSION["idusuario"]."";

$res3 = pg_query($conecta, $sql3);
$linha3 = pg_fetch_array($res3);




$sql2= "SELECT iv.idvenda, iv.idCurso, iv.preco, p.NomeCurso FROM ItensVenda iv, cursos p WHERE p.idcurso = iv.idcurso AND idvenda=".$linha3['ultimavenda'];

    $res2 = pg_query($conecta, $sql2);






$mail->Subject = 'Compra finalizada com sucesso!'; //Preencher com o assunto do email

$mail->isHTML(true); //Configurar mensagem como HTML

$mail->CharSet='UTF-8'; //Configurar conjunto de caracteres da mensagem em HTML

//Replace the plain text body with one created manually


while ($linha2 = pg_fetch_array($res2))
    {
        
    $qtdetotal = 0;

    $nomeproduto=$linha2['nomecurso'];
    $idvenda=$linha2['idvenda'];
    $preco=$linha2['preco'];
    

    $tabela = $tabela.'
    <br><br>- <strong>Nome do curso:</strong> '.$nomeproduto.'
    <br>- <strong>ID da Venda:</strong> '.$idvenda.'
    <br>- <strong>Preço:</strong> '.$preco;
    
    
    

}

//----------------------------------------------------------------------------------------------------------------------------------------
            
            $mail->Subject = 'Finalização de compra'; //Preencher com o assunto do email
            
            $mail->isHTML(true); //Configurar mensagem como HTML
            
            $mail->CharSet='UTF-8'; //Configurar conjunto de caracteres da mensagem em HTML
            
            //Replace the plain text body with one created manually

            $sql = "SELECT nome FROM usuarios WHERE idusuario = ".$_SESSION["idusuario"]."";
            $res = pg_query($conecta, $sql);
            $linha = pg_fetch_array($res);
            $nome2 = $linha['nome'];
            $mail->Body = '<html><head><meta charset="utf-8"></head>
            <body> 
            Parabéns '.$nome2.'! Sua compra foi realizada com sucesso!
            <br><br>
            
        
            Dados da compra:
            '.$tabela.'
            </body></html>'; //Mensagem em HTML


            //send the message, check for errors
            if (!$mail->send()) {
                echo "Mailer Error: " . $mail->ErrorInfo;
            } else {
                echo "<script>alert('Sua compra foi realizada com êxito! Verifique seu e-mail para ver as informações da compra.');</script>";
                echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../../login.php'>";
        

            }