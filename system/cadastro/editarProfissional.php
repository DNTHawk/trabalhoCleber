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

  $id = $_GET["prof_id"];
  settype($id, "integer");

  try {
    $stmt = $conexao->prepare("SELECT * FROM usuario, nivelacesso, especialidade WHERE usuario.idNivelAcesso = nivelacesso.idNivelAcesso AND usuario.especialidade = especialidade.idEspecialidade AND idUsuario = $id");
    $stmt->bindParam(1, $idUsuario, PDO::PARAM_INT);
    if ($stmt->execute()) {
      $rs = $stmt->fetch(PDO::FETCH_OBJ);
      $idUsuario = $rs->idUsuario;
      $nome = $rs->nome;
      $especialidade = $rs->especialidade;
      $email = $rs->email;
      $usuario = $rs->usuario;
      $password = $rs->password;
      $idNivelAcesso = $rs->idNivelAcesso;
      $nivelAcesso = $rs->nivelAcesso;
      $nomeEspecialidade = $rs->nomeEspecialidade;
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
      <h3 id="tipo_cadastro">
        Alterar Profissional
      </h3>
    </div>
    <div class="row">
      <div class="col-md-12" id="formulario_cadastro">

        <form class="form-horizontal" method="POST" action="../processa/proc_cadastros.php" id="form_profissional">
          <input type="hidden" name="op" value="2">
          <input type="hidden" name="idUsuario" value="<?php echo ($idUsuario) ?>">
          <div class="form_section pa1">
            <div class="row mb1">
              <div class="col-sm-12 col-md-6">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" name="nome" value="<?php echo ($nome) ?>" require>
              </div>

              <div class="col-sm-12 col-md-6">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" name="email" value="<?php echo ($email) ?>" require>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-sm-12 col-md-6">
                  <label for="usuario">Usuário</label>
                  <input type="text" class="form-control" name="usuario" value="<?php echo ($usuario) ?>" require>
                </div>

                <div class="col-sm-12 col-md-6">
                  <label for="senha">Senha</label>
                  <input type="password" class="form-control" name="senha" placeholder="Senha" require>
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
                <div class="form-group">
                  <label for="nivelAcesso">Nivel de Acesso:</label>
                  <?php
                  $sql = "SELECT * from nivelacesso order by nivelAcesso asc";
                  $stm = $conexao->prepare($sql);
                  $stm->execute();
                  $nivelAcessos = $stm->fetchAll(PDO::FETCH_OBJ);
                  ?>
                  <select class="form-control" name="nivelAcesso" id="nivelAcesso" required>
                    <?php 
                    if (isset($nivelAcesso) && $nivelAcesso != null || $nivelAcesso != ""){?> <option value="<?=$idNivelAcesso?>"><?=$nivelAcesso?></option> <?php
                  }else{
                    ?><option value="">Especialidade:</option><?php
                  }
                  ?>
                  <?php foreach($nivelAcessos as $nivelAcesso):?>
                    <option value=<?=$nivelAcesso->idNivelAcesso?>><?=$nivelAcesso->nivelAcesso?></option>
                  <?php endforeach;?>
                </select>
                <span class='msg-erro msg-status'></span>
              </div>
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