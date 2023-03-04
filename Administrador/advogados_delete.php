<?php
    include_once('conexao_adm.php');

    $id = $_GET['id'];

    if(!empty($_GET['id'])){

        $sqlDelte = "DELETE FROM usuario WHERE idusuario=$id";
        $resultDelte = $conn->query($sqlDelte);

        header('location: advogados.php');
    }
?>