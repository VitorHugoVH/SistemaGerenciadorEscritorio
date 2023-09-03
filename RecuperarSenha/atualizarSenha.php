<?php
include_once('../config.php');
session_start();

// RECENDO DADOS DA SESSAO

$emailUser = $_SESSION['emailRecuperacao'];

if(isset($_POST['redefinirSenha'])){
  $newSenha = $_POST['novaSenha'];

  // VERIFICAR EM QUAL TABELA O EMAIL DO USUÁRIO ESTÁ PRESENTE

  $sqlClientes = "SELECT * FROM clientes WHERE email1 = '$emailUser'";
  $resultClientes = $conexao->query($sqlClientes);

  $sqlUsuarios = "SELECT * FROM usuarios WHERE email1 = '$emailUser'";
  $resultUsuarios = $conexao->query($sqlUsuarios);

  if ($resultClientes->num_rows > 0) {
    $sqlUpdateClientes = "UPDATE clientes SET senha = '$newSenha' WHERE email1 = '$emailUser'";
    if ($conexao->query($sqlUpdateClientes) === TRUE) {
      $_SESSION['success_message'] = "Senha atualizada com sucesso";
      header('Location: ../login.php');
      exit;
    }else {
      echo "Erro ao atualizar a senha na tabela 'clientes': " . $conexao->error;
    }
  } elseif ($resultUsuarios->num_rows > 0) {
    $sqlUpdateUsuarios = "UPDATE usuarios SET senha = '$newSenha' WHERE email1 = '$emailUser'";
    if ($conexao->query($sqlUpdateUsuarios) === TRUE) {
      $_SESSION['success_message'] = "Senha atualizada com sucesso";
      header('Location: ../login.php');
      exit;
    } else {
      echo "Erro ao atualizar a senha na tabela 'usuarios': " . $conexao->error;
    }
  } else {
    echo "Email do usuário não encontrado em nenhuma tabela.";
    header('Location: ../login.php');
    exit;
  }
}
?>
