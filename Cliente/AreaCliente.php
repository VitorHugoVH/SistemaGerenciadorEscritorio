<?php

require('./conexao_cliente.php');
require('../Administrador/sessao_usuarios.php');

// VERIFICAÇÃO LOGIN E NÍVEL DE USUÁRIO
verificarAcesso($conn);

$username = $_SESSION['usernameCliente'] ?? '';
$idCliente = $_SESSION['idCliente'] ?? '';

// RECEBER NOME DO CLIENTE

// Defina a consulta SQL para buscar o nome do cliente
$sqlBuscaNomeCliente = "SELECT * FROM clientes WHERE id='$idCliente'";
$resultBuscaNomeCliente = $conn->query($sqlBuscaNomeCliente);

// Verifique se a consulta foi bem-sucedida
if ($resultBuscaNomeCliente === false) {
    die("Erro na consulta: " . $conn->error);
}

// Inicialize a variável $nomeCliente
$nomeCliente = "";

// Obtenha o nome do cliente se a consulta retornar resultados
if ($data_cli = mysqli_fetch_assoc($resultBuscaNomeCliente)) {
    $nomeCliente = $data_cli['nomecliente'];
}

// Consulta SQL principal para buscar processos
if (!empty($_GET['statusfiltro']) && $_GET['statusfiltro'] !== 'Todos') {
    $sql = "SELECT * FROM processo WHERE nomecliente = ? AND privado = '(O cliente poderá visualizar)' AND stat LIKE ?";
    $params = array($nomeCliente, "%" . $_GET['statusfiltro'] . "%");
    $paramTypes = 'ss';
} else {
    $sql = "SELECT * FROM processo WHERE nomecliente = ? AND privado = '(O cliente poderá visualizar)'";
    $params = array($nomeCliente);
    $paramTypes = 's';
}

if (!empty($_GET['buscanome'])) {
    $nome = $_GET['buscanome'];
    $sql .= " AND nomecliente LIKE ?";
    $params[] = "%$nome%";
    $paramTypes .= 's';
}

if (!empty($_GET['termobusca'])) {
    $termo = $_GET['termobusca'];
    $sql .= " AND id LIKE ?";
    $params[] = "%$termo%";
    $paramTypes .= 's';
}

if (!empty($_GET['advogado'])) {
    $nomeadvogado = $_GET['advogado'];
    $sql .= " AND nomeadvogado LIKE ?";
    $params[] = "%$nomeadvogado%";
    $paramTypes .= 's';
}

$sql .= " ORDER BY id ASC";

$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Erro na preparação da consulta: " . $conn->error);
}

// Associe os parâmetros e tipos
$stmt->bind_param($paramTypes, ...$params);

if (!$stmt->execute()) {
    die("Erro na execução da consulta: " . $stmt->error);
}

$result = $stmt->get_result();


/*BUSCAR DADOS PARA OS MODAIS*/

$sqlBuscaModal = "SELECT * FROM clientes WHERE id='$idCliente'";
$resultBuscaModal = $conn->query($sqlBuscaModal);

