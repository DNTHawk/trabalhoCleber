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

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Cadastros</title>
  <?php
  include("../components/bibliotecas.php");
  ?>

  <script>
    function confirmacaoDeleteNA(id) {
      var resposta = confirm("Deseja remover esse registro?");
      
      if (resposta == true) {
        window.location.href = "../processa/excluirNivelAcesso.php?NA_id="+id;
      }
    }
  </script>
</head>

<body>
  <?php
  include("../components/toolbar.php");
  ?>

  <div class="container">
    <h3 class="text-center">Selecione o tipo de cadastro</h3><br/>
    <div class="row centered" style="margin-top: 60px">
      <div class="col-sm-10 col-md-10">
        <form method="POST" action="../processa/proc_cadastros.php">
          <div class="form-group">
            <label for="nivelAcesso">Nivel de acesso</label>
            <input type="text" class="form-control" name="nivelAcesso" placeholder="Nível de Acesso do usuário" required>
          </div>
          <div class="col-sm-12 to-right">
            <input type="hidden" name="op" value="4">
            <button type="submit" class="btn btn-success">Cadastrar</button>
          </div>
        </form>
      </div>
    </div>

    <div class="centered mt2">
      <table class="table table-bordered">
        <tr>
          <th>Nível Acesso</th>
          <th>Ações</th>
        </tr>
        <?php 
        try{
          $stmt = $conexao->prepare("SELECT * FROM nivelacesso");
          if ($stmt->execute()) {
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
              echo "<tr>";
              echo "<td>".$rs->nivelAcesso
              ."</td><td><center><a class='btn btn-warning' href=\"editarNivelAcesso.php?NA_id=".$rs->idNivelAcesso."\">Editar</a>";
              ?>
              <a href="javascript:func()" class="btn btn-danger" onclick="confirmacaoDeleteNA('<?php echo ($rs->idNivelAcesso) ?>')">Excluir</a>
              <?php
              echo "</tr>";
            }
          } else {
            echo "Erro: Não foi possível recuperar os dados do banco de dados";
          }
        }catch (PDOException $erro) {
          echo "Erro: ".$erro->getMessage();
        }
        ?>
      </table>
    </div>

  </div>

  <script src="../js/form_cadastro.js"></script>
  <script src="../../lib/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</body>

</html>