<?php
    include_once('conexao_adm.php');

    if(isset($_POST['salvar'])){

        $id = $_POST['id'];
        $newcliente1 = $_POST['client1'];
        $newcliente2  = $_POST['client2'];
        $newvencimento = $_POST['vencimento'];
        $newvalor = $_POST['valor'];
        $newcategoria1 = $_POST['categoria1'];
        $newcategoria2 = $_POST['categoria2'];
        $newsubcategoria1 = $_POST['subcategoria1'];
        $newsubcategoria2 = $_POST['subcategoria2'];
        $newobservacoes = $_POST['observacoes'];
        $newstatus = $_POST['status'];
        $newrecebimentodata = $_POST['recebimentodata'];
        $newjuros = $_POST['juros'];
        $newmulta = $_POST['multa'];
        $newrepetir = $_POST['repetir'];
        $newparcelas = $_POST['parcelas'];
        $newanexo = $_POST['anexo'];

        if($newrecebimentodata == ''){
            $newrecebimentodata = "";
        }

        if($newstatus == 'receber'){
            $newstatus = "A receber";
        }else{
            $newstatus = "Recebido";
        }

        if($newcliente1 != ''){
            $newcliente2 = "";
        }else{
            $newcliente1 = "";
        }

        if($newcategoria1 != ''){
            $newcategoria2 = "";
        }else{
            $newcategoria1 = "";
        }

        if($newsubcategoria1 != ''){
            $newsubcategoria2 = "";
        }else {
            $newsubcategoria1 = "";
        }

        $sqlUpdate = "UPDATE receita SET cliente1='$newcliente1', cliente2='$newcliente2', vencimento='$newvencimento', valor='$newvalor', categoria1='$newcategoria1', categoria2='$newcategoria2', subcategoria1='$newsubcategoria1', subcategoria2='$newsubcategoria2', observacoes='$newobservacoes', statuss='$newstatus', recebimentodata='$newrecebimentodata', juros='$newjuros', multa='$newmulta', repetir='$newrepetir', parcelas='$newparcelas', anexo='$newanexo'
        WHERE id='$id'";

        $resultUpdate = $conn->query($sqlUpdate); 

        header('Location: receitas.php');
    }
?>