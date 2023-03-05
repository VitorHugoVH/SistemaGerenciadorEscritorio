<?php
include_once('conexao_adm.php');

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
        $endereco = $rua . ", " . $numerocasa . " - " . $bairro . ", " . $cidade . "/" . $estado;
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
    <link rel="stylesheet" type="text/css" href="estilosAdm.css" />
    <link rel="icon" type="image/x-icon" href="imagens/icon.png" />
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <title>Fraga e Melo Advogados Associados</title>
</head>

<body>
    <div class="wrapper">
        <div class="section">
            <div class="top_navbar">
                <a href="/Users/vh007/OneDrive/%C3%81rea%20de%20Trabalho/Tudo/Site%20TCC/Site%20Fraga%20e%20Melo%20BootsTrap/index.php" class="link"><button class="button button4">Voltar</button></a>
            </div>
            <div class="container" id='main'>
                <form action="procuracoes_view.php" method="POST">
                    <div class="row">
                        <div class="col-10">
                            <div class="bloco3">
                                <h3 class="text-muted">Criar procuração</h3>
                            </div>
                        </div>
                        <div class="col-2">

                        </div>
                    </div>
                    <div class="bloco4">
                        <div class="row">
                            <div class="titulo">
                                <h4 class="title"><b>Confirmar dados procuração</b></h4>
                            </div>
                            <div class="campos">
                                <label for="nomecliente"><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Outorgante</h6>
                                    </b></label>
                                <select class="form-select" name="nomecliente" id="nomecliente">
                                    <?php
                                    include_once('conexao_adm.php');

                                    $sqlcliente = "SELECT nomecliente FROM clientes";
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
                                <label for="nacionalidade"><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Nacionalidade</h6>
                                    </b></label>
                                <select class="form-select" name="nacionalidade" id="nacionalidade">
                                    <option <?= ($nacionalidade == 'brasileiro') ? 'selected' : ' ' ?>>brasileiro</option>
                                    <option <?= ($nacionalidade == 'argentino') ? 'selected' : ' ' ?>>argentino</option>
                                    <option <?= ($nacionalidade == 'colombiano') ? 'selected' : ' ' ?>>colombiano</option>
                                    <option <?= ($nacionalidade == 'peruano') ? 'selected' : ' ' ?>>peruano</option>
                                    <option <?= ($nacionalidade == 'chileno') ? 'selected' : ' ' ?>>chileno</option>
                                    <option <?= ($nacionalidade == 'equatoriano') ? 'selected' : ' ' ?>>equatoriano</option>
                                    <option <?= ($nacionalidade == 'uruguaiano') ? 'selected' : ' ' ?>>uruguaiano</option>
                                    <option <?= ($nacionalidade == 'venezuelano') ? 'selected' : ' ' ?>>venezuelano</option>
                                    <option <?= ($nacionalidade == 'boliviano') ? 'selected' : ' ' ?>>boliviano</option>
                                    <option <?= ($nacionalidade == 'guianense') ? 'selected' : ' ' ?>>guianense</option>
                                    <option <?= ($nacionalidade == 'surinamense') ? 'selected' : ' ' ?>>surinamense</option>
                                    <option <?= ($nacionalidade == 'paraguaiano') ? 'selected' : ' ' ?>>paraguaiano</option>
                                    <option <?= ($nacionalidade == 'franco-guianense') ? 'selected' : ' ' ?>>franco-guianense</option>
                                </select>
                            </div>
                            <div class="campos">
                                <label for="estadocivil"><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Estado civil</h6>
                                    </b></label>
                                <select class="form-select" name="estadocivil" id="estadocivil">
                                    <option <?= ($estadocivil == 'Solteiro(a)') ? 'selected' : ' ' ?>>Solteiro(a)</option>
                                    <option <?= ($estadocivil == 'Casado(a)') ? 'selected' : ' ' ?>>Casado(a)</option>
                                    <option <?= ($estadocivil == 'Separado(a) judicialmente') ? 'selected' : ' ' ?>>Separado(a) judicialmente</option>
                                    <option <?= ($estadocivil == 'Divorciado(a)') ? 'selected' : ' ' ?>>Divorciado(a)</option>
                                    <option <?= ($estadocivil == 'Viúvo(a)') ? 'selected' : ' ' ?>>Viúvo(a)</option>
                                    <option <?= ($estadocivil == 'União estável') ? 'selected' : ' ' ?>>União estável</option>
                                </select>
                            </div>
                            <div class="campos">
                                <label for="profissao"><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Profissão do cliente</h6>
                                    </b></label>
                                <input type="text" name="profissaocliente" id="profissaocliente" class="form-control" placeholder="Profissão do cliente" value="<?php echo $profissao ?>">
                            </div>
                            <div class="campos">
                                <label for="rg"><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">RG do cliente</h6>
                                    </b></label>
                                <input type="text" class="form-control" id="rg" name="rg" onkeypress="$(this).mask('00.000.000-0');" placeholder="00.000.000-0" value="<?php echo $rg ?>">
                            </div>
                            <div class="campos">
                                <label for="cpf"><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">CPF do cliente</h6>
                                    </b></label>
                                <input type="text" class="form-control" id="cpf" name="cpf" onkeypress="$(this).mask('000.000.000-00');" placeholder="000.000.000-00" value="<?php echo $cpf ?>">
                            </div>
                            <div class="campos">
                                <label for="endereco"><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Endereço</h6>
                                    </b></label>
                                <input type="text" name="endereco" id="endereco" class="form-control" value="<?php echo $endereco ?>" placeholder="Endereço do cliente">
                            </div>
                            <div class="campos">
                                <label for="nomeadvogado"><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Outorgado</h6>
                                    </b></label>
                                <select class="form-select" name="nomeadvogado" id="nomeadvogado">
                                    <?php
                                    include_once('conexao_adm.php');

                                    $sqlUsuario = "SELECT * FROM usuario";
                                    $resultUsuario = $conn->query($sqlUsuario);

                                    while ($data_user = mysqli_fetch_assoc($resultUsuario)) {
                                        $nomeadv = $data_user['nome'];

                                        if ($nomeadv == $nomeadvogado) {
                                            echo "<option selected>" . $nomeadv . "</option>";
                                        } else {
                                            echo "<option>" . $nomeadv . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="campos">
                                <div class="row">
                                    <label for="client1"><b>
                                            <h6 style="font-family: arial, sans-serif; font-size: 16px;">Classe processual</h6>
                                        </b></label>
                                    <div class="input-group">
                                        <select class="form-select" aria-label="Default select example" name="classeprocesso" id="classeprocesso" onchange="nfalecido()">
                                            <option <?= ($classeprocesso == 'Ação de cobrança') ? 'selected' : ' ' ?>>Ação de cobrança</option>
                                            <option <?= ($classeprocesso == 'Ação de despejo') ? 'selected' : ' ' ?>>Ação de despejo</option>
                                            <option <?= ($classeprocesso == 'Ação de indenização') ? 'selected' : ' ' ?>>Ação de indenização</option>
                                            <option <?= ($classeprocesso == 'Divórcio') ? 'selected' : ' ' ?>>Divórcio</option>
                                            <option <?= ($classeprocesso == 'Execução de alimentos') ? 'selected' : ' ' ?>>Execução de alimentos</option>
                                            <option <?= ($classeprocesso == 'Impugnação do valor da causa') ? 'selected' : ' ' ?>>Impugnação do valor da causa</option>
                                            <option <?= ($classeprocesso == 'Processo de inventário') ? 'selected' : ' ' ?>>Processo de inventário</option>
                                        </select>
                                        <input type="hidden" name="outraclasse" id="outraclasse" class="form-control" placeholder="Nome da classe">
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary" name="textclass" id="textclass" type="button" onclick="classeadd()">Adicionar</button>
                                            <button class="btn btn-secondary" name="selectclass" id="selectclass" type="button" onclick="classeselect()" style="display: none;">Selecionar</button>
                                        </div>
                                        <script>
                                            function classeadd() {
                                                document.getElementById('classeprocesso').style.display = "none";
                                                document.getElementById('outraclasse').type = "text";
                                                document.getElementById('textclass').style.display = "none";
                                                document.getElementById('selectclass').style.display = "block";
                                            }

                                            function classeselect() {
                                                document.getElementById('classeprocesso').style.display = "block";
                                                document.getElementById('outraclasse').type = "hidden";
                                                document.getElementById('textclass').style.display = "block";
                                                document.getElementById('selectclass').style.display = "none";
                                            }
                                        </script>
                                    </div>
                                </div>
                            </div>
                            <!---Javascript Falecido--->
                            <div id="falecidoarea" style="  margin-top: 1%; margin-bottom: 2%; display: none;">
                                <label class="form-label">Nome do falecido</label>
                                <input type="text" name="nomefalecido" id="nomefalecido" class="form-control" placeholder="Nome do falecido" value="<?php echo $nomefalecido ?>">
                            </div>
                            <script>
                                function nfalecido() {
                                    if (document.getElementById('classeprocesso').value == 'Processo de inventário') {
                                        document.getElementById('falecidoarea').style.display = 'block';
                                    } else {
                                        document.getElementById('falecidoarea').style.display = 'none';
                                    }
                                }
                            </script>
                            <!---Javascript Falecido Final--->
                        </div>
                    </div>
                    <input type="hidden" name="datacriacao" value="<?php echo date('d/m/Y') ?>">
                    <input type="hidden" name="sexo" value="<?php echo $sexo ?>">
                    <div class="final">
                        <div class="row">
                            <div class="col-8">

                            </div>
                            <div class="col-2">
                                <div id="voltar">
                                    <a href="procuracoes.php"><button type="button" class="btn btn-secondary" id='salvar'>Volar</button></a>
                                </div>
                            </div>
                            <div class="col-2">
                                <div id="voltar">
                                    <a href="#"><button type="submit" class="btn btn-success" name="enviar" id='salvar'>Próximo</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="sidebar">
            <div class="profile">
                <img src="imagensADM/logoadmin.png" alt="profile_picture" width="35%">
                <h3>Advocacia</h3>
                <p>Fraga e Melo Advogados</p>
            </div>
            <ul class="lista">
                <li>
                    <a href="admin.php" class="links">
                        <span class="icon"><i class="fas fa-desktop"></i></span>
                        <span class="item">Deashboard</span>
                    </a>
                </li>
                <li>
                    <a class="links" href="processos.php">
                        <span class="icon"><i class="fas fa-scale-balanced"></i></span>
                        <span class="item">Processos</span>
                    </a>
                </li>
                <li>
                    <a href="agenda.php" class="links">
                        <span class="icon"><i class="fas fa-calendar-days"></i></span>
                        <span class="item">Agenda</span>
                    </a>
                </li>
                <li>
                    <a href="cobrança.php" class="links">
                        <span class="icon"><i class="fas fa-rocket"></i></span>
                        <span class="item">Marketing</span>
                    </a>
                </li>
                <div class="dropdown">
                    <li>
                        <a href="financeiro.php" class="links">
                            <span class="icon"><i class="fas fa-dollar-sign"></i></span>
                            <span class="item">Financeiro</span>
                            <svg xmlns="http://www.w3.org/2000/svg" style="margin-left: 30%;" width="16" height="13" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                            </svg>
                        </a>
                    </li>
                    <div class="dropdown-content">
                        <li>
                            <a href="despesas.php" class="links" style="width: 100%;">
                                <span class="item2" style="margin-left: 15%;">Despesas</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="links">
                                <span class="item2" style="margin-left: 15%; width: 100%;">Receitas</span>
                            </a>
                        </li>
                    </div>
                </div>
                <li>
                    <a href="equipe.php" class="links">
                        <span class="icon"><i class="fas fa-users"></i></span>
                        <span class="item">Equipe</span>
                    </a>
                </li>
                <div class="dropdown">
                    <li>
                        <a href="equipe.php" class="active">
                            <span class="icon"><i class="fas fa-file"></i></span>
                            <span class="item">Arquivos</span>
                            <svg xmlns="http://www.w3.org/2000/svg" style="margin-left: 32%;" width="16" height="13" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                            </svg>
                        </a>
                    </li>
                    <div class="dropdown-content">
                        <li>
                            <a href="procuracoes.php" class="links" style="width: 100%;">
                                <span class="item2" style="margin-left: 15%;">Procuração</span>
                            </a>
                        </li>
                        <li>
                            <a href="declaracao.php" class="links" style="width: 100%;">
                                <span class="item2" style="margin-left: 15%;">Declaração</span>
                            </a>
                        </li>
                        <li>
                            <a href="contrato.php" class="links" style="width: 100%;">
                                <span class="item2" style="margin-left: 15%;">Contrato</span>
                            </a>
                        </li>
                    </div>
                </div>
                <li>
                    <a href="configuracoes.php" class="links">
                        <span class="icon"><i class="fas fa-edit"></i></span>
                        <span class="item">Editor de Texto</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</body>
<script>
    function add() {
        document.getElementById('classeprocesso').style.display = 'none';
        document.getElementById('outraclasse').type = 'text';
        document.getElementById('adicionar').type = 'hidden';
        document.getElementById('selecionar').type = 'button';
    }
</script>

</html>