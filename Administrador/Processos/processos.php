<?php

include_once('../conexao_adm.php');
require('../sessao_usuarios.php');

// VERIFICAÇÃO LOGIN E NÍVEL DE USUÁRIO
verificarAcesso($conn);

$username = $_SESSION['username'] ?? '';
$idUsuario = $_SESSION['idUsuario'] ?? '';


include_once('../conexao_adm.php');
$sql = "SELECT * FROM processo ORDER BY id ASC";

if (!empty($_GET['statusfiltro'])) {
    $stat = $_GET['statusfiltro'];
    if ($stat == "Ativo") {
        $sql = "SELECT * FROM processo WHERE stat LIKE '%$stat%' ORDER BY id ASC";
    } else {
        $sql = "SELECT * FROM processo ORDER BY id ASC";
    }
}
if (!empty($_GET['buscanome'])) {
    $nome = $_GET['buscanome'];
    $sql = "SELECT * FROM processo WHERE nomecliente LIKE '%$nome%' ORDER BY id ASC";
}
if (!empty($_GET['termobusca'])) {
    $termo = $_GET['termobusca'];
    $sql = "SELECT * FROM processo WHERE id LIKE '%$termo%'";
}
if (!empty($_GET['advogado'])) {
    $nomeadvogado = $_GET['advogado'];
    $sql = "SELECT * FROM processo WHERE nomeadvogado LIKE '%$nomeadvogado%'";
}
$result = $conn->query($sql);


/*BUSCAR DADOS PARA OS MODAIS*/

$sqlBuscaModal = "SELECT * FROM usuario WHERE idusuario='$idUsuario'";
$resultBuscaModal = $conn->query($sqlBuscaModal);

