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
            $mail->SMTPDebug = 2;

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
                $email = $_SESSION["email"];
                //.$linha['nome'].
                print_r($email, $_SESSION["email"]);
                
                $mail->addAddress($email); //Preencher com o email e nome de quem receberá a mensag


            //Set the subject line




            $sql = "SELECT * FROM VENDAS WHERE idusuario = $idusuario AND IDVENDA = '".$_SESSION['venda']."'";
            $res = pg_query($conecta, $sql);
            $linha = pg_fetch_array($res);
            
            
            $sql = "SELECT * FROM itensvenda WHERE idvenda = '".$_SESSION['venda']."'";
            $res = pg_query($conecta, $sql);
            $linha = pg_fetch_array($res);
            $idCurso = $linha['idcurso'];
            
            $tabela = "<html><body>
            <table>
                <thead>
                    <tr>
                        <td>Nome</td>
                        <td>Descrição</td>
                        <td>Preço</td>
                    </tr>
                </thead>
                
                <tbody>
                ";
                foreach($idCurso as $idCurso)
                { // Início do FOREACH
                    $sql = "SELECT NomeCurso, Img, preco FROM cursos WHERE idCurso=$idCurso AND excluido IS FALSE ORDER BY idCurso";
                    $res = pg_query($conecta, $sql);
                    $linha = pg_fetch_array($res);
    
                    $preco = $linha['preco'];
                    $nome = $linha['nomecurso'];
                    $Img = $linha['Img'];
                    
                    $tabela = $tabela."
                    <tr>
                        <td>".$nome."</td>
                        <td>".$descricao."</td>
                        <td>".$preco."</td>
                    </tr>";
                
                }
            $tabela = $tabela."</tbody></table></body></html>";
            
            
            $mail->Subject = 'Finalização de compra'; //Preencher com o assunto do email
            
            $mail->isHTML(true); //Configurar mensagem como HTML
            
            $mail->CharSet='UTF-8'; //Configurar conjunto de caracteres da mensagem em HTML
            
            //Replace the plain text body with one created manually
            $mail->Body = '<html><head><meta charset="utf-8"></head>
            <body> 
            Parabéns '.$nome.'! Sua compra foi realizada com sucesso!
            <br><br><br><br>
            
            Dados da compra:<br><br>
            '.$tabela.'
            </body></html>'; //Mensagem em HTML


            //send the message, check for errors
            if (!$mail->send()) {
                echo "Mailer Error: " . $mail->ErrorInfo;
            } else {
                echo "Message sent!"; // alterar aqui
            }