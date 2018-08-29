<?php
 
// Constantes com as credenciais de acesso ao banco MySQL
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
<<<<<<< HEAD
define('DB_PASS', '');
=======
define('DB_PASS', 'root');
>>>>>>> b13b36a27085d2c18e16cc35c7b644b681b4dedf
define('DB_NAME', 'sismedico');
 
// Habilita todas as exibições de erros
ini_set('display_errors', true);
error_reporting(E_ALL);
 
// Inclui o arquivo de funçõees
require_once 'funcoes.php';

?>