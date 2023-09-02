<?php

include_once("../conexao_cliente.php");

if(isset($_POST['salvar'])){

  $idUsuario = $_POST['idCliente'];
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

  $sqlUpdate = "UPDATE clientes SET nomecliente='$nomeUsuario', cpf='$cpfUsuario', email1='$emailUsuario', numero1='$telefoneUsuario', 
  profissao='$profissaoUsuario', cep1='$cepUsuario', endereco1='$enderecoUsuario', numerocasa1='$numeroUsuario', complemento1='$complementoUsuario',
  bairro1='$bairroUsuario', cidade1='$cidadeUsuario', estado1='$estadoUsuario' WHERE id='$idUsuario' ";

  $resultUpdate = $conn->query($sqlUpdate);

  header('location: ../AreaCliente.php');
}

?>