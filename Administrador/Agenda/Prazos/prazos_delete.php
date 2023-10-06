<?php
include_once('../../conexao_adm.php');
require('../../sessao_usuarios.php');

verificarAcesso($conn);

    $id = $_GET['id'];

    $sqlDeletePrazo = "DELETE FROM prazo WHERE id=$id";
    $resultPrazo = $conn->query($sqlDeletePrazo);

    header('Location: agenda_prazos.php');
?>