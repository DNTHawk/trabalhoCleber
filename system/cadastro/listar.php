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
        <button class="ms1 btn btn-primary" onclick="seleciona_form('usuarios')">Usuários</button>
        <button class="ms1 btn btn-success" onclick="seleciona_form('centro_medico')">Centros Médicos</button>
        <button class="ms1 btn btn-warning" onclick="seleciona_form('imagens')">Imagens</button>
      </div>
    </div>

    <div class="text-center ma1">
      <h3 id="tipo_lista"></h3>
    </div>

    <div class="centered mt2" id="usuarios">
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

    <div class="centered mt2" id="imagens">
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
  </div>

  <script src="../js/seleciona_lista.js"></script>
  <script src="../../lib/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</body>

</html>