<?php

include_once('../conexao_adm.php');
require('../sessao_usuarios.php');

// VERIFICAÇÃO LOGIN E NÍVEL DE USUÁRIO
verificarAcesso($conn);

$username = $_SESSION['username'] ?? '';
$idUsuario = $_SESSION['idUsuario'] ?? '';

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
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../estilosAdm.css" />
    <link rel="icon" type="image/x-icon" href="../imagensADM/logoadmin.png" />
    <link rel="stylesheet" type="text/css" href="../fontawesome/css/all.css" />
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Fraga e Melo Advogados Associados</title>
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
</head>
<?php
include_once '../conexao_adm.php';
$id = $_GET['id'];
$sql = "SELECT * FROM processo WHERE id=$id";
$rs = mysqli_query($conn, $sql);
$linha = mysqli_fetch_array($rs);

$numeroProcesso = $linha['nprocesso'];
$nomePrimeiroAdvogado = $linha['nomeadvogado'];
$nomeSegundoAdvogado = $linha['segundoAdvogado'];
$nomeTerceiroAdvogado = $linha['terceiroAdvogado'];
$nomeCliente = $linha['nomecliente'];

?>
<?php
include 'C:\xampp\htdocs\FragaeMelo\Site Fraga e Melo BootsTrap\config.php';

