<?php
include_once('../conexao_adm.php');

//DADOS PROCURAÇÃO

if (isset($_POST['enviar'])) {

    $statusProcesso = $_POST['statusProcesso'];
    $faseProcesso = $_POST['faseProcesso'];
    $poderProcesso = $_POST['poderProcesso'];
    $classeProcesso = $_POST['classeProcesso'];
    $naturezaProcesso = $_POST['naturezaProcesso'];
    $ritoProcesso = $_POST['ritoProcesso'];
    $varaProcesso = $_POST['varaProcesso'];
    $comarcaProcesso = $_POST['comarcaProcesso'];
    $valorCausaProcesso = $_POST['valorCausaProcesso'];
    $aberturaProcesso = $_POST['aberturaProcesso'];
    $valorHonorarioProcesso = $_POST['valorHonorarioProcesso'];
    $parcelasProcesso = $_POST['parcelasProcesso'];
    $observacoesProcesso = $_POST['observacoesProcesso'];

    $numeroProcesso = isset($_POST['numeroProcesso']) ? $_POST['numeroProcesso'] : '';
    $nomePrimeiroAdvogado = isset($_POST['nomePrimeiroAdvogado']) ? $_POST['nomePrimeiroAdvogado'] : '';
    $nomeSegundoAdvogado = isset($_POST['nomeSegundoAdvogado']) ? $_POST['nomeSegundoAdvogado'] : '';
    $nomeCliente = isset($_POST['nomeCliente']) ? $_POST['nomeCliente'] : '';

        $nomeAdvogadoArray = explode("-", $nomePrimeiroAdvogado);
        $nomeAdvogado = trim($nomeAdvogadoArray[0]);

        $nomeAdvogadoArray2 = explode("-", $nomeSegundoAdvogado);
        $nomeAdvogado2 = trim($nomeAdvogadoArray2[0]);
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

    while($dados_adv1 = mysqli_fetch_assoc($resultBuscaPrimeiroAdvogado)){
        $telefone1 = $dados_adv1['telefone1'];
        $emailAdvogado1 = $dados_adv1['email1'];
    }

    // BUSCAR DADOS SEGUNDO ADVOGADO

    $sqlBuscaSegundoAdvogado = "SELECT * FROM usuario WHERE nome='$nomeAdvogado2'";
    $resultBuscaSegundoAdvogado = $conn->query($sqlBuscaSegundoAdvogado);

    while($dados_adv2 = mysqli_fetch_assoc($resultBuscaSegundoAdvogado)){
        $telefone2 = $dados_adv2['telefone1'];
        $emailAdvogado2 = $dados_adv2['email1'];
    }

    // BUSCAR DADOS PROCESSO

    if (isset($_POST[$numeroProcesso])) {
    $sqlBuscaProcesso = "SELECT * FROM processo WHERE nprocesso='$numeroProcesso'";
    $resultBusca = $conn->query($sqlBuscaProcesso);

        while ($data = mysqli_fetch_assoc($resultBusca)) {
            /*VERIFICAR STATUS DOS DADOS RECEBIDOS NO FORMULÁRIO*/
            $fields = array(
                'status' => $statusProcesso,
                'fase' => $faseProcesso,
                'poderjudiciario' => $poderProcesso,
                'classe' => $classeProcesso,
                'natureza' => $naturezaProcesso,
                'ritoProcesso' => $ritoProcesso,
                'nomedavara' => $varaProcesso,
                'nomedacomarca' => $comarcaProcesso,
                'valorCausa' => $valorCausaProcesso,
                'dataa' => $aberturaProcesso,
                'valorHonorario' => $valorHonorarioProcesso,
                'parcelas' => $parcelasProcesso,
                'observacoes' => $observacoesProcesso
            );

            $additionalRow = '';

            foreach ($fields as $field => $value) {
                if (isset($data[$field])) {
                    ${$field} = $data[$field];
                    $additionalRow .= '<tr>
                                            <td style="border: 1px solid black; padding: 8px;">'. ucfirst($field) .'</td>
                                            <td style="border: 1px solid black; padding: 8px;">'. ${$field} .'</td>
                                    </tr>';
                } else {
                    ${$field} = 'null';
                }
            }
        }

        // RENDERIZAR AS TABELAS PARTES

        $clienteRow = '
        <tr>
            <td style="border: 1px solid black; padding: 8px;">Cliente</td>
            <td style="border: 1px solid black; padding: 8px;">'. $nomeCliente .'</td>
            <td style="border: 1px solid black; padding: 8px;">'. $telefoneCompleto .'</td>
            <td style="border: 1px solid black; padding: 8px;">'. $emailCliente .'</td>
        </tr>';

        $advogadoRow = '
        <tr>
            <td style="border: 1px solid black; padding: 8px;">Advogado</td>
            <td style="border: 1px solid black; padding: 8px;">'. $nomeAdvogado .'</td>
            <td style="border: 1px solid black; padding: 8px;">'. $telefone1 .'</td>
            <td style="border: 1px solid black; padding: 8px;">'. $emailAdvogado1 .'</td>
        </tr>';

        $advogadoRow = '';
        $advogadoRow2 = '';

        if ($nomeAdvogado2 != 'Não consta') {
            $advogadoRow2 = '
                <tr>
                    <td style="border: 1px solid black; padding: 8px;">Advogado</td>
                    <td style="border: 1px solid black; padding: 8px;">'. $nomeAdvogado2 .'</td>
                    <td style="border: 1px solid black; padding: 8px;">'. $telefone2 .'</td>
                    <td style="border: 1px solid black; padding: 8px;">'. $emailAdvogado2 .'</td> 
                </tr>';
            $DadosTabelaPartes = $clienteRow . $advogadoRow . $advogadoRow2;
        } else {
            $DadosTabelaPartes = $clienteRow . $advogadoRow;
        }
    }

require_once ('../dompdf/autoload.inc.php');

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf(['enable_remote' => true]);

$html = '<div style="overflow: auto;">
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
    '.  $additionalRow .'
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
    '. $DadosTabelaPartes .'
</table>';

$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream(
    "relatório.pdf",
    array(
        "Attachment" => false
    )
);
