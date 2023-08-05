<?php
    include_once('../../conexao_adm.php');
    require('../../sessao_usuarios.php');

    // VERIFICAÇÃO LOGIN E NÍVEL DE USUÁRIO
    verificarAcesso($conn);

    $id = $_GET['id'];

    if(!empty($_GET['id'])){

        $sqlCheck = "UPDATE prazo SET atendido='Sim' WHERE id=$id";
        $resultCheck = $conn->query($sqlCheck);

        header('Location: agenda_prazos.php');
    }
?>