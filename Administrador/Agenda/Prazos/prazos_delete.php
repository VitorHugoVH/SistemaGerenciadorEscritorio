<?php
include_once('../../conexao_adm.php');

    $id = $_GET['id'];
    
    if(!empty($_GET['id'])){

        $sqlDelete = "DELETE FROM prazo WHERE id=$id";

        mysqli_query($conn, $sqlDelete);
        if (mysqli_affected_rows($conn) > 0){
            header('location: agenda_prazos.php');
        }
    }
?>