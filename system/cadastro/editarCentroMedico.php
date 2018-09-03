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

  $id = $_GET["cm_id"];
  settype($id, "integer");

  try {
    $stmt = $conexao->prepare("SELECT * FROM centromedico WHERE idCM = $id");
    $stmt->bindParam(1, $idCM, PDO::PARAM_INT);
    if ($stmt->execute()) {
      $rs = $stmt->fetch(PDO::FETCH_OBJ);
      $idCM = $rs->idCM;
      $nomeCM = $rs->nomeCM;
      $cnpj = $rs->cnpj;
      $nomeFantasia = $rs->nomeFantasia;
      $cep = $rs->cep;
      $rua = $rs->rua;
      $numero = $rs->numero;
      $bairro = $rs->bairro;
      $cidade = $rs->cidade;
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
      <h3 id="tipo_cadastro">Alterar Centro Medico</h3>
    </div>
    <div class="row">
      <div class="col-md-12" id="formulario_cadastro">
        <form method="POST" action="../processa/proc_cadastros.php">
          <input type="hidden" name="op" value="1">
          <input type="hidden" name="idCM" value="<?php echo ($idCM) ?>">
          <div class="form_section">
            <h4 class="text-center mb1">Informações básicas</h4>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-10 col-md-12">
                  <label for="nome">Nome</label>
                  <input type="text" class="form-control" name="nome" value="<?php echo ($nomeCM) ?>" require>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-sm-10 col-md-6">
                  <label for="cnpj">CNPJ</label>
                  <input type="text" class="form-control" name="cnpj" value="<?php echo ($cnpj) ?>" require>
                </div>

                <div class="col-sm-10 col-md-6">
                  <label for="nome_fantasia">Nome Fantasia</label>
                  <input type="text" class="form-control" name="nome_fantasia" value="<?php echo ($nomeFantasia) ?>" require>
                </div>
              </div>
            </div>

          </div>
          <div class="form_section">
            <h4 class="text-center ma1">Endereço</h4>
            <div class="form-group">
              <div class="row">
                <label for="cep" class="col-sm-2 col-md-2 control-label">CEP</label>
                <div class="mb1 col-sm-10 col-md-12">
                  <input type="text" class="form-control" name="cep" value="<?php echo ($cep) ?>" require>
                </div>
              </div>
              <div class="row">
                <div class="mb1 col-sm-10 col-md-6">
                  <label for="rua">Rua</label>
                  <input type="text" class="form-control" name="rua" value="<?php echo ($rua) ?>" require>
                </div>
                <div class="mb1 col-sm-10 col-md-6">
                  <label for="numero">Número</label>
                  <input type="text" class="form-control" name="numero" value="<?php echo ($numero) ?>" require>
                </div>
              </div>
              <div class="row">
                <div class="mb1 col-sm-10 col-md-6">
                  <label for="bairro" class="col-sm-2 control-label">Bairro</label>
                  <input type="text" class="form-control" name="bairro" value="<?php echo ($bairro) ?>" require>
                </div>
                <div class="mb1 col-sm-10 col-md-6">
                  <label for="cidade" class="col-sm-1 control-label">Cidade</label>
                  <input type="text" class="form-control" name="cidade" value="<?php echo ($cidade) ?>" require>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-12 to-right">
              <button type="submit" class="btn btn-success">Alterar</button>
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