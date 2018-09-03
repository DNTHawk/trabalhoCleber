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
    <h3 class="centered mb1">Cadastro de anúncio</h3>
    <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="../processa/proc_anuncio.php" id="form_especialidades">
      <input type="hidden" name="op" value="1">
      <input type="hidden" name="idAnuncio" value="">
      <div class="form_section pa1">
        <div class="form-group">
          <label for='selecao-arquivo' class="centered">Selecionar um arquivo</label>
          <div class="row">
            <div class="col-md-12">
              <input id='selecao-arquivo' type="file" name="foto" require>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="col-md-4 offset-4">
                <div id="image-holder"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 to-right">
          <button id="btnCadEsp" type="submit" class="btn btn-success">Salvar</button>
        </div>
      </div>

    </form>
  </div>

  <script src="../../lib/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="../js/form_cadastro.js"></script>

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
      } else {
        alert("Este navegador nao suporta FileReader.");
      }
    });
  </script>

</body>

</html>