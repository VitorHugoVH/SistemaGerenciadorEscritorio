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

$query = "SELECT * FROM usuario WHERE usuario = '{$usuario}' AND senha = '{$senha}' AND status = 'Ativo'";

$result = mysqli_query($conexao, $query);

$row = mysqli_num_rows($result);

if ($row == 1) {
    $_SESSION['usuariologado'] = $usuario;
    $_SESSION['senhalogado'] = $senha;
    $_SESSION['logged'] = true;
    header('Location: Administrador/Deashboard/admin.php');
} else {
    // Consulta na tabela "clientes" caso a primeira consulta não tenha retornado resultados
    $query_clientes = "SELECT * FROM clientes WHERE login = '{$usuario}' AND senha = '{$senha}' AND status = 'Ativo'";

    $result_clientes = mysqli_query($conexao, $query_clientes);
    $row_clientes = mysqli_num_rows($result_clientes);

    while($data_cli = mysqli_fetch_assoc($result_clientes)){
        $idCliente = $data_cli['id'];
    }

    if ($row_clientes == 1) {
        $_SESSION['clientelogado'] = $usuario;
        $_SESSION['senhaCliente'] = $senha;
        $_SESSION['idCliente'] = $idCliente;
        $_SESSION['logged'] = true;
        header('Location: Cliente/AreaCliente.php');
    } else {
        $_SESSION['erro'] = "Email ou Senha inválidos!";
        header('Location: login.php');
        exit();
    }
}
