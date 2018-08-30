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
<html lang="en">

  <head>

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

    <style>
    footer{
      margin-top: 20px;
    }
    html, body, header{
      width: 100%;
      height: 100%;
    }
    .carousel-inner img {
      width: 100%;
      height: 100%;
  }
    </style>

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="index.html"><img src="img/logo-hospital-albert-einstein.png"height="30%" width="20%" ></img></a>
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
              <a class="nav-link" href="#sobre">Sobre
              
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#esp">Especialidades</a>
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

    <!-- Header with Background Image -->
    <header>
      <div id="demo" class="carousel slide" data-ride="carousel">

  <!-- Indicators -->
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>
  
  <!-- The slideshow -->
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="la.jpg" alt="Los Angeles" width="1100" height="500">
    </div>
    <div class="carousel-item">
      <img src="chicago.jpg" alt="Chicago" width="1100" height="500">
    </div>
    <div class="carousel-item">
      <img src="ny.jpg" alt="New York" width="1100" height="500">
    </div>
  </div>
  
  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>
    </header>

    <!-- Page Content -->
    
    <div id="sobre" class="container">

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
      <!-- /.row -->
      <section>
        <div class="row">
          <?php 
          try{
            $stmt = $conexao->prepare("SELECT * FROM especialidade");
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
                      <a href="esp" class="btn btn-primary">Descubra mais!</a>
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
      </section>
      <div class="row justify-content-center" id="contato"> 
        
        <div class="col-12 col-md-8 col-lg-6 pb-5">
                          <!--Form with header-->
                          <h2 class="card-title">Entre em contato conosco</h2>
                            <div class="card border-primary rounded-0">
                               
                                <div class="card-body p-3">
    
                                    <!--Body-->
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
    
                            </div>
                                             
                    </div>
    </div>
    <!-- /.container -->

    
    
    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Instituto Albert Einstein 2018</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