while($data_usuario = mysqli_fetch_assoc($resultBuscaModal)){

    // Buscar Dados Para o modal Meus Dados

    $nomeUsuario = $data_usuario['nome'];
    $cpfUsuario = $data_usuario['cpf'];
    $emailUsuario = $data_usuario['email1'];
    $telefoneUsuario = $data_usuario['telefone1'];
    $profissaoUsuario = $data_usuario['profissao'];
    $cepUsuario = $data_usuario['cep1'];
    $enderecoUsuario = $data_usuario['endereco1'];
    $numeroUsuario = $data_usuario['numerocasa1'];
    $complementoUsuario = $data_usuario['complemento1'];
    $bairroUsuario = $data_usuario['bairro1'];
    $cidadeUsuario = $data_usuario['cidade1'];
    $estadoUsuario = $data_usuario['estado1'];

    // Buscar Dados Para o modal Alterar Login

    $loginUsuario = $data_usuario['usuario'];
    $senhaUsuario = $data_usuario['senha'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../estilosAdm.css" />
    <link rel="icon" type="image/x-icon" href="imagens/icon.png" />
    <link rel="stylesheet" type="text/css" href="../fontawesome/css/all.css" />
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
                  <a class="dropdown-item btn-logout" href="../sessao_destroy.php">Sair</a>
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
                        <form action="../MeusDados/meus_dados.php" method="POST">
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
                                <input name="telefoneUsuario" type="tel" class="form-control phone" placeholder="Telefone" id="telefoneUsuario" data-inputmask="'mask': '(99) 99999-9999'" value="<?php echo $emailUsuario; ?>">
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
                            <input type="hidden" value="<?php echo $idUsuario; ?>" name="idUsuario">
                            </div>
                            <div class="modal-footer">
                                <div class="final">
                                    <div class="row">
                                        <div class="col-6">
                                            <div id="salvar">
                                                <a href="admin.php"><button type="button" class="btn btn-outline-secondary" id="voltar2">Voltar</button></a>
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
                                <form action="../MeusDados/meu_login.php" method="POST">
                                    <input type="hidden" name="idUsuario" value="<?php echo $idUsuario ?>">
                                    <input type="hidden" name="senhaUsuario" value="<?php echo $senhaUsuario ?>">
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
                                                    <a href="admin.php"><button type="button" class="btn btn-outline-secondary" id="voltar2">Voltar</button></a>
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
                                    <input type="hidden" name="idUsuario" value="<?php echo $idUsuario ?>">
                                    <input type="hidden" name="senhaUsuario" value="<?php echo $senhaUsuario ?>">
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
                                                } else {
                                                    // Agora você pode enviar o formulário manualmente
                                                    document.getElementById("formMinhaSenha").submit();
                                                }
                                            }
                                        </script>
                                    </div>
                                    <div class="modal-footer">
                                    <div class="final">
                                        <div class="row">
                                            <div class="col-6">
                                                <div id="salvar">
                                                    <a href="admin.php"><button type="button" class="btn btn-outline-secondary" id="voltar2">Voltar</button></a>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div id="voltar">
                                                    <a href="#"><button type="submit" class="btn btn-success" name="send" id="send" onclick="validatePasswords()">Salvar</button></a>
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
                            include_once('../conexao_adm.php');

                            $sqlqT = "SELECT * FROM processo";
                            $resultqT = $conn->query($sqlqT);

                            $quantidade = 0;
                            while ($qt = mysqli_fetch_assoc($resultqT)) {
                                $quantidade += 1;
                            }
                            ?>
                            <small class="text-muted">Exibindo <?php echo $quantidade; ?> resultado(s)</small>
                            <small class="text-muted">
                                <div class="mb-4">
                                    <img src="../imagensADM/verde.png" alt="ativo" style="width: 1%;">ativo
                                    <img src="../imagensADM/azul.png" alt="ativo" style="width: 1%;">suspenso
                                    <img src="../imagensADM/cinza.png" alt="ativo" style="width: 1%;">baixado
                                </div>
                            </small>
                        </div>
                    </div>
                    <div class="col-2">
                        <div id="enviar">
                            <a href="processos_add1.php"><button type="button" class="btn btn-success" id='add1'>Adicionar</button></a>
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
                                        $url_imagem = '../imagensADM/cinza.png';
                                    } elseif ($user_data['stat'] == 'Suspenso') {
                                        $url_imagem = '../imagensADM/azul.png';
                                    } elseif ($user_data['stat'] == 'Ativo') {
                                        $url_imagem = '../imagensADM/verde.png';
                                    }

                                    echo "<td>" . "<img src='$url_imagem' style='width: 0.5em; margin-right: 5%;'>" . $user_data['stat'] . "</td>";
                                    echo "<td>" . $user_data['fase'] . "</td>";
                                    echo "<td>" . $user_data['nomecliente'] . "</td>";
                                    echo "<td>" . $user_data['nomeadvogado'] . "</td>";
                                    echo "<td>" . $user_data['natureza'] . "</td>";
                                    echo "  <td>
                                            <a class='btn btn-sm btn-primary' href='processos_edit.php?id=$user_data[id]'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                                                    <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/>
                                                </svg>
                                            </a>
                                            <a class='btn btn-sm btn-danger' href='processos_delete.php?id=$user_data[id]' onclick='confirma()'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                                    <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                                                </svg>
                                            </a>
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
                <img src="../imagensADM/logoadmin.png" alt="profile_picture" width="35%">
                <h3>Advocacia</h3>
                <p>Fraga e Melo Advogados</p>
            </div>
            <ul class="lista">
                <li>
                    <a class="links" href="../Deashboard/admin.php">
                        <span class="icon"><i class="fas fa-desktop"></i></span>
                        <span class="item">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="processos.php" class="active">
                        <span class="icon"><i class="fas fa-scale-balanced"></i></span>
                        <span class="item">Processos</span>
                    </a>
                </li>
                <div class="dropdown">
                    <li>
                        <a class="links">
                            <span class="icon"><i class="fas fa-calendar-days"></i></span>
                            <span class="item">Agenda</span>
                            <svg xmlns="http://www.w3.org/2000/svg" style="margin-left: 40%;" width="16" height="13" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                            </svg>
                        </a>
                    </li>
                    <div class="dropdown-content">
                        <li>
                            <a href="../Agenda/Compromissos/agenda_compromissos.php" class="links" style="width: 100%;">
                                <span class="item2" style="margin-left: 15%;">Compromissos</span>
                            </a>
                        </li>
                        <li>
                            <a href="../Agenda/Tarefas/agenda_tarefas.php" class="links">
                                <span class="item2" style="margin-left: 15%; width: 100%;">Tarefas</span>
                            </a>
                        </li>
                        <li>
                            <a href="../Agenda/Prazos/agenda_prazos.php" class="links">
                                <span class="item2" style="margin-left: 15%;">Prazos</span>
                            </a>
                        </li>
                    </div>
                </div>
                <div class="dropdown">
                    <li>
                        <a href="#" class="links">
                            <span class="icon"><i class="fas fa-dollar-sign"></i></span>
                            <span class="item">Financeiro</span>
                            <svg xmlns="http://www.w3.org/2000/svg" style="margin-left: 27%;" width="16" height="13" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                            </svg>
                        </a>
                    </li>
                    <div class="dropdown-content">
                        <li>
                            <a href="../Financeiro/Despesas/despesas.php" class="links" style="width: 100%;">
                                <span class="item2" style="margin-left: 15%;">Despesas</span>
                            </a>
                        </li>
                        <li>
                            <a href="../Financeiro/Receitas/receitas.php" class="links">
                                <span class="item2" style="margin-left: 15%; width: 100%;">Receitas</span>
                            </a>
                        </li>
                    </div>
                </div>
                <div class="dropdown">
                    <li>
                        <a href="#" class="links">
                            <span class="icon"><i class="fas fa-users"></i></span>
                            <span class="item">Equipe</span>
                            <svg xmlns="http://www.w3.org/2000/svg" style="margin-left: 41%;" width="16" height="13" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                            </svg>
                        </a>
                    </li>
                    <div class="dropdown-content">
                        <li>
                            <a href="../Equipe/Clientes/clientes.php" class="links" style="width: 100%;">
                                <span class="item2" style="margin-left: 15%;">Clientes</span>
                            </a>
                        </li>
                        <li>
                            <a href="../Equipe/Advogados/advogados.php" class="links" style="width: 100%;">
                                <span class="item2" style="margin-left: 15%;">Advogados</span>
                            </a>
                        </li>
                    </div>
                </div>
                <div class="dropdown">
                    <li>
                        <a href="#" class="links">
                            <span class="icon"><i class="fas fa-file"></i></span>
                            <span class="item">Arquivos</span>
                            <svg xmlns="http://www.w3.org/2000/svg" style="margin-left: 32%;" width="16" height="13" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                            </svg>
                        </a>
                    </li>
                    <div class="dropdown-content">
                        <li>
                            <a href="../Arquivos/Procuracoes/procuracoes.php" class="links" style="width: 100%;">
                                <span class="item2" style="margin-left: 15%;">Procuração</span>
                            </a>
                        </li>
                        <li>
                            <a href="../Arquivos/Declaracoes/declaracoes.php" class="links" style="width: 100%;">
                                <span class="item2" style="margin-left: 15%;">Declaração</span>
                            </a>
                        </li>
                        <li>
                            <a href="../Arquivos/Contratos/contratos.php" class="links" style="width: 100%;">
                                <span class="item2" style="margin-left: 15%;">Contrato</span>
                            </a>
                        </li>
                    </div>
                </div>
            </ul>
        </div>
        <!--FIM NAVEGAÇÃO-->
</body>
<script>
    function confirma(id) {
        if (confirm("Deseja realmente excluir este processo?")) {
            location.href = "processos_delete.php?id=" + id;
        }
    }
</script>

</html>