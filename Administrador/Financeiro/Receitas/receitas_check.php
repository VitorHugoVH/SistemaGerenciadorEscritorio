<?php
    include_once('../../conexao_adm.php');

    $id = $_GET['id'];

    if(!empty($_GET['id'])){

        $sqlCheck = "UPDATE receita SET statuss='Recebido' WHERE id=$id";
        $resultCheck = $conn->query($sqlCheck);

        header('Location: receitas.php');
    }
?>