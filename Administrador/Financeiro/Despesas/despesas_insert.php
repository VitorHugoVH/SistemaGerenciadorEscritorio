<?php
include_once('../../conexao_adm.php');
require('../../sessao_usuarios.php');

// VERIFICAÇÃO LOGIN E NÍVEL DE USUÁRIO
verificarAcesso($conn);

if (isset($_POST['salvar'])) {

    $vencimento = $_POST['vencimento'];
    $valor  = $_POST['valor'];
    $categoria = $_POST['categoria'];
    $categoria2 = $_POST['categoria2'];
    $subcategoria = $_POST['subcategoria3'];
    $subcategoria2 = $_POST['subcategoria4'];
    $observacoes = $_POST['observacoes'];
    $status = $_POST['status'];
    $datapagamento = $_POST['datapagamento'];
    $juros = $_POST['juros'];
    $total = $_POST['total'];
    $repetir = $_POST['repetir'];
    $parcelas = $_POST['parcelas'];
    $anexo = $_POST['anexo'];
    $datacriacao = $_POST['datacriacao'];

    if ($categoria == 'Impostos') {
        $categoria = 'Impostos';
    } elseif ($categoria == 'Infra-estrutura') {
        $categoria = 'Infra-estrutura';
    }

    if ($subcategoria == 'IPTU') {
        $subcategoria = 'IPTU';
    } elseif ($subcategoria == 'IPVA') {
        $subcategoria = 'IPVA';
    }

    if ($categoria2 != '') {
        $categoria = ' ';
    } elseif ($categoria != '') {
        $categoria2 = ' ';
    }

    if ($subcategoria2 != '') {
        $subcategoria = ' ';
    } elseif ($subcategoria != ' ') {
        $subcategoria2 = ' ';
    }

    if ($status == 'Apagar') {
        $status = 'Á pagar';
    } elseif ($status == 'Pago') {
        $status = 'Pago';
    }

    if ($repetir == 'uma') {
        $repetir = 'Não Repetir';
    } elseif ($repetir == 'repetir') {
        $repetir = "Repetir";
    }

    $sqlEnviar = "INSERT INTO despesa (datavencimento, valor, categoria, categoria2, subcategoria, subcategoria2, observacao, situacao, datapagamento, juros, total, repetir, parcelas, anexo, datacriacao)
        VALUES ('$vencimento', '$valor', '$categoria', '$categoria2', '$subcategoria', '$subcategoria2', '$observacoes', '$status', '$datapagamento', '$juros', '$total', '$repetir', '$parcelas', '$anexo', '$datacriacao')";

    $resultEnviar = $conn->query($sqlEnviar);

    ##INICIO SISTEMA REPETIÇÃO##

    $repeticao = 0;
    if (!empty($_POST['parcelas'])) {
        $repeticao = $parcelas;
        $mesatual = date('d/m/Y');
        $nextmonth = date('d/m/Y', strtotime("+1 months", strtotime($datacriacao)));
        while ($repeticao <= 0) {

            if ($nextmonth = $mesatual) {
                $sqlEnviar2 = "INSERT INTO despesa (datavencimento, valor, categoria, categoria2, subcategoria, subcategoria2, observacao, situacao, datapagamento, juros, total, repetir, parcelas, anexo)
                                VALUES ('$vencimento', '$valor', '$categoria', '$categoria2', '$subcategoria', '$subcategoria2', '$observacoes', '$status', '$datapagamento', '$juros', '$total', '$repetir', '$parcelas', '$anexo')";

                $resultEnviar2 = $conn->query($sqlEnviar2);
            }
            $repeticao = $repeticao -= 1;
        }
    }

    ##FINAL SISTEMA REPETIÇÃO##  

    header('Location: despesas.php');
}
