<?php
include_once('../conexao_adm.php');
require('../sessao_usuarios.php');

// VERIFICAÇÃO LOGIN E NÍVEL DE USUÁRIO
verificarAcesso($conn);

//DADOS PROCURAÇÃO

if (isset($_POST['enviar'])) {
    $idProcesso = $_POST['idProcesso'];
    $statusProcesso = isset($_POST['statusProcesso']) ? 'on' : '';
    $faseProcesso = isset($_POST['faseProcesso']) ? 'on' : '';
    $poderProcesso = isset($_POST['poderProcesso']) ? 'on' : '';
    $classeProcesso = isset($_POST['classeProcesso']) ? 'on' : '';
    $naturezaProcesso = isset($_POST['naturezaProcesso']) ? 'on' : '';
    $ritoProcesso = isset($_POST['ritoProcesso']) ? 'on' : '';
    $varaProcesso = isset($_POST['varaProcesso']) ? 'on' : '';
    $comarcaProcesso = isset($_POST['comarcaProcesso']) ? 'on' : '';
    $valorCausaProcesso = isset($_POST['valorCausaProcesso']) ? 'on' : '';
    $valorDividaProcesso = isset($_POST['valorDividaProcesso']) ? 'on' : '';
    $aberturaProcesso = isset($_POST['aberturaProcesso']) ? 'on' : '';
    $valorHonorarioProcesso = isset($_POST['valorHonorarioProcesso']) ? 'on' : '';
    $parcelasProcesso = isset($_POST['parcelasProcesso']) ? 'on' : '';
    $observacoesProcesso = isset($_POST['observacoesProcesso']) ? 'on' : '';

    // Variável para armazenar os dados da tabela
    $DadosTabelaProcesso = '';

    // Array contendo as variáveis
    $variaveis = [
        'stat' => $statusProcesso,
        'fase' => $faseProcesso,
        'poderjudiciario' => $poderProcesso,
        'classe' => $classeProcesso,
        'natureza' => $naturezaProcesso,
        'ritoProcesso' => $ritoProcesso,
        'nomedavara' => $varaProcesso,
        'nomedacomarca' => $comarcaProcesso,
        'valorCausa' => $valorCausaProcesso,
        'valorDivida' => $valorDividaProcesso,
        'dataa' => $aberturaProcesso,
        'valorHonorario' => $valorHonorarioProcesso,
        'parcelas' => $parcelasProcesso,
        'observacoes' => $observacoesProcesso,
    ];

    // Array associativo com mapeamento de nomes para a tabela
    $nomesTabela = [
        'stat' => 'Status',
        'fase' => 'Fase',
        'poderjudiciario' => 'Poder Judiciário',
        'classe' => 'Classe',
        'natureza' => 'Natureza',
        'ritoProcesso' => 'Rito do Processo',
        'nomedavara' => 'Nome da Vara',
        'nomedacomarca' => 'Nome da Comarca',
        'valorCausa' => 'Valor da Causa',
        'valorDivida' => 'Valor da Divida',
        'dataa' => 'Data de Abertura',
        'valorHonorario' => 'Valor do Honorário',
        'parcelas' => 'Parcelas',
        'observacoes' => 'Observações',
    ];

    // Loop para verificar e armazenar os dados na variável
    foreach ($variaveis as $nome => $valor) {
        if ($valor == 'on') {
            $buscaDados = "SELECT $nome FROM processo WHERE id='$idProcesso'";
            $resultado = $conn->query($buscaDados);

            if ($resultado) {
                $dados = mysqli_fetch_assoc($resultado);
                $valorBanco = $dados[$nome];
                $nomeTabela = $nomesTabela[$nome]; // Obter o nome da tabela a partir do array associativo

                // Verificar se o valor não está vazio antes de adicionar à tabela
                if ($valorBanco != '') {
                    $DadosTabelaProcesso .= '<tr>';
                    $DadosTabelaProcesso .= '<td style="border: 1px solid black; padding: 8px;">' . $nomeTabela . '</td>';
                    $DadosTabelaProcesso .= '<td style="border: 1px solid black; padding: 8px;">' . $valorBanco . '</td>';
                    $DadosTabelaProcesso .= '</tr>';
                }
            }
        }
    }

    $nomePrimeiroAdvogado = isset($_POST['nomePrimeiroAdvogado']) ? $_POST['nomePrimeiroAdvogado'] : '';
    $nomeSegundoAdvogado = isset($_POST['nomeSegundoAdvogado']) ? $_POST['nomeSegundoAdvogado'] : '';
    $nomeTerceiroAdvogado = isset($_POST['nomeTerceiroAdvogado']) ? $_POST['nomeTerceiroAdvogado'] : '';
    $nomeCliente = isset($_POST['nomeCliente']) ? $_POST['nomeCliente'] : '';

    $nomeAdvogadoArray = explode('-', $nomePrimeiroAdvogado);
    $nomeAdvogado = trim($nomeAdvogadoArray[0]);

    $nomeAdvogadoArray2 = explode('-', $nomeSegundoAdvogado);
    $nomeAdvogado2 = trim($nomeAdvogadoArray2[0]);

    $nomeAdvogadoArray3 = explode('-', $nomeTerceiroAdvogado);
    $nomeAdvogado3 = trim($nomeAdvogadoArray3[0]);
}

