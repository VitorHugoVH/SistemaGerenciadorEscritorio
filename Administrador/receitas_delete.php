<?php
    include_once('conexao_adm.php');

    $id = $_GET['id'];

    if(!empty($_GET['id'])){
        
        $sqlDelete = "DELETE FROM receita WHERE id=$id";
        $resultDelete = $conn->query($sqlDelete);

        header('Location: receitas.php');
    }
?>