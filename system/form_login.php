<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
    <script src="js/main.js"></script>
    <link rel="stylesheet" href="../lib/node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="bg1"></div>
    <div class="bg2"></div> 
    <div id="logoHospital">
        <p>H</p>
    </div>  
    <div class="container-fluid">
        <div id="form_login" class="row">
            <div id="box" class="col-md-4 offset-md-4">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Login</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form action="login.php">
                            <div class="form-group">
                                <label for="matricula">Matricula:</label>
                                <input type="text" name="matricula" class="form-control" require>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form action="login.php">
                            <div class="form-group">
                                <label for="password">Senha:</label>
                                <input type="password" name="password" class="form-control" require>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <button class="btn btn-primary btn-block" type="submit">Entrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>