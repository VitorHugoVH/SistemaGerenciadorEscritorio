<?php
    include_once('conexao_adm.php');

    $id = $_GET['id'];

    if(!empty($_GET['id'])){

        $sqlCheck = "UPDATE despesa SET situacao='Pago' WHERE id=$id";
        $reseult = $conn->query($sqlCheck);

        header('Location: despesas.php');
    }
?>