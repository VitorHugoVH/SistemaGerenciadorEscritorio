<?php
    include_once('conexao_adm.php');

    $id = $_GET['id'];

    $sqlDeleteComp = "DELETE FROM compromisso WHERE id=$id";
    $resultComp = $conn->query($sqlDeleteComp);

    header('Location: agenda_compromissos.php');
?>