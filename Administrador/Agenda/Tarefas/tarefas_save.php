<?php
include_once('conexao_adm.php');
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

            if(!empty($newprazodate)){
                $newprazodate2 = date('d/m/Y', strtotime($newprazodate));
            }

            $sqlUpdate = "UPDATE tarefas SET tipotarefa='$newtipotarefa', advogado='$newresponsa', prazo='$newprazodate2', titulo='$newtituloprazo', tarefa='$newdesctarefa', stat='$newstatus'
            WHERE id='$id'";

            $resultUpdate = $conn->query($sqlUpdate);
        }
        header('Location: agenda_tarefas.php');
?>