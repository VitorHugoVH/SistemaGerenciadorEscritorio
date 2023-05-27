<?php
    include_once('../../conexao_adm.php');

    $id = $_GET['id'];

    $sqlStatus = "UPDATE usuario SET status='Inativo' WHERE idusuario='$id'";
    $resultStatus = $conn->query($sqlStatus);
    
    header('location: advogados.php');
?>