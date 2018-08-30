<?php 

include("../processa/conexao.php");

$idCM = $_GET["cm_id"];

try {
  $conexao = db_connect();
  $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conexao->exec("set names utf8");
} catch (PDOException $erro) {
  echo "Erro na conexão:" . $erro->getMessage();
}

try {
    $stmt = $conexao->prepare("DELETE FROM centromedico WHERE idCM = ?");
    $stmt->bindParam(1, $idCM, PDO::PARAM_INT);
    if ($stmt->execute()) {
        echo"<script language='javascript' type='text/javascript'>alert('Registro foi excluido com sucesso!');window.location.href='../cadastro/listar.php';</script>";
        $idCM = null;
    } else {
        throw new PDOException("Erro: Não foi possível executar a declaração sql");
    }
} catch (PDOException $erro) {
    echo "Erro: ".$erro->getMessage();
}
?>