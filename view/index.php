<?php 

include("../system/processa/conexao.php");

try {
  $conexao = db_connect();
  $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conexao->exec("set names utf8");
} catch (PDOException $erro) {
  echo "Erro na conexão:" . $erro->getMessage();
}

?>


<!DOCTYPE html>
<html>
<head>
  <title>Hospital Albert Einstein</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Hospital Albert Einstein</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/business-frontpage.css" rel="stylesheet">
  <link href="css/carousel.css" rel="stylesheet">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="vendor/jquery/jquery.min.js"></script>

  <style>
  /* Make the image fully responsive */
  .carousel-inner {
    background-color: #cdcdcd;
  }
  .carousel-inner img {
    width: 80%;
    height: 400px;
    margin-left: 10%;
  }
  .carousel-control-next, .carousel-control-prev{
    height: 100%;
    margin-top: 40px;
  }
  .carousel-indicators{
    bottom: -90px;
  }
  .navbar-green .navbar-brand {
    color: #fff;
  }

  .navbar-green .navbar-brand:hover, .navbar-green .navbar-brand:focus {
    color: #fff;
  }

  .navbar-green .navbar-nav .nav-link {
    color: rgba(255, 255, 255, 0.5);
  }

  .navbar-green .navbar-nav .nav-link:hover, .navbar-green .navbar-nav .nav-link:focus {
    color: rgba(255, 255, 255, 0.75);
  }

  .navbar-green .navbar-nav .nav-link.disabled {
    color: rgba(255, 255, 255, 0.25);
  }

  .navbar-green .navbar-nav .show > .nav-link,
  .navbar-green .navbar-nav .active > .nav-link,
  .navbar-green .navbar-nav .nav-link.show,
  .navbar-green .navbar-nav .nav-link.active {
    color: #fff;
  }

  .navbar-green .navbar-toggler {
    color: rgba(255, 255, 255, 0.5);
    border-color: rgba(255, 255, 255, 0.1);
  }

  .navbar-green .navbar-toggler-icon {
    background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(255, 255, 255, 0.5)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
  }

  .navbar-green .navbar-text {
    color: rgba(255, 255, 255, 0.5);
  }

  .navbar-green .navbar-text a {
    color: #fff !important;
  }
  .nav-link{
    color: #FFF;
  }

  .navbar-green .navbar-text a:hover, .navbar-green .navbar-text a:focus {
    color: #fff;
  }

  .bg-green {
    background-color: #28a745 !important;
  }

  a.bg-green:hover, a.bg-green:focus,
  button.bg-green:hover,
  button.bg-green:focus {
    background-color: #28a745 !important;
  }

  #sobre{
    position: relative;
    top: 40px;
  }
  .border-primary {
    border-color: #28a745!important;
  }

  footer{
    margin-top: 60px;
    margin-bottom: -40px;
  }
