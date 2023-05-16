<?php
    include_once('conexao_adm.php');

    $id = $_GET['id'];

    if(isset($_GET['id'])){
        $sqlUpdatecheck ="UPDATE tarefas SET stat='Finalizado' WHERE id=$id";
        $result = $conn->query($sqlUpdatecheck);
    }
        header('Location: agenda_tarefas.php');
?>