<?php 
include("../processa/conexao.php");

session_start();
require '../processa/verifica_sessao.php'; 

try {
  $conexao = db_connect();
  $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conexao->exec("set names utf8");
} catch (PDOException $erro) {
  echo "Erro na conexão:" . $erro->getMessage();
}


try{

  $id = $_GET["paci_id"];
  settype($id, "integer");

  try {
    $stmt = $conexao->prepare("SELECT * FROM paciente WHERE idPaciente = $id");
    $stmt->bindParam(1, $idPaciente, PDO::PARAM_INT);
    if ($stmt->execute()) {
      $rs = $stmt->fetch(PDO::FETCH_OBJ);
      $idPaciente = $rs->idPaciente;
      $nomePaciente = $rs->nomePaciente;
      $emailPaciente = $rs->emailPaciente;
      $contatoPaciente = $rs->contatoPaciente;
      $cpfPaciente = $rs->cpfPaciente;
      $rgPaciente = $rs->rgPaciente;
      $ruaPaciente = $rs->ruaPaciente;
      $bairroPaciente = $rs->bairroPaciente;
      $cidadePaciente = $rs->cidadePaciente;
      $estadoPaciente = $rs->estadoPaciente;
    } else {
      throw new PDOException("Erro: Não foi possível executar a declaração sql");
    }
  } catch (PDOException $erro) {
    echo "Erro: ".$erro->getMessage();
  }

}catch (PDOException $erro) {
  echo "Erro na conexão:" . $erro->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Cadastros</title>
  <?php
  include("../components/bibliotecas.php");
  ?>
</head>

<body>
  <?php
  include("../components/toolbar.php");
  ?>

  <div id="mgt" class="container">
    <div class="text-center ma1">
      <h3 id="tipo_cadastro">Alterar Paciente</h3>
    </div>
    <div class="row">
      <div class="col-md-12" id="formulario_cadastro">
        <form method="POST" action="../processa/proc_cadastros.php">
      <input type="hidden" name="op" value="5">
      <input type="hidden" name="idPaciente" value="<?php echo ($idPaciente) ?>">
      <div class="form_section pa1">
        <div class="form-group">
          <div class="col-sm-12">
          <div class="mb1">
						<div class="row centered pa1" style="border: solid 1px #DDD">
              <span style="margin-top: -10px">Dados principais</span>
              <div class="col-sm-12 col-md-12">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" name="nome" value="<?php echo ($nomePaciente) ?>" require>
              </div>

              <div class="col-sm-12 col-md-6">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" name="email" value="<?php echo ($emailPaciente) ?>" require>
              </div>

              <div class="col-sm-12 col-md-6">
                <label for="num_contato">Número Contato</label>
                <input type="text" class="form-control" name="num_contato" value="<?php echo ($contatoPaciente) ?>" require>
              </div>

              <div class="col-sm-12 col-md-6">
                <label for="cpf">CPF</label>
                <input type="text" class="form-control" name="cpf" value="<?php echo ($cpfPaciente) ?>" require>
              </div>

              <div class="col-sm-12 col-md-6">
                <label for="rg">RG</label>
                <input type="text" class="form-control" name="rg" value="<?php echo ($rgPaciente) ?>" require>
              </div>
						</div>

						<div class="row centered pa1 mt1" style="border: solid 1px #DDD">
              <span style="margin-top: -10px">Endereço</span>
              <div class="col-sm-12 col-md-12">
                <label for="rua">Rua</label>
                <input type="text" class="form-control" name="rua" value="<?php echo ($ruaPaciente) ?>" require>
              </div>

              <div class="col-sm-12 col-md-6">
                <label for="bairro">Bairro</label>
                <input type="text" class="form-control" name="bairro" value="<?php echo ($bairroPaciente) ?>"require>
              </div>

              <div class="col-sm-12 col-md-6">
                <label for="cidade">Cidade</label>
                <input type="text" class="form-control" name="cidade" value="<?php echo ($cidadePaciente) ?>" require>
              </div>

              <div class="col-sm-12 col-md-12">
                <label for="cidade">Estado</label>
                <input type="text" class="form-control" name="estado" value="<?php echo ($estadoPaciente) ?>" require>
              </div>
							</div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">	
        <div class="col-md-12 to-right">
          <button id="btnCadEsp" type="submit" class="btn btn-success">Alterar</button>
        </div>
      </div>
    </form>
      </div>
    </div>
  </div>
  

  <script src="../../lib/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="../js/form_cadastro.js"></script>
  
</body>

</html>