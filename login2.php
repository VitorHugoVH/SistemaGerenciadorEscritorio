<?php
include('config.php');

if(empty($_POST['usuario']) || empty($_POST['senha'])) {
    header('Location: login.php');
    exit();
}

$usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);

$query = "SELECT * from usuario where usuario = '{$usuario}' and senha = '{$senha}' and status = 'Ativo'";

$result = mysqli_query($conexao, $query);

$row = mysqli_num_rows($result);

if($row == 1){
    $_SESSION['usuario'] = $usuario;
    header('Location: Administrador/admin.php');
    exit();
}else {
    header('Location: login.php');
    exit();
}

?>