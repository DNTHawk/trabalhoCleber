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
    <h3 class="text-center">Selecione o tipo de cadastro</h3><br/>
    <div class="row centered" style="margin-top: 60px">
      <div class="col-sm-10 col-md-10">
        <div class="form-group">
          <label for="nivelAcesso">Nivel de acesso</label>
          <input type="text" class="form-control" name="nivelAcesso" placeholder="Nível de Acesso do usuário" required>
        </div>
        <div class="col-sm-12 to-right">
          <button type="submit" class="btn btn-success">Cadastrar</button>
        </div>
      </div>
    </div>

    <div class="centered mt2">
      <table class="table table-bordered">
        <tr>
          <th>Nível Acesso</th>
          <th>Ações</th>
        </tr>
        <tr>
          <td>Administrador</td>
          <td>
            <button class="btn btn-warning">Editar</button>
            <button class="btn btn-danger">Excluir</button>
          </td>
        </tr>
        <tr>
          <td>Usuário</td>
          <td>
            <button class="btn btn-warning">Editar</button>
            <button class="btn btn-danger">Excluir</button>
          </td>
        </tr>
      </table>
    </div>

  </div>

  <script src="../js/form_cadastro.js"></script>
  <script src="../../lib/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</body>

</html>