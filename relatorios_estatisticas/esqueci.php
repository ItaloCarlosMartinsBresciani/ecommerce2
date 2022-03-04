<!DOCTYPE html>
<html lang="PT-BR">

<head>
  <meta charset="UTF-8">
  <link rel="icon" href="imagem/icon.png">
  <title>Login</title>
  
  <link rel="stylesheet" type="text/css" href="css/form.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/8545ffdfda.js" crossorigin="anonymous"></script>
</head>

<body>
<?php
        session_start();
        if (!isset($_SESSION["logou"]))
        {
          echo "<div id='login-container'>
          <h1><i class='fas fa-user-plus'></i> Esqueci minha senha</h1>
          <form action='php/email/sendEmail.php' method='POST'>
          
            <label for='email'>E-mail</label>
            <input type='email' name='email' id='email' placeholder='Digite seu e-mail' required>
            <input type='submit' value='Mandar e-mail'>
            </form>
          <form action='index.php' method='POST'>
          <input type='submit' value='Voltar'>
          </form>
        </div>";
        }