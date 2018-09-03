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

  $id = $_GET["espc_id"];
  settype($id, "integer");

  try {
    $stmt = $conexao->prepare("SELECT * FROM especialidade WHERE idEspecialidade = $id");
    $stmt->bindParam(1, $idEspecialidade, PDO::PARAM_INT);
    if ($stmt->execute()) {
      $rs = $stmt->fetch(PDO::FETCH_OBJ);
      $idEspecialidade = $rs->idEspecialidade;
      $nomeEspecialidade = $rs->nomeEspecialidade;
      $descricao = $rs->descricao;
      $linkImagem = $rs->linkImagem;
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

  <div class="container">
    <div class="text-center ma1">
      <h3 id="tipo_cadastro">Alterar Especialidade</h3>
    </div>
    <div class="row">
      <div class="col-md-12" id="formulario_cadastro">
        <form method="POST" enctype="multipart/form-data" action="../processa/proc_cadastros.php">
          <input type="hidden" name="op" value="3">
          <input type="hidden" name="idEspecialidade" value="<?php echo ($idEspecialidade) ?>">
          <div class="form_section pa1">
            <div class="form-group">
              <label for="especialidade" class="col-sm-2 control-label">Especialidade</label>
              <div class="col-sm-12">
                <div class="row">
                  <input type="text" class="form-control" name="especialidade" placeholder="Especialidade" value="<?php echo ($nomeEspecialidade) ?>" require>
                </div>
                <div class="row">
                  <textarea class="form-control mt1" name="descricao" placeholder="Descrição" require><?php echo ($descricao); ?></textarea>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <label for='selecao-arquivo'>Selecionar um arquivo</label>
                    <input id='selecao-arquivo' type="file" name="foto">
                  </div>
                  <div class="col-md-4">
                    <div id="image-holder" style=""></div>
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
  <script>
    $("#selecao-arquivo").on('change', function () {

      if (typeof (FileReader) != "undefined") {

        var image_holder = $("#image-holder");
        image_holder.empty();

        var reader = new FileReader();
        reader.onload = function (e) {
          $("<img />", {
            "src": e.target.result,
            "class": "thumb-image"
          }).appendTo(image_holder);
        }
        image_holder.show();
        reader.readAsDataURL($(this)[0].files[0]);
      } else{
        alert("Este navegador nao suporta FileReader.");
      }
    });
  </script>
  <script src="../js/form_cadastro.js"></script>
  
</body>

</html>