$sql2 = "SELECT * FROM usuario WHERE idusuario=$id";
$rs2 = mysqli_query($conn, $sql2);
$linha2 = mysqli_fetch_array($rs2);
?>

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
            <div class="container" id='main'>

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
                                                        <a href="admin.php"><button type="button" class="btn btn-outline-secondary" id="voltar2">Voltar</button></a>
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
                            <h3 class="text-muted">Relatório de Processos</h3>
                        </div>
                    </div>
                    <div class="col-2">
                        <div id="voltar">
                            <a href="processos.php"><button type="button" class="btn btn-secondary"
                                    id='voltar1'>Volar</button></a>
                        </div>
                    </div>
                </div>
                <div class="bloco4">
                    <form action="processos_create.php" method="POST" target="_blank">
                        <div class="row">
                            <div class="col-5">
                                <div class="bloco03">
                                    <h3 class="txt">Relatório</h3>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <p id="txti">Processo Nº <?php echo $linha['nprocesso']; ?></p>
                        </div>
                        <div class="row">
                            <hr style="border-color:#aaaaaa !important;">
                        </div>
                        <div class="row">
                            <table class="table table-bordered">
                                <thead class="tabelarelatorio">
                                    <div class="row">
                                        <tr>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <input type="checkbox" class="form-check-input" id="customCheck1"
                                                    name="statusProcesso" value="on" checked>
                                            </td>
                                            <td class="custom-control">Satus processo</td>
                                            <td class="custom-control"><?php echo $linha['stat']; ?></td>
                                        </tr>
                                    </div>
                                    <div class="row">
                                        <tr>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <input type="checkbox" class="form-check-input" id="customCheck2"
                                                    name="faseProcesso" value="on" checked>
                                            </td>
                                            <td class="custom-control">Fase Processo</td>
                                            <td class="custom-control"><?php echo $linha['fase']; ?></td>
                                        </tr>
                                    </div>
                                    <div class="row">
                                        <tr>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <input type="checkbox" class="form-check-input" id="customCheck3"
                                                    name="poderProcesso" value="on" checked>
                                            </td>
                                            <td class="custom-control">Poder judiciário</td>
                                            <td class="custom-control"><?php echo $linha['poderjudiciario']; ?></td>
                                        </tr>
                                    </div>
                                    <div class="row">
                                        <tr>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <input type="checkbox" class="form-check-input" id="customCheck4"
                                                    name="classeProcesso" value="on" checked>
                                            </td>
                                            <td class="custom-control">Classe processual</td>
                                            <td class="custom-control"><?php echo $linha['classe']; ?></td>
                                        </tr>
                                    </div>
                                    <div class="row">
                                        <tr>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <input type="checkbox" class="form-check-input" id="customCheck5"
                                                    name="naturezaProcesso" value="on" checked>
                                            </td>
                                            <td class="custom-control">Natureza da Ação</td>
                                            <td class="custom-control"><?php echo $linha['natureza']; ?></td>
                                        </tr>
                                    </div>
                                    <div class="row">
                                        <tr>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <input type="checkbox" class="form-check-input" id="customCheck6"
                                                    name="ritoProcesso" value="on" checked>
                                            </td>
                                            <td class="custom-control">Rito</td>
                                            <td class="custom-control"><?php echo $linha['ritoProcesso']; ?></td>
                                        </tr>
                                    </div>
                                    <div class="row">
                                        <tr>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <input type="checkbox" class="form-check-input" id="customCheck7"
                                                    name="varaProcesso" value="on" checked>
                                            </td>
                                            <td class="custom-control">Vara do processo</td>
                                            <td class="custom-control"><?php echo $linha['numerovara'] . ' - ' . $linha['nomedavara']; ?></td>
                                        </tr>
                                    </div>
                                    <div class="row">
                                        <tr>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <input type="checkbox" class="form-check-input" id="customCheck8"
                                                    name="comarcaProcesso" value="on" checked>
                                            </td>
                                            <td class="custom-control">Nome da comarca</td>
                                            <td class="custom-control"><?php echo $linha['nomedacomarca']; ?></td>
                                        </tr>
                                    </div>
                                    <div class="row">
                                        <tr>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <input type="checkbox" class="form-check-input" id="customCheck9"
                                                    name="valorCausaProcesso" value="on" checked>
                                            </td>
                                            <td class="custom-control">Valor da causa</td>
                                            <td class="custom-control"><?php echo $linha['valorCausa']; ?></td>
                                        </tr>
                                    </div>
                                    <!-- INÍCIO FORMATAÇÃO DATA BRASIL-->
                                    <?php
                                    $data = $linha['dataa'];
                                    
                                    $dataformatada = date('d/m/Y', strtotime($data));
                                    ?>
                                    <!-- FIM FORMATAÇÃO DATA BRASIL-->
                                    <div class="row">
                                        <tr>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <input type="checkbox" class="form-check-input" id="customCheck10"
                                                    name="aberturaProcesso" value="on" checked>
                                            </td>
                                            <td class="custom-control">Data de abertura</td>
                                            <td class="custom-control"><?php echo $dataformatada; ?></td>
                                        </tr>
                                    </div>
                                    <div class="row">
                                        <tr>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <input type="checkbox" class="form-check-input" id="customCheck11"
                                                    name="valorHonorarioProcesso" value="on" checked>
                                            </td>
                                            <td class="custom-control">Valor honorário</td>
                                            <td class="custom-control"><?php echo $linha['valorHonorario']; ?></td>
                                        </tr>
                                    </div>
                                    <div class="row">
                                        <tr>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <input type="checkbox" class="form-check-input" id="customCheck12"
                                                    name="parcelasProcesso" value="on" checked>
                                            </td>
                                            <td class="custom-control">Nº Parcelas</td>
                                            <td class="custom-control"><?php echo $linha['parcelas'] . ' parcelas'; ?></td>
                                        </tr>
                                    </div>
                                    <div class="row">
                                        <tr>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <input type="checkbox" class="form-check-input" id="customCheck13"
                                                    name="observacoesProcesso" value="on" checked>
                                            </td>
                                            <td class="custom-control">Observações</td>
                                            <td class="custom-control"><?php echo $linha['observacoes']; ?></td>
                                        </tr>
                                    </div>
                                </thead>
                            </table>
                        </div>
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" style="white-space: nowrap;">
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td>Nome</td>
                                            <td>Telefone</td>
                                            <td>E-mail</td>
                                        </tr>
                                        <tr>
                                            <th>Cliente (<?php echo $linha['posicaocliente']; ?>)</th>
                                            <td><?php echo $linha['nomecliente'];
                                            $nome = $linha['nomecliente']; ?></td>
                                            <?php
                                            include_once '../conexao_adm.php';
                                            
                                            $sqlcliente = "SELECT * FROM clientes WHERE nomecliente='$nome'";
                                            $resultcliente = $conn->query($sqlcliente);
                                            
                                            while ($data_client = mysqli_fetch_assoc($resultcliente)) {
                                                echo '<td>' . '(' . $data_client['ddd1'] . ')' . $data_client['numero1'] . '</td>';
                                                echo '<td>' . $data_client['email1'] . '</td>';
                                            }
                                            ?>
                                        </tr>
                                        <tr>
                                            <th>Advogado</th>
                                            <td><?php echo $linha['nomeadvogado']; ?></td>
                                            <?php
                                            include_once '../conexao_adm.php';
                                            
                                            $advogado = $linha['nomeadvogado'];
                                            $advogado = explode('-', $advogado);
                                            $nomeAdvogado = trim($advogado[0]);
                                            
                                            $sqlAdvogado = "SELECT * FROM usuario WHERE nome='$nomeAdvogado'";
                                            $resultAdvogado = $conn->query($sqlAdvogado);
                                            
                                            while ($dados = mysqli_fetch_assoc($resultAdvogado)) {
                                                echo '<td>' . $dados['telefone1'] . '</td>';
                                                echo '<td>' . $dados['email1'] . '</td>';
                                            }
                                            ?>
                                        </tr>

                                        <!--VERIFICAÇÃO SEGUNDO ADVOGADO-->

                                        <input type="hidden" name="nomesegundoAdvogado" id="nomesegundoAdvogado"
                                            value="<?php echo $linha['segundoAdvogado']; ?>">

                                        <script>
                                            document.addEventListener("DOMContentLoaded", function() {
                                                var valor = document.getElementById("nomesegundoAdvogado").value;
                                                var trElement = document.getElementById("segundoAdvogadoRow");

                                                if (valor == 'Não consta') {
                                                    trElement.style.display = "none";
                                                } else {
                                                    trElement.style.display = "table-row";
                                                }
                                            });
                                        </script>

                                        <!--VERIFICAÇÃO SEGUNDO ADVOGADO-->

                                        <tr id="segundoAdvogadoRow">
                                            <th>Advogado</th>
                                            <td><?php echo $linha['segundoAdvogado']; ?></td>
                                            <?php
                                            $segundoAdvogado = $linha['segundoAdvogado'];
                                            $segundoAdvogado = explode('-', $segundoAdvogado);
                                            $nomeSegundoAdvogado = trim($segundoAdvogado[0]);
                                            
                                            $sqlSegundoAdvogado = "SELECT * FROM usuario WHERE nome='$nomeSegundoAdvogado'";
                                            $resultSegundoAdvogado = $conn->query($sqlSegundoAdvogado);
                                            
                                            while ($dados2 = mysqli_fetch_assoc($resultSegundoAdvogado)) {
                                                echo '<td>' . $dados2['telefone1'] . '</td>';
                                                echo '<td>' . $dados2['email1'] . '</td>';
                                            }
                                            ?>
                                        </tr>

                                        <!--VERIFICAÇÃO TERCEIRO ADVOGADO-->

                                        <input type="hidden" name="nometerceiroAdvogado" id="nometerceiroAdvogado"
                                        value="<?php echo $linha['terceiroAdvogado']; ?>">

                                    <script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                            var valor = document.getElementById("nometerceiroAdvogado").value;
                                            var trElement = document.getElementById("terceiroAdvogadoRow");

                                            if (valor == 'Não consta') {
                                                trElement.style.display = "none";
                                            } else {
                                                trElement.style.display = "table-row";
                                            }
                                        });
                                    </script>

                                    <!--VERIFICAÇÃO TERCEIRO ADVOGADO-->

                                    <tr id="terceiroAdvogadoRow">
                                        <th>Advogado</th>
                                        <td><?php echo $linha['terceiroAdvogado']; ?></td>
                                        <?php
                                        $terceiroAdvogado = $linha['terceiroAdvogado'];
                                        $terceiroAdvogado = explode('-', $terceiroAdvogado);
                                        $nomeTerceiroAdvogado = trim($terceiroAdvogado[0]);
                                        
                                        $sqlTerceiroAdvogado = "SELECT * FROM usuario WHERE nome='$nomeTerceiroAdvogado'";
                                        $resultTerceiroAdvogado = $conn->query($sqlTerceiroAdvogado);
                                        
                                        while ($dados3 = mysqli_fetch_assoc($resultTerceiroAdvogado)) {
                                            echo '<td>' . $dados3['telefone1'] . '</td>';
                                            echo '<td>' . $dados3['email1'] . '</td>';
                                        }
                                        ?>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!--VERIFICAÇÃO TABELA COMPROMISSO---->
                        <?php
                            $sqlVerificarCompromisso = "SELECT COUNT(*) AS count FROM compromisso WHERE processo='$id'";
                            $resultVerificarCompromisso = $conn->query($sqlVerificarCompromisso);
                            $rowVerificarCompromisso = $resultVerificarCompromisso->fetch_assoc();
                            $countCompromissos = $rowVerificarCompromisso['count'];
                        ?>
                         <!--VERIFICAÇÃO TABELA COMPROMISSO---->

                        <?php if ($countCompromissos >= 1): ?>
                            <div class="compromissos" style="margin-top: 3%; display: block;">
                                <div class="row">
                                    <p id="txti"><b>Compromissos</b></p>
                                </div>
                                <div class="row">
                                    <hr style="border-color:#aaaaaa !important;">
                                </div>
                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" style="white-space: nowrap;">
                                            <tbody>
                                                <tr>
                                                    <td><strong>Protocolo</strong></td>
                                                    <td><strong>Data</strong></td>
                                                    <td><strong>Compromisso com</strong></td>
                                                    <td><strong>Classificação</strong></td>
                                                    <td><strong>Descrição</strong></td>
                                                </tr>
                                                <?php
                                                    $sqlCompromisso = "SELECT * FROM compromisso WHERE processo='$id'";
                                                    $resultCompromisso = $conn->query($sqlCompromisso);

                                                    while($data_comp = mysqli_fetch_assoc($resultCompromisso)){
                                                        echo '<tr>';
                                                        echo '<td>'. $data_comp['id'] .'</td>';
                                                        echo '<td>'. $data_comp['datafinal'] .'</td>';
                                                        echo '<td>'. $data_comp['nomecompromisso'] .'</td>';
                                                        echo '<td>'. $data_comp['classificacao'] .'</td>';
                                                        echo '<td>'. $data_comp['observacoes'] .'</td>';
                                                        echo '</tr>';
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!--VERIFICAÇÃO TABELA PRAZOS---->
                            <?php
                                $sqlVerificarPrazo = "SELECT * FROM prazo WHERE processo='$id'";
                                $resultVerificarPrazo = $conn->query($sqlVerificarPrazo);
                                $countPrazos = $resultVerificarPrazo->num_rows;
                            ?>
                        <!--VERIFICAÇÃO TABELA PRAZOS---->

                        <?php if ($countPrazos >= 1): ?>
                            <div class="row">
                                <p id="txti"><b>Prazos</b></p>
                            </div>
                            <div class="row">
                                <hr style="border-color:#aaaaaa !important;">
                            </div>

                            <?php while ($rowPrazo = $resultVerificarPrazo->fetch_assoc()): ?>
                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" style="white-space: nowrap;">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 150px;"><strong>Protocolo</strong></td>
                                                    <td><?php echo $rowPrazo['id']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 150px;"><strong>Data</strong></td>
                                                    <td><?php echo $rowPrazo['datafinal']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 150px;"><strong>Descrição</strong></td>
                                                    <td><?php echo $rowPrazo['descricao']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 150px;"><strong>Prazo atendido</strong></td>
                                                    <td><?php echo $rowPrazo['atendido']; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <hr style="border-color:#aaaaaa !important;">
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-10">

                            </div>
                            <div class="col-2">
                                <div id="voltar">
                                    <a href="#"><button type="submit" class="btn btn-success" name="enviar"
                                            id='salvar'>Gerar PDF</button></a>
                                </div>
                            </div>
                        </div>
                        <!--ENVIO INPUTS COM INFORMAÇÕES IMPORTANTES-->

                        <input type="hidden" name="numeroProcesso" value="<?php echo $numeroProcesso; ?>">
                        <input type="hidden" name="nomePrimeiroAdvogado" value="<?php echo $nomePrimeiroAdvogado; ?>">
                        <input type="hidden" name="nomeSegundoAdvogado" value="<?php echo $nomeSegundoAdvogado; ?>">
                        <input type="hidden" name="nomeTerceiroAdvogado" value="<?php echo $nomeTerceiroAdvogado; ?>">
                        <input type="hidden" name="nomeCliente" value="<?php echo $nomeCliente; ?>">
                        <input type="hidden" name="idProcesso" value="<?php echo $id; ?>">

                        <!--ENVIO INPUTS COM INFORMAÇÕES IMPORTANTES-->
                    </form>
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
                                <svg xmlns="http://www.w3.org/2000/svg" style="margin-left: 40%;" width="16"
                                    height="13" fill="currentColor" class="bi bi-caret-down-fill"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                                </svg>
                            </a>
                        </li>
                        <div class="dropdown-content">
                            <li>
                                <a href="../Agenda/Compromissos/agenda_compromissos.php" class="links"
                                    style="width: 100%;">
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
                                <svg xmlns="http://www.w3.org/2000/svg" style="margin-left: 27%;" width="16"
                                    height="13" fill="currentColor" class="bi bi-caret-down-fill"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
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
                                <svg xmlns="http://www.w3.org/2000/svg" style="margin-left: 41%;" width="16"
                                    height="13" fill="currentColor" class="bi bi-caret-down-fill"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
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
                                <svg xmlns="http://www.w3.org/2000/svg" style="margin-left: 32%;" width="16"
                                    height="13" fill="currentColor" class="bi bi-caret-down-fill"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                                </svg>
                            </a>
                        </li>
                        <div class="dropdown-content">
                            <li>
                                <a href="../Arquivos/Procuracoes/procuracoes.php" class="links"
                                    style="width: 100%;">
                                    <span class="item2" style="margin-left: 15%;">Procuração</span>
                                </a>
                            </li>
                            <li>
                                <a href="../Arquivos/Declaracoes/declaracoes.php" class="links"
                                    style="width: 100%;">
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

</html>
