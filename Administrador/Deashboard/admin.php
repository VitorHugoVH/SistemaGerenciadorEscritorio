<?php
include_once('../conexao_adm.php');
include('../sessao_usuarios.php');

// VERIFICAÇÃO LOGIN E NÍVEL DE USUÁRIO

verificarAcesso($conn);

$username = $_SESSION['username'] ?? '';

$mesatual = date('F/Y');

/*FUNÇÃO PROCESSOS ESTE MES*/

$sqlMes = "SELECT * FROM processo WHERE mes LIKE '%$mesatual%'";
$result = $conn->query($sqlMes);

$totalnmes = 0;
while ($user_data = mysqli_fetch_assoc($result)) {
    $estemes = $user_data['mes'];
    $totalnmes += 1;
}

/*FUNÇÃO PROCESSOS ESTE MES*/

/*FUNÇÃO COMPROMISSOS ESTE MES*/

$sqlMesComp = "SELECT * FROM compromisso WHERE mes LIKE '%$mesatual%'";
$resultCompMes = $conn->query($sqlMesComp);

$totalComp = 0;
while ($user_comp = mysqli_fetch_assoc($resultCompMes)) {
    $estemesComp = $user_comp['mes'];
    $totalComp += 1;
}

/*FUNÇÃO COMPROMISSOS ESTE MES*/


/*FUNÇÃO PRAZOS ESTE MES*/

    // Obter o número do mês atual
    $mes_atual = date('m');
    $totalPrazo = 0;

    // Consulta SQL para buscar os prazos marcados para este mês
    $sql = "SELECT * FROM prazo WHERE DATE_FORMAT(datafinal, '%m') = '$mes_atual' AND atendido = 'Não'";

    // Executar a consulta
    $resultPrazoMes = mysqli_query($conn, $sql);

    // Processar o resultado
    if (mysqli_num_rows($resultPrazoMes) > 0) {
        while ($row = mysqli_fetch_assoc($resultPrazoMes)) {
            $totalPrazo += 1;
        }
    } else {
        $totalPrazo = 0;
    }

/*FUNÇÃO PRAZOS ESTE MES*/

/*FUNÇÃO GRÁFICO PROCESSOS*/

$sqlGrafico = 'SELECT * FROM processo';
$result2 = $conn->query($sqlGrafico);
$totalJaneiro = 0;
$totalFevereiro = 0;
$totalMarco = 0;
$totalAbril = 0;
$totalMaio = 0;
$totalJunho = 0;
$totalJulho = 0;
$totalAgosto = 0;
$totalSetembro = 0;
$totalOutubro = 0;
$totalNovembro = 0;
$totalDezembro = 0;
$anoatual = date('Y');

while ($user_grafico = mysqli_fetch_assoc($result2)) {
    $mes = $user_grafico['mes'];

    if ($mes == 'January/' . +$anoatual) {
        $totalJaneiro += 1;
    } elseif ($mes == 'February/' . +$anoatual) {
        $totalFevereiro += 1;
    } elseif ($mes == 'March/' . +$anoatual) {
        $totalMarco += 1;
    } elseif ($mes == 'April/' . +$anoatual) {
        $totalAbril += 1;
    } elseif ($mes == 'May/' . +$anoatual) {
        $totalMaio += 1;
    } elseif ($mes == 'June/' . +$anoatual) {
        $totalJunho += 1;
    } elseif ($mes == 'July/' . +$anoatual) {
        $totalJulho += 1;
    } elseif ($mes == 'August/' . +$anoatual) {
        $totalAgosto += 1;
    } elseif ($mes == 'September/' . +$anoatual) {
        $totalSetembro += 1;
    } elseif ($mes == 'October/' . +$anoatual) {
        $totalOutubro += 1;
    } elseif ($mes == 'Novmber/' . +$anoatual) {
        $totalNovembro += 1;
    } elseif ($mes == 'December/' . +$anoatual) {
        $totalDezembro += 1;
    }
}

/*FUNÇÃO GRÁFICO PROCESSOS*/

/*FUNÇÃO COBRANÇAS*/

$sqlCobrancas = "SELECT * FROM receita WHERE statuss='Recebido' AND MONTH(vencimento) = MONTH(CURRENT_DATE)";
$resultCobranca = $conn->query($sqlCobrancas);

