<?php
session_start();
$_SESSION['logged'] = false;
include('config.php');

if (empty($_POST['usuario']) || empty($_POST['senha'])) {
    header('Location: login.php');
    exit();
}

$usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);

$query = "SELECT * from usuario where usuario = '{$usuario}' and senha = '{$senha}' and status = 'Ativo'";

$result = mysqli_query($conexao, $query);

$row = mysqli_num_rows($result);

if ($row == 1) {
    $_SESSION['usuariologado'] = $usuario;
    $_SESSION['senhalogado'] = $senha;
    $_SESSION['logged'] = true;
    header('Location: Administrador/Deashboard/admin.php');
} else {
    $_SESSION['erro'] = "Email ou Senha inválidos!";
    header('Location: login.php');
    exit();
}
