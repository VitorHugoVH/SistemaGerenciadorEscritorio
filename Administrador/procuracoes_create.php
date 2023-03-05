<?php
include_once('conexao_adm.php');

require_once 'dompdf/autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf(['enable_remote' => true]);
$dompdf->loadHtml('
    <img src="http://localhost/FragaeMelo/Site%20Fraga%20e%20Melo%20BootsTrap/Administrador/logoimage/logo.jpg" style="width: 35%; margin-left: 60%;">
    <br><br>
    <h3 style="text-align: center;">PROCURAÇÃO</h3>
    <p style="margin-left: 50px; margin-right: 50px; text-align: justify;">OUTORGANTE: HILSON RICARDO GARNIER PIRES, brasileiro, casado,
    arquiteto, portador da cédula de identidade de nº 3001746928, 
    inscrito no CPF sob o nº 405.512.450-34, residente e domiciliado 
    na Avenida Beira Mar, 685 – Bairro Village Dunnas I, Balneário 
    Gaivota-SC.
    </p>
    
');

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream(
    "procuração.pdf",
    array(
        "Attachment" => false
    )
);
