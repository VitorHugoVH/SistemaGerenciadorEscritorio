<?php
    include_once('../../conexao_adm.php');
    require('../../sessao_usuarios.php');

    // VERIFICAÇÃO LOGIN E NÍVEL DE USUÁRIO
    verificarAcesso($conn);

    if(isset($_POST['salvar'])){

        $cliente1 = $_POST['client1'];
        $cliente2 = $_POST['client2'];
        $vencimento = $_POST['vencimento'];
        $valor = $_POST['valor'];
        $categoria1 = $_POST['categoria1'];
        $categoria2 = $_POST['categoria2'];
        $subcategoria1 = $_POST['subcategoria1'];
        $subcategoria2 = $_POST['subcategoria2'];
        $observacoes = $_POST['observacoes'];
        $status = $_POST['status'];
        $recebimentodata = $_POST['recebimentodata'];
        $juros = $_POST['juros'];
        $multa = $_POST['multa'];
        $datacriacao = $_POST['datacriacao'];

        if($recebimentodata == ''){
            $recebimentodata = "";
        }

        if($status == 'receber'){
            $status = "A receber";
        }else{
            $status = "Recebido";
        }

        if($cliente1 != ''){
            $cliente2 = "";
        }else{
            $cliente1 = "";
        }

        if($categoria1 != ''){
            $categoria2 = "";
        }else{
            $categoria1 = "";
        }

        if($subcategoria1 != ''){
            $subcategoria2 = "";
        }else {
            $subcategoria1 = "";
        }
        
        $sqlEnviar = "INSERT INTO receita (cliente1, cliente2, vencimento, valor, categoria1, categoria2, subcategoria1, subcategoria2, observacoes, statuss, recebimentodata, juros, multa, datacriacao)
        VALUES ('$cliente1', '$cliente2', '$vencimento', '$valor', '$categoria1', '$categoria2', '$subcategoria1', '$subcategoria2', '$observacoes', '$status', '$recebimentodata', '$juros', '$multa', '$datacriacao')";

        $resultEnviar = $conn->query($sqlEnviar); 

        header('Location: receitas.php');
    }
?>