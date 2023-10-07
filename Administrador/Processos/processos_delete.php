<?php

include_once('../conexao_adm.php');
require('../sessao_usuarios.php');

// VERIFICAÇÃO LOGIN E NÍVEL DE USUÁRIO
verificarAcesso($conn);

$id = $_GET['id'];

$sql = "DELETE FROM processo WHERE id=$id";
mysqli_query($conn, $sql);

header('location: processos.php');