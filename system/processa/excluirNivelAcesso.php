<?php 

include("../processa/conexao.php");

$idNivelAcesso = $_GET["NA_id"];

try {
  $conexao = db_connect();
  $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conexao->exec("set names utf8");
} catch (PDOException $erro) {
  echo "Erro na conexão:" . $erro->getMessage();
}

try {
  $stmt = $conexao->prepare("DELETE FROM nivelacesso WHERE idNivelAcesso = ?");
  $stmt->bindParam(1, $idNivelAcesso, PDO::PARAM_INT);
  if ($stmt->execute()) {
    echo"<script language='javascript' type='text/javascript'>alert('Registro foi excluido com sucesso!');window.location.href='../cadastro/nivel_acesso.php';</script>";
    $idNivelAcesso = null;
  } else {
    throw new PDOException("Erro: Não foi possível executar a declaração sql");
  }
} catch (PDOException $erro) {
  echo "Erro: ".$erro->getMessage();
}
?>