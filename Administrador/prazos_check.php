<?php
include_once('conexao_adm.php');

    $id = $_GET['id'];

    if(!empty($_GET['id'])){

        $sqlCheck = "UPDATE prazo SET atendido='Sim' WHERE id=$id";
        $resultCheck = $conn->query($sqlCheck);

        header('Location: agenda_prazos.php');
    }
?>