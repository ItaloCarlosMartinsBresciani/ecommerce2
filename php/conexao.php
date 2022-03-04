<?php
  try {

    $conecta = new PDO("pgsql:host=kesavan.db.elephantsql.com;port=5432;dbname=epmmpnjf", 'epmmpnjf', 'n61RM3DiYC2lHiVJ20LCHh5itky1ZKam');
    $conecta->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
  }catch(PDOException $e)
  {
    echo 'Erro:' . $e->getCode() . 'Message' . $e->getMessage();
  }
