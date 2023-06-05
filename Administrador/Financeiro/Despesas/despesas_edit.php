<?php

// VERIFICAÇÃO LOGIN
session_start();
$logged = $_SESSION['logged'] ?? NULL;

if (!$logged) {
  header('Location: /FragaeMelo/Site%20Fraga%20e%20Melo%20BootsTrap/login.php');
};

if (!empty($_GET['id'])) {

    include_once('../../conexao_adm.php');

    $id = $_GET['id'];

    $sqlEdit = "SELECT * FROM despesa WHERE id=$id";
    $resultEdit = $conn->query($sqlEdit);

    if ($resultEdit->num_rows > 0) {

        while ($data = mysqli_fetch_assoc($resultEdit)) {

            $datavencimento = $data['datavencimento'];
            $valor = $data['valor'];
            $categoria = $data['categoria'];
            $categoria2 = $data['categoria2'];
            $subcategoria = $data['subcategoria'];
            $subcategoria2 = $data['subcategoria2'];
            $observacao = $data['observacao'];
            $situacao = $data['situacao'];
            $datapagamento = $data['datapagamento'];
            $juros = $data['juros'];
            $total = $data['total'];
            $repetir = $data['repetir'];
            $parcelas = $data['parcelas'];
            $anexo = $data['anexo'];
            $datacriacao = $data['datacriacao'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

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
                <a href="../../../../Site Fraga e Melo BootsTrap/index.php" class="link"><button class="button button4">Voltar</button></a>
            </div>
            <div class="container" id='main'>
                <form action="despesas_save.php" method="POST">
                    <div class="row">
                        <div class="col-10">
                            <div class="bloco3">
                                <h3 class="text-muted">Adicionar</h3>
                            </div>
                        </div>
                        <div class="col-2">
                            <div id="voltar">
                                <a href="despesas.php"><button type="button" class="btn btn-secondary" id='voltar1'>Volar</button></a>
                            </div>
                        </div>
                    </div>
                    <div class="bloco4">
                        <div class="row">
                            <div class="titulo">
                                <h4 class="title"><b>Cadastrar Despesas</b></h4>
                            </div>
                            <div class="campos">
                                <label for="vencimento"><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Data vencimento</h6>
                                    </b></label>
                                <input type="date" name="vencimento" id="vencimento" class="form-control" value="<?php echo $datavencimento; ?>" placeholder="00/00/0000">
                            </div>
                            <div class="campos">
                                <label><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Valor</h6>
                                    </b></label>
                                <input type="number" name="valor" id="valor" placeholder="0,00" class="form-control" value="<?php echo $valor; ?>">
                            </div>
                            <div class="campos">
                                <div class="row">
                                    <label for="categoria"><b>
                                            <h6 style="font-family: arial, sans-serif; font-size: 16px;">Categoria</h6>
                                        </b></label>
                                    <div class="col-10">
                                        <select name="categoria" id="categoria" class="form-control">
                                            <option value="Impostos" <?= ($categoria == 'Impostos') ? "selected" : ''; ?>>Impostos</option>
                                            <option value="Infra-estrutura" <?= ($categoria == 'Infra-estrutura') ? "selected" : ''; ?>>Infra-estrutura</option>
                                        </select>
                                        <input type="hidden" name="categoria2" id="alterar" class="form-control" placeholder="Adicionar outra..." value="<?php echo $categoria2; ?>">
                                    </div>
                                    <div class="col-2">
                                        <button class="btn btn-secondary" name="botao" id="botao" onclick="mudar()" type="button">Adicionar</button>
                                        <button class="btn btn-secondary" name="botao2" id="botao2" style="display: none;" onclick="mudar2()" type="button">Selecionar</button>
                                    </div>
                                </div>
                            </div>
                            <div class="campos">
                                <div class="row">
                                    <label for="subcategoria3"><b>
                                            <h6 style="font-family: arial, sans-serif; font-size: 16px;">Subcategoria</h6>
                                        </b></label>
                                    <div class="col-10">
                                        <select name="subcategoria3" id="subcategoria3" class="form-control">
                                            <option value="IPTU" <?= ($subcategoria == 'IPTU') ? 'selected' : ''; ?>>IPTU</option>
                                            <option value="IPVA" <?= ($subcategoria == 'IPVA') ? 'selected' : ''; ?>>IPVA</option>
                                        </select>
                                        <input type="hidden" name="subcategoria4" id="alterar3" class="form-control" placeholder="Adicionar outra..." value="<?php echo $subcategoria2; ?>">
                                    </div>
                                    <div class="col-2">
                                        <button class="btn btn-secondary" name="botao3" id="botao3" onclick="Sub()" type="button">Adicionar</button>
                                        <button class="btn btn-secondary" name="botao4" id="botao4" style="display: none;" onclick="Sub2()" type="button">Selecionar</button>
                                    </div>
                                </div>
                            </div>
                            <div class="campos">
                                <label for="desctarefa"><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Observação</h6>
                                    </b></label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="1" placeholder="Observação" name="observacoes" id="observacoes"><?php echo $observacao; ?></textarea>
                            </div>
                            <div class="campos">
                                <label><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Situação</h6>
                                    </b></label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Apagar" id="pagar" name="status" <?= ($situacao == 'Á pagar') ? "checked" : ''; ?> placeholder=".">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        A pagar
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Pago" id="pago" onclick="Check()" name="status" <?= ($situacao == 'Pago') ? "checked" : ''; ?> placeholder=".">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Pago
                                    </label>
                                </div>
                            </div>
                            <div id="campos3" style="margin-top: 2%; margin-bottom: 2%; display: none;">
                                <label for="datapagamento"><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Data do pagamento</h6>
                                    </b></label>
                                <input type="date" name="datapagamento" id="datapagamento" class="form-control" placeholder="00/00/0000" value="<?php echo $datapagamento; ?>">
                            </div>
                            <div class="campos">
                                <label for="juros"><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Valor do juros</h6>
                                    </b></label>
                                <input type="number" name="juros" id="juros" class="form-control" placeholder="0,00" value="<?php echo $juros; ?>">
                            </div>
                            <div class="campos">
                                <label for="total"><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Total</h6>
                                    </b></label>
                                <input type="number" name="total" id="total" class="form-control" placeholder="0,00" value="<?php echo $total ?>">
                            </div>
                            <div class="campos">
                                <label><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Repetir valor?</h6>
                                    </b></label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="uma" id="flexCheckDefault" name="repetir" <?= ($repetir == 'Não Repetir') ? "checked" : '' ?>>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Desejo inserir este valor apenas um vez
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="repetir" id="flexCheckChecked" onclick="isChecked()" name="repetir" <?= ($repetir == 'Repetir') ? "checked" : '' ?>>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Desejo repetir este valor
                                    </label>
                                </div>
                            </div>
                            <div id="campos2" style="margin-top: 2%; margin-bottom: 2%; display: none;">
                                <label><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Nº de parcelas:</h6>
                                    </b></label>
                                <input type="number" name="parcelas" id="parcelas" class="form-control" placeholder="3" value="<?php echo $parcelas; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="bloco5">
                        <div class="row">
                            <div class="titulo">
                                <h4 class="title"><b>Anexo</b></h4>
                            </div>
                            <div class="campos">
                                <input type="file" name="anexo" id="anexo" class="form-control" value="<?php echo $anexo ?>" placeholder="<?php echo $anexo ?>">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="datacriacao" value="<?php echo date('d/m/Y') ?>">
                    <input type="hidden" name="id" id="id" value="<?php echo $id ?>">
                    <div class="final">
                        <div class="row">
                            <div class="col-8">

                            </div>
                            <div class="col-2">
                                <div>
                                    <a href="despesas.php"><button type="button" class="btn btn-outline-secondary" id="voltar2">Cancelar</button></a>
                                </div>
                            </div>
                            <div class="col-2">
                                <div id="voltar">
                                    <a href="receitas_insert.php"><button type="submit" class="btn btn-success" name="atualizar" id='atualizar'>Atualizar</button></a>
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
                        <span class="item">Deashboard</span>
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
                <li>
                    <a href="../../Site_Marketing/site_marketing.php" class="links">
                        <span class="icon"><i class="fas fa-network-wired"></i></span>
                        <span class="item">Site</span>
                    </a>
                </li>
                <div class="dropdown">
                    <li>
                        <a href="#" class="active">
                            <span class="icon"><i class="fas fa-dollar-sign"></i></span>
                            <span class="item">Financeiro</span>
                            <svg xmlns="http://www.w3.org/2000/svg" style="margin-left: 27%;" width="16" height="13" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                            </svg>
                        </a>
                    </li>
                    <div class="dropdown-content">
                        <li>
                            <a href="despesas.php" class="active" style="width: 100%;">
                                <span class="item2" style="margin-left: 15%;">Despesas</span>
                            </a>
                        </li>
                        <li>
                            <a href="../Receitas/receitas.php" class="links">
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
                <li>
                    <a href="configuracoes.php" class="links">
                        <span class="icon"><i class="fas fa-edit"></i></span>
                        <span class="item">Editor de Texto</span>
                    </a>
                </li>
            </ul>
        </div>
        <!--FIM NAVEGAÇÃO-->
    </div>
    <script>
        function mudar() {
            document.getElementById('categoria').style.display = "none";
            document.getElementById('alterar').type = "text";
            document.getElementById('botao').style.display = "none";
            document.getElementById('botao2').style.display = "block";
        }

        function mudar2() {
            document.getElementById('categoria').style.display = "block";
            document.getElementById('alterar').type = "hidden";
            document.getElementById('botao').style.display = "block";
            document.getElementById('botao2').style.display = "none";
        }

        function Sub() {
            document.getElementById('subcategoria3').style.display = "none";
            document.getElementById('alterar3').type = "text";
            document.getElementById('botao3').style.display = "none";
            document.getElementById('botao4').style.display = "block";
        }

        function Sub2() {
            document.getElementById('subcategoria3').style.display = "block";
            document.getElementById('alterar3').type = "hidden";
            document.getElementById('botao3').style.display = "block";
            document.getElementById('botao4').style.display = "none";
        }

        function Check() {
            if (document.getElementById("pago").checked) {
                document.getElementById("campos3").style.display = "block";
            } else {
                document.getElementById("campos3").style.display = "none";
            }
        }

        function isChecked() {
            if (document.getElementById("flexCheckChecked").checked) {
                document.getElementById("campos2").style.display = "block";
            } else {
                document.getElementById("campos2").style.display = "none";
            }
        }
    </script>
</body>

</html>