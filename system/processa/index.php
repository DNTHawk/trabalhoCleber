<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <form action="cad_usuario.php" method="post">
        <label for="nome">Nome</label>
        <input type="text" name="nome" require>
        </br>
        </br>
        <label for="matricula">Matricula</label>
        <input type="text" name="matricula" require>
        </br>
        </br>
        <label for="password">Senha</label>
        <input type="text" name="password" require>
        </br>
        </br>
        <input type="hidden" name="op" value="1">
        <button class="btn btn-primary btn-block" type="submit">Entrar</button>
    </form>
</body>
</html>