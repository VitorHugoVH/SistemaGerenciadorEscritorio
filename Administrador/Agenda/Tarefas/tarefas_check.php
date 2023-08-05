<?php
    include_once('../../conexao_adm.php');
    require('../../sessao_usuarios.php');

    // VERIFICAÇÃO LOGIN E NÍVEL DE USUÁRIO
    verificarAcesso($conn);

    $id = $_GET['id'];

    if(isset($_GET['id'])){
        $sqlUpdatecheck ="UPDATE tarefas SET stat='Finalizado' WHERE id=$id";
        $result = $conn->query($sqlUpdatecheck);
    }
        header('Location: agenda_tarefas.php');
?>