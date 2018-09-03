<?php

require_once 'conexao.php';

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

function cadAnuncio()
{
  global $conexao, $foto, $idAnuncio;

  $nome_imagem = pegaDadosImagem();

  $caminho_imagem = "../processa/fotos/".$nome_imagem;

  move_uploaded_file($foto["tmp_name"], $caminho_imagem);

  try {
    if ($idAnuncio != "") {

      $stmt = $conexao->prepare("UPDATE especialidade  SET nomeEspecialidade=?, descricao=?, linkImagem=? WHERE idAnuncio = ?");
      $stmt->bindParam(2, $idAnuncio);

      $stmt->bindParam(1, $caminho_imagem);

      if ($stmt->execute()) {
        if ($stmt->rowCount() > 0) {
          echo"<script language='javascript' type='text/javascript'>alert('Dados cadastrado com sucesso!');window.location.href='../cadastro/listar.php';</script>";
          $idAnuncio = null;
          $caminho_imagem = null;

        } else {
          echo "Erro ao tentar efetivar cadastro";
        }
      } else {
        throw new PDOException("Erro: Não foi possível executar a declaração sql");
      }
    } else {

      $stmt = $conexao->prepare(" INSERT INTO anuncio (linkAnuncio) VALUES ('$caminho_imagem')");

      if ($stmt->execute()){
        if ($stmt->rowCount() > 0) {
          echo "<script language='javascript' type='text/javascript'>alert('Dados cadastrados com sucesso!');window.location.href='../cadastro/cadastro_anuncio.php';</script>";
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


switch ($op) {
  case '1': //Cadastro Centro Medico
  $idAnuncio = $_POST["idAnuncio"];
  $foto = $_FILES["foto"];
  pegaDadosImagem();
  
  cadAnuncio();
  break;

  default:
        # code...
  break;
}

?>