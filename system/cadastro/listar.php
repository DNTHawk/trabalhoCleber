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
  <title>Listar</title>
  <?php
  include("../components/bibliotecas.php");
  ?>
  <script language="Javascript">
    function confirmacaoDeleteEsp(id) {
        var resposta = confirm("Deseja remover esse registro?");
    
        if (resposta == true) {
              window.location.href = "../processa/excluirEspecialidade.php?espc_id="+id;
        }
    }
    function confirmacaoDeleteCM(id) {
        var resposta = confirm("Deseja remover esse registro?");
    
        if (resposta == true) {
              window.location.href = "../processa/excluirCentroMedico.php?cm_id="+id;
        }
    }
    </script>
</head>

<body>
  <?php
  include("../components/toolbar.php");
  ?>
  <div class="container" style="margin-top: 60px">
    <div>
      <h3 id="mgt" class="text-center">Selecione o tipo de lista</h3><br/>
      <div class="centered">
        <button class="ms1 btn btn-primary" onclick="seleciona_form('profissionais')">Profissionais</button>
        <button class="ms1 btn btn-success" onclick="seleciona_form('centro_medico')">Centros Médicos</button>
        <button class="ms1 btn btn-warning" onclick="seleciona_form('especialidade')">Especialidades</button>
      </div>
    </div>

    <div class="text-center ma1">
      <h3 id="tipo_lista"></h3>
    </div>

    <div class="centered mt2" id="profissionais">
      <table class="table table-bordered">
        <tr>
          <th>Nome</th>
          <th>Especialidade</th>
          <th>Email</th>
          <th>Usuário</th>
          <th>Ações</th>
        </tr>
        <?php 
        try{
          $stmt = $conexao->prepare("SELECT * FROM usuario, especialidade WHERE usuario.especialidade = especialidade.idEspecialidade");
          if ($stmt->execute()) {
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
              echo "<tr>";
              echo "<td>".$rs->nome
              ."</td><td>".$rs->nomeEspecialidade
              ."</td><td>".$rs->email
              ."</td><td>".$rs->usuario
              ."</td><td><center><button class='btn btn-warning'>Editar</button>
              <button class='btn btn-danger'>Excluir</button></center></td>";
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

    <div class="centered mt2" id="centro_medico">
      <table class="table table-bordered">
        <tr>
          <th>Nome</th>
          <th>CNPJ</th>
          <th>Nome Fantasia</th>
          <th>CEP</th>
          <th>Rua</th>
          <th>Número</th>
          <th>Bairro</th>
          <th>Cidade</th>
          <th>Ações</th>
        </tr>
        <?php 
        try{
          $stmt = $conexao->prepare("SELECT * FROM centromedico");
          if ($stmt->execute()) {
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
              echo "<tr>";
              echo "<td>".$rs->nomeCM
              ."</td><td>".$rs->cnpj
              ."</td><td>".$rs->nomeFantasia
              ."</td><td>".$rs->cep
              ."</td><td>".$rs->rua
              ."</td><td>".$rs->numero
              ."</td><td>".$rs->bairro
              ."</td><td>".$rs->cidade
              ."</td><td><center><a class='btn btn-warning' href=\"editarCentroMedico.php?cm_id=".$rs->idCM."\">Editar</a>";
              ?>
              <a href="javascript:func()" class="btn btn-danger" onclick="confirmacaoDeleteCM('<?php echo ($rs->idCM) ?>')">Excluir</a>
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

    <div class="centered mt2" id="especialidade">
    <div class="card pa1">
              <div class="row">
      <?php 
      try{
        $stmt = $conexao->prepare("SELECT * FROM especialidade");
        if ($stmt->execute()) {
          while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
            ?>
             
                <div class="card-text col-md-9">
                  <h5><?php echo ($rs->nomeEspecialidade) ?></h5>
                  <p>
                    <?php echo ($rs->descricao) ?>
                  </p>
                </div>
                <div class="card-image col-md-3">
                  <?php echo "<img style='width: 100%' src='$rs->linkImagem'/>"; ?>
                  <div class="mt1 centered">
                    <tr>
                      <td>
                        <?php echo "<a class='btn btn-warning'  href=\"editarEspecialidade.php?espc_id=".$rs->idEspecialidade."\">Editar</a>";?>
                        <a href="javascript:func()" class="btn btn-danger" onclick="confirmacaoDeleteEsp('<?php echo ($rs->idEspecialidade) ?>')">Excluir</a>
                      </td>
                    </tr>
                  </div>
                </div>
              <hr>
            <?php
          }
        } else {
          echo "Erro: Não foi possível recuperar os dados do banco de dados";
        }
      }catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
      }
      ?>
      </div>
            </div>
    </div>
  </div>

  <script src="../js/seleciona_lista.js"></script>
  <script src="../../lib/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</body>

</html>