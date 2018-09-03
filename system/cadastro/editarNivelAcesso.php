<?php 

include("../processa/conexao.php");


try {
  $conexao = db_connect();
  $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conexao->exec("set names utf8");
} catch (PDOException $erro) {
  echo "Erro na conexão:" . $erro->getMessage();
}

try{

  $id = $_GET["NA_id"];
  settype($id, "integer");

  try {
    $stmt = $conexao->prepare("SELECT * FROM nivelacesso WHERE idNivelAcesso = $id");
    $stmt->bindParam(1, $idNivelAcesso, PDO::PARAM_INT);
    if ($stmt->execute()) {
      $rs = $stmt->fetch(PDO::FETCH_OBJ);
      $idNivelAcesso = $rs->idNivelAcesso;
      $nivelAcesso = $rs->nivelAcesso;
      
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

  session_start();
  require '../processa/verifica_sessao.php'; 

  ?>

  <div class="container">
    <h3 class="text-center">Alterar Nivel Acesso</h3><br/>
    <div class="row centered" style="margin-top: 60px">
      <div class="col-sm-10 col-md-10">
        <form method="POST" action="../processa/proc_cadastros.php">
          <div class="form-group">
            <label for="nivelAcesso">Nivel de acesso</label>
            <input type="text" class="form-control" name="nivelAcesso" value="<?php echo ($nivelAcesso) ?>" required>
          </div>
          <div class="col-sm-12 to-right">
            <input type="hidden" name="op" value="4">
            <input type="hidden" name="idNivelAcesso" value="<?php echo ($idNivelAcesso) ?>">
            <button type="submit" class="btn btn-success">Alterar</button>
          </div>
        </form>
      </div>
    </div>

  </div>

  <script src="../js/form_cadastro.js"></script>
  <script src="../../lib/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</body>

</html>