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

  global $nome, $cnpj, $nome_fantasia, $cep, $rua, $numero, $bairro, $cidade, $conexao, $idCM;

  try {
    if ($idCM != "") {

      $stmt = $conexao->prepare("UPDATE centromedico  SET nomeCM=?, cnpj=?, nomeFantasia=?, cep=?, rua=?, numero=?, bairro=?, cidade=? WHERE idCM = ?");
      $stmt->bindParam(9, $idCM);


      $stmt->bindParam(1, $nome);
      $stmt->bindParam(2, $cnpj);
      $stmt->bindParam(3, $nome_fantasia);
      $stmt->bindParam(4, $cep);
      $stmt->bindParam(5, $rua);
      $stmt->bindParam(6, $numero);
      $stmt->bindParam(7, $bairro);
      $stmt->bindParam(8, $cidade);

      if ($stmt->execute()) {
        if ($stmt->rowCount() > 0) {
          echo"<script language='javascript' type='text/javascript'>alert('Dados alterados com sucesso!');window.location.href='../cadastro/listar.php';</script>";
          $idCM = null;
          $nomeCM = null;
          $cnpj = null;
          $nome_fantasia = null;
          $cep = null;
          $rua = null;
          $numero = null;
          $bairro = null;
          $cidade = null;

        } else {
          echo "Erro ao tentar efetivar cadastro";
        }
      } else {
        throw new PDOException("Erro: Não foi possível executar a declaração sql");
      }
    } else {
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

  } catch (PDOException $erro) {
    echo "Erro: ".$erro->getMessage();
  }

}

