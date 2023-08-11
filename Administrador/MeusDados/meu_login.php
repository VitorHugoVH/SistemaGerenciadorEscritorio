<?php

include_once("../conexao_adm.php");
require_once("../sessao_usuarios.php");

verificarAcesso($conn);

if(isset($_POST['enviar'])) {

  $id = $_POST['idUsuario'];
  $senhaUsuario = $_POST['senhaUsuario'];

  $UserLogin = $_POST['usuario'];
  $PassLogin = $_POST['senha'];

  if($PassLogin == $senhaUsuario) {
    $sqlUpdate = "UPDATE usuario SET usuario = ? WHERE idusuario = ?";
    
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
      $_SESSION['usuariologado'] = $UserLogin;

      header('location: ../Deashboard/admin.php');
      exit();
    } else {
      echo "Erro na execução da consulta: " . $stmt->error;
    }

    $stmt->close();
  } else {
    echo '<script>alert("Senha incorreta!"); window.location.href="../Deashboard/admin.php";</script>';
  }
}

?>
