<?php

// inclui o arquivo de inicialização
require 'conexao.php';

// resgata variáveis do formulário
$matricula = isset($_POST['matricula']) ? $_POST['matricula'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

if (empty($matricula) || empty($password))
{
	echo"<script language='javascript' type='text/javascript'>alert('O campo login deve ser preenchido');window.location.href='form_login.php';</script>";
	exit;
}

// cria o hash da senha
$passwordHash = make_hash($password);

$PDO = db_connect();

$sql = "SELECT * FROM usuario WHERE usuario.matricula = :matricula AND usuario.password = :password" ;
$stmt = $PDO->prepare($sql);

$stmt->bindParam(':matricula', $matricula);
$stmt->bindParam(':password', $passwordHash);

$stmt->execute();

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($users) <= 0)
{
	echo"<script language='javascript' type='text/javascript'>alert('Matricula ou senha incorreta!');window.location.href='form_login.php';</script>";
	exit;
}

// pega o primeiro usuário
$user = $users[0];

session_start();
$_SESSION['logged_in'] = true;
$_SESSION['user_matricula'] = $user['matricula'];
$_SESSION['user_name'] = $user['nome'];
$_SESSION['user_funcao'] = $user['funcaoPessoa'];
$_SESSION['user_filial'] = $user['filial'];

header('Location: index.php');

?>