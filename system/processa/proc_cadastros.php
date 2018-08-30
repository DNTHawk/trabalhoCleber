<?php

require 'conexao.php';

$op = $_POST["op"];

try {
  $conexao = db_connect();
  $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conexao->exec("set names utf8");
} catch (PDOException $erro) {
  echo "Erro na conexão:" . $erro->getMessage();
}

function pegaDadosImagem(){

  global $foto;

  if (!empty($foto["name"])) {

    // Largura máxima em pixels
    $largura = 3150;
    // Altura máxima em pixels
    $altura = 3180;
    // Tamanho máximo do arquivo em bytes
    $tamanho = 1000000000000;

    $error = array();

      // Verifica se o arquivo é uma imagem
    if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $foto["type"])){
      $error[1] = "Isso não é uma imagem.";
    } 

    // Verifica se o tamanho da imagem é maior que o tamanho permitido
    if($foto["size"] > $tamanho) {
      $error[4] = "A imagem deve ter no máximo ".$tamanho." bytes";
    }

    // Se não houver nenhum erro
    try {
      if (count($error) == 0) {

        preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);

          // Gera um nome único para a imagem
        $nome_imagem = md5(uniqid(time())) . "." . $ext[1];

      return $nome_imagem;        

      }
    }catch (PDOException $erro) {
      echo "Erro: ".$erro->getMessage();
    }


  }
}

function cadCentroMedico()
{

  global $nome, $cnpj, $nome_fantasia, $cep, $rua, $numero, $bairro, $cidade, $conexao;

  $stmt = $conexao->prepare(" INSERT INTO centromedico (nomeCM, cnpj, nomeFantasia, cep, rua, numero, bairro, cidade) 
    VALUES ('$nome', '$cnpj', '$nome_fantasia', '$cep', '$rua', '$numero', '$bairro', '$cidade')");

  if ($stmt->execute()) {
    if ($stmt->rowCount() > 0) {
      echo "<script language='javascript' type='text/javascript'>alert('Dados cadastrados com sucesso!');window.location.href='../cadastro/cadastros.php';</script>";
    } else {
      echo "<script>alert('Erro ao efetivar o cadastro!')</script>";
    }
  } else {
    throw new PDOException("Erro: Não foi possível executar a declaração sql");
  }

}

function cadProfissional()
{
  global $nome, $email, $usuario, $senha, $nivel_de_acesso, $conexao, $especialidade;

  $passwordHash = make_hash($senha);

  $stmt = $conexao->prepare(" INSERT INTO usuario (nome, especialidade, email, usuario, password, nivelacesso) 
    VALUES ('$nome', '$especialidade' , '$email', '$usuario', '$passwordHash', '$nivel_de_acesso')");

  if ($stmt->execute()) {
    if ($stmt->rowCount() > 0) {
      echo "<script language='javascript' type='text/javascript'>alert('Dados cadastrados com sucesso!');window.location.href='../cadastro/cadastros.php';</script>";
    } else {
      echo "<script>alert('Erro ao efetivar o cadastro!')</script>";
    }
  } else {
    throw new PDOException("Erro: Não foi possível executar a declaração sql");
  }

}

function cadEspecialidade()
{
  global $conexao, $especialidade, $descricao, $idEspecialidade, $foto;

  $nome_imagem = pegaDadosImagem();

  $caminho_imagem = "../processa/fotos/".$nome_imagem;

  move_uploaded_file($foto["tmp_name"], $caminho_imagem);

  try {
    if ($idEspecialidade != "") {

      $stmt = $conexao->prepare("UPDATE especialidade  SET nomeEspecialidade=?, descricao=?, linkImagem=? WHERE idEspecialidade = ?");
      $stmt->bindParam(4, $idEspecialidade);


      $stmt->bindParam(1, $especialidade);
      $stmt->bindParam(2, $descricao);
      $stmt->bindParam(3, $caminho_imagem);

      if ($stmt->execute()) {
        if ($stmt->rowCount() > 0) {
          echo"<script language='javascript' type='text/javascript'>alert('Dados cadastrado com sucesso!');window.location.href='../cadastro/listar.php';</script>";
          $idEspecialidade = null;
          $especialidade = null;
          $descricao = null;
          $caminho_imagem = null;

        } else {
          echo "Erro ao tentar efetivar cadastro";
        }
      } else {
        throw new PDOException("Erro: Não foi possível executar a declaração sql");
      }
    } else {

      $stmt = $conexao->prepare(" INSERT INTO especialidade (nomeEspecialidade, descricao, linkImagem) VALUES ('$especialidade','$descricao','$caminho_imagem')");

      if ($stmt->execute()){
        if ($stmt->rowCount() > 0) {
          echo "<script language='javascript' type='text/javascript'>alert('Dados cadastrados com sucesso!');window.location.href='../cadastro/cadastros.php';</script>";
        } else {
          echo "<script>alert('Erro ao efetivar o cadastro!')</script>";
        }
      } else {
        throw new PDOException("Erro: Não foi possível executar a declaração sql");
      }
    }
    


  } catch (PDOException $erro) {
    echo "Erro: ".$erro->getMessage();
  }

}

function cadNivelAcesso()
{
  global $conexao, $nivelAcesso;

  $stmt = $conexao->prepare(" INSERT INTO nivelacesso (nivelAcesso) VALUES ('$nivelAcesso')");

  if ($stmt->execute()) {
    if ($stmt->rowCount() > 0) {
      echo "<script language='javascript' type='text/javascript'>alert('Dados cadastrados com sucesso!');window.location.href='../cadastro/nivel_acesso.php';</script>";
    } else {
      echo "<script>alert('Erro ao efetivar o cadastro!')</script>";
    }
  } else {
    throw new PDOException("Erro: Não foi possível executar a declaração sql");
  }

}
switch ($op) {
  case '1': //Cadastro Centro Medico
  $nome = $_POST["nome"];
  $cnpj = $_POST["cnpj"];
  $nome_fantasia = $_POST["nome_fantasia"];
  $cep = $_POST["cep"];
  $rua = $_POST["rua"];
  $numero = $_POST["numero"];
  $bairro = $_POST["bairro"];
  $cidade = $_POST["cidade"];

  cadCentroMedico();
  break;
  case '2'://Cadastro Profissional
  $nome = $_POST["nome"];
  $especialidade = $_POST["especialidade"];
  $email = $_POST["email"];
  $usuario = $_POST["usuario"];
  $senha = $_POST["senha"];
  $nivel_de_acesso = $_POST["nivel_de_acesso"];

  cadProfissional();
  break;

  case '3':
  $idEspecialidade = $_POST["idEspecialidade"];
  $especialidade = $_POST["especialidade"];
  $descricao = $_POST["descricao"];
  $foto = $_FILES["foto"];
  pegaDadosImagem();
  cadEspecialidade();
  break;

  case '4':
  $nivelAcesso = $_POST["nivelAcesso"];
  cadNivelAcesso();
  break;

  default:
        # code...
  break;
}

?>