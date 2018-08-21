<?php

// inclui o arquivo de inicialização
require 'conexao.php';

// resgata variáveis do formulário
$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// cria o hash da senha
$passwordHash = make_hash($password);

$PDO = db_connect();

$sql = "SELECT * FROM usuario WHERE usuario.usuario = :usuario AND usuario.password = :password" ;
$stmt = $PDO->prepare($sql);

$stmt->bindParam(':usuario', $usuario);
$stmt->bindParam(':password', $passwordHash);

$stmt->execute();

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($users) <= 0)
{
	echo"<script language='javascript' type='text/javascript'>alert('Matricula ou senha incorreta!');window.location.href='../form_login.php';</script>";
	exit;
}

// pega o primeiro usuário
$user = $users[0];

session_start();
$_SESSION['logged_in'] = true;
$_SESSION['user_usuario'] = $user['usuario'];
$_SESSION['user_name'] = $user['nome'];

header('Location: ../index.php');

?>