</style>
</head>
<body>
  <nav class="navbar navbar-expand-lg .navbar-green bg-green fixed-top">
    <div class="container">
      <a style="color: #FFF" class="navbar-brand" href="index.php"><span>Hospital Albert Einstein</span></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#home">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#sobre">Sobre</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Especialidades
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <?php 
              try{
                $stmt = $conexao->prepare("SELECT * FROM especialidade");
                if ($stmt->execute()) {
                  while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                    echo "<a class='dropdown-item' href=\"especialidades.php?espec_id=".$rs->idEspecialidade."\">".$rs->nomeEspecialidade."</a>";
                  }
                } else {
                  echo "Erro: Não foi possível recuperar os dados do banco de dados";
                }
              }catch (PDOException $erro) {
                echo "Erro: ".$erro->getMessage();
              }
              
              ?>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#contato">Contato</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../system/form_login.php">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div id="demo" class="carousel slide" data-ride="carousel">

    <!-- Indicators -->
    <ul class="carousel-indicators">
      <li data-target="#demo" data-slide-to="0" class="active"></li>
      <li data-target="#demo" data-slide-to="1"></li>
      <li data-target="#demo" data-slide-to="2"></li>
    </ul>
    
    <!-- The slideshow -->
    <div class="carousel-inner" id="home">
      <?php 
        try{
        $stmt = $conexao->prepare("SELECT * FROM anuncio LIMIT 1");
        if ($stmt->execute()) {
          while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
            ?>
              <div class="carousel-item active">
                <?php echo "<img width='1100' height='500' src='../system/cadastro/$rs->linkAnuncio'/>"; ?>
              </div>
            <?php
          }
        } else {
          echo "Erro: Não foi possível recuperar os dados do banco de dados";
        }
      }catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
      }
      ?>
      <?php 
        try{
        $stmt = $conexao->prepare("SELECT * FROM anuncio LIMIT 1, 3");
        if ($stmt->execute()) {
          while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
            ?>
              <div class="carousel-item">
                <?php echo "<img width='1100' height='500' src='../system/cadastro/$rs->linkAnuncio'/>"; ?>
              </div>
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
    
    <!-- Left and right controls -->
    <a class="carousel-control-prev" href="#demo" data-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#demo" data-slide="next">
      <span class="carousel-control-next-icon"></span>
    </a>
  </div>
<span id="sobre"><br></br></span>
  <div  class="container">
    <div class="row">
      <div class="col-sm-8">
        <h2 class="mt-4">Hospital Albert Einstein</h2>
        <p>A Sociedade Beneficente Israelita Brasileira Albert Einstein chega aos 60 anos, em 2015, fazendo uma das coisas que mais
          gosta: inovar e crescer, sempre com excelência. E olha que tudo começou pequeno, numa reunião de amigos, em 1955, em que
          o dr. Manoel Tabacow Hidal apresentou sua ideia de fazer um hospital. O sonho virou compromisso da comunidade judaica: oferecer
        à população do Brasil uma referência em qualidade da prática médica.</br></p>
        <p id="esp">A Sociedade Beneficente Israelita Brasileira Albert Einstein chega aos 60 anos, em 2015, fazendo uma das coisas que mais
        gosta: inovar e crescer, sempre com excelência.</br></p>
      </div>
    </div> 
    <center id="text-esp">Especialidades</center>
    <div class="row">
      <?php 
      try{
        $stmt = $conexao->prepare("SELECT * FROM especialidade LIMIT 3");
        if ($stmt->execute()) {
          while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
            ?>
            <div class="col-sm-4 my-4">
              <div class="card">
                <?php echo "<img class='card-img-top' src='../system/cadastro/$rs->linkImagem'/>"; ?>
                <div class="card-body">
                  <h4 class="card-title"><?php echo ($rs->nomeEspecialidade) ?></h4>
                  <p class="card-text"><?php echo ($rs->descricao) ?></p>
                </div>
                <div class="card-footer">
                  <?php
                  echo "<a class='btn btn-success' href=\"especialidades.php?espec_id=".$rs->idEspecialidade."\">Descubra mais!</a>";
                  ?>
                </div>
              </div>
            </div>
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
    <div class="row justify-content-center" id="contato"> 
      <div class="col-12 col-md-8 col-lg-6 pb-5">
        <h2 class="card-title">Entre em contato conosco</h2>
        <div class="card border-primary rounded-0">
          <div class="card-body p-3">
            <form action="../system/processa/enviaEmail.php" method="POST">
              <div class="form-group">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-user text-info"></i></div>
                  </div>
                  <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required="">
                </div>
              </div>
              <div class="form-group">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-envelope text-info"></i></div>
                  </div>
                  <input type="email" class="form-control" id="email" name="email" placeholder="exemplo@gmail.com" required="">
                </div>
              </div>
              <div class="form-group">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-comment text-info"></i></div>
                  </div>
                  <textarea class="form-control" name="mensagem" placeholder="Mensagem" required=""></textarea>
                </div>
              </div>
              <div class="text-center">
                <input type="submit" value="Enviar" class="btn btn-info btn-block rounded-0 py-2">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Instituto Albert Einstein 2018</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  </div>


</body>
</html>