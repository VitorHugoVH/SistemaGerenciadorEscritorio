<?php
include_once('../../conexao_adm.php');

// VERIFICAÇÃO LOGIN
session_start();
$logged = $_SESSION['logged'] ?? NULL;

if (!$logged) {
  header('Location: /FragaeMelo/Site%20Fraga%20e%20Melo%20BootsTrap/login.php');
};

#Variáveis

if (isset($_POST['Enviar'])) {

    $datainicial = $_POST['datainicial'];
    $datafinal = $_POST['datafinal'];
    $horainicial = $_POST['horainicial'];
    $horafinal = $_POST['horafinal'];
    $nomecompromisso = $_POST['nomecompromisso'];
    $classificacao = $_POST['classificacao'];
    $processo = $_POST['processo'];
    $local = $_POST['local'];
    $observacoes = $_POST['observacoes'];
    $nomeadvogado = $_POST['nomeadvogado'];
    $nomecliente = $_POST['nomecliente'];
    $mesatualcomp = $_POST['mes'];

    switch ($processo) {
        case 'Nenhum processo selecionado':
            $processo = "Não selecionado";
    }

    $sqlEnviar = "INSERT INTO compromisso (datainicial, horainicial, datafinal, horafinal, nomecompromisso, classificacao, processo, locall, observacoes, nomeadvogado, cliente, mes)
                      VALUES ('$datainicial', '$horainicial', '$datafinal', '$horafinal', '$nomecompromisso', '$classificacao', '$processo', '$local', '$observacoes', '$nomeadvogado', '$nomecliente', '$mesatualcomp')";
    $result = $conn->query($sqlEnviar);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../estilosAdm.css" />
    <link rel="icon" type="image/x-icon" href="../../../imagens/icon.png" />
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
                <a href="../../../index.php" class="link"><button class="button button4">Voltar</button></a>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-10">
                        <div class="bloco3">
                            <h3 class="text-muted">Compromissos</h3>
                            <?php
                            include_once('../../conexao_adm.php');

                            $sqlqT = "SELECT * FROM compromisso";
                            $resultqT = $conn->query($sqlqT);

                            $quantidade = 0;
                            while ($qt = mysqli_fetch_assoc($resultqT)) {
                                $quantidade += 1;
                            }
                            ?>
                            <small class="text-muted">Exibindo <?php echo $quantidade; ?> resultado(s)</small>
                        </div>
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal" id="add1">
                            Adicionar
                        </button>
                    </div>
                    <!--ÁREA MODAL--->
                    <form action="" method="POST">
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Adicionar</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-3">
                                                <label><b>
                                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Data Incial</h6>
                                                    </b></label>
                                                <input type="date" name="datainicial" id="datainicial" class="form-control" aria-label="Default" required>
                                            </div>
                                            <div class="col-3">
                                                <label><b>
                                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Hora Incial</h6>
                                                    </b></label>
                                                <input type="time" name="horainicial" id="horainicial" class="form-control" aria-label="Default" placeholder="00:00">
                                            </div>
                                            <div class="col-3">
                                                <label><b>
                                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Data Final</h6>
                                                    </b></label>
                                                <input type="date" name="datafinal" id="datafinal" class="form-control" aria-label="Default" required>
                                            </div>
                                            <div class="col-3">
                                                <label><b>
                                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Hora Final</h6>
                                                    </b></label>
                                                <input type="time" name="horafinal" id="horafinal" class="form-control" aria-label="Default">
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 2%;">
                                            <div class="col-12">
                                                <label><b>
                                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Nome do compromisso</h6>
                                                    </b></label>
                                                <input type="text" name="nomecompromisso" id="nomecompromisso" class="form-control" placeholder="Nome do Compromisso" required>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 2%;">
                                            <div class="col-12">
                                                <label><b>
                                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Classificação</h6>
                                                    </b></label>
                                                <select name="classificacao" class="form-select">
                                                    <option selected>Audiência</option>
                                                    <option>Reunião</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 2%;">
                                            <div class="col-12">
                                                <label><b>
                                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Processo</h6>
                                                    </b></label>
                                                <select name="processo" class="form-select">
                                                    <?php
                                                    echo "<option selected>Não consta</option>";

                                                    include_once('../../conexao_adm.php');

                                                    $sql = "SELECT id FROM processo";
                                                    $resultProcesso = $conn->query($sql);

                                                    while ($processo = mysqli_fetch_assoc($resultProcesso)) {

                                                        $id = $processo['id'];
                                                        echo "<option>$id</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 2%;">
                                            <div class="col-12">
                                                <label><b>
                                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Local</h6>
                                                    </b></label>
                                                <input type="text" name="local" id="nomecompromisso" class="form-control" placeholder="local">
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 2%;">
                                            <div class="col-12">
                                                <label for="exampleFormControlTextarea1"><b>
                                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Observações</h6>
                                                    </b></label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Observações" name="observacoes"></textarea>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 2%;">
                                            <div class="col-12">
                                                <label><b>
                                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Advogado</h6>
                                                    </b></label>
                                                <select name="nomeadvogado" class="form-select">
                                                    <option selected>Não consta</option>
                                                    <?php
                                                    include_once('../../conexao_adm.php');

                                                    $sqlAdvogado = "SELECT nome FROM usuario";
                                                    $resultAdvogado = $conn->query($sqlAdvogado);

                                                    while ($advogado = mysqli_fetch_assoc($resultAdvogado)) {
                                                        $nomeadvogado = $advogado['nome'];

                                                        echo "<option>$nomeadvogado</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 2%;">
                                            <div class="col-12">
                                                <label><b>
                                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Cliente</h6>
                                                    </b></label>
                                                <select name="nomecliente" class="form-select">
                                                    <option selected>Não consta</option>
                                                    <?php
                                                    include_once('../../conexao_adm.php');

                                                    $sqlCliente = "SELECT nomecliente FROM clientes";
                                                    $resultCliente = $conn->query($sqlCliente);

                                                    while ($cliente = mysqli_fetch_assoc($resultCliente)) {
                                                        $nomecliente = $cliente['nomecliente'];

                                                        echo "<option>$nomecliente</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="mes" value="<?php echo date('F/Y') ?>">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-success" name="Enviar">Enviar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <?php
                ##FIlTROS COMPROMISSOS##


                ?>
                <div class="bloco">
                    <form action="" method="GET">
                        <div class="row">
                            <div class="col-3">
                                <p>Data Incial</p>
                                <input type="date" name="datainicial" id="datainicial" class="form-control" aria-label="Default">
                            </div>
                            <div class="col-3">
                                <p>Data Final</p>
                                <input type="date" name="datafinal" id="datafinal" class="form-control" aria-label="Default">
                            </div>
                            <div class="col-3">
                                <p>Advogados</p>
                                <select class="form-select" aria-label="Default select example" name="advogadoss" id="advogado">
                                    <option selected>Selecionar...</option>
                                    <?php
                                    include_once('../../conexao_adm.php');

                                    $sqlAD = "SELECT nome FROM usuario";
                                    $resultAD = $conn->query($sqlAD);

                                    while ($idAD = mysqli_fetch_assoc($resultAD)) {
                                        $idAD = $idAD['nome'];
                                        echo "<option>$idAD</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-3">
                                <p>Buscar</p>
                                <div class="input-group mb-3">
                                    <button class="btn btn-outline-secondary" name="buscar" type="submit" style=" width: 100%;">Localizar</button>
                                </div>
                            </div>
                        </div>
                        <?php
                        include_once('../../conexao_adm.php');
                        $sqlFiltro = "SELECT * FROM compromisso ORDER BY id ASC";

                        if (!empty($_GET['advogadoss'])) {
                            $nomeadv = $_GET['advogadoss'];
                            if ($nomeadv == "Selecionar...") {
                                $sqlFiltro = "SELECT * FROM compromisso ORDER BY id ASC";
                            } else {
                                $sqlFiltro = "SELECT * FROM compromisso WHERE nomeadvogado LIKE '%$nomeadv%' ORDER BY id ASC";
                            }
                        }
                        if (!empty($_GET['dataincial'])) {
                            $datain = $_GET['datainicial'];
                            $sqlFiltro = "SELECT * FROM compromisso WHERE datainicial LIKE '%$datain%' ORDER BY id ASC";
                        }
                        if (!empty($_GET['datafinal'])) {
                            $datafin = $_GET['datafinal'];
                            $sqlFiltro = "SELECT * FROM compromisso WHERE datafinal LIKE '%$datafin%' ORDER BY id ASC";
                        }

                        $resultTable = $conn->query($sqlFiltro);

                        ?>
                    </form>
                </div>
                <div class="bloco">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" style="white-space: nowrap;">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Data Inicial</th>
                                    <th>Data Final</th>
                                    <th>Título</th>
                                    <th>Classificação</th>
                                    <th>Processo</th>
                                    <th>Cliente</th>
                                    <th>Advogado</th>
                                    <th>Opções</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                include_once('../../conexao_adm.php');

                                $resultTable = $conn->query($sqlFiltro);

                                while ($data = mysqli_fetch_assoc($resultTable)) {

                                    /*FORMATADOR DE DATAS*/

                                    $dataI = $data['datainicial'];
                                    $dataI = date('d/m/Y', strtotime($dataI));

                                    $dataF = $data['datafinal'];
                                    $dataF = date('d/m/Y', strtotime($dataF));

                                    /*FORMATADOR DE DATAS*/

                                    echo "<tr>";
                                    echo "<td>" . $data['id'] . "</td>";
                                    echo "<td>" . $dataI . "</td>";
                                    echo "<td>" . $dataF . "</td>";
                                    echo "<td>" . $data['nomecompromisso'] . "</td>";
                                    echo "<td>" . $data['classificacao'] . "</td>";
                                    echo "<td>" . $data['processo'] . "</td>";
                                    echo "<td>" . $data['cliente'] . "</td>";
                                    echo "<td>" . $data['nomeadvogado'] . "</td>";
                                    echo "  <td>
                                            <a class='btn btn-sm btn-primary' href='compromissos_edit.php?id=$data[id]'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pen-fill' viewBox='0 0 16 16'>
                                                    <path d='m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z'/>
                                                </svg>
                                            </a>
                                            <a class='btn btn-sm btn-danger' href='compromissos_delete.php?id=$data[id]' onclick='confirma()'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                                    <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
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
                        <a class="active" href="#">
                            <span class="icon"><i class="fas fa-calendar-days"></i></span>
                            <span class="item">Agenda</span>
                            <svg xmlns="http://www.w3.org/2000/svg" style="margin-left: 40%;" width="16" height="13" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                            </svg>
                        </a>
                    </li>
                    <div class="dropdown-content">
                        <li>
                            <a href="agenda_compromissos.php" class="active" style="width: 100%;">
                                <span class="item2" style="margin-left: 15%;">Compromissos</span>
                            </a>
                        </li>
                        <li>
                            <a href="../Tarefas/agenda_tarefas.php" class="links">
                                <span class="item2" style="margin-left: 15%; width: 100%;">Tarefas</span>
                            </a>
                        </li>
                        <li>
                            <a href="../Prazos/agenda_prazos.php" class="links">
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
    </div>
</body>
<script>
    function confirma(id) {
        if (confirm("Deseja realmente excluir este compromisso?")) {
            location.href = "Agenda/Compromissos/agenda_compromissos.php?id=" + id;
        }
    }
</script>

</html>