<?php

include_once('../conexao_adm.php');
require('../sessao_usuarios.php');

// VERIFICAÇÃO LOGIN E NÍVEL DE USUÁRIO
verificarAcesso($conn);

$stat = isset($_POST['statusfiltro'])?$_POST['statusfiltro']:1;
$bnome = isset($_POST['buscanome'])?$_POST['buscanome']:"";
$termobusca = isset($_POST['termobusca'])?$_POST['termobusca']:"";

$select = "SELECT * FROM processo";

$select .= " WHERE (1=1) ";
if(isset($_POST['statusfiltro'])){
    $status = $_POST['statusfiltro'];
    $select .= "AND stat = '$status'";
}
if ($_POST['buscanome']!=""){
    $nome = $_POST["buscanome"];
    $select .= " AND nomecliente like '%$nome%' ";
}

$select .= " ORDER BY stat";
$select .= " ORDER BY nomecliente";

$enviar = mysqli_query($conn, $select)
    or die(mysqli_error($conn));
