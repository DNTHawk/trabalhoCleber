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
            <h4 class="text-center mb1">Informações básicas</h4>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-10 col-md-12">
                  <label for="inputEmail3">Nome</label>
                  <input type="text" class="form-control" name="nome" placeholder="Nome Completo">
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-sm-10 col-md-6">
                  <label for="inputEmail3">CNPJ</label>
                  <input type="email" class="form-control" name="cpnj1" placeholder="CNPJ">
                </div>

                <div class="col-sm-10 col-md-6">
                  <label for="inputEmail3">Nome Fantasia</label>
                  <input type="text" class="form-control" name="nome_fantasia" placeholder="Nome Fantasia">
                </div>
              </div>
            </div>

          </div>
          <div class="form_section">
            <h4 class="text-center ma1">Endereço</h4>
            <div class="form-group">
              <div class="row">
                <label for="inputPassword3" class="col-sm-2 col-md-2 control-label">CEP</label>
                <div class="mb1 col-sm-10 col-md-12">
                  <input type="text" class="form-control" name="cep" placeholder="CEP">
                </div>
              </div>
              <div class="row">
                <div class="mb1 col-sm-10 col-md-6">
                  <label for="inputPassword3">Rua</label>
                  <input type="password" class="form-control" name="senha" placeholder="Rua">
                </div>
                <div class="mb1 col-sm-10 col-md-6">
                  <label for="inputPassword3">Número</label>
                  <input type="password" class="form-control" name="senha" placeholder="Número">
                </div>
              </div>
              <div class="row">
                <div class="mb1 col-sm-10 col-md-6">
                  <label for="inputPassword3" class="col-sm-2 control-label">Bairro</label>
                  <input type="password" class="form-control" name="senha" placeholder="Bairro">
                </div>
                <div class="mb1 col-sm-10 col-md-6">
                  <label for="inputPassword3" class="col-sm-1 control-label">Cidade</label>
                  <input type="password" class="form-control" name="senha" placeholder="Cidade">
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


        <form class="form-horizontal" method="POST" action="processa/proc_cad_usuario.php" id="form_profissional">
          <div class="form_section pa1">
            <div class="row mb1">
              <div class="col-sm-12 col-md-6">
                <label for="inputEmail3">Nome</label>
                <input type="text" class="form-control" name="nome" placeholder="Nome Completo">
              </div>

              <div class="col-sm-12 col-md-6">
                <label for="inputEmail3">E-mail</label>
                <input type="email" class="form-control" name="email" placeholder="E-mail">
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-sm-12 col-md-6">
                  <label for="inputEmail3">Usuário</label>
                  <input type="text" class="form-control" name="usuario" placeholder="Usuário">
                </div>

                <div class="col-sm-12 col-md-6">
                  <label for="inputPassword3">Senha</label>
                  <input type="password" class="form-control" name="senha" placeholder="Senha">
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-sm-12 col-md-12">
                  <label for="inputPassword3">Nivel de Acesso</label>
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

        <form class="form-horizontal" method="POST" action="processa/proc_cad_usuario.php" id="form_especialidades">
          <div class="form_section pa1">
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Especialidade</label>
              <div class="col-sm-12">
                <input type="text" class="form-control" name="especialidade" placeholder="Especialidade">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12 to-right">
                <button type="submit" class="btn btn-success">Cadastrar</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="../js/form_cadastro.js"></script>
</body>

</html>