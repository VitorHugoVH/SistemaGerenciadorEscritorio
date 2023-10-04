<?php

include_once("../conexao_adm.php");

if(isset($_POST['salvar'])){

  $idUsuario = $_POST['idUsuario'];
  $nomeUsuario = $_POST['nomeUsuario'];
  $cpfUsuario = $_POST['cpfUsuario'];
  $emailUsuario = $_POST['emailUsuario'];
  $telefoneUsuario = $_POST['telefoneUsuario'];
  $profissaoUsuario = $_POST['profissaoUsuario'];
  $cepUsuario = $_POST['cepUsuario'];
  $enderecoUsuario = $_POST['enderecoUsuario'];
  $numeroUsuario = $_POST['numeroUsuario'];
  $complementoUsuario = $_POST['complementoUsuario'];
  $bairroUsuario = $_POST['bairroUsuario'];
  $cidadeUsuario = $_POST['cidadeUsuario'];
  $estadoUsuario = $_POST['estadoUsuario'];

  ##VERIFICAR SE O EMAIL JÁ ESTÁ SENDO USADO##

  $sqlVerificaEmailUsuario = "SELECT * FROM usuario 
  WHERE usuario = '$emailUsuario'
  OR email1 = '$emailUsuario'
  OR email2 = '$emailUsuario'
  OR email3 = '$emailUsuario'";
          
  $sqlVerificaEmailClientes = "SELECT * FROM clientes
  WHERE email1 = '$emailUsuario'
  OR email2 = '$emailUsuario'
  OR email3 = '$emailUsuario'";
          
  $resultVerificaEmailUsuario = $conn->query($sqlVerificaEmailUsuario);
  $resultVerificaEmailClientes = $conn->query($sqlVerificaEmailClientes);
  
  if ($resultVerificaEmailUsuario->num_rows > 0 || $resultVerificaEmailClientes->num_rows > 0) {
        echo "<script>alert('O email já está cadastrado.'); window.history.back();</script>";
        exit;
      } else {

        $sqlUpdate = "UPDATE usuario SET nome='$nomeUsuario', cpf='$cpfUsuario', email1='$emailUsuario', telefone1='$telefoneUsuario', 
        profissao='$profissaoUsuario', cep1='$cepUsuario', endereco1='$enderecoUsuario', numerocasa1='$numeroUsuario', complemento1='$complementoUsuario',
        bairro1='$bairroUsuario', cidade1='$cidadeUsuario', estado1='$estadoUsuario' WHERE idusuario='$idUsuario' ";

        $resultUpdate = $conn->query($sqlUpdate);

        header('location: ../Deashboard/admin.php');
        exit;
      }
}

?>