<?php
include_once('../../conexao_adm.php');

//DADOS PROCURAÇÃO

if (isset($_POST['enviar'])) {

    $conteudo = $_POST['descricao'];
    $nomecliente = $_POST['nomecliente'];
}

require_once ('../../dompdf/autoload.inc.php');

// reference the Dompdf namespace
use Dompdf\Dompdf;
use FontLib\Table\Type\head;

// instantiate and use the dompdf class
$dompdf = new Dompdf(['enable_remote' => true]);
$dompdf->loadHtml('
<img src="http://localhost/FragaeMelo/Site%20Fraga%20e%20Melo%20BootsTrap/Administrador/logoimage/logo.jpg" style="width: 35%; margin-left: 60%;">
    ' . $conteudo . '
');

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream(
    "procuração_" . $nomecliente . ".pdf",
    array(
        "Attachment" => false
    )
);
