<?php
include_once("../conexao_cliente.php");

if (isset($_POST['send'])) {
    $id = $_POST['idCliente'];
    $senhaUsuario = $_POST['senhaCliente'];

    $senhaAtual = $_POST['senhaAtual'];
    $novaSenha = $_POST['novaSenha'];

    // Verificar se a senha atual inserida corresponde à senha no banco de dados
    $sqlSenha = "SELECT senha FROM usuario WHERE idusuario = ?";
    $stmtSenha = $conn->prepare($sqlSenha);
    $stmtSenha->bind_param("i", $id);
    $stmtSenha->execute();
    $stmtSenha->bind_result($senhaDoBanco);
    $stmtSenha->fetch();
    $stmtSenha->close();

    if ($senhaAtual == $senhaDoBanco) {
        // Atualizar a senha
        $sqlUpdate = "UPDATE usuario SET senha = ? WHERE idusuario = ?";
        $stmtUpdate = $conn->prepare($sqlUpdate);
        $stmtUpdate->bind_param("si", $novaSenha, $id);

        if ($stmtUpdate->execute()) {
            $stmtUpdate->close();
            // Atualizar a variável de sessão com a nova senha
            $_SESSION['senhalogado'] = $novaSenha;

            header('Location: ../Deashboard/admin.php');
            exit();
        } else {
            echo "Erro na execução da consulta: " . $stmtUpdate->error;
        }
    } else {
        echo '<script>alert("Senha atual incorreta!"); window.location.href="../Deashboard/admin.php";</script>';
    }
}
?>
