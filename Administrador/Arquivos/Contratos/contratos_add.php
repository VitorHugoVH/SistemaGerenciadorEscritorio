<?php
include_once '../../conexao_adm.php';

// VERIFICAÇÃO LOGIN
session_start();
$logged = $_SESSION['logged'] ?? null;

if (!$logged) {
    header('Location: /FragaeMelo/Site%20Fraga%20e%20Melo%20BootsTrap/login.php');
}

$id = $_POST['nprocesso'];

if (!empty($_POST['nprocesso'])) {
    //DADOS TABELA PROCESSO

    $sqlProcesso = "SELECT * FROM processo WHERE id=$id";
    $resultProcesso = $conn->query($sqlProcesso);

    while ($data_pro = mysqli_fetch_assoc($resultProcesso)) {
        $nomecliente = $data_pro['nomecliente'];
        $nomeadvogado = $data_pro['nomeadvogado'];
        $classeprocesso = $data_pro['classe'];
        $nomefalecido = $data_pro['falecido'];
        $nprocesso = $data_pro['nprocesso'];
        $numerovara = $data_pro['numerovara'];
        $parcelas = $data_pro['parcelas'];
        $valorcausa = $data_pro['valorHonorario'];
        $nomeVara = $data_pro['nomedavara'];
        $valorHonorario = $data_pro['valorHonorario'];
    }

    //DADOS TABELA CLIENTE

    $sqlCliente = "SELECT * FROM clientes WHERE nomecliente LIKE '%$nomecliente%'";
    $resultCliente = $conn->query($sqlCliente);

    while ($data_cli = mysqli_fetch_assoc($resultCliente)) {
        $cpf = $data_cli['cpf'];
        $sexo = $data_cli['sexo'];
        $rg = $data_cli['rg'];
        $estadocivil = $data_cli['estadocivil'];
        $profissao = $data_cli['profissao'];
        $nacionalidade = $data_cli['nacionalidade'];
        $rua = $data_cli['endereco1'];
        $numerocasa = $data_cli['numerocasa1'];
        $bairro = $data_cli['bairro1'];
        $cidade = $data_cli['cidade1'];
        $estado = $data_cli['estado1'];
        $endereco = $rua . ', ' . $numerocasa . ' - ' . $bairro . ', ' . $cidade . '/' . $estado;
    }

    //DADOS TABELA USUARIO

    $sqlAdvogado = "SELECT * FROM usuario WHERE nome LIKE '%$nomeadvogado%'";
    $resultAdvogado = $conn->query($sqlAdvogado);

    while ($data_adv = mysqli_fetch_assoc($resultAdvogado)) {
        $oab = $data_adv['oab'];
        $estadooab = $data_adv['estadooab'];
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../estilosAdm.css" />
    <link rel="icon" type="image/x-icon" href="imagens/icon.png" />
    <link rel="stylesheet" type="text/css" href="../../fontawesome/css/all.css" />
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
    </style>
    <title>Fraga e Melo Advogados Associados</title>
</head>

<body>
    <div class="wrapper">
        <div class="section">
            <div class="top_navbar">
                <a href="../../../../Site Fraga e Melo BootsTrap/index.php" class="link"><button
                        class="button button4">Voltar</button></a>
            </div>
            <div class="container" id='main'>
                <form action="contratos_view.php" method="POST">
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
                                <h4 class="title"><b>Confirmar dados contrato</b></h4>
                            </div>
                            <div class="campos">
                                <label for="nomecliente"><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Contratante</h6>
                                    </b></label>
                                <select class="form-select" name="nomecliente" id="nomecliente">
                                    <?php
                                    include_once '../../conexao_adm.php';
                                    
                                    $sqlcliente = 'SELECT nomecliente FROM clientes';
                                    $resultcliente = $conn->query($sqlcliente);
                                    
                                    while ($data_cliente = mysqli_fetch_assoc($resultcliente)) {
                                        $nomecli = $data_cliente['nomecliente'];
                                    
                                        if ($nomecliente == $nomecli) {
                                            echo "<option selected>$nomecli</option>";
                                        } else {
                                            echo "<option>$nomecli</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="campos">
                                <label for="numeroprocesso"><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Nº Identificação
                                            processo</h6>
                                    </b></label>
                                <input id="numeroprocesso" name="numeroprocesso" type="text" class="form-control" id="cnj" placeholder="0000.00.000000-0"
                                    oninput="this.value = mascaraCNJ(this.value)" maxlength="16" minlength="16"
                                    value="<?php echo $nprocesso; ?>" required>
                                <script>
                                    // seleciona o input com id "cnj"
                                    const cnjInput = document.querySelector("#cnj");

                                    // adiciona o event listener para "input"
                                    cnjInput.addEventListener("input", function() {
                                        // obtém o valor atual do input
                                        let value = this.value;
                                        // remove todos os caracteres que não são números ou letras
                                        value = value.replace(/[^\w]/gi, "");
                                        // adiciona os pontos e o hífen na posição correta
                                        if (value.length > 4) {
                                            value = value.substr(0, 4) + "." + value.substr(4);
                                        }
                                        if (value.length > 7) {
                                            value = value.substr(0, 7) + "." + value.substr(7);
                                        }
                                        if (value.length > 13) {
                                            value = value.substr(0, 13) + "-" + value.substr(13);
                                        }
                                        // atualiza o valor do input com a máscara aplicada
                                        this.value = value;
                                    });
                                </script>
                            </div>
                            <div class="campos">
                                <label class="form-label" for="nomedavara">Vara do Processo</label>
                                <div class="row">
                                    <div class="input-group">
                                        <select name="nomedavara" id="nomedavara" class="form-control" required>
                                            <option <?= $nomeVara == 'Vara Cívil' ? 'selected' : '' ?>>Vara Cívil</option>
                                            <option <?= $nomeVara == 'Vara Criminal' ? 'selected' : '' ?>>Vara Criminal</option>
                                            <option <?= $nomeVara == 'Vara da Família' ? 'selected' : '' ?>>Vara da Família</option>
                                            <option <?= $nomeVara == 'Vara do Trabalho' ? 'selected' : '' ?>>Vara do Trabalho</option>
                                            <option <?= $nomeVara == 'Vara da Infância e Juventude' ? 'selected' : '' ?>>Vara da Infância e Juventude</option>
                                            <option <?= $nomeVara == 'Vara de Execução Penal' ? 'selected' : '' ?>>Vara de Execução Penal</option>
                                        </select>
                                        <input type="hidden" name="outronomedavara" id="outronomedavara"
                                            class="form-control" placeholder="Vara processo">
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary" name="txtnomedavara" id="txtnomedavara"
                                                type="button" onclick="adicionar()">Adicionar
                                            </button>
                                            <button class="btn btn-secondary" name="selnomedavara" id="selnomedavara"
                                                type="button" onclick="selecionar()"
                                                style="display: none;">Selecionar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!--ADICIONAR OUTRO CAMPO VARA DO PROCESSO--->
                                <script>
                                    // RECEBER E DECLARAR VARIÁVEIS

                                    let camposelectvara = document.getElementById('nomedavara');
                                    let campotextvara = document.getElementById('outronomedavara');
                                    let botaoadicionar = document.getElementById('txtnomedavara');
                                    let botaoselecionar = document.getElementById('selnomedavara');

                                    // DEFINIR AS FUNÇÕES

                                    function adicionar() {
                                        camposelectvara.style.display = 'none';
                                        campotextvara.type = 'text';
                                        botaoadicionar.style.display = 'none';
                                        botaoselecionar.style.display = 'block';
                                    }

                                    function selecionar() {
                                        camposelectvara.style.display = 'block';
                                        campotextvara.type = 'hidden';
                                        botaoadicionar.style.display = 'block';
                                        botaoselecionar.style.display = 'none';
                                    }
                                </script>
                                <!--FIM ADICIONAR OUTRO CAMPO VARA DO PROCESSO--->
                            </div>
                            <div class="campos">
                                <label for="nomeadvogado"><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Nº da Vara</h6>
                                    </b></label>
                                <input type="text" maxlength="7" class="form-control" name="numerovara"
                                    id="numerovara" placeholder="0000000ª" onkeyup="formatarVara(this)"
                                    value="<?php echo $numerovara; ?>">
                                <script>
                                    function formatarVara(input) {
                                        // remove caracteres não numéricos
                                        let num = input.value.replace(/[^\d]/g, '');

                                        // adiciona 'ª' como último caractere, se houver número
                                        if (num) {
                                            num += 'ª';
                                        }

                                        // atualiza o valor do input com a string formatada
                                        input.value = num;
                                    }
                                </script>
                            </div>
                            <div class="campos">
                                <label class="form-label" for="valorhonorario">Valor Honorário</label>
                                <input type="text" id="valorhonorario" name="valorhonorario" class="form-control"
                                    value="<?php echo $valorHonorario ?>" maxlength="14" required />
                            </div>
                            <script>
                                var inputHonorario = document.getElementById('valorhonorario');
                            
                                inputHonorario.addEventListener('input', function() {
                                    formatarValor(this);
                                });
                            
                                function formatarValor(input) {
                                    var valor = input.value;
                            
                                    // Remove tudo que não é dígito
                                    valor = valor.replace(/\D/g, '');
                            
                                    // Adiciona a vírgula para separar os centavos
                                    valor = valor.slice(0, -2) + ',' + valor.slice(-2);
                            
                                    // Adiciona o símbolo R$
                                    valor = 'R$ ' + valor;
                            
                                    // Atualiza o valor do input
                                    input.value = valor;
                            
                                    // Verifica se o valor mínimo foi atingido
                                    var valorNumerico = parseFloat(valor.replace(/[^0-9,-]+/g, "").replace(",", "."));
                                    if (valorNumerico < 100) {
                                        input.setCustomValidity('O valor mínimo é R$ 100,00');
                                    } else {
                                        input.setCustomValidity('');
                                    }
                                }
                            
                                // Chama a função de formatação inicialmente
                                formatarValor(inputHonorario);
                            </script>
                            <div class="campos">
                                <label for="nomeadvogado"><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Parcelas</h6>
                                    </b></label>
                                <input type="number" name="parcelas" id="parcelas" class="form-control"
                                    placeholder="3" value="<?php echo $parcelas; ?>" max="24" min="1" maxlength="2" required />
                            </div>
                            <div class="campos">
                                <label for="primeiroPagamento"><b><h6 style="font-family: arial, sans-serif; font-size: 16px;">Data Primeiro Pagamento</h6></b></label>
                                <input type="date" class="form-control" id="primeiroPagamento" name="primeiroPagamento" required>
                            </div>
                          
                            <!--DEFINIR DATA PARA PAGAMENTO HOJE-->

                            <script>
                                // Obtém a data atual
                                var dataAtual = new Date();
                            
                                // Formata a data atual para o formato 'YYYY-MM-DD'
                                var ano = dataAtual.getFullYear();
                                var mes = String(dataAtual.getMonth() + 1).padStart(2, '0');
                                var dia = String(dataAtual.getDate()).padStart(2, '0');
                                var dataFormatada = `${ano}-${mes}-${dia}`;
                            
                                // Define o valor padrão da data no input
                                document.getElementById('primeiroPagamento').value = dataFormatada;
                            </script>
                            
                        </div>
                    </div>
                    <div class="final">
                        <div class="row">
                            <div class="col-8">

                            </div>
                            <div class="col-2">
                                <div id="voltar">
                                    <a href="contratos.php"><button type="button" class="btn btn-secondary"
                                            id='salvar'>Voltar</button></a>
                                </div>
                            </div>
                            <div class="col-2">
                                <div id="voltar">
                                    <a href="#"><button type="submit" class="btn btn-success" name="enviar"
                                            id='salvar'>Próximo</button></a>
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
                            <a href="../../Agenda/Compromissos/agenda_compromissos.php" class="links"
                                style="width: 100%;">
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