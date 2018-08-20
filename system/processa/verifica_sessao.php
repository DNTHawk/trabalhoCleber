<?php
 
require_once 'conexao.php';
 
if (!isLoggedIn())
{
    header('Location: ../form_login.php');
}

?>