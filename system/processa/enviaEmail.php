<?php
	$nome=$_POST["nome"];
	$assunto="Contato Hospital Albert Ainstein";
	$email_remetente=$_POST["email"];
	$email_from ="lipedigo@hotmail.com";
	$mensagem = $_POST["mensagem"];

	$headers="MIME-Version: 1.0\r\n";
	$headers .="Content-type: text/html; charset=iso-8859-1\r\n";//o ponto é usado para poder quebrar a linha
	$headers .="From: \"$nome\"<$email_remetente>\r\n";
	mail($email_from,$assunto,$mensagem,$headers);
	echo"<script language='javascript' type='text/javascript'>alert('Email Enviado com Suscesso!');window.location.href='../../view/index.php';</script>";
	
?>