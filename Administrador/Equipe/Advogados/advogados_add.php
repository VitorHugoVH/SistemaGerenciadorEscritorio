<!DOCTYPE html>
<html lang="en">

<?php
include('../../sessao_usuarios.php');

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

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../estilosAdm.css" />
    <link rel="icon" type="image/x-icon" href="../../imagensADM/logoadmin.png" />
    <link rel="stylesheet" type="text/css" href="../../fontawesome/css/all.css" />
    <script src="../../../reloadIcon.js"></script>
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
    <div id="loading-container">
        <div id="loading-icon" class="centered" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: rgba(0, 0, 0, 0.5); border-radius: 8px; padding: 20px; z-index: 999;">
            <img src="../../../loading-gif.gif" alt="Carregando..." style="width: 32px; height: 32px;" />
        </div>
    </div>
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
                  <a class="dropdown-item btn-logout" href="../../sessao_destroy.php">Sair</a>
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

                                        if (isNaN(v[v.length - 1])) { 
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

                <form action="advogados_insert.php" method="POST">
                    <div class="row">
                        <div class="col-10">
                            <div class="bloco3">
                                <h3 class="text-muted">Adicionar</h3>
                            </div>
                        </div>
                        <div class="col-2">
                            <div id="voltar">
                                <a href="advogados.php"><button type="button" class="btn btn-secondary" id='voltar1'>Volar</button></a>
                            </div>
                        </div>
                    </div>
                    <div class="bloco4">
                        <div class="row">
                            <div class="titulo">
                                <h4 class="title"><b>Dados do Membro</b></h4>
                            </div>
                            <div class="campos">
                                <label for="nomeadvogado"><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Nome completo</h6>
                                    </b></label>
                                <input type="text" name="nomeadvogado" id="nomeadvogado" placeholder="Nome completo" class="form-control">
                            </div>
                            <div class="campos">
                                <label for="funcao"><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Função</h6>
                                    </b></label>
                                <select class="form-select" name="funcao" id="funcao" onchange="fun()">
                                    <option value="Não selecionado">Selecione</option>
                                    <option>Advogado</option>
                                    <option>Assistente juridico</option>
                                    <option>Auditor</option>
                                    <option>Bacharel em direito</option>
                                    <option>Diretoria de operações</option>
                                    <option>Estagiário</option>
                                    <option>Paralegal</option>
                                    <option>Perito</option>
                                    <option>Recepção</option>
                                    <option>Secretário</option>
                                    <option>Sócio fundador</option>
                                </select>
                            </div>
                            <div id="OAB" style="margin-top: 2%; margin-bottom: 2%; display: none;">
                                <label for="numerooab"><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Número da OAB</h6>
                                    </b></label>
                                <input type="text" name="numerooab" id="numerooab" class="form-control" placeholder="Número da OAB">
                            </div>
                            <div id="UF" style="margin-top: 2%; margin-bottom: 2%; display: none;">
                                <label for="estadooab"><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Estado da OAB</h6>
                                    </b></label>
                                <select id="estadooab" name="estadooab" class="form-select">
                                    <option>Selecione</option>
                                    <option>AC</option>
                                    <option>AL</option>
                                    <option>AP</option>
                                    <option>AM</option>
                                    <option>BA</option>
                                    <option>CE</option>
                                    <option>DF</option>
                                    <option>ES</option>
                                    <option>GO</option>
                                    <option>MA</option>
                                    <option>MS</option>
                                    <option>MT</option>
                                    <option>MG</option>
                                    <option>PA</option>
                                    <option>PB</option>
                                    <option>PR</option>
                                    <option>PE</option>
                                    <option>PI</option>
                                    <option>RJ</option>
                                    <option>RN</option>
                                    <option>RS</option>
                                    <option>RO</option>
                                    <option>RR</option>
                                    <option>SC</option>
                                    <option>SP</option>
                                    <option>SE</option>
                                    <option>TO</option>
                                </select>
                            </div>
                            <script>
                                function fun() {
                                    if (document.getElementById('funcao').value != 'Advogado') {
                                        document.getElementById('OAB').style.display = 'none';
                                        document.getElementById('UF').style.display = 'none';
                                    } else {
                                        document.getElementById('OAB').style.display = 'block';
                                        document.getElementById('UF').style.display = 'block';
                                    }
                                }
                            </script>
                            <div class="campos">
                                <label><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">CPF</h6>
                                    </b></label>
                                <input type="text" name="numerocpf" id="numerocpf" class="form-control" placeholder="Número do CPF" maxlength="11" oninput="mascara(this)">
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
                                <label for="sexo"><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Sexo</h6>
                                    </b></label>
                                <select class="form-select" name="sexo" id="sexo">
                                    <option>Masculino</option>
                                    <option>Feminino</option>
                                </select>
                            </div>
                            <div class="campos">
                                <label><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Data de nascimento</h6>
                                    </b></label>
                                <input type="date" name="datanascimento" id="datanascimento" class="form-control" placeholder="__/__/__">
                            </div>
                            <div class="campos">
                                <label><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">RG</h6>
                                    </b></label>
                                <input type="text" name="numerorg" id="numerorg" class="form-control" placeholder="Número do RG" onkeyup="formatarRG(this)">
                            </div>
                            <!--FUNÇÃO PARA FORMATAÇÃO DO CAMPO RG--->

                            <script>
                                function formatarRG(input) {
                                    // remove caracteres não numéricos
                                    let num = input.value.replace(/[^\d]/g, '');
                            
                                    // limita o número de caracteres a 9
                                    num = num.slice(0, 10);
                            
                                    // formatação do RG: XX.XXX.XXX-X
                                    if (num.length > 2) {
                                        num = num.substring(0, 2) + '.' + num.substring(2);
                                    }
                                    if (num.length > 6) {
                                        num = num.substring(0, 6) + '.' + num.substring(6);
                                    }
                                    if (num.length > 10) {
                                        num = num.substring(0, 10) + '-' + num.substring(10);
                                    }
                            
                                    // atualiza o valor do input com a string formatada
                                    input.value = num;
                                }
                            </script>
                            
                            <!----FUNÇÃO PARA FORMATAÇÃO DO CAMPO RG--->
                            <div class="campos">
                                <label for="estadocivil"><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Estado civil</h6>
                                    </b></label>
                                <select class="form-select" name="estadocivil" id="estadocivil">
                                    <option>Casado(a)</option>
                                    <option>Divorciado(a)</option>
                                    <option>Separado(a) judicialmente</option>
                                    <option>Solteiro(a)</option>
                                    <option>União estável</option>
                                    <option>Viúvo(a)</option>
                                </select>
                            </div>
                            <div class="campos">
                                <label><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Profissão</h6>
                                    </b></label>
                                <input type="text" name="profissao" id="profissao" class="form-control" placeholder="Profissão">
                            </div>
                            <div class="campos">
                                <label><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Outros documentos e observações</h6>
                                    </b></label>
                                <textarea class="form-control" col="1" rows="8" name="descricao" id="descricao" placeholder="Observações"></textarea>
                            </div>
                            <div class="campos">
                                <label><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Status do usuario</h6>
                                    </b></label>
                                <select class="form-select" name="status" id="status">
                                    <option>Ativo</option>
                                    <option>Inativo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="bloco5">
                        <div class="row">
                            <div class="titulo">
                                <h4 class="title"><b>Emails</b></h4>
                            </div>
                            <div class="campos">
                                <div class="input-group">
                                    <input type="email" name="email" id="email" placeholder="Email" class="form-control">
                                    <div class="input-group-append">
                                        <input type="button" value="Adicionar e-mail" name="addemail" id="addemail" class="btn btn-secondary" onclick="adde1()">
                                    </div>
                                </div>
                                <div id="email2" style="margin-top: 2%; margin-bottom: 2%; display: none;">
                                    <div class="input-group">
                                        <input type="email" name="email2" id="email2" placeholder="Email" class="form-control">
                                        <div class="input-group-append">
                                            <input type="button" value="Adicionar e-mail" name="addemail2" id="addemail2" class="btn btn-secondary" onclick="adde2()">
                                        </div>
                                    </div>
                                </div>
                                <div id="email3" style="margin-top: 2%; margin-bottom: 2%; display: none;">
                                    <div class="input-group">
                                        <input type="email" name="email3" id="email3" placeholder="Email" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bloco5">
                        <div class="row">
                            <div class="titulo">
                                <h4 class="title"><b>Telefones</b></h4>
                            </div>
                            <div class="campos">
                                <div class="row">
                                    <div class="col-3">
                                        <label for="tipocontato"><b>
                                                <h6 style="font-family: arial, sans-serif; font-size: 16px;">Tipo contato</h6>
                                            </b></label>
                                        <select class="form-select" name="tipocontato" id="tipocontato">
                                            <option>Telefone</option>
                                            <option>Fax</option>
                                            <option>Celular</option>
                                            <option>Residencial</option>
                                            <option>Comercial</option>
                                            <option>Nextel</option>
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <label for="ddi"><b>
                                                <h6 style="font-family: arial, sans-serif; font-size: 16px;">DDI</h6>
                                            </b></label>
                                        <input type="number" name="ddi" id="ddi" class="form-control" maxlength="2" placeholder="55">
                                    </div>
                                    <div class="col-2">
                                        <label for="ddd"><b>
                                                <h6 style="font-family: arial, sans-serif; font-size: 16px;">DDD</h6>
                                            </b></label>
                                        <input type="number" name="ddd" id="ddd" class="form-control" maxlength="2" placeholder="DDD">
                                    </div>
                                    <div class="col-5">
                                        <label for="numero"><b>
                                                <h6 style="font-family: arial, sans-serif; font-size: 16px;">Número</h6>
                                            </b></label>
                                        <input type="number" name="numero" id="numero" class="form-control" maxlength="2" placeholder="Telefone">
                                    </div>
                                </div>
                                <!--Javascript Telefone2--->
                                <div id="telefone2" style="  margin-top: 2%; margin-bottom: 2%; display: none;">
                                    <div class="row">
                                        <div class="col-3">
                                            <label for="tipocontato2"><b>
                                                    <h6 style="font-family: arial, sans-serif; font-size: 16px;">Tipo contato</h6>
                                                </b></label>
                                            <select class="form-select" name="tipocontato2" id="tipocontato2">
                                                <option>Telefone</option>
                                                <option>Fax</option>
                                                <option>Celular</option>
                                                <option>Residencial</option>
                                                <option>Comercial</option>
                                                <option>Nextel</option>
                                            </select>
                                        </div>
                                        <div class="col-2">
                                            <label for="ddi2"><b>
                                                    <h6 style="font-family: arial, sans-serif; font-size: 16px;">DDI</h6>
                                                </b></label>
                                            <input type="number" name="ddi2" id="ddi2" class="form-control" maxlength="2" placeholder="55">
                                        </div>
                                        <div class="col-2">
                                            <label for="ddd2"><b>
                                                    <h6 style="font-family: arial, sans-serif; font-size: 16px;">DDD</h6>
                                                </b></label>
                                            <input type="number" name="ddd2" id="ddd2" class="form-control" maxlength="2" placeholder="DDD">
                                        </div>
                                        <div class="col-5">
                                            <label for="numero2"><b>
                                                    <h6 style="font-family: arial, sans-serif; font-size: 16px;">Número</h6>
                                                </b></label>
                                            <input type="number" name="numero2" id="numero2" class="form-control" maxlength="2" placeholder="Telefone">
                                        </div>
                                    </div>
                                </div>
                                <!--Javascript Telefone3--->
                                <div id="telefone3" style="  margin-top: 2%; margin-bottom: 2%; display: none;">
                                    <div class="row">
                                        <div class="col-3">
                                            <label for="tipocontato3"><b>
                                                    <h6 style="font-family: arial, sans-serif; font-size: 16px;">Tipo contato</h6>
                                                </b></label>
                                            <select class="form-select" name="tipocontato3" id="tipocontato3">
                                                <option>Telefone</option>
                                                <option>Fax</option>
                                                <option>Celular</option>
                                                <option>Residencial</option>
                                                <option>Comercial</option>
                                                <option>Nextel</option>
                                            </select>
                                        </div>
                                        <div class="col-2">
                                            <label for="ddi3"><b>
                                                    <h6 style="font-family: arial, sans-serif; font-size: 16px;">DDI</h6>
                                                </b></label>
                                            <input type="number" name="ddi3" id="ddi3" class="form-control" maxlength="2" placeholder="55">
                                        </div>
                                        <div class="col-2">
                                            <label for="ddd3"><b>
                                                    <h6 style="font-family: arial, sans-serif; font-size: 16px;">DDD</h6>
                                                </b></label>
                                            <input type="number" name="ddd3" id="ddd3" class="form-control" maxlength="2" placeholder="DDD">
                                        </div>
                                        <div class="col-5">
                                            <label for="numero3"><b>
                                                    <h6 style="font-family: arial, sans-serif; font-size: 16px;">Número</h6>
                                                </b></label>
                                            <input type="number" name="numero3" id="numero3" class="form-control" maxlength="2" placeholder="Telefone">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="campos">
                                <input type="button" value="Adicionar telefone" name="addmais1" id="addmais1" class="btn btn-secondary" onclick="addtel1()">
                                <input type="hidden" value="Adicionar telefone" name="addmais2" id="addmais2" class="btn btn-secondary" onclick="addtel2()">
                            </div>
                        </div>
                    </div>
                    <div class="bloco5">
                        <div class="titulo">
                            <h4 class="title"><b>Endereço</b></h4>
                        </div>
                        <div class="campos">
                            <label for="cep"><b>
                                    <h6 style="font-family: arial, sans-serif; font-size: 16px;">CEP</h6>
                                </b></label>
                            <input type="text" name="cep" id="cep" class="form-control" placeholder="CEP" maxlength="8">
                        </div>
                        <div class="campos">
                            <div class="row">
                                <div class="col-9">
                                    <label for="endereco"><b>
                                            <h6 style="font-family: arial, sans-serif; font-size: 16px;">Endereço</h6>
                                        </b></label>
                                    <input type="text" name="endereco" id="endereco" class="form-control" placeholder="Endereço">
                                </div>
                                <div class="col-3">
                                    <label for="numerocasa"><b>
                                            <h6 style="font-family: arial, sans-serif; font-size: 16px;">Número</h6>
                                        </b></label>
                                    <input type="text" name="numerocasa" id="numerocasa" class="form-control" placeholder="Número">
                                </div>
                            </div>
                        </div>
                        <div class="campos">
                            <label for="complemento"><b>
                                    <h6 style="font-family: arial, sans-serif; font-size: 16px;">Complemento</h6>
                                </b></label>
                            <input type="text" name="complemento" id="complemento" class="form-control" placeholder="Complemento">
                        </div>
                        <div class="campos">
                            <div class="row">
                                <div class="col-4">
                                    <label for="bairro"><b>
                                            <h6 style="font-family: arial, sans-serif; font-size: 16px;">Bairro</h6>
                                        </b></label>
                                    <input type="text" name="bairro" id="bairro" class="form-control" placeholder="Bairro">
                                </div>
                                <div class="col-4">
                                    <label for="cidade"><b>
                                            <h6 style="font-family: arial, sans-serif; font-size: 16px;">Cidade</h6>
                                        </b></label>
                                    <input type="text" name="cidade" id="cidade" class="form-control" placeholder="Cidade">
                                </div>
                                <div class="col-4">
                                    <label for="estado"><b>
                                            <h6 style="font-family: arial, sans-serif; font-size: 16px;">Estado</h6>
                                        </b></label>
                                    <select class="form-select" id="estado" name="estado">
                                        <option value="">Selecione</option>
                                        <option value="AC">AC</option>
                                        <option value="AL">AL</option>
                                        <option value="AP">AP</option>
                                        <option value="AM">AM</option>
                                        <option value="BA">BA</option>
                                        <option value="CE">CE</option>
                                        <option value="DF">DF</option>
                                        <option value="ES">ES</option>
                                        <option value="GO">GO</option>
                                        <option value="MA">MA</option>
                                        <option value="MS">MS</option>
                                        <option value="MT">MT</option>
                                        <option value="MG">MG</option>
                                        <option value="PA">PA</option>
                                        <option value="PB">PB</option>
                                        <option value="PR">PR</option>
                                        <option value="PE">PE</option>
                                        <option value="PI">PI</option>
                                        <option value="RJ">RJ</option>
                                        <option value="RN">RN</option>
                                        <option value="RS">RS</option>
                                        <option value="RO">RO</option>
                                        <option value="RR">RR</option>
                                        <option value="SC">SC</option>
                                        <option value="SP">SP</option>
                                        <option value="SE">SE</option>
                                        <option value="TO">TO</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="campos">
                            <input type="button" value="Adicionar endereço" name="addmaisendereco" id="addmaisendereco" class="btn btn-secondary" onclick="addcep()">
                        </div>
                    </div>
                    <!--Javascript Add Endereço---->
                    <div id="addendereco" style="background-color: #fcfcfc; padding: 2%; margin-top: 5%; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; display: none;">
                        <div class="titulo">
                            <h4 class="title"><b>Endereço 2</b></h4>
                        </div>
                        <div class="campos">
                            <label for="cep2"><b>
                                    <h6 style="font-family: arial, sans-serif; font-size: 16px;">CEP</h6>
                                </b></label>
                            <input type="text" name="cep2" id="cep2" class="form-control" placeholder="CEP" maxlength="8">
                        </div>
                        <div class="campos">
                            <div class="row">
                                <div class="col-9">
                                    <label for="endereco2"><b>
                                            <h6 style="font-family: arial, sans-serif; font-size: 16px;">Endereço</h6>
                                        </b></label>
                                    <input type="text" name="endereco2" id="endereco2" class="form-control" placeholder="Endereço">
                                </div>
                                <div class="col-3">
                                    <label for="numerocasa2"><b>
                                            <h6 style="font-family: arial, sans-serif; font-size: 16px;">Número</h6>
                                        </b></label>
                                    <input type="text" name="numerocasa2" id="numerocasa2" class="form-control" placeholder="Número">
                                </div>
                            </div>
                        </div>
                        <div class="campos">
                            <label for="complemento2"><b>
                                    <h6 style="font-family: arial, sans-serif; font-size: 16px;">Complemento</h6>
                                </b></label>
                            <input type="text" name="complemento2" id="complemento2" class="form-control" placeholder="Complemento">
                        </div>
                        <div class="campos">
                            <div class="row">
                                <div class="col-4">
                                    <label for="bairro2"><b>
                                            <h6 style="font-family: arial, sans-serif; font-size: 16px;">Bairro</h6>
                                        </b></label>
                                    <input type="text" name="bairro2" id="bairro2" class="form-control" placeholder="Bairro">
                                </div>
                                <div class="col-4">
                                    <label for="cidade2"><b>
                                            <h6 style="font-family: arial, sans-serif; font-size: 16px;">Cidade</h6>
                                        </b></label>
                                    <input type="text" name="cidade2" id="cidade2" class="form-control" placeholder="Cidade">
                                </div>
                                <div class="col-4">
                                    <label for="estado2"><b>
                                            <h6 style="font-family: arial, sans-serif; font-size: 16px;">Estado</h6>
                                        </b></label>
                                    <select class="form-select" id="estado2" name="estado2">
                                        <option>Selecione</option>
                                        <option value="AC">AC</option>
                                        <option value="AL">AL</option>
                                        <option value="AP">AP</option>
                                        <option value="AM">AM</option>
                                        <option value="BA">BA</option>
                                        <option value="CE">CE</option>
                                        <option value="DF">DF</option>
                                        <option value="ES">ES</option>
                                        <option value="GO">GO</option>
                                        <option value="MA">MA</option>
                                        <option value="MS">MS</option>
                                        <option value="MT">MT</option>
                                        <option value="MG">MG</option>
                                        <option value="PA">PA</option>
                                        <option value="PB">PB</option>
                                        <option value="PR">PR</option>
                                        <option value="PE">PE</option>
                                        <option value="PI">PI</option>
                                        <option value="RJ">RJ</option>
                                        <option value="RN">RN</option>
                                        <option value="RS">RS</option>
                                        <option value="RO">RO</option>
                                        <option value="RR">RR</option>
                                        <option value="SC">SC</option>
                                        <option value="SP">SP</option>
                                        <option value="SE">SE</option>
                                        <option value="TO">TO</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="campos">
                            <input type="button" value="Excluir endereço" name="retirarendereco" id="retirarendereco" class="btn btn-primary" onclick="retirar()">
                        </div>
                    </div>
                    <!--Final Add Endereço---->
                    <div class="bloco5">
                        <div class="titulo">
                            <h4 class="title"><b>Dados para acesso</b></h4>
                        </div>
                        <div class="campos">
                            <label for="login"><b>
                                    <h6 style="font-family: arial, sans-serif; font-size: 16px;">Login</h6>
                                </b></label>
                            <input type="text" name="login" id="login" class="form-control" placeholder="Login">
                        </div>
                        <div class="campos">
                            <label for="senhaUser"><b>
                                    <h6 style="font-family: arial, sans-serif; font-size: 16px;">Senha</h6>
                                </b></label>
                            <div class="input-group">
                                <input type="password" name="senhaUser" id="senhaUser" class="form-control" placeholder="Senha">
                                <div class="input-group-append" name="notviewSenhaUser" id="notviewSenhaUser" style="display: block;">
                                    <a class='btn btn-sm btn-primary' onclick="view()">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="30" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16">
                                            <path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z" />
                                            <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z" />
                                        </svg>
                                    </a>
                                </div>
                                <div class="input-group-append" name="viewSenhaUser" id="viewSenhaUser" style="display: none;">
                                    <a class='btn btn-sm btn-primary' onclick="notview()">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="30" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="campos">
                            <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="true" id="flexCheckChecked" name="enviarEmailUsuario" checked>
                            <label class="form-check-label" for="flexCheckChecked">
                                Enviar dados para o email do usuario
                            </label>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="datacriacao" value="<?php echo date('d/m/Y') ?>">
                    <div class="final">
                        <div class="row">
                            <div class="col-8">

                            </div>
                            <div class="col-2">
                                <div id="salvar">
                                    <a href="advogados.php"><button type="button" class="btn btn-outline-secondary" id="voltar2">Cancelar</button></a>
                                </div>
                            </div>
                            <div class="col-2">
                                <div id="voltar">
                                    <a href="advogados_insert.php"><button type="submit" class="btn btn-success" name="enviar" id="salvar">Salvar</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--INÍCIO NAVEGAÇÃO-->
        <div class="sidebar" style="overflow-y: auto;">
            <div class="profile">
                <img src="../../imagensADM/logoadmin.png" alt="profile_picture" width="35%">
                <h3>Advocacia</h3>
                <p>Fraga e Melo Advogados</p>
            </div>
            <ul class="lista">
                <li>
                    <a class="links" href="../../Deashboard/admin.php">
                        <span class="icon"><i class="fas fa-desktop"></i></span>
                        <span class="item">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="processos.php" class="links">
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
                            <a href="../../Agenda/Compromissos/agenda_compromissos.php" class="links" style="width: 100%;">
                                <span class="item2" style="margin-left: 15%;">Compromissos</span>
                            </a>
                        </li>
                        <li>
                            <a href="../../Agenda/Tarefas/agenda_tarefas.php" class="links">
                                <span class="item2" style="margin-left: 15%; width: 100%;">Tarefas</span>
                            </a>
                        </li>
                        <li>
                            <a href="../../Agenda/Prazos/agenda_prazos.php" class="links">
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
                            <a href="../../Financeiro/Despesas/despesas.php" class="links" style="width: 100%;">
                                <span class="item2" style="margin-left: 15%;">Despesas</span>
                            </a>
                        </li>
                        <li>
                            <a href="../../Financeiro/Receitas/receitas.php" class="links">
                                <span class="item2" style="margin-left: 15%; width: 100%;">Receitas</span>
                            </a>
                        </li>
                    </div>
                </div>
                <div class="dropdown">
                    <li>
                        <a href="#" class="active">
                            <span class="icon"><i class="fas fa-users"></i></span>
                            <span class="item">Equipe</span>
                            <svg xmlns="http://www.w3.org/2000/svg" style="margin-left: 41%;" width="16" height="13" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                            </svg>
                        </a>
                    </li>
                    <div class="dropdown-content">
                        <li>
                            <a href="../Clientes/clientes.php" class="links" style="width: 100%;">
                                <span class="item2" style="margin-left: 15%;">Clientes</span>
                            </a>
                        </li>
                        <li>
                            <a href="advogados.php" class="active" style="width: 100%;">
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
                            <a href="../../Arquivos/Procuracoes/procuracoes.php" class="links" style="width: 100%;">
                                <span class="item2" style="margin-left: 15%;">Procuração</span>
                            </a>
                        </li>
                        <li>
                            <a href="../../Arquivos/Declaracoes/declaracoes.php" class="links" style="width: 100%;">
                                <span class="item2" style="margin-left: 15%;">Declaração</span>
                            </a>
                        </li>
                        <li>
                            <a href="../../Arquivos/Contratos/contratos.php" class="links" style="width: 100%;">
                                <span class="item2" style="margin-left: 15%;">Contrato</span>
                            </a>
                        </li>
                    </div>
                </div>
            </ul>
        </div>
        <!--FIM NAVEGAÇÃO-->
    </div>
</body>
<script>
    function documento() {
        if (document.getElementById('tipodocumento').value == 'CNPJ') {
            document.getElementById('numerocpf').type = 'hidden';
            document.getElementById('numerocnpj').type = 'text';

            /*Javascript CPF*/
            document.getElementById('campos3').style.display = 'none';
            document.getElementById('campos4').style.display = 'none';
            document.getElementById('campos5').style.display = 'none';
            document.getElementById('campos6').style.display = 'none';
            document.getElementById('campos7').style.display = 'none';

            /*Javascript CNPJ*/
            document.getElementById('segundacampos2').style.display = 'block';
            document.getElementById('segundacampos3').style.display = 'block';
            document.getElementById('segundacampos4').style.display = 'block';
            document.getElementById('segundacampos5').style.display = 'block';
            document.getElementById('segundacampos6').style.display = 'block';
            document.getElementById('segundacampos7').style.display = 'block';

        } else {
            document.getElementById('numerocpf').type = 'text';
            document.getElementById('numerocnpj').type = 'hidden';

            document.getElementById('campos3').style.display = 'block';
            document.getElementById('campos4').style.display = 'block';
            document.getElementById('campos5').style.display = 'block';
            document.getElementById('campos6').style.display = 'block';
            document.getElementById('campos7').style.display = 'block';

            document.getElementById('segundacampos2').style.display = 'none';
            document.getElementById('segundacampos3').style.display = 'none';
            document.getElementById('segundacampos4').style.display = 'none';
            document.getElementById('segundacampos5').style.display = 'none';
            document.getElementById('segundacampos6').style.display = 'none';
            document.getElementById('segundacampos7').style.display = 'none';
        }
    }

    function adde1() {
        document.getElementById('email2').style.display = 'block';
        document.getElementById('addemail').type = 'hidden';
    }

    function adde2() {
        document.getElementById('email3').style.display = 'block';
        document.getElementById('addemail2').type = 'hidden';
    }

    function addtel1() {
        document.getElementById('telefone2').style.display = 'block';
        document.getElementById('addmais1').type = 'hidden';
        document.getElementById('addmais2').type = 'button';
    }

    function addtel2() {
        document.getElementById('telefone3').style.display = 'block';
        document.getElementById('addmais2').type = 'hidden';
        document.getElementById('addmais2').type = 'hidden';
    }

    function addcep() {
        document.getElementById('addmaisendereco').type = 'hidden';
        document.getElementById('addendereco').style.display = 'block';
    }

    function retirar() {
        document.getElementById('addendereco').style.display = 'none';
    }

    /*Javascript API Busca CEP 1*/

    let cep = document.querySelector('#cep');
    let rua = document.querySelector('#endereco');
    let bairro = document.querySelector('#bairro');
    let cidade = document.querySelector('#cidade');
    let estado = document.querySelector('#estado');


    cep.addEventListener('blur', function(e) {
        let cep = e.target.value;
        let script = document.createElement('script');
        script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=popularForm';
        document.body.appendChild(script);
    });

    function popularForm(resposta) {

        if ("erro" in resposta) {
            alert('CEP não encontrado');
            return;
        }

        rua.value = resposta.logradouro;
        bairro.value = resposta.bairro;
        cidade.value = resposta.cidade;
        estado.value = resposta.uf;
    }
    /*Javascript API Busca CEP 2*/

    let cep2 = document.querySelector('#cep2');
    let rua2 = document.querySelector('#endereco2');
    let bairro2 = document.querySelector('#bairro2');
    let cidade2 = document.querySelector('#cidade2');
    let estado2 = document.querySelector('#estado2');


    cep2.addEventListener('blur2', function(e2) {
        let cep2 = e2.target.value;
        let script2 = document.createElement('script2');
        script2.src = 'https://viacep.com.br/ws/' + cep2 + '/json/?callback=popularForm';
        document.body.appendChild(script2);
    });

    function popularForm2(resposta2) {

        if ("erro" in resposta2) {
            alert('CEP não encontrado');
            return;
        }

        rua2.value = resposta2.logradouro;
        bairro2.value = resposta2.bairro;
        cidade2.value = resposta2.cidade;
        estado2.value = resposta2.uf;
    }

    function view() {
        document.getElementById('senhaUser').type = 'text';
        document.getElementById('notviewSenhaUser').style.display = 'none';
        document.getElementById('viewSenhaUser').style.display = 'block';
    }

    function notview() {
        document.getElementById('senhaUser').type = 'password';
        document.getElementById('notviewSenhaUser').style.display = 'block';
        document.getElementById('viewSenhaUser').style.display = 'none';
    }
</script>

</html>