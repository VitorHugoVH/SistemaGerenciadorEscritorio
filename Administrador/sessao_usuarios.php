<?php

require("conexao_adm.php");

function verificarAcesso($conn) {
    session_start();
    $logged = $_SESSION['logged'] ?? false;

    if (!$logged) {
        header('Location: /FragaeMelo/Site%20Fraga%20e%20Melo%20BootsTrap/login.php');
        exit();
    }

    $usuario = $_SESSION['usuariologado'];
    $senha = $_SESSION['senhalogado'];

    // Consulta na tabela "usuario"
    $query = "SELECT * FROM usuario WHERE usuario = '{$usuario}' AND senha = '{$senha}' AND status = 'Ativo'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_num_rows($result);

    while($dados_usuario = mysqli_fetch_assoc($result)){
        $idUsuario = $dados_usuario['idusuario']; 
    }

    // Se o usuário for encontrado na tabela "usuario"
    if ($row == 1) {
        // Continua o código normalmente para usuários encontrados na tabela "usuario"
        $_SESSION['logged'] = true;
        $_SESSION['username'] = $usuario;
        $_SESSION['idUsuario'] = $idUsuario;
        return true;
    } else {
        // Consulta na tabela "clientes" para verificar se o cliente existe
        $query_clientes = "SELECT * FROM clientes WHERE login = '{$usuario}' AND senha = '{$senha}'";
        $result_clientes = mysqli_query($conn, $query_clientes);
        $row_clientes = mysqli_num_rows($result_clientes);

        // Se o cliente for encontrado na tabela "clientes"
        if ($row_clientes == 1) {
            // Redireciona o cliente para a página do cliente
            header('Location: /FragaeMelo/Site%20Fraga%20e%20Melo%20BootsTrap/Cliente/index.php');
            exit();
        } else {
            // Usuário ou cliente não encontrado em nenhuma tabela
            $_SESSION['erro'] = "Email ou Senha inválidos!";
            header('Location: login.php');
            exit();
        }
    }
}
