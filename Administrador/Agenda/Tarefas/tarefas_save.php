<?php
        include_once('../../conexao_adm.php');
        require('../../sessao_usuarios.php');

        // VERIFICAÇÃO LOGIN E NÍVEL DE USUÁRIO
        verificarAcesso($conn);
        if(isset($_POST['update'])){
            $id = $_POST['id'];
            $newtipotarefa = $_POST['tipotarefa'];
            $newresponsa = $_POST['nomeadvogado'];
            $newprazodate = $_POST['prazodate'];
            $newtituloprazo = $_POST['tituloprazo'];
            $newdesctarefa = $_POST['desctarefa'];
            $newstatus = $_POST['inlineRadioOptions'];

            if($newstatus == 'option1'){
                $newstatus = 'Finalizado';
            }else{
                $newstatus = 'Não finalizado';
            }

            $sqlUpdate = "UPDATE tarefas SET tipotarefa='$newtipotarefa', advogado='$newresponsa', prazo='$newprazodate', titulo='$newtituloprazo', tarefa='$newdesctarefa', stat='$newstatus'
            WHERE id='$id'";

            $resultUpdate = $conn->query($sqlUpdate);
        }
        header('Location: agenda_tarefas.php');
?>