// BUSCAR DADOS DO CLIENTE

$sqlBuscaCliente = "SELECT * FROM clientes WHERE nomecliente='$nomeCliente'";
$resultBuscaCliente = $conn->query($sqlBuscaCliente);

while ($dados_cli = mysqli_fetch_assoc($resultBuscaCliente)) {
    $telefoneDD = $dados_cli['ddd1'];
    $telefoneN = $dados_cli['numero1'];
    $telefoneCompleto = '(' . $telefoneDD . ') ' . $telefoneN;
    $emailCliente = $dados_cli['email1'];
}

// BUSCAR DADOS PRIMEIRO ADVOGADO

$sqlBuscaPrimeiroAdvogado = "SELECT * FROM usuario WHERE nome='$nomeAdvogado'";
$resultBuscaPrimeiroAdvogado = $conn->query($sqlBuscaPrimeiroAdvogado);

while ($dados_adv1 = mysqli_fetch_assoc($resultBuscaPrimeiroAdvogado)) {
    $telefone1 = $dados_adv1['telefone1'];
    $emailAdvogado1 = $dados_adv1['email1'];
}

// BUSCAR DADOS SEGUNDO ADVOGADO

$sqlBuscaSegundoAdvogado = "SELECT * FROM usuario WHERE nome='$nomeAdvogado2'";
$resultBuscaSegundoAdvogado = $conn->query($sqlBuscaSegundoAdvogado);

while ($dados_adv2 = mysqli_fetch_assoc($resultBuscaSegundoAdvogado)) {
    $telefone2 = $dados_adv2['telefone1'];
    $emailAdvogado2 = $dados_adv2['email1'];
}

// BUSCAR DADOS TERCEIRO ADVOGADO

$sqlBuscaTerceiroAdvogado = "SELECT * FROM usuario WHERE nome='$nomeAdvogado3'";
$resultBuscaTerceiroAdvogado = $conn->query($sqlBuscaTerceiroAdvogado);

while ($dados_adv3 = mysqli_fetch_assoc($resultBuscaTerceiroAdvogado)) {
    $telefone3 = $dados_adv3['telefone1'];
    $emailAdvogado3 = $dados_adv3['email1'];
}

// BUSCAR DADOS COMPROMISSOS

$sqlCompromissos = "SELECT * FROM compromisso WHERE processo='$idProcesso'";
$resultCompromissos = $conn->query($sqlCompromissos);

$compromissoRows = '';

if ($resultCompromissos->num_rows >= 1) {
    $compromissoRows .='
    <h4 style="font-weight: bold; margin-top: 20px; margin-bottom: 0px;">Compromissos</h4>
    <hr style="clear: both; margin-top: 0px;"></hr>
    <table style="border-collapse: collapse; width: 100%;">
    <tr>
        <th style="border: 1px solid black; padding: 8px;">Protocolo</th>
        <th style="border: 1px solid black; padding: 8px;">Data</th>
        <th style="border: 1px solid black; padding: 8px;">Compromisso com</th>
        <th style="border: 1px solid black; padding: 8px;">Classificação</th>
        <th style="border: 1px solid black; padding: 8px;">Descrição</th>
    </tr>
    ';
    while ($rowCompromisso = mysqli_fetch_assoc($resultCompromissos)) {
        $compromissoRows .= '
        <tr>
            <td style="border: 1px solid black; padding: 8px;">' . $rowCompromisso['id'] . '</td>
            <td style="border: 1px solid black; padding: 8px;">' . $rowCompromisso['datainicial'] . '</td>
            <td style="border: 1px solid black; padding: 8px;">' . $rowCompromisso['nomecompromisso'] . '</td>
            <td style="border: 1px solid black; padding: 8px;">' . $rowCompromisso['classificacao'] . '</td>
            <td style="border: 1px solid black; padding: 8px;">' . $rowCompromisso['observacoes'] . '</td>
        </tr>';
    }
}

// BUSCAR DADOS PRAZOS

$sqlPrazos = "SELECT * FROM prazo WHERE processo='$idProcesso'";
$resultPrazos = $conn->query($sqlPrazos);

$prazoRows = '';

