<?php

include_once("../conexao_cliente.php");
require_once("../../Administrador/sessao_usuarios.php");

verificarAcesso($conn);

if(isset($_POST['enviar'])) {

  $id = $_POST['idCliente'];
  $senhaUsuario = $_POST['senhaCliente'];

  $UserLogin = $_POST['usuario'];
  $PassLogin = $_POST['senha'];

  if($PassLogin == $senhaUsuario) {
    $sqlUpdate = "UPDATE clientes SET login = ? WHERE id = ?";
    
    // Preparar a consulta
    $stmt = $conn->prepare($sqlUpdate);
    
    if (!$stmt) {
      die("Erro na preparação da consulta: " . $conn->error);
    }
    
    // Executar a consulta usando prepared statement
    $stmt->bind_param("si", $UserLogin, $id);
    
    if ($stmt->execute()) {
      $stmt->close();

      // Atualize a variável de sessão com o novo nome de usuário
      $_SESSION['usernameCliente'] = $UserLogin;

      header('location: ../AreaCliente.php');
      exit();
    } else {
      echo "Erro na execução da consulta: " . $stmt->error;
    }

    $stmt->close();
  } else {
    echo '<script>alert("Senha incorreta!"); window.location.href="../AreaCliente.php";</script>';
  }
}

?>
