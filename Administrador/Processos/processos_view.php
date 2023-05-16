<?php

// VERIFICAÇÃO LOGIN
session_start();
$logged = $_SESSION['logged'] ?? NULL;

if (!$logged) {
  header('Location: /FragaeMelo/Site%20Fraga%20e%20Melo%20BootsTrap/login.php');
};

?>
<!DOCTYPE html>
<html lang="pt-BR">

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
    </style>
</head>
<?php
include_once('../conexao_adm.php');
$id = $_GET['id'];
$sql = "SELECT * FROM processo WHERE id=$id";
$rs = mysqli_query($conn, $sql);
$linha = mysqli_fetch_array($rs);
?>
<?php
include('C:\xampp\htdocs\FragaeMelo\Site Fraga e Melo BootsTrap\config.php');

$sql2 = "SELECT * FROM usuario WHERE idusuario=$id";
$rs2 = mysqli_query($conn, $sql2);
$linha2 = mysqli_fetch_array($rs2);
?>

<body>
    <div class="wrapper">
        <div class="section">
            <div class="top_navbar">
                <a href="/Users/vh007/OneDrive/%C3%81rea%20de%20Trabalho/Tudo/Site%20TCC/Site%20Fraga%20e%20Melo%20BootsTrap/index.php" class="link"><button class="button button4">Voltar</button></a>
            </div>
            <div class="container" id='main'>
                <div class="row">
                    <div class="col-10">
                        <div class="bloco3">
                            <h3 class="text-muted">Relatório de Processos</h3>
                        </div>
                    </div>
                    <div class="col-2">
                        <div id="voltar">
                            <a href="processos.php"><button type="button" class="btn btn-secondary" id='voltar1'>Volar</button></a>
                        </div>
                    </div>
                </div>
                <div class="bloco4">
                    <div class="row">
                        <div class="col-5">
                            <div class="bloco03">
                                <h3 class="txt">Relatório</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <p id="txti">Partes e dados processuais / Processo Nº <?php echo $linha['nprocesso'] ?></p>
                    </div>
                    <div class="row">
                        <hr style="border-color:#aaaaaa !important;">
                    </div>
                    <div class="row">
                        <table class="table">
                            <thead class="tabelarelatorio">
                                <div class="row">
                                    <tr>
                                        <th class="linhas">Poder Judiciário</th>
                                        <td class="linhas"><?php echo $linha['poderjudiciario']; ?></td>
                                    </tr>
                                </div>
                                <div class="row">
                                    <tr>
                                        <th class="linhas">Vara do processo</th>
                                        <td class="linhas"><?php echo $linha['numerovara'] . " - " . $linha['nomedavara']; ?></td>
                                    </tr>
                                </div>
                                <div class="row">
                                    <tr>
                                        <th class="linhas">Natureza da Ação</th>
                                        <td class="linhas"><?php echo $linha['natureza']; ?></td>
                                    </tr>
                                </div>
                                <div class="row">
                                    <tr>
                                        <th class="linhas">Nome da comarca</th>
                                        <td class="linhas"><?php echo $linha['nomedacomarca']; ?></td>
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
                                        <th class="linhas">Data de cadastro sistema</th>
                                        <td class="linhas"><?php echo $dataformatada; ?></td>
                                    </tr>
                                </div>
                                <div class="row">
                                    <tr>
                                        <th class="linhas">Classe Processual</th>
                                        <td class="linhas"><?php echo  $linha['classe']; ?></td>
                                    </tr>
                                </div>
                                <div class="row">
                                    <tr>
                                        <th class="linhas">Valor da causa</th>
                                        <td class="linhas"><?php echo $linha['valor']; ?></td>
                                    </tr>
                                </div>
                                <div class="row">
                                    <tr>
                                        <th class="linhas">Nº Parcelas</th>
                                        <td class="linhas"><?php echo $linha['parcelas'] . " parcelas"; ?></td>
                                    </tr>
                                </div>
                                <div class="row">
                                    <tr>
                                        <th class="linhas">Status do processo</th>
                                        <td class="linhas"><?php echo $linha['stat']; ?></td>
                                    </tr>
                                </div>
                                <div class="row">
                                    <tr>
                                        <th class="linhas">Observações</th>
                                        <td class="linhas"><?php echo $linha['observacoes']; ?></td>
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
                                        include_once('../conexao_adm.php');

                                        $sqlcliente = "SELECT * FROM clientes WHERE nomecliente='$nome'";
                                        $resultcliente = $conn->query($sqlcliente);

                                        while ($data_client = mysqli_fetch_assoc($resultcliente)) {
                                            echo "<td>" . "(" . $data_client['ddd1'] . ")" . $data_client['numero1'] . "</td>";
                                            echo "<td>" . $data_client['email1'] . "</td>";
                                        }
                                        ?>
                                    </tr>
                                    <tr>
                                        <th>Advogado</th>
                                        <td><?php echo $linha['nomeadvogado'];
                                            $nomeadv = $linha['nomeadvogado']; ?></td>
                                        <?php
                                        include_once('../conexao_adm.php');

                                        if ($nomeadv == 'Sandro Carvalho de Fraga') {
                                            echo "<td>(51)984026629</td>";
                                            echo "<td>sandro@fragaemeloadvogados.adv.br</td>";
                                        } else {
                                            echo "<td>(51)94156949</td>";
                                            echo "<td>elisete@fragaemeloadvogados.adv.br</td>";
                                        }
                                        ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <hr style="border-color:#aaaaaa !important;">
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
                            <span class="item">Deashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="/Processos//Processos/processos.php" class="active">
                            <span class="icon"><i class="fas fa-scale-balanced"></i></span>
                            <span class="item">Processos</span>
                        </a>
                    </li>
                    <div class="dropdown">
                        <li>
                            <a class="links">
                                <span class="icon"><i class="fas fa-calendar-days"></i></span>
                                <span class="item">Agenda</span>
                                <svg xmlns="http://www.w3.org/2000/svg" style="margin-left: 40%;" width="16" height="13" fill="currentColor"
                                     class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                    <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
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
                        <a href="site_marketing.php" class="links">
                            <span class="icon"><i class="fas fa-network-wired"></i></span>
                            <span class="item">Site</span>
                        </a>
                    </li>
                    <div class="dropdown">
                        <li>
                            <a href="financeiro.php" class="links">
                                <span class="icon"><i class="fas fa-dollar-sign"></i></span>
                                <span class="item">Financeiro</span>
                                <svg xmlns="http://www.w3.org/2000/svg" style="margin-left: 27%;" width="16" height="13" fill="currentColor"
                                     class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                    <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
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
                            <a href="#" class="links">
                                <span class="icon"><i class="fas fa-users"></i></span>
                                <span class="item">Equipe</span>
                                <svg xmlns="http://www.w3.org/2000/svg" style="margin-left: 41%;" width="16" height="13" fill="currentColor"
                                     class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                    <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
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
                            <a href="#" class="links">
                                <span class="icon"><i class="fas fa-file"></i></span>
                                <span class="item">Arquivos</span>
                                <svg xmlns="http://www.w3.org/2000/svg" style="margin-left: 32%;" width="16" height="13" fill="currentColor"
                                     class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                    <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
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

</html>