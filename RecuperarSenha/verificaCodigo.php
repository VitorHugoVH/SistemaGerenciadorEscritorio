<?php
session_start();

// Verifique se o código de recuperação está armazenado na sessão
if(isset($_SESSION['codigo_recuperacao'])){
    $codigoRecuperacao = $_SESSION['codigo_recuperacao'];
} else {
    // Se o código de recuperação não estiver definido na sessão, redirecione para recuperarSenha2.php ou execute outra ação adequada.
    header('Location: recuperarSenha2.php');
    exit;
}

if(isset($_POST['verificarCodigo'])){
    $codigoInserido = $_POST['codigo'];

    // Verifique se o código inserido pelo usuário é igual ao código de recuperação
    if($codigoInserido == $codigoRecuperacao){
        // Código igual, redirecione para redefinirSenha.php ou execute outra ação adequada.
        header('Location: redefinirSenha.php');
        exit;
    } else {
        // Código diferente, redirecione para recuperarSenha2.php ou execute outra ação adequada.
        header('Location: recuperarSenha2.php');
        exit;
    }
} else {
    // Se o formulário não foi enviado, redirecione para recuperarSenha2.php ou execute outra ação adequada.
    header('Location: recuperarSenha2.php');
    exit;
}
