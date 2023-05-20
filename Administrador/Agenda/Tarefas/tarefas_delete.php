<?php
    include_once('../../conexao_adm.php');

    $id = $_GET['id'];

    if(isset($_GET['id'])){
        
        $sqlDelete = "DELETE FROM tarefas WHERE id=$id";

        mysqli_query($conn, $sqlDelete);
            if (mysqli_affected_rows($conn) > 0){
                header('location: agenda_tarefas.php');
            }
    }
?>