$valorCobrancaTotal = 0;

while($data_combranca = mysqli_fetch_assoc($resultCobranca)){
    
    $valorCombrancas = $data_combranca['valor'];

    $valorCombrancas = floatval(preg_replace('/[^\d.,]/', '', $valorCombrancas));
    $valorCobrancaTotal += $valorCombrancas;
}

$valorCobrancaTotal = number_format($valorCobrancaTotal, 2, ',', '.');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../estilosAdm.css" />
    <link rel="icon" type="image/x-icon" href="../imagensADM/logoadmin.png" />
    <link rel="stylesheet" type="text/css" href="../fontawesome/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Fraga e Melo Advogados Associados</title>
    <style>
        /*INICIO ESTILO BARRA DE ROLAGEM NAVBAR*/

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

        /*FIM ESTILO BARRA DE ROLAGEM NAVBAR*/

        .comp::-webkit-scrollbar {
            width: 10px;
        }

        .comp::-webkit-scrollbar-track {
            background-color: lightgray;
        }

        .comp::-webkit-scrollbar-thumb {
            background-color: #4d79ff;
            border-radius: 10px;
            opacity: 0.7;
        }
    </style>
</head>

<body>
    <!--ÍNICIO NAV BAR-->
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
                  <a class="dropdown-item" href="#">Meus dados</a>
                  <a class="dropdown-item" href="#">Alterar login</a>
                  <a class="dropdown-item" href="#">Alterar senha</a>
                  <!-- Mais opções, se necessário -->
                  <li><hr class="dropdown-divider"></li>
                  <a class="dropdown-item" href="#">Sair</a>
                </div>
              </div>
            <!--INÍCIO CONTEÚDO-->
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="area1">
                            <span class="icon"><i class="fas fa-barcode"></i></span>
                            <span class="item"><b>R$ <?php echo $valorCobrancaTotal; ?></b></span>
                            <p class="info"><small>Cobrança(s) recebidas este mês</small></p>
                        </div>
                        <div class="area1">
                            <span class="icon"><i class="fas fa-calendar-days"></i></span>
                            <span class="item"><b><?php echo $totalComp; ?></b> Compromisso(s)</span>
                            <p class="info"><small>Agendado(s) para este mês</small></p>
                        </div>
                        <div class="area2">
                            <span class="icon"><i class="fas fa-scale-balanced"></i></span>
                            <span class="item"><b><?php echo $totalnmes; ?></b> Processo(s)</span>
                            <p class="info"><small>Adicionado(s) este mês</small></p>
                        </div>
                        <div class="area2">
                            <span class="icon"><i class="fas fa-rocket"></i></span>
                            <span class="item"><b><?php  echo $totalPrazo; ?></b> Prazo(s)</span>
                            <p class="info"><small>Marcado(s) para este mês</small></p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="area3">
                            <canvas id="myChart" style="width: 100%; height: 100%;"></canvas>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="parte">
                            <label><b>Compromisso</b></label>
                            <a href="../Agenda/Compromissos/agenda_compromissos.php"><input type="submit" value="Ver Mais" name="btn"
                                                                        class="btn btn-primary" style="float: right; width: 25%; padding: 1%;"></a>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="parte">
                            <label><b>Tarefas</b></label>
                            <a href="../Agenda/Tarefas/agenda_tarefas.php"><input type="submit" value="Ver Mais" name="btn"
                                                                   class="btn btn-primary" style="float: right; width: 25%; padding: 1%;"></a>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="parte">
                            <label><b>Prazos</b></label>
                            <a href="../Agenda/Prazos/agenda_prazos.php"><input type="submit" value="Ver Mais" name="btn"
                                                                  class="btn btn-primary" style="float: right; width: 25%; padding: 1%;"></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="comp" style="overflow-y: auto;">
                            <table class="table">
                                <tbody>
                                    <?php
                                    include_once('../conexao_adm.php');

                                    $sqlComp = 'SELECT * FROM compromisso';
                                    $resultComp = $conn->query($sqlComp);
                                    
                                    if (mysqli_affected_rows($conn) > 0) {
                                        while ($comp = mysqli_fetch_assoc($resultComp)) {
                                            $datacomp = $comp['datafinal'];
                                            $datacomp = date('d/m/Y', strtotime($datacomp));
                                            echo '<tr>';
                                            echo '<td style="white-space: nowrap;"><small><b>' . $comp['id'] . ' - ' . $comp['nomecompromisso'] . '</b> - ' . $datacomp . '</small></td>';
                                        }
                                    } else {
                                        echo '<tr>';
                                        echo '<td style="white-space: nowrap;"><small>Nenhum compromisso próximo</small></td>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="comp" style="overflow-y: auto;">
                            <table class="table">
                                <tbody>
                                    <?php
                                    include_once('../conexao_adm.php');

                                    $sqlTarefa = 'SELECT * FROM tarefas';
                                    $resultarefa = $conn->query($sqlTarefa);
                                    
                                    if (mysqli_affected_rows($conn) > 0) {
                                        while ($tarefa = mysqli_fetch_assoc($resultarefa)) {
                                            $datatarefa = $tarefa['prazo'];
                                            $datatarefa = date('d/m/Y', strtotime($datatarefa));
                                            echo '<tr>';
                                            echo '<td style="white-space: nowrap;"><small><b>' . $tarefa['id'] . ' - ' . $tarefa['titulo'] . '</b> - ' . $datatarefa . '</small></td>';
                                        }
                                    } else {
                                        echo '<tr>';
                                        echo '<td style="white-space: nowrap;"><small>Nenhuma tarefa próxima</small></td>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="comp" style="overflow-y: auto;">
                            <table class="table">
                                <tbody>
                                    <?php
                                    include_once('../conexao_adm.php');

                                    $sqlPrazo = 'SELECT * FROM prazo';
                                    $resulprazo = $conn->query($sqlPrazo);
                                    
                                    if (mysqli_affected_rows($conn) > 0) {
                                        while ($prazo = mysqli_fetch_assoc($resulprazo)) {
                                            $dataprazo = $prazo['datafinal'];
                                            $dataprazo = date('d/m/Y', strtotime($dataprazo));
                                            echo '<tr>';
                                            echo '<td style="white-space: nowrap;"><small><b>' . $prazo['id'] . ' - ' . $prazo['cliente'] . '</b> - ' . $dataprazo . '</small></td>';
                                        }
                                    } else {
                                        echo '<tr>';
                                        echo '<td style="white-space: nowrap;"><small>Nenhum prazo próximo</small></td>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--FIM CONTEÚDO-->
        </div>
        <!--FIM NAV BAR-->
        <!--INÍCIO NAVEGAÇÃO-->
        <div class="sidebar" style="overflow-y: auto;">
            <div class="profile">
                <img src="../imagensADM/logoadmin.png" alt="profile_picture" width="35%">
                <h3>Advocacia</h3>
                <p>Fraga e Melo Advogados</p>
            </div>
            <ul class="lista">
                <li>
                    <a class="active" href="admin.php">
                        <span class="icon"><i class="fas fa-desktop"></i></span>
                        <span class="item">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="../Processos/processos.php" class="links">
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
    const ctx = document.getElementById('myChart');
    var Janeiro = "<?php echo $totalJaneiro; ?>"
    var Fevereiro = "<?php echo $totalFevereiro; ?>"
    var Marco = "<?php echo $totalMarco; ?>"
    var Abril = "<?php echo $totalAbril; ?>"
    var Maio = "<?php echo $totalMaio; ?>"
    var Junho = "<?php echo $totalJunho; ?>"
    var Julho = "<?php echo $totalJulho; ?>"
    var Agosto = "<?php echo $totalAgosto; ?>"
    var Setembro = "<?php echo $totalSetembro; ?>"
    var Outubro = "<?php echo $totalOutubro; ?>"
    var Novembro = "<?php echo $totalNovembro; ?>"
    var Dezembro = "<?php echo $totalDezembro; ?>"

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro',
                'Outubro', 'Novembro', 'Dezembro'
            ],
            datasets: [{
                label: '# Processos',
                data: [Janeiro, Fevereiro, Marco, Abril, Maio, Junho, Julho, Agosto, Setembro, Outubro,
                    Novembro, Dezembro
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

</html>
