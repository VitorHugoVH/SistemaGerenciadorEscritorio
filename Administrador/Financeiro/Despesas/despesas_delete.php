<?php
    include_once('../../conexao_adm.php');
    require('../../sessao_usuarios.php');

    // VERIFICAÇÃO LOGIN E NÍVEL DE USUÁRIO
    verificarAcesso($conn);

    $id = $_GET['id'];

    if(!empty($_GET['id'])){

        $sqlDelete = "DELETE FROM despesa WHERE id=$id";
        $resultDelete = $conn->query($sqlDelete);

        header('Location: despesas.php');
    }
?>