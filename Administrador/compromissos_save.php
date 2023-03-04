<?php

    include_once('conexao_adm.php');

    if(isset($_POST['up'])){

        $id = $_POST['id'];
        $datainicial = $_POST['datainicial'];
        $horainicial = $_POST['horainicial'];
        $datafinal = $_POST['datafinal'];
        $horafinal = $_POST['horafinal'];
        $nomecompromisso = $_POST['nomecompromisso'];
        $classificacao = $_POST['classificacao'];
        $processo = $_POST['processo'];
        $local = $_POST['local'];
        $observacoes = $_POST['observacoes'];
        $nomeadvogado = $_POST['nomeadvogado'];
        $nomecliente = $_POST['nomecliente'];
        $mesatualComp = $_POST['mes'];

        if(!empty($datainicial)){
            $datainicial2 = date('d/m/Y', strtotime($datainicial));
        }

        if(!empty($datafinal)){
            $datafinal2 = date('d/m/Y', strtotime($datafinal));
        }

        $sql = "UPDATE compromisso SET datainicial='$datainicial2',horainicial='$horainicial',datafinal='$datafinal2',horafinal='$datafinal',nomecompromisso='$nomecompromisso',classificacao='$classificacao',processo='$processo',locall='$local',observacoes='$observacoes',nomeadvogado='$nomeadvogado',cliente='$nomecliente',mes='$mesatualComp' 
        WHERE id='$id'";

        $result = $conn->query($sql);
    }

    header('Location: agenda_compromissos.php');
?>