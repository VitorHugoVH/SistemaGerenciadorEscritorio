<?php
    include_once('../../conexao_adm.php');
    require('../../sessao_usuarios.php');

    // VERIFICAÇÃO LOGIN E NÍVEL DE USUÁRIO
    verificarAcesso($conn);

    if(isset($_POST['atualizar'])){

        $id = $_POST['id'];
        $newvencimento = $_POST['vencimento'];
        $newvalor = $_POST['valor'];
        $newcategoria = $_POST['categoria'];
        $newcategoria2 = $_POST['categoria2'];
        $newsubcategoria = $_POST['subcategoria3'];
        $newsubcategoria2 = $_POST['subcategoria4'];
        $newobservacoes = $_POST['observacoes'];
        $newstatus = $_POST['status'];
        $newdatapagamento = $_POST['datapagamento'];
        $newjuros = $_POST['juros'];
        $newtotal = $_POST['total'];
        $newrepetir = $_POST['repetir'];
        $newparcelas = $_POST['parcelas'];

        if ($newstatus == 'Apagar') {
            $newstatus = 'Á pagar';
        } elseif ($status == 'Pago') {
            $newstatus = 'Pago';
        }

        if(!empty($newvencimento)){
            $newvencimento2 = date('d/m/Y', strtotime($newvencimento));
        }

        $sqlUpdate = "UPDATE despesa SET datavencimento='$newvencimento2', valor='$newvalor', categoria='$newcategoria', categoria2='$newcategoria2', subcategoria='$newsubcategoria', subcategoria2='$newsubcategoria2', observacao='$newobservacoes', situacao='$newstatus', datapagamento='$newdatapagamento', juros='$newjuros', total='$newtotal', repetir='$newrepetir', parcelas='$newparcelas'
        WHERE id='$id'";

        $resultUpdate = $conn->query($sqlUpdate);

        header('Location: despesas.php');
    }
?>