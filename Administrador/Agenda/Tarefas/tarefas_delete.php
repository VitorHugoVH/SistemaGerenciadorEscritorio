<?php
    include_once('../../conexao_adm.php');
    require('../../sessao_usuarios.php');

    // VERIFICAÇÃO LOGIN E NÍVEL DE USUÁRIO
    verificarAcesso($conn);

    $id = $_GET['id'];

    if(isset($_GET['id'])){
        
        $sqlDelete = "DELETE FROM tarefas WHERE id=$id";

        mysqli_query($conn, $sqlDelete);
            if (mysqli_affected_rows($conn) > 0){
                header('location: agenda_tarefas.php');
            }
    }
?>