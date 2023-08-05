<?php
include_once('../../conexao_adm.php');
require('../../sessao_usuarios.php');

// VERIFICAÇÃO LOGIN E NÍVEL DE USUÁRIO
verificarAcesso($conn);

    $id = $_GET['id'];

    $sqlDeleteComp = "DELETE FROM compromisso WHERE id=$id";
    $resultComp = $conn->query($sqlDeleteComp);

    header('Location: agenda_compromissos.php');
?>