function cadProfissional()
{
  global $nome, $email, $usuario, $senha, $nivel_de_acesso, $conexao, $especialidade, $idUsuario;

  $passwordHash = make_hash($senha);

  try {
    if ($idUsuario != "") {

      $stmt = $conexao->prepare("UPDATE usuario  SET nome=?, especialidade=?, email=?, usuario=?, password=?, idNivelAcesso=? WHERE idUsuario = ?");
      $stmt->bindParam(7, $idUsuario);

      $stmt->bindParam(1, $nome);
      $stmt->bindParam(2, $especialidade);
      $stmt->bindParam(3, $email);
      $stmt->bindParam(4, $usuario);
      $stmt->bindParam(5, $passwordHash);
      $stmt->bindParam(6, $nivel_de_acesso);

      if ($stmt->execute()) {
        if ($stmt->rowCount() > 0) {
          echo"<script language='javascript' type='text/javascript'>alert('Dados alterados com sucesso!');window.location.href='../cadastro/listar.php';</script>";
          $idUsuario = null;
          $nome = null;
          $especialidade = null;
          $email = null;
          $usuario = null;
          $passwordHash = null;
          $nivel_de_acesso = null;

        } else {
          echo "Erro ao tentar efetivar cadastro";
        }
      } else {
        throw new PDOException("Erro: Não foi possível executar a declaração sql");
      }
    } else {
      
      $stmt = $conexao->prepare(" INSERT INTO usuario (nome, especialidade, email, usuario, password, idNivelAcesso) 
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

  } catch (PDOException $erro) {
    echo "Erro: ".$erro->getMessage();
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
          echo"<script language='javascript' type='text/javascript'>alert('Dados alterados com sucesso!');window.location.href='../cadastro/listar.php';</script>";
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
  global $conexao, $nivelAcesso, $idNivelAcesso;

  try {
    if ($idNivelAcesso != "") {

      $stmt = $conexao->prepare("UPDATE nivelacesso  SET nivelAcesso=? WHERE $idNivelAcesso = ?");
      $stmt->bindParam(2, $idNivelAcesso);


      $stmt->bindParam(1, $nivelAcesso);

      if ($stmt->execute()) {
        if ($stmt->rowCount() > 0) {
          echo"<script language='javascript' type='text/javascript'>alert('Dados alterados com sucesso!');window.location.href='../cadastro/listar.php';</script>";
          $idNivelAcesso = null;
          $nivelAcesso = null;

        } else {
          echo "Erro ao tentar efetivar cadastro";
        }
      } else {
        throw new PDOException("Erro: Não foi possível executar a declaração sql");
      }
    } else {
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

  } catch (PDOException $erro) {
    echo "Erro: ".$erro->getMessage();
  }

  

}

function cadPaciente()
{

  global $conexao, $nomePaciente, $emailPaciente, $contatoPaciente, $cpfPaciente, $rgPaciente, $ruaPaciente, $bairroPaciente, $cidadePaciente, $estadoPaciente, $idPaciente;

  try {
    if ($idPaciente != "") {

      $stmt = $conexao->prepare("UPDATE paciente  SET nomePaciente=?, emailPaciente=?, contatoPaciente=?, cpfPaciente=?, 
      rgPaciente=?, ruaPaciente=?, bairroPaciente=?, cidadePaciente=?, estadoPaciente=? WHERE idPaciente = ?");
      $stmt->bindParam(10, $idPaciente);


      $stmt->bindParam(1, $nomePaciente);
      $stmt->bindParam(2, $emailPaciente);
      $stmt->bindParam(3, $contatoPaciente);
      $stmt->bindParam(4, $cpfPaciente);
      $stmt->bindParam(5, $rgPaciente);
      $stmt->bindParam(6, $ruaPaciente);
      $stmt->bindParam(7, $bairroPaciente);
      $stmt->bindParam(8, $cidadePaciente);
      $stmt->bindParam(9, $estadoPaciente);

      if ($stmt->execute()) {
        if ($stmt->rowCount() > 0) {
          echo"<script language='javascript' type='text/javascript'>alert('Dados alterados com sucesso!');window.location.href='../cadastro/listar.php';</script>";
          $idPaciente = null;
          $nomePaciente = null;
          $emailPaciente = null;
          $contatoPaciente = null;
          $cpfPaciente = null;
          $rgPaciente = null;
          $ruaPaciente = null;
          $bairroPaciente = null;
          $cidadePaciente = null;
          $estadoPaciente = null;

        } else {
          echo "Erro ao tentar efetivar cadastro";
        }
      } else {
        throw new PDOException("Erro: Não foi possível executar a declaração sql");
      }
    } else {
      $stmt = $conexao->prepare(" INSERT INTO paciente (nomePaciente, emailPaciente, contatoPaciente, cpfPaciente, rgPaciente, ruaPaciente, bairroPaciente, cidadePaciente, estadoPaciente) 
        VALUES ('$nomePaciente', '$emailPaciente', '$contatoPaciente', '$cpfPaciente', '$rgPaciente', '$ruaPaciente', '$bairroPaciente', '$cidadePaciente', '$estadoPaciente')");

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

  } catch (PDOException $erro) {
    echo "Erro: ".$erro->getMessage();
  }

}

switch ($op) {
  case '1': //Cadastro Centro Medico
  $idCM = $_POST["idCM"];
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
  $idUsuario = $_POST["idUsuario"];
  $nome = $_POST["nome"];
  $especialidade = $_POST["especialidade"];
  $email = $_POST["email"];
  $usuario = $_POST["usuario"];
  $senha = $_POST["senha"];
  $nivel_de_acesso = $_POST["nivelAcesso"];

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
  $idNivelAcesso = $_POST["idNivelAcesso"];
  $nivelAcesso = $_POST["nivelAcesso"];
  cadNivelAcesso();
  break;

  case '5':
  $idPaciente = $_POST["idPaciente"];
  $nomePaciente = $_POST["nome"];
  $emailPaciente = $_POST["email"];
  $contatoPaciente = $_POST["num_contato"];
  $cpfPaciente = $_POST["cpf"];
  $rgPaciente = $_POST["rg"];
  $ruaPaciente = $_POST["rua"];
  $bairroPaciente = $_POST["bairro"];
  $cidadePaciente = $_POST["cidade"];
  $estadoPaciente = $_POST["estado"];

  cadPaciente();
  break;


  default:
        # code...
  break;
}

?>