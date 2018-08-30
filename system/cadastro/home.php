<?php 

include("../processa/conexao.php");

session_start();
require '../processa/verifica_sessao.php'; 

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Cadastros</title>
  <?php
  include("../components/bibliotecas.php");
  ?>
</head>

<body>
  <?php
  include("../components/toolbar.php");
  ?>

  <div class="bg1"></div>
  <div class="bg2"></div>

  
  <script src="../js/form_cadastro.js"></script>
  <script src="../../lib/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</body>

</html>