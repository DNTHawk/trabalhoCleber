<?php

require_once 'conexao.php';

$op = $_POST["op"];

$foto = $_FILES["foto"];

try {
  $conexao = db_connect();
  $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conexao->exec("set names utf8");
} catch (PDOException $erro) {
  echo "Erro na conexão:" . $erro->getMessage();
}

require_once 'proc_cadastros.php';

$nome_imagem = pegaDadosImagem();

$caminho_imagem = "../processa/fotos/".$nome_imagem;

move_uploaded_file($foto["tmp_name"], $caminho_imagem);

?>