if ($resultPrazos->num_rows >= 1) {
    $prazoRows .='
    <h4 style="font-weight: bold; margin-top: 20px; margin-bottom: 0px;">Prazos</h4>
    <hr style="clear: both; margin-top: 0px;"></hr>
    <table style="border-collapse: collapse; width: 100%;">
        <tr>
            <th style="border: 1px solid black; padding: 8px;">Protocolo</th>
            <th style="border: 1px solid black; padding: 8px;">Data</th>
            <th style="border: 1px solid black; padding: 8px;">Descrição</th>
            <th style="border: 1px solid black; padding: 8px;">Prazo atendido</th>
        </tr>
    ';
    while ($rowPrazo = mysqli_fetch_assoc($resultPrazos)) {
        $prazoRows .= '
        <tr>
            <td style="border: 1px solid black; padding: 8px;">' . $rowPrazo['id'] . '</td>
            <td style="border: 1px solid black; padding: 8px;">' . $rowPrazo['datafinal'] . '</td>
            <td style="border: 1px solid black; padding: 8px;">' . $rowPrazo['descricao'] . '</td>
            <td style="border: 1px solid black; padding: 8px;">' . $rowPrazo['atendido'] . '</td>
        </tr>';
    }
}


// RENDERIZAR AS TABELAS PARTES

$clienteRow = '
  <tr>
   <td style="border: 1px solid black; padding: 8px;">Cliente</td>
   <td style="border: 1px solid black; padding: 8px;">' . $nomeCliente . '</td>
   <td style="border: 1px solid black; padding: 8px;">' . $telefoneCompleto . '</td>
   <td style="border: 1px solid black; padding: 8px;">' . $emailCliente . '</td>
  </tr>';

$advogadoRows = '';

if ($nomeAdvogado != 'Não consta') {
    $advogadoRows .= '
    <tr>
     <td style="border: 1px solid black; padding: 8px;">Advogado</td>
     <td style="border: 1px solid black; padding: 8px;">' . $nomeAdvogado . '</td>
     <td style="border: 1px solid black; padding: 8px;">' . $telefone1 . '</td>
     <td style="border: 1px solid black; padding: 8px;">' . $emailAdvogado1 . '</td>
    </tr>';
}

if ($nomeAdvogado2 != 'Não consta') {
    $advogadoRows .= '
    <tr>
     <td style="border: 1px solid black; padding: 8px;">Advogado</td>
     <td style="border: 1px solid black; padding: 8px;">' . $nomeAdvogado2 . '</td>
     <td style="border: 1px solid black; padding: 8px;">' . $telefone2 . '</td>
     <td style="border: 1px solid black; padding: 8px;">' . $emailAdvogado2 . '</td>
    </tr>';
}

if ($nomeAdvogado3 != 'Não consta') {
    $advogadoRows .= '
    <tr>
     <td style="border: 1px solid black; padding: 8px;">Advogado</td>
     <td style="border: 1px solid black; padding: 8px;">' . $nomeAdvogado3 . '</td>
     <td style="border: 1px solid black; padding: 8px;">' . $telefone3 . '</td>
     <td style="border: 1px solid black; padding: 8px;">' . $emailAdvogado3 . '</td>
    </tr>';
}

$DadosTabelaPartes = $clienteRow . $advogadoRows;

require_once '../dompdf/autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf(['enable_remote' => true]);

$html =
    '<div style="overflow: auto;">
 <img src="http://localhost/FragaeMelo/Site%20Fraga%20e%20Melo%20BootsTrap/Administrador/logoimage/logo.jpg" style="width: 35%; float: left;">
 <div style="float: right;">
  <h4 style="font-weight: bold;">Fraga e Melo Advogados Associados</h4>
  <p style="text-align: center;">fragaemeloadvogados.adv.br</p>
 </div>
</div>
<hr style="clear: both;"></hr>
<div style="right: 0; left: 0;">
 <h3 style="text-align: center;">Relatório Geral</h3>
</div>
<hr style="clear: both;"></hr>
<h4 style="font-weight: bold; margin-top: 50px; margin-bottom: 0px;">Dados Processuais</h4>
<hr style="clear: both; margin-top: 0px;"></hr>
<table style="border-collapse: collapse; width: 100%;">
   ' .
    $DadosTabelaProcesso .
    '
</table>
<h4 style="font-weight: bold; margin-top: 20px; margin-bottom: 0px;">Partes</h4>
<hr style="clear: both; margin-top: 0px;"></hr>
<table style="border-collapse: collapse; width: 100%;">
 <tr>
  <th style="border: 1px solid black; padding: 8px;">Posição</th>
  <th style="border: 1px solid black; padding: 8px;">Nome</th>
  <th style="border: 1px solid black; padding: 8px;">Telefone</th>
  <th style="border: 1px solid black; padding: 8px;">E-mail</th>
 </tr>
 '.$DadosTabelaPartes .'
</table>
    '. $compromissoRows .'
</table>
    '.$prazoRows.'
</table>';

$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('relatório.pdf', [
    'Attachment' => false,
]);
