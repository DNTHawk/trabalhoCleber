<?php 

require 'conexao.php';

$nome = $_POST["nome"];
$matricula = $_POST["matricula"];
$password = $_POST["password"];
$op = $_POST["op"];

try {
    $conexao = db_connect();
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao->exec("set names utf8");
} catch (PDOException $erro) {
    echo "Erro na conexão:".$erro->getMessage();
}

function cadUsuario(){

    global $nome, $matricula, $password, $conexao;

    $stmt = $conexao->prepare("INSERT INTO usuario (nome, matricula, password) VALUES ('$nome', '$matricula', '$password')");
    
    if ($stmt->execute()) {
        if ($stmt->rowCount() > 0) {
            echo"<script language='javascript' type='text/javascript'>alert('Dados cadastrados com sucesso!');window.location.href='index.php';</script>";   
        } else {
            echo "<script>alert('Erro ao efetivar o cadastro!')</script>";
        }
    } else {
        throw new PDOException("Erro: Não foi possível executar a declaração sql");
    } 
}

switch ($op) {
    case '1'://Cadastro
        cadUsuario();
        break;

    default:
        
        break;
}

?>