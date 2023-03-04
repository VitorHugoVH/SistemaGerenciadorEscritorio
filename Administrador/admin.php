<?php
include_once('conexao_adm.php');

$mesatual = date('F/Y');

$sqlMes = "SELECT * FROM processo WHERE mes LIKE '%$mesatual%'";
$result = $conn->query($sqlMes);

$totalnmes = 0;
while ($user_data = mysqli_fetch_assoc($result)) {
  $estemes = $user_data['mes'];
  $totalnmes += 1;
}

$sqlMesComp = "SELECT * FROM compromisso WHERE mes LIKE '%$mesatual%'";
$resultCompMes = $conn->query($sqlMesComp);

$totalComp = 0;
while ($user_comp = mysqli_fetch_assoc($resultCompMes)) {
  $estemesComp = $user_comp['mes'];
  $totalComp += 1;
}

$sqlGrafico = "SELECT * FROM processo";
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="estilosAdm.css" />
  <link rel="icon" type="image/x-icon" href="imagens/icon.png" />
  <link rel="stylesheet" type="text/css" href="fontawesome/css/all.css" />
  <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
  <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
  <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <title>Fraga e Melo Advogados Associados</title>
</head>

<body>
  <!--ÍNICIO NAV BAR-->
  <div class="wrapper">
    <div class="section">
      <div class="top_navbar">
        <a href="http://localhost/FragaeMelo/Site%20Fraga%20e%20Melo%20BootsTrap/index.php" class="link"><button class="button button4">Voltar</button></a>
      </div>
      <!--INÍCIO CONTEÚDO-->
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="area1">
              <span class="icon"><i class="fas fa-barcode"></i></span>
              <span class="item"><b>R$500,00</b></span>
              <p class="info"><small>Cobrança(s) recebidas este mês</small></p>
            </div>
            <div class="area1">
              <span class="icon"><i class="fas fa-calendar-days"></i></span>
              <span class="item"><b><?php echo $totalComp; ?></b> Compromissos</span>
              <p class="info"><small>Agendados para este mês</small></p>
            </div>
            <div class="area2">
              <span class="icon"><i class="fas fa-scale-balanced"></i></span>
              <span class="item"><b><?php echo $totalnmes; ?></b> Processo(s)</span>
              <p class="info"><small>Adicionado(s) este mês</small></p>
            </div>
            <div class="area2">
              <span class="icon"><i class="fas fa-rocket"></i></span>
              <span class="item"><b>15</b> Publicações</span>
              <p class="info"><small>Publicação(es) realizadas neste mês</small></p>
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
              <a href="agenda_compromissos.php"><input type="submit" value="Ver Mais" name="btn" class="btn btn-primary" style="float: right; width: 25%; padding: 1%;"></a>
            </div>
          </div>
          <div class="col-4">
            <div class="parte">
              <label><b>Tarefas</b></label>
              <a href="agenda_tarefas.php"><input type="submit" value="Ver Mais" name="btn" class="btn btn-primary" style="float: right; width: 25%; padding: 1%;"></a>
            </div>
          </div>
          <div class="col-4">
            <div class="parte">
              <label><b>Prazos</b></label>
              <a href="agenda_prazos.php"><input type="submit" value="Ver Mais" name="btn" class="btn btn-primary" style="float: right; width: 25%; padding: 1%;"></a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            <div class="comp" style="overflow-y: auto;">
              <table class="table">
                <tbody>
                  <?php
                  include_once('conexao_adm.php');

                  $sqlComp = "SELECT * FROM compromisso";
                  $resultComp = $conn->query($sqlComp);

                  if (mysqli_affected_rows($conn) > 0) {
                    while ($comp = mysqli_fetch_assoc($resultComp)) {
                      echo "<tr>";
                      echo "<td><small><b>" . $comp['id'] . " - " . $comp['nomecompromisso'] . "</b> - " . $comp['datafinal'] . "</small></td>";
                    }
                  } else {
                    echo "<tr>";
                    echo "<td><small>Nenhum compromisso próximo</small></td>";
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
                  include_once('conexao_adm.php');

                  $sqlTarefa = "SELECT * FROM tarefas";
                  $resultarefa = $conn->query($sqlTarefa);

                  if (mysqli_affected_rows($conn) > 0) {
                    while ($tarefa = mysqli_fetch_assoc($resultarefa)) {
                      echo "<tr>";
                      echo "<td><small><b>" . $tarefa['id'] . " - " . $tarefa['titulo'] . "</b> - " . $tarefa['prazo'] . "</small></td>";
                    }
                  } else {
                    echo "<tr>";
                    echo "<td><small>Nenhum compromisso próximo</small></td>";
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
                  include_once('conexao_adm.php');

                  $sqlPrazo = "SELECT * FROM prazo";
                  $resulprazo = $conn->query($sqlPrazo);

                  if (mysqli_affected_rows($conn) > 0) {
                    while ($prazo = mysqli_fetch_assoc($resulprazo)) {
                      echo "<tr>";
                      echo "<td><small><b>" . $prazo['id'] . " - " . $prazo['cliente'] . "</b> - " . $prazo['datafinal'] . "</small></td>";
                    }
                  } else {
                    echo "<tr>";
                    echo "<td><small>Nenhum compromisso próximo</small></td>";
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
        <img src="imagensADM/logoadmin.png" alt="profile_picture" width="35%">
        <h3>Advocacia</h3>
        <p>Fraga e Melo Advogados</p>
      </div>
      <ul class="lista">
        <li>
          <a class="active">
            <span class="icon"><i class="fas fa-desktop"></i></span>
            <span class="item">Deashboard</span>
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
              <a href="agenda_compromissos.php" class="links" style="width: 100%;">
                <span class="item2" style="margin-left: 15%;">Compromissos</span>
              </a>
            </li>
            <li>
              <a href="agenda_tarefas.php" class="links">
                <span class="item2" style="margin-left: 15%; width: 100%;">Tarefas</span>
              </a>
            </li>
            <li>
              <a href="agenda_prazos.php" class="links">
                <span class="item2" style="margin-left: 15%;">Prazos</span>
              </a>
            </li>
          </div>
        </div>
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
              <svg xmlns="http://www.w3.org/2000/svg" style="margin-left: 27%;" width="16" height="13" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
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
              <a href="receitas.php" class="links">
                <span class="item2" style="margin-left: 15%; width: 100%;">Receitas</span>
              </a>
            </li>
          </div>
        </div>
        <div class="dropdown">
          <li>
            <a href="equipe.php" class="links">
              <span class="icon"><i class="fas fa-users"></i></span>
              <span class="item">Equipe</span>
              <svg xmlns="http://www.w3.org/2000/svg" style="margin-left: 41%;" width="16" height="13" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
              </svg>
            </a>
          </li>
          <div class="dropdown-content">
            <li>
              <a href="clientes.php" class="links" style="width: 100%;">
                <span class="item2" style="margin-left: 15%;">Clientes</span>
              </a>
            </li>
            <li>
              <a href="advogados.php" class="links" style="width: 100%;">
                <span class="item2" style="margin-left: 15%;">Advogados</span>
              </a>
            </li>
          </div>
        </div>
        <div class="dropdown">
          <li>
            <a href="equipe.php" class="links">
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
      labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
      datasets: [{
        label: '# Processos',
        data: [Janeiro, Fevereiro, Marco, Abril, Maio, Junho, Julho, Agosto, Setembro, Outubro, Novembro, Dezembro],
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