while($data_usuario = mysqli_fetch_assoc($resultBuscaModal)){

    // Buscar Dados Para o modal Meus Dados

    $nomeUsuario = $data_usuario['nomecliente'];
    $cpfUsuario = $data_usuario['cpf'];
    $emailUsuario = $data_usuario['email1'];
    $telefoneUsuario = $data_usuario['numero1'];
    $profissaoUsuario = $data_usuario['profissao'];
    $cepUsuario = $data_usuario['cep1'];
    $enderecoUsuario = $data_usuario['endereco1'];
    $numeroUsuario = $data_usuario['numerocasa1'];
    $complementoUsuario = $data_usuario['complemento1'];
    $bairroUsuario = $data_usuario['bairro1'];
    $cidadeUsuario = $data_usuario['cidade1'];
    $estadoUsuario = $data_usuario['estado1'];

    // Buscar Dados Para o modal Alterar Login

    $loginUsuario = $data_usuario['login'];
    $senhaCliente = $data_usuario['senha'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../Administrador/estilosAdm.css" />
    <link rel="icon" type="image/x-icon" href="../Administrador/imagensADM/logoadmin.png" />
    <link rel="stylesheet" type="text/css" href="../Administrador/fontawesome/css/all.css" />
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .sidebar::-webkit-scrollbar {
            width: 10px;
        }

        .sidebar::-webkit-scrollbar-track {
            background-color: #fff;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background-color: #4d79ff;
            border-radius: 10px;
            opacity: 0.1;
            /* Define a opacidade da barra de rolagem */
        }

        /*ESTILIZAÇÂO BOTÂO SAIR*/

        /* Estilize o item "Sair" para o estado normal */
        .dropdown-item.btn-logout {
            background-color: transparent;
            color: black;
            transition: background-color 0.3s, color 0.3s;
        }

        /* Efeito de hover para o item "Sair" */
        .dropdown-item.btn-logout:hover {
            background-color: red;
            color: white;
        }

        /*ESTILIZAÇÃO OUTROAS OPÇÕES*/

        .dropdown-item.btn-option {
            background-color: transparent;
            color: black;
            transition: background-color 0.3s, color 0.3s;
        }

        /* Efeito de hover para o item "Sair" */
        .dropdown-item.btn-option:hover {
            background-color: #0769b9;
            color: white;
        }
    </style>
    <title>Fraga e Melo Advogados Associados</title>
</head>

<body>
    <div class="wrapper">
        <div class="section">
            <div class="top_navbar d-flex justify-content-end dropdown">
                <div class="d-flex align-items-center">
                    <i class="fas fa-user-circle fa-2x text-white"></i>
                    <p class="m-0 ms-2" style="font-size: 14px; color: white;"><?php echo $username; ?></p>
                </div>
                <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton" style="z-index: 9999;">
                  <!-- Opções do menu suspenso -->
                  <div style="backgroud-color: gray;"><p style="text-align: center; text-color: white; text-style: bold;">PERFIL</p></div>
                  <li><hr class="dropdown-divider"></li>
                  <a class="dropdown-item btn-option" href="#" data-bs-toggle="modal" data-bs-target="#meusDadosModal">Meus dados</a>
                  <a class="dropdown-item btn-option" href="#" data-bs-toggle="modal" data-bs-target="#meuLoginModal">Alterar login</a>
                  <a class="dropdown-item btn-option" href="#" data-bs-toggle="modal" data-bs-target="#minhaSenhaModal">Alterar senha</a>
                  <!-- Mais opções, se necessário -->
                  <li><hr class="dropdown-divider"></li>
                  <a class="dropdown-item btn-logout" href="../Administrador/sessao_destroy.php">Sair</a>
                </div>
            </div>
            <!--INÍCIO CONTEÚDO-->
            <div class="container">

                <!-- Modal "Meus Dados" -->
                <div class="modal fade" id="meusDadosModal" tabindex="-1" aria-labelledby="meusDadosModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="meusDadosModalLabel">Meus Dados</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <form action="./AlterarDados/meus_dadosCliente.php" method="POST">
                            <div class="campos">
                                <div class="form-group">
                                    <label for="nomeUsuario">Nome</label>
                                    <input name="nomeUsuario" type="text" class="form-control" placeholder="Nome completo" id="nomeUsuario" value="<?php echo $nomeUsuario; ?>">
                                </div>
                            </div>
                            <div class="campos">
                                <label for="numerocpfUsuario">CPF</label>
                                <input name="cpfUsuario" type="text" name="numerocpf" id="numerocpf" class="form-control" placeholder="Número do CPF" maxlength="11" oninput="mascara(this)" value="<?php echo $cpfUsuario; ?>">
                                <script>
                                    function mascara(i) {

                                        var v = i.value;

                                        if (isNaN(v[v.length - 1])) { // impede entrar outro caractere que não seja número
                                            i.value = v.substring(0, v.length - 1);
                                            return;
                                        }

                                        i.setAttribute("maxlength", "14");
                                        if (v.length == 3 || v.length == 7) i.value += ".";
                                        if (v.length == 11) i.value += "-";

                                    }
                                </script>
                            </div>
                            <div class="campos">
                                <label for="emailUsuario">E-mail</label>
                                <input name="emailUsuario" type="email" class="form-control" placeholder="E-mail" id="emailUsuario" value="<?php echo $emailUsuario; ?>">
                            </div>
                            <div class="campos">
                                <label for="telefoneUsuario">Telefone</label>
                                <input name="telefoneUsuario" type="tel" class="form-control phone" placeholder="Telefone" id="telefoneUsuario" data-inputmask="'mask': '(99) 99999-9999'" value="<?php echo $telefoneUsuario; ?>">
                                <script>
                                    $(document).ready(function() {
                                        // Inicialize o inputmask para o campo de telefone
                                        $('.phone').inputmask();
                                    });
                                </script>
                            </div>
                            <div class="campos">
                                <label for="profissaoUsuario">Profissao</label>
                                <input name="profissaoUsuario" type="text" class="form-control" placeholder="" id="profissaoUsuario" value="<?php echo $profissaoUsuario; ?>">
                            </div>
                            <div class="campos">
                                <label for="cepUsuario">CEP</label>
                                <input name="cepUsuario" type="text" class="form-control" placeholder="" id="cepUsuario" value="<?php echo $cepUsuario; ?>">
                                <script>
                                    $(document).ready(function() {
                                    // Aplica a máscara de CEP no campo de CEP
                                    $('#cepUsuario').inputmask('99999-999');
                                    });
                                </script>
                            </div>
                            <div class="campos">
                                <label for="enderecoUsuario">Endereço</label>
                                <input name="enderecoUsuario" type="text" class="form-control" placeholder="" id="enderecoUsuario" value="<?php echo $enderecoUsuario; ?>">
                            </div>
                            <div class="campos">
                                <label for="numeroUsuario">Número</label>
                                <input name="numeroUsuario" type="number" class="form-control" placeholder="" id="numeroUsuario" value="<?php echo $numeroUsuario; ?>">
                            </div>
                            <div class="campos">
                                <label for="complementoUsuario">Complemento</label>
                                <input name="complementoUsuario" type="text" class="form-control" placeholder="" id="complementoUsuario" value="<?php echo $complementoUsuario; ?>">
                            </div>
                            <div class="campos">
                                <label for="bairroUsuario">Bairro</label>
                                <input name="bairroUsuario" type="text" class="form-control" placeholder="" id="bairroUsuario" value="<?php echo $bairroUsuario; ?>">
                            </div>
                            <div class="campos">
                                <label for="cidadeUsuario">Cidade</label>
                                <input name="cidadeUsuario" type="text" class="form-control" placeholder="" id="cidadeUsuario" value="<?php echo $cidadeUsuario; ?>">
                            </div>
                            <div class="campos">
                                <label for="estadoUsuario">Estado</label>
                                <input name="estadoUsuario" type="text" class="form-control" placeholder="" id="estadoUsuario" value="<?php echo $estadoUsuario; ?>">
                            </div>
                            <input type="hidden" value="<?php echo $idCliente; ?>" name="idCliente">
                            </div>
                            <div class="modal-footer">
                                <div class="final">
                                    <div class="row">
                                        <div class="col-6">
                                            <div id="salvar">
                                                <a href="AreaCliente.php"><button type="button" class="btn btn-outline-secondary" id="voltar2">Voltar</button></a>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div id="voltar">
                                                <a href="advogados_insert.php"><button type="submit" class="btn btn-success" name="salvar" id="salvar">Salvar</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>

                <!-- Modal "Alterar Login" -->
                <div class="modal fade" id="meuLoginModal" tabindex="-1" aria-labelledby="meuLoginModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="meuLoginModalLabel">Alterar login</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="./AlterarDados/meu_loginCliente.php" method="POST">
                                    <input type="hidden" name="idCliente" value="<?php echo $idCliente ?>">
                                    <input type="hidden" name="senhaCliente" value="<?php echo $senhaCliente ?>">
                                    <div class="campos">
                                        <label for="usuario">Novo login</label>
                                        <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Login usuário" value="<?php echo $loginUsuario ?>" required>
                                    </div>
                                    <div class="campos">
                                    <label for="senha">Senha atual</label>
                                        <div class="input-group">
                                            <input type="password" name="senha" id="senha" class="form-control" placeholder="Senha" required>
                                            <div class="input-group-append" name="notview" id="notview" style="display: block;">
                                                <a class='btn btn-sm btn-primary' onclick="view()">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="30" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16">
                                                        <path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z" />
                                                        <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z" />
                                                    </svg>
                                                </a>
                                            </div>
                                            <div class="input-group-append" name="view" id="view" style="display: none;">
                                                <a class='btn btn-sm btn-primary' onclick="notview()">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="30" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                        <script>
                                            function view() {
                                                document.getElementById('senha').type = 'text';
                                                document.getElementById('notview').style.display = 'none';
                                                document.getElementById('view').style.display = 'block';
                                            }

                                            function notview() {
                                                document.getElementById('senha').type = 'password';
                                                document.getElementById('notview').style.display = 'block';
                                                document.getElementById('view').style.display = 'none';
                                            }
                                        </script>
                                    </div>
                                    <div class="modal-footer">
                                    <div class="final">
                                        <div class="row">
                                            <div class="col-6">
                                                <div id="salvar">
                                                    <a href="AreaCliente.php"><button type="button" class="btn btn-outline-secondary" id="voltar2">Voltar</button></a>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div id="voltar">
                                                    <a href="../MeusDados/meu_login.php"><button type="submit" class="btn btn-success" name="enviar" id="enviar">Salvar</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal "Alterar Senha" -->
                <div class="modal fade" id="minhaSenhaModal" tabindex="-1" aria-labelledby="minhaSenhaModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="minhaSenhaModal">Alterar senha</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="../MeusDados/minha_senha.php" method="POST" id="formMinhaSenha">
                                    <input type="hidden" name="idCliente" value="<?php echo $idCliente ?>">
                                    <input type="hidden" name="senhaCliente" value="<?php echo $senhaCliente ?>">
                                    <div class="campos">
                                        <label for="senhaAtual">Senha atual</labeL>
                                        <input type="password" name="senhaAtual" id="senhaAtual" class="form-control" placeholder="Senha atual" required>
                                    </div>
                                    <div class="campos">
                                        <label for="novaSenha">Nova senha</labeL>
                                        <div class="input-group">
                                            <input type="password" name="novaSenha" id="novaSenha" class="form-control" placeholder="Nova senha" required>
                                            <div class="input-group-append" name="naover" id="naover" style="display: block;">
                                                <a class='btn btn-sm btn-primary' onclick="ver()">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="30" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16">
                                                        <path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z" />
                                                        <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z" />
                                                    </svg>
                                                </a>
                                            </div>
                                            <div class="input-group-append" name="ver" id="ver" style="display: none;">
                                                <a class='btn btn-sm btn-primary' onclick="naover()">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="30" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                        <script>
                                            function ver() {
                                                document.getElementById('novaSenha').type = 'text';
                                                document.getElementById('naover').style.display = 'none';
                                                document.getElementById('ver').style.display = 'block';
                                            }

                                            function naover() {
                                                document.getElementById('novaSenha').type = 'password';
                                                document.getElementById('naover').style.display = 'block';
                                                document.getElementById('ver').style.display = 'none';
                                            }
                                        </script>
                                    </div>
                                    <div class="campos">
                                        <label for="confirmarSenha">Confirmar senha</labeL>
                                        <div class="input-group">
                                            <input type="password" name="confirmarSenha" id="confirmarSenha" class="form-control" placeholder="Confirmar senha" required>
                                            <div class="input-group-append" name="naover2" id="naover2" style="display: block;">
                                                <a class='btn btn-sm btn-primary' onclick="ver2()">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="30" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16">
                                                        <path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z" />
                                                        <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z" />
                                                    </svg>
                                                </a>
                                            </div>
                                            <div class="input-group-append" name="ver2" id="ver2" style="display: none;">
                                                <a class='btn btn-sm btn-primary' onclick="naover2()">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="30" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                        <script>
                                            function ver2() {
                                                document.getElementById('confirmarSenha').type = 'text';
                                                document.getElementById('naover2').style.display = 'none';
                                                document.getElementById('ver2').style.display = 'block';
                                            }

                                            function naover2() {
                                                document.getElementById('confirmarSenha').type = 'password';
                                                document.getElementById('naover2').style.display = 'block';
                                                document.getElementById('ver2').style.display = 'none';
                                            }
                                            function validatePasswords() {
                                                var novaSenha = document.getElementById("novaSenha").value;
                                                var confirmarSenha = document.getElementById("confirmarSenha").value;

                                                if (novaSenha !== confirmarSenha) {
                                                    alert("As senhas não coincidem!");
                                                    return false; 
                                                }
                                                return true;
                                            }
                                        </script>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="final">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div id="salvar">
                                                        <a href="AreaCliente.php"><button type="button" class="btn btn-outline-secondary" id="voltar2">Voltar</button></a>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div id="voltar">
                                                        <button type="submit" class="btn btn-success" name="send" id="send" onclick="return validatePasswords();">Salvar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-10">
                        <div class="bloco3">
                            <h3 class="text-muted">Processos</h3>
                            <?php

                                $sqlqT = "SELECT * FROM processo WHERE nomecliente='$nomeCliente' AND privado='(O cliente poderá visualizar)'";
                                $resultqT = $conn->query($sqlqT);

                                if (!$resultqT) {
                                    die("Erro na consulta: " . $conn->error);
                                }

                                $quantidade = 0;
                                while ($qt = mysqli_fetch_assoc($resultqT)) {
                                    $quantidade += 1;
                                }

                            ?>
                            <small class="text-muted">Exibindo <?php echo $quantidade; ?> resultado(s)</small>
                            <small class="text-muted">
                                <div class="mb-4">
                                    <img src="../Administrador/imagensADM/verde.png" alt="ativo" style="width: 1%;">ativo
                                    <img src="../Administrador/imagensADM/azul.png" alt="ativo" style="width: 1%;">suspenso
                                    <img src="../Administrador/imagensADM/cinza.png" alt="ativo" style="width: 1%;">baixado
                                </div>
                            </small>
                        </div>
                    </div>
                </div>
                <div class="bloco">
                    <form action="" method="GET">
                        <div class="row">
                            <div class="col-3">
                                <p>Status</p>
                                <select class="form-select" aria-label="Default select example" name="statusfiltro" id="statusfiltro">
                                    <option value="Todos" selected>Ver todos os processos</option>
                                    <option value="Ativo">Ver apenas os ativos</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <p>Filtrar</p>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="Nome do cliente" name="buscanome">
                                </div>
                            </div>
                            <div class="col-3">
                                <p>Nº Processo</p>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Número do processo" aria-label="Recipient's username" aria-describedby="basic-addon2" name="termobusca">
                                </div>
                            </div>
                            <div class="col-3">
                                <p>Buscar</p>
                                <div class="input-group mb-3">
                                    <button class="btn btn-outline-secondary" type="submit" style=" width: 100%;">Localizar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="bloco">
                    <div class="table-responsive">
                        <table class="table" style="white-space: nowrap;">
                            <thead>
                                <tr>
                                    <th scope="col">#ID</th>
                                    <th scope="col">Satus</th>
                                    <th scope="col">Fase</th>
                                    <th scope="col">Cliente</th>
                                    <th scope="col">Advogado</th>
                                    <th scope="col">Natureza da Ação</th>
                                    <th scope="col">Opção</th>
                                </tr>
                            </thead>
                            <tbody style="white-space: nowrap;">
                                <?php
                                while ($user_data = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<th scope='row'>" . $user_data['id'] . "</td>";

                                    if ($user_data['stat'] == 'Baixado') {
                                        $url_imagem = '../Administrador/imagensADM/cinza.png';
                                    } elseif ($user_data['stat'] == 'Suspenso') {
                                        $url_imagem = '../Administrador/imagensADM/azul.png';
                                    } elseif ($user_data['stat'] == 'Ativo') {
                                        $url_imagem = '../Administrador/imagensADM/verde.png';
                                    }

                                    echo "<td>" . "<img src='$url_imagem' style='width: 0.5em; margin-right: 5%;'>" . $user_data['stat'] . "</td>";
                                    echo "<td>" . $user_data['fase'] . "</td>";
                                    echo "<td>" . $user_data['nomecliente'] . "</td>";
                                    echo "<td>" . $user_data['nomeadvogado'] . "</td>";
                                    echo "<td>" . $user_data['natureza'] . "</td>";
                                    echo "  <td>
                                            <a class='btn btn-sm btn-secondary' href='processos_view.php?id=$user_data[id]'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-folder-fill' viewBox='0 0 16 16'>
                                                    <path d='M9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.825a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3zm-8.322.12C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139z'/>
                                                </svg>
                                            </a>
                                        </td>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--INÍCIO NAVEGAÇÃO-->
        <div class="sidebar" style="overflow-y: auto;">
            <div class="profile">
                <img src="../Administrador/imagensADM/logoadmin.png" alt="profile_picture" width="35%">
                <h3>Advocacia</h3>
                <p>Fraga e Melo Advogados</p>
            </div>
            <ul class="lista">
                <li>
                    <a href="processos.php" class="active">
                        <span class="icon"><i class="fas fa-scale-balanced"></i></span>
                        <span class="item">Processos</span>
                    </a>
                </li>
            </ul>
        </div>
        <!--FIM NAVEGAÇÃO-->
</body>
<script>
    function confirma(id) {
        if (confirm("Deseja realmente excluir este processo?")) {
            location.href = "processos_delete.php?id=" + id;
        } else {
            // O usuário clicou em "Cancelar", então não fazemos nada.
        }
    }
</script>

</html>