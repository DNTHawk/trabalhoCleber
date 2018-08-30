<?php 
include("../processa/conexao.php");

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
</head>

<body>
  <?php
  include("../components/toolbar.php");
  ?>

  <div id="mgt" class="container">
    <div>
      <h3 class="text-center">Selecione o tipo de cadastro</h3><br/>
      <div class="centered">
        <button class="ms1 btn btn-primary" onclick="seleciona_form('centro_medico')">Centro médico</button>
        <button class="ms1 btn btn-success" onclick="seleciona_form('profissional')">Profissional</button>
        <button class="ms1 btn btn-warning" onclick="seleciona_form('especialidade')">Especialidade</button>
      </div>
    </div>
    <div class="text-center ma1">
      <h3 id="tipo_cadastro"></h3>
    </div>
    <div class="row">
      <div class="col-md-12" id="formulario_cadastro">
        <form class="form-horizontal" method="POST" action="../processa/proc_cadastros.php" id="form_centro_medico">
          <input type="hidden" name="op" value="1">
          <div class="form_section">
            <h4 class="text-center mb1">Informações básicas</h4>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-10 col-md-12">
                  <label for="nome">Nome</label>
                  <input type="text" class="form-control" name="nome" placeholder="Nome Completo">
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-sm-10 col-md-6">
                  <label for="cnpj">CNPJ</label>
                  <input type="text" class="form-control" name="cnpj" placeholder="CNPJ">
                </div>

                <div class="col-sm-10 col-md-6">
                  <label for="nome_fantasia">Nome Fantasia</label>
                  <input type="text" class="form-control" name="nome_fantasia" placeholder="Nome Fantasia">
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
                  <input type="text" class="form-control" name="cep" placeholder="CEP">
                </div>
              </div>
              <div class="row">
                <div class="mb1 col-sm-10 col-md-6">
                  <label for="rua">Rua</label>
                  <input type="text" class="form-control" name="rua" placeholder="Rua">
                </div>
                <div class="mb1 col-sm-10 col-md-6">
                  <label for="numero">Número</label>
                  <input type="text" class="form-control" name="numero" placeholder="Número">
                </div>
              </div>
              <div class="row">
                <div class="mb1 col-sm-10 col-md-6">
                  <label for="bairro" class="col-sm-2 control-label">Bairro</label>
                  <input type="text" class="form-control" name="bairro" placeholder="Bairro">
                </div>
                <div class="mb1 col-sm-10 col-md-6">
                  <label for="cidade" class="col-sm-1 control-label">Cidade</label>
                  <input type="text" class="form-control" name="cidade" placeholder="Cidade">
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-12 to-right">
              <button type="submit" class="btn btn-success">Cadastrar</button>
            </div>
          </div>
        </form>

        <form class="form-horizontal" method="POST" action="../processa/proc_cadastros.php" id="form_profissional">
          <input type="hidden" name="op" value="2">
          <div class="form_section pa1">
            <div class="row mb1">
              <div class="col-sm-12 col-md-6">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" name="nome" placeholder="Nome Completo">
              </div>

              <div class="col-sm-12 col-md-6">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" name="email" placeholder="E-mail">
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-sm-12 col-md-6">
                  <label for="usuario">Usuário</label>
                  <input type="text" class="form-control" name="usuario" placeholder="Usuário">
                </div>

                <div class="col-sm-12 col-md-6">
                  <label for="senha">Senha</label>
                  <input type="password" class="form-control" name="senha" placeholder="Senha">
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
              <div class="col-sm-12 col-md-6">
                  <div class="form-group">
                        <label for="especialidade">Especialidade:</label>
                            <?php
                                $sql = "SELECT * from especialidade order by nomeEspecialidade asc";
                                $stm = $conexao->prepare($sql);
                                $stm->execute();
                                $especialidades = $stm->fetchAll(PDO::FETCH_OBJ);
                            ?>
                        <select class="form-control" name="especialidade" id="especialidade" required>
                        <?php 
                            if (isset($especialidade) && $especialidade != null || $especialidade != ""){?> <option value="<?=$especialidade?>"><?=$nomeEspecialidade?></option> <?php
                            }else{
                            ?><option value="">Especialidade:</option><?php
                            }
                        ?>
                        <?php foreach($especialidades as $especialidade):?>
                            <option value=<?=$especialidade->idEspecialidade?>><?=$especialidade->nomeEspecialidade?></option>
                        <?php endforeach;?>
                        </select>
                        <span class='msg-erro msg-status'></span>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                  <label for="nivel_de_acesso">Nivel de Acesso</label>
                  <select class="form-control" name="nivel_de_acesso">
                    <option value="1">Administrativo</option>
                    <option value="2">Usuário</option>
                  </select>
                </div>
              </div>
            </div>

          </div>
          <div class="form-group">
            <div class="col-sm-12 to-right">
              <button type="submit" class="btn btn-success">Cadastrar</button>
            </div>
          </div>
        </form>

        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="../processa/proc_cadastros.php" id="form_especialidades">
          <input type="hidden" name="op" value="3">
          <div class="form_section pa1">
            <div class="form-group">
              <label for="especialidade" class="col-sm-2 control-label">Especialidade</label>
              <div class="col-sm-12">
                <div class="row">
                  <input type="text" class="form-control" name="especialidade" placeholder="Especialidade">
                </div>
                <div class="row">
                  <textarea class="form-control mt1" name="descricao" placeholder="Descrição"></textarea>
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
              <button id="btnCadEsp" type="submit" class="btn btn-success">Cadastrar</button>
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