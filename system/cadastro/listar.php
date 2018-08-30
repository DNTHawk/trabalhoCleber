<?php 

include("../processa/proc_listar.php");
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
  <div class="container" style="margin-top: 60px">
    <div>
      <h3 class="text-center">Selecione o tipo de lista</h3><br/>
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
          <th>Ações</th>
        </tr>
        <tr>
          <td>João pé de mesa</td>
          <td>
            <button class="btn btn-warning">Editar</button>
            <button class="btn btn-danger">Excluir</button>
          </td>
        </tr>
        <tr>
          <td>Maria</td>
          <td>
            <button class="btn btn-warning">Editar</button>
            <button class="btn btn-danger">Excluir</button>
          </td>
        </tr>
      </table>
    </div>

    <div class="centered mt2" id="especialidade">
      <div class="card pa1">
        <div class="row">
          <div class="card-text col-md-9">
            <h5>Nome da especialidade</h5>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis cum non enim, doloremque obcaecati labore
              a voluptatem, cumque similique quam, quibusdam repudiandae natus ratione quia quasi tempore ipsam laboriosam
              maxime.
            </p>
          </div>
          <div class="card-image col-md-3">
            <img src="http://www.cesed.br/portal/wp-content/uploads/2014/08/Neurologia-600x320.jpg" alt="imagem" style="width: 100%">
            <div class="mt1 centered">
              <tr>
                <td>
                  <button class="btn btn-warning" style="margin-right: 10px">Editar</button>
                  <button class="btn btn-danger">Excluir</button>
                </td>
              </tr>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="../js/seleciona_lista.js"></script>
  <script src="../../lib/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</body>

</html>