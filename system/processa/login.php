<?php

// Inclui o arquivo de conexão
require 'conexao.php';

//Resgata variáveis do formulário
$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// Cria o hash da senha
$passwordHash = make_hash($password);

// Recebe a variavel de conexão
$PDO = db_connect();

// Variavel com o comando SQL
$sql = "SELECT * FROM usuario WHERE usuario.usuario = :usuario AND usuario.password = :password" ;

// Prepara uma instrução para execução e retorna um objeto de instrução
$stmt = $PDO->prepare($sql);

// Passa variáveis para marcadores de parâmetros no comando SQL que foi passado para PDO->prepare
$stmt->bindParam(':usuario', $usuario);
$stmt->bindParam(':password', $passwordHash);

//Executa uma instrução preparada
$stmt->execute();

// Retorna uma matriz contendo todas as linhas do conjunto de resultados
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Verifica se foi encontrado o usuario no banco de dados
if (count($users) <= 0)
{
	echo"<script language='javascript' type='text/javascript'>alert('Matricula ou senha incorreta!');window.location.href='../form_login.php';</script>";
	exit;
}

// Pega o primeiro usuário
$user = $users[0];

// Inicia a sessão
session_start();
$_SESSION['logged_in'] = true;
$_SESSION['user_usuario'] = $user['usuario'];
$_SESSION['user_name'] = $user['nome'];

// Direciona para pagina incial
header('Location: ../index.php');

?>