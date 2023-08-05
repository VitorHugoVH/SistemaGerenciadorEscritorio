<?php
    include_once('../../conexao_adm.php');
    require('../../sessao_usuarios.php');

    // VERIFICAÇÃO LOGIN E NÍVEL DE USUÁRIO
    verificarAcesso($conn);

    $id = $_GET['id'];

    if(!empty($_GET['id'])){

        $sqlCheck = "UPDATE despesa SET situacao='Pago' WHERE id=$id";
        $reseult = $conn->query($sqlCheck);

        header('Location: despesas.php');
    }
?>