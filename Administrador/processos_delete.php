<?php

include_once('conexao_adm.php');

$id = $_GET['id'];

$sql = "DELETE FROM processo WHERE id=$id";
mysqli_query($conn, $sql);
if (mysqli_affected_rows($conn) > 0){
    header('location: processos.php');
}