<?php 

include("../processa/conexao.php");

$idPaciente = $_GET["paci_id"];

try {
  $conexao = db_connect();
  $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conexao->exec("set names utf8");
} catch (PDOException $erro) {
  echo "Erro na conexão:" . $erro->getMessage();
}

try {
  $stmt = $conexao->prepare("DELETE FROM paciente WHERE idPaciente = ?");
  $stmt->bindParam(1, $idPaciente, PDO::PARAM_INT);
  if ($stmt->execute()) {
    echo"<script language='javascript' type='text/javascript'>alert('Registro foi excluido com sucesso!');window.location.href='../cadastro/listar.php';</script>";
    $idPaciente = null;
  } else {
    throw new PDOException("Erro: Não foi possível executar a declaração sql");
  }
} catch (PDOException $erro) {
  echo "Erro: ".$erro->getMessage();
}
?>