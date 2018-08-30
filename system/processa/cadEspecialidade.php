<?php 
session_start();

require '../processa/conexao.php';

$localFoto = '';

try {
  $conexao = db_connect();
  $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conexao->exec("set names utf8");
} catch (PDOException $erro) {
  echo "Erro na conexão:".$erro->getMessage();
}
  // Recupera os dados dos campos
$foto = $_FILES["foto"];

  // Se a foto estiver sido selecionada
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

    // Pega as dimensões da imagem
  $dimensoes = getimagesize($foto["tmp_name"]);

    // Verifica se a largura da imagem é maior que a largura permitida
  if($dimensoes[0] > $largura) {
    $error[2] = "A largura da imagem não deve ultrapassar ".$largura." pixels";
  }

    // Verifica se a altura da imagem é maior que a altura permitida
  if($dimensoes[1] > $altura) {
    $error[3] = "Altura da imagem não deve ultrapassar ".$altura." pixels";
  }

    // Verifica se o tamanho da imagem é maior que o tamanho permitido
  if($foto["size"] > $tamanho) {
    $error[4] = "A imagem deve ter no máximo ".$tamanho." bytes";
  }

    // Se não houver nenhum erro
  try {
    if (count($error) == 0) {

      // Pega extensão da imagem
      preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);

          // Gera um nome único para a imagem
      $nome_imagem = md5(uniqid(time())) . "." . $ext[1];

          // Caminho de onde ficará a imagem
      $caminho_imagem = "fotos/".$nome_imagem;

      // Faz o upload da imagem para seu respectivo caminho
      move_uploaded_file($foto["tmp_name"], $caminho_imagem);

      // Insere os dados no banco

      try {
        if (count($error) == 0) {


          preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);

          // Gera um nome único para a imagem
          $nome_imagem = md5(uniqid(time())) . "." . $ext[1];

          // Caminho de onde ficará a imagem
          $caminho_imagem = "fotos/".$nome_imagem;

          move_uploaded_file($foto["tmp_name"], $caminho_imagem);

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
      }catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
      }
    }
  } catch (PDOException $erro) {
    echo "Erro: ".$erro->getMessage();
  }
}
?>