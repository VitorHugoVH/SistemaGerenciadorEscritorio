<?php

include_once('../../conexao_adm.php');
require('../../sessao_usuarios.php');

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
<html lang="pt-br">
<?php
include_once('../../conexao_adm.php');

//DADOS PROCURAÇÃO

if (isset($_POST['enviar'])) {

    $nomecliente = $_POST['nomecliente'];
    $numeroProcesso = $_POST['numeroprocesso'];
    $varadoProcesso = $_POST['nomedavara'];
    $numeroVara = $_POST['numerovara'];
    $valorHonorario = $_POST['valorhonorario'];
    $parcelas = $_POST['parcelas'];
    $primeiroPagamento = $_POST['primeiroPagamento'];
    
    // Remover o "R$" da string
    $valorSemCifrao = str_replace("R$", "", $valorHonorario);

    // Converter o valor em float
    $valorHonorarioFloat = floatval($valorSemCifrao);

    // Formatar o valor com duas casas decimais
    $valorHonorarioSemCifrao = number_format($valorHonorarioFloat, 2, ',', '');

    // Array associativo com os valores por extenso de 1 a 12
    $extenso = array(
        1 => "um",
        2 => "dois",
        3 => "três",
        4 => "quatro",
        5 => "cinco",
        6 => "seis",
        7 => "sete",
        8 => "oito",
        9 => "nove",
        10 => "dez",
        11 => "onze",
        12 => "doze",
        13 => "treze",
        14 => "catorze",
        15 => "quinze",
        16 => "dezesseis",
        17 => "dezessete",
        18 => "dezoito",
        19 => "dezenove",
        20 => "vinte",
        21 => "vinte e um",
        22 => "vinte e dois",
        23 => "vinte e três",
        24 => "vinte e quatro"
    );
    

    // Verificar se o valor da variável $parcelas está no intervalo de 1 a 12
    if ($parcelas >= 1 && $parcelas <= 24) {
        // Atribuir o valor por extenso à variável $parcelasExtenso
        $parcelasExtenso = $extenso[$parcelas];
    } else {
        // Caso o valor esteja fora do intervalo, atribuir uma mensagem padrão
        $parcelasExtenso = "Valor inválido";
    }

    // FORMATAÇÃO DAS DATAS

    $dia = date('d');
    $mes = date('M');
    $ano = date('Y');

    //FUNÇÃO MES PORTUGUÊS

    $mes_extenso = array(
        'Jan' => 'Janeiro',
        'Feb' => 'Fevereiro',
        'Mar' => 'Março',
        'Apr' => 'Abril',
        'May' => 'Maio',
        'Jun' => 'Junho',
        'Jul' => 'Julho',
        'Aug' => 'Agosto',
        'Nov' => 'Novembro',
        'Sep' => 'Setembro',
        'Oct' => 'Outubro',
        'Dec' => 'Dezembro'
    );

        // FORMATAÇÃO DIAS DE PAGAMENTO HONORÁRIOS

        // Tratamento do valor de $valorHonorarioSemCifrao para garantir que seja numérico
        $valorHonorarioSemCifrao = str_replace(',', '.', $valorHonorarioSemCifrao);

        // Verifica se $primeiroPagamento é uma data válida
        if (strtotime($primeiroPagamento) !== false) {
            $distribuicaoHonorarios = array();
            $valorParcela = (float) $valorHonorarioSemCifrao / $parcelas;
            $valorParcela = number_format($valorParcela, 2, '.', ''); // Arredonda para 2 casas decimais

            // Converte a data do primeiro pagamento para um objeto DateTime
            $dataPrimeiroPagamento = new DateTime($primeiroPagamento);

            for ($i = 1; $i <= $parcelas; $i++) {
                $dataVencimento = $dataPrimeiroPagamento->format('d/m/Y');
                $valorParcelaFormatado = number_format($valorParcela, 2, ',', '.'); // Formata o valor com 2 casas decimais
                $descricaoParcela = "{$i}) A ({$i}ª) parcela na quantia de R$ {$valorParcelaFormatado} a ser paga com vencimento para o dia {$dataVencimento};";
                $distribuicaoHonorarios[] = $descricaoParcela;

                // Adiciona um mês à data do primeiro pagamento para calcular a data da próxima parcela
                $dataPrimeiroPagamento->modify('+1 month');
            }
        }

}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../estilosAdm.css" />
    <link rel="icon" type="image/x-icon" href="../../imagensADM/logoadmin.png" />
    <link rel="stylesheet" type="text/css" href="../../fontawesome/css/all.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/35qnw3mr7vfcivpkll7h2mly3vod8u7kh8ujfb0q3qur0e4j/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
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
    <script>
        tinymce.init({
            selector: '#editor',
            plugins: 'autoresize',
            menubar: false,
        });
    </script>
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

            <form action="contratos_create.php" method="POST" target="_blank">
                <div class="row">
                    <div class="col-10">
                        <div class="bloco3">
                            <h3 class="text-muted">Criar contrato</h3>
                        </div>
                    </div>
                    <div class="col-2">

                    </div>
                </div>
                <div class="bloco4">
                    <div class="row">
                        <div class="titulo">
                            <h4 class="title"><b> Visualizar contrato</b></h4>
                        </div>
                    </div>
                    <div class="campos">
                            <textarea id="editor" name="descricao">
                                <h3 style="text-align: center;">CONTRATO DE HONORÁRIOS ADVOCATÍCIOS</h3>
                                <p style="margin-left: 50px; margin-right: 50px; text-align: justify;"><b>CONTRATANTE:</b></p>
                                <p style="margin-left: 50px; margin-right: 50px; text-align: justify;">

                                    <b>CONTRATADOS: FRAGA E MELO ADVOGADOS ASSOCIADOS,</b> inscrita no OAB\RS sob o nº 4496, representada neste apto pelos sócios
                                    <b>SANDRO CARVALHO DE FRAGA</b>, brasileiro, divorciado, advogado, inscrito na OAB\RS sob o nº52230 e ELISETE CAMARGO DE MELO, brasileira, solteira, 
                                    advogada, inscrita na OAB/SC sob o n° 65356-B, com escritório profissional na Rua Juca Batista, 4625-
                                    Guatambu, 833- Bairro Hípica- nesta Capital, neste Estado.

                                </p>
                                <p style="margin-left: 50px; margin-right: 50px; text-align: justify;">

                                    O <b>CONTRATANTE</b>, acima qualificado, contrata os serviços profissionais de advocacia dos
                                    <b>CONTRATADOS</b>, conforme as cláusulas e condições seguintes: 

                                </p>
                                <p style="margin-left: 50px; margin-right: 50px; text-align: justify; margin-top: 20px;">
                                
                                    <b>DA NATUREZA DOS SERVIÇOS CONTRATADOS:</b>

                                </p>
                                <p style="margin-left: 50px; margin-right: 50px; text-align: justify;">

                                    <b>Cláusula Primeira:</b> As partes pactuam o Contrato de Honorários com a finalidade de apresentar defesa 
                                    em face da Ação proposta por <b> <?php  $nomecliente ?>, processo <?php echo $numeroProcesso ?>, a qual tramita junto a <?php echo $numeroVara ?> <?php echo mb_strtoupper($varadoProcesso) ?>
                                    DE PORTO ALEGRE-RS.</b>

                                </p>
                                <p style="margin-left: 50px; margin-right: 50px; text-align: justify;">

                                    <b>Cláusula Segunda:</b> A <b>CONTRATANTE</b> obriga-se a colocar à disposição dos <b>CONTRATADOS</b> toda a 
                                    documentação solicitada, bem como outorgar procuração quando necessária.                                    

                                </p>
                                <p style="margin-left: 50px; margin-right: 50px; text-align: justify; margin-top: 20px;">
                                
                                    <b>DA REMUNERAÇÃO E DESPESA:</b>

                                </p>
                                <p style="margin-left: 50px; margin-right: 50px; text-align: justify;">

                                    <b>Cláusula Terceira:</b> Como remuneração pelos serviços ora contratados o <b>CONTRATANTE</b> pagará aos <b>CONTRATADOS</b>
                                    a quantia equivalte a <b><?php echo $valorHonorario ?> (<?php echo $valorHonorarioSemCifrao ?> reais), em <?php echo $parcelas ?> (<?php echo $parcelasExtenso ?>) parcelas mensais,
                                    distribuidas da seguinte forma de pagamento: </b>

                                </p>
                                <p style="margin-left: 50px; margin-right: 50px; text-align: justify; font-size: 14px; white-space: nowrap;">
                                    <?php
                                        foreach ($distribuicaoHonorarios as $parcela) {
                                            echo '<strong>' . $parcela . '</strong><br>';
                                        }
                                    ?>
                                </p>
                                <p style="margin-left: 50px; margin-right: 50px; text-align: justify;">

                                    <b>Parágrafo Segundo: Os pagamentos serão efetuados através de deposito mensal na conta corrente 
                                    nº351033550-8, agência 0835, do Banco Banrisul, e nome de SANDRO CARVALHO DE FRAGA, 
                                    CPF/MF606580290-53 ou pela CHAVE PIX 606580290-53.</b>

                                </p>
                                <p style="margin-left: 50px; margin-right: 50px; text-align: justify;">

                                    <b>Parágrafo Terceiro:</b> Sempre que necessário, o <b>CONTRATANTE</b> adiantará aos <b>CONTRATADOS</b> o 
                                    valor estimado de custas e despesas, obrigando-se estes a prestarem contas ao final de cada caso

                                </p>
                                <p style="margin-left: 50px; margin-right: 50px; text-align: justify;">

                                    <b>Parágrafo Quarto:</b> Os honorários advocatícios percebidos em ações judiciais ou acordos extrajudiciais, 
                                    reverterão sempre em favor dos CONTRATADOS, sem prejuízo do disposto no item “1”acima.

                                </p>
                                <p style="margin-left: 50px; margin-right: 50px; text-align: justify;">

                                    <b>Parágrafo Quinto:</b> O não pagamento liberará o contratado de dar seguimento na ação, independente de 
                                    aviso, notificação ou interpelação.

                                </p>
                                <p style="margin-left: 50px; margin-right: 50px; text-align: justify; margin-top: 20px;">
                                
                                    <b>DO PRAZO DO CONTRATO E CONDIÇÕES GERAIS</b>

                                </p>
                                <p style="margin-left: 50px; margin-right: 50px; text-align: justify;">

                                    <b>Cláusula Quarta:</b> O presente contrato começa a vigorar na data de sua assinatura e terá prazo
                                    indeterminado, podendo a parte que quiser rescindí-lo, fazê-lo mediante simples carta protocolada com 
                                    antecedência de 30(trinta) dias.

                                </p>
                                <p style="margin-left: 50px; margin-right: 50px; text-align: justify;">

                                    <b>Cláusula Quinta:</b> Manifestada a rescisão contratual, as procurações outorgadas serão substabelecidas 
                                    pelos CONTRATADOS, aos advogados indicados pelo CONTRATANTE, prestando-se imediatamente 
                                    as contas das custas e despesas, liquidando eventuais diferenças, com que as partes dar-se-ão mútua e 
                                    recíproca quitação.

                                </p>
                                <p style="margin-left: 50px; margin-right: 50px; text-align: justify;">

                                    <b>Cláusula Sexta:</b> O ajuizamento ou defesa em outra ação, será estipulado o preço e a forma de pagamento 
                                    para esta nova medida, independente do valor ora ajustado.

                                </p>
                                <p style="margin-left: 50px; margin-right: 50px; text-align: justify;">

                                    Elegem o foro da cidade de Porto Alegre para questões resultantes deste contrato, com expressa renúncia 
                                    de qualquer outro.

                                </p>
                                <p style="margin-left: 50px; margin-right: 50px; text-align: justify;">

                                    E, por estarem assim justos e contratados, assinam o presente em (2)duas vias de igual teor e forma. 

                                </p>
                                <br>
                                <p style="text-align: center;">Porto Alegre/RS, <?php echo $dia ?> de <?php echo $mes_extenso["$mes"] ?> de <?php echo $ano ?></p>
                                <br>
                                <hr style="width: 60%; color: black;">
                                <p style="text-align: center;"><b><?php echo mb_strtoupper($nomecliente) ?></b></p>
                                <br>
                                <div style="display: flex; justify-content: center;">

                                    <div style="text-align: center; margin: 0 100px;">
                                        <p>
                                            <b>SANDRO CARVALHO DE FRAGA</b>
                                        </p>
                                        <p>
                                            <b>OAB/RS 52.230</b>
                                        </p>
                                    </div>

                                    <div style="text-align: center; margin: 0 100px;">
                                        <p>
                                            <b>ELISETE CAMARGO DE MELO</b>
                                        </p>
                                        <p>
                                            <b>OAB/SC Nº 65356-B</b>
                                        </p>
                                    </div>
                                </div>
                                <br><br><br><br><br><br>
                                <p style="font-size: 12px; margin-top:10px; text-align: center;">Rua Guatambú, nº833, Fone(051) 32129832- Hípica Porto Alegre/RS</p>
                            </textarea>
                    </div>
                </div>
                <input type="hidden" name="datacriacao" value="<?php echo date('d/m/Y') ?>">
                <input type="hidden" name="nomecliente" id="nomecliente" value="<?php echo mb_strtoupper($nomecliente) ?>">
                <div class="final">
                    <div class="row">
                        <div class="col-8">

                        </div>
                        <div class="col-2">
                            <div id="voltar">
                                <a href="contratos.php"><button type="button" class="btn btn-secondary" id='salvar'>Volar</button></a>
                            </div>
                        </div>
                        <div class="col-2">
                            <div id="voltar">
                                <a href="#"><button type="submit" class="btn btn-success" name="enviar" id='salvar'>Concluir</button></a>
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
                    <a href="../../Processos/processos.php" class="links">
                        <span class="icon"><i class="fas fa-scale-balanced"></i></span>
                        <span class="item">Processos</span>
                    </a>
                </li>
                <div class="dropdown">
                    <li>
                        <a class="links" href="#">
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
                            <a href="../../Financeiro/Despesas/despesas.php" class="active" style="width: 100%;">
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
                            <a href="../../Equipe/Clientes/clientes.php" class="links" style="width: 100%;">
                                <span class="item2" style="margin-left: 15%;">Clientes</span>
                            </a>
                        </li>
                        <li>
                            <a href="../../Equipe/Advogados/advogados.php" class="links" style="width: 100%;">
                                <span class="item2" style="margin-left: 15%;">Advogados</span>
                            </a>
                        </li>
                    </div>
                </div>
                <div class="dropdown">
                    <li>
                        <a href="#" class="active">
                            <span class="icon"><i class="fas fa-file"></i></span>
                            <span class="item">Arquivos</span>
                            <svg xmlns="http://www.w3.org/2000/svg" style="margin-left: 32%;" width="16" height="13" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                            </svg>
                        </a>
                    </li>
                    <div class="dropdown-content">
                        <li>
                            <a href="../Procuracoes/procuracoes.php" class="links" style="width: 100%;">
                                <span class="item2" style="margin-left: 15%;">Procuração</span>
                            </a>
                        </li>
                        <li>
                            <a href="../Declaracoes/declaracao.php" class="links" style="width: 100%;">
                                <span class="item2" style="margin-left: 15%;">Declaração</span>
                            </a>
                        </li>
                        <li>
                            <a href="contratos.php" class="active" style="width: 100%;">
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
</html>