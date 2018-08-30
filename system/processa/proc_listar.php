<?php

require 'conexao.php';

try {
  $conexao = db_connect();
  $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conexao->exec("set names utf8");
} catch (PDOException $erro) {
  echo "Erro na conexão:" . $erro->getMessage();
}

function listarProfissional(){
    global $conexao;

    $sql = "SELECT * FROM usuario, especialidade WHERE usuario.especialidade = especialidade.idEspecialidade" ;
    $stmt = $conexao->prepare($sql);
    


}

?>