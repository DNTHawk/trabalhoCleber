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
        <form class="form-horizontal" method="POST" action="../processa/proc_cad_usuario.php" id="form_centro_medico">
          <div class="form_section">
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Nome</label>
              <div class="col-sm-10 col-md-12">
                <input type="text" class="form-control" name="nome" placeholder="Nome Completo">
              </div>
            </div>

            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">CNPJ</label>
              <div class="col-sm-10 col-md-12">
                <input type="email" class="form-control" name="email" placeholder="CNPJ">
              </div>
            </div>

            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Nome Fantasia</label>
              <div class="col-sm-10 col-md-12">
                <input type="text" class="form-control" name="usuario" placeholder="Nome Fantasia">
              </div>
            </div>
          </div>
          <div class="form_section">
            <h4 class="text-center ma1">Endereço</h4>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 col-md-2 control-label">CEP</label>
              <div class="mb1 col-sm-10 col-md-12">
                <input type="password" class="form-control" name="senha" placeholder="CEP">
              </div>
              <label for="inputPassword3" class="col-sm-2 control-label">Rua</label>
              <div class="mb1 col-sm-10 col-md-12">
                <input type="password" class="form-control" name="senha" placeholder="Rua">
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">Número</label>
              <div class="mb1 col-sm-10 col-md-12">
                <input type="password" class="form-control" name="senha" placeholder="Número">
              </div>
              <label for="inputPassword3" class="col-sm-2 control-label">Bairro</label>
              <div class="mb1 col-sm-10 col-md-12">
                <input type="password" class="form-control" name="senha" placeholder="Bairro">
              </div>
              <label for="inputPassword3" class="col-sm-1 control-label">Cidade</label>
              <div class="mb1 col-sm-10 col-md-12">
                <input type="password" class="form-control" name="senha" placeholder="Cidade">
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-12 to-right">
              <button type="submit" class="btn btn-success">Cadastrar</button>
            </div>
          </div>
        </form>


        <form class="form-horizontal" method="POST" action="processa/proc_cad_usuario.php" id="form_profissional">
          <div class="form_section pa1">
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Nome</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nome" placeholder="Nome Completo">
              </div>
            </div>

            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">E-mail</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" name="email" placeholder="E-mail">
              </div>
            </div>

            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Usuário</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="usuario" placeholder="Usuário">
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Senha</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" name="senha" placeholder="Senha">
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Nivel de Acesso</label>
              <div class="col-sm-10">
                <select class="form-control" name="nivel_de_acesso">
                  <option value="1">Administrativo</option>
                  <option value="2">Usuário</option>
                </select>
              </div>
            </div>

          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10 to-right">
              <button type="submit" class="btn btn-success">Cadastrar</button>
            </div>
          </div>
        </form>

        <form class="form-horizontal" method="POST" action="processa/proc_cad_usuario.php" id="form_especialidades">
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Nome</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="nome" placeholder="Nome Completo">
            </div>
          </div>

          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">E-mail</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" name="email" placeholder="E-mail">
            </div>
          </div>

          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Usuário</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="usuario" placeholder="Usuário">
            </div>
          </div>

          <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Senha</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" name="senha" placeholder="Senha">
            </div>
          </div>

          <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Nivel de Acesso</label>
            <div class="col-sm-10">
              <select class="form-control" name="nivel_de_acesso">
                <option value="1">Administrativo</option>
                <option value="2">Usuário</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-success">Cadastrar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="../js/form_cadastro.js"></script>
</body>

</html>