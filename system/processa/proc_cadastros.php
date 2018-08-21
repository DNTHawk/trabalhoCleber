<?php

require 'conexao.php';

$op = $_POST["op"];

try {
    $conexao = db_connect();
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao->exec("set names utf8");
} catch (PDOException $erro) {
    echo "Erro na conexão:".$erro->getMessage();
}

function cadCentroMedico(){

    global $nome, $cnpj, $nome_fantasia, $cep, $rua, $numero, $bairro, $conexao;

    $stmt = $conexao->prepare(" INSERT INTO centroMedico (nomeCM, cnpj, nomeFantasia, cep, rua, numero, bairro, cidade) 
    VALUES ('$nome', '$cnpj', '$nome_fantasia', '$cep', '$rua', '$numero', '$bairro')");

    var_dump($stmt);

    if ($stmt->execute()) {
        if ($stmt->rowCount() > 0) {
            echo"<script language='javascript' type='text/javascript'>
            alert('Dados cadastrados com sucesso!');window.location.href='../cadastro/cadastros.php';</script>";
        } else {
            echo "<script>alert('Erro ao efetivar o cadastro!')</script>";
        }
    } else {
        throw new PDOException("Erro: Não foi possível executar a declaração sql");
    }
    
};

switch ($op) {
    case '1':
        $nome = $_POST["nome"];
        $cnpj = $_POST["cnpj"];
        $nome_fantasia = $_POST["nome_fantasia"];
        $cep = $_POST["cep"];
        $rua = $_POST["rua"];
        $numero = $_POST["numero"];
        $bairro = $_POST["bairro"];
        $cidade = $_POST["cidade"];

        cadCentroMedico();
        break;
    
    default:
        # code...
        break;
}

?>