<?php

// VERIFICAÇÃO LOGIN
session_start();
$logged = $_SESSION['logged'] ?? NULL;

if (!$logged) {
  header('Location: /FragaeMelo/Site%20Fraga%20e%20Melo%20BootsTrap/login.php');
};


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
    </style>
    <title>Fraga e Melo Advogados Associados</title>
</head>

<body>
    <div class="wrapper">
        <div class="section">
            <div class="top_navbar">
                <a href="/Users/vh007/OneDrive/%C3%81rea%20de%20Trabalho/Tudo/Site%20TCC/Site%20Fraga%20e%20Melo%20BootsTrap/index.php" class="link"><button class="button button4">Voltar</button></a>
            </div>
            <div class="container">
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
                        <span class="item">Deashboard</span>
                    </a>
                </li>
                <li>
                    <a href="/Processos/processos" class="active">
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
                            <a href="agenda_tarefas.php" class="links">
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
                <li>
                    <a href="site_marketing.php" class="links">
                        <span class="icon"><i class="fas fa-network-wired"></i></span>
                        <span class="item">Site</span>
                    </a>
                </li>
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
                            <a href="contratos.php" class="links" style="width: 100%;">
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
    function confirma(id) {
        if (confirm("Deseja realmente excluir este processo?")) {
            location.href = "processos_delete.php?id=" + id;
        }
    }
</script>

</html>