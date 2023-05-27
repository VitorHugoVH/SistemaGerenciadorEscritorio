<?php
if (!empty($_GET['id'])) {
    include_once('../../conexao_adm.php');

    $id = $_GET['id'];

    $sqlSelect = "SELECT * FROM compromisso WHERE id=$id";

    $result = $conn->query($sqlSelect);

    if ($result->num_rows > 0) {

        while ($data_comp = mysqli_fetch_assoc($result)) {

            $dataincial = $data_comp['datainicial'];
            $horainicial = $data_comp['horainicial'];
            $datafinal = $data_comp['datafinal'];
            $horafinal = $data_comp['horafinal'];
            $nomecompromisso = $data_comp['nomecompromisso'];
            $classificacao = $data_comp['classificacao'];
            $processo = $data_comp['processo'];
            $locall = $data_comp['locall'];
            $observacoes = $data_comp['observacoes'];
            $nomeadvogado = $data_comp['nomeadvogado'];
            $cliente = $data_comp['cliente'];
        }
    } else {
        header('Location: Agenda/Compromissos/agenda_compromissos.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php

// VERIFICAÇÃO LOGIN
session_start();
$logged = $_SESSION['logged'] ?? NULL;

if (!$logged) {
  header('Location: /FragaeMelo/Site%20Fraga%20e%20Melo%20BootsTrap/login.php');
};

?>

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
            <div class="container" id='main'>
                <form action="compromissos_save.php" method="POST">
                    <div class="row">
                        <div class="col-10">
                            <div class="bloco3">
                                <h3 class="text-muted">Editar</h3>
                            </div>
                        </div>
                        <div class="col-2">
                            <div id="voltar">
                                <a href="agenda_compromissos.php"><button type="button" class="btn btn-secondary" id='voltar1'>Volar</button></a>
                            </div>
                        </div>
                    </div>
                    <div class="bloco4">
                        <div class="row">
                            <div class="titulo">
                                <h4 class="title"><b>Dados do Compromisso</b></h4>
                            </div>
                        </div>
                        <div class="campos">
                            <div class="row">
                                <div class="col-3">
                                    <label><b>
                                            <h6 style="font-family: arial, sans-serif; font-size: 16px;">Data Incial</h6>
                                        </b></label>
                                    <input type="date" name="datainicial" id="datainicial" class="form-control" aria-label="Default" value="<?php echo $dataincial ?>" required>
                                </div>
                                <div class="col-3">
                                    <label><b>
                                            <h6 style="font-family: arial, sans-serif; font-size: 16px;">Hora Incial</h6>
                                        </b></label>
                                    <input type="time" name="horainicial" id="horainicial" class="form-control" aria-label="Default" placeholder="00:00" value="<?php echo $horainicial ?>">
                                </div>
                                <div class="col-3">
                                    <label><b>
                                            <h6 style="font-family: arial, sans-serif; font-size: 16px;">Data Final</h6>
                                        </b></label>
                                    <input type="date" name="datafinal" id="datafinal" class="form-control" aria-label="Default" value="<?php echo $datafinal ?>" required>
                                </div>
                                <div class="col-3">
                                    <label><b>
                                            <h6 style="font-family: arial, sans-serif; font-size: 16px;">Hora Final</h6>
                                        </b></label>
                                    <input type="time" name="horafinal" id="horafinal" class="form-control" aria-label="Default" value="<?php echo $horafinal ?>">
                                </div>
                            </div>
                        </div>
                        <div class="campos">
                            <div class="row">
                                <div class="col-12">
                                    <label><b>
                                            <h6 style="font-family: arial, sans-serif; font-size: 16px;">Nome do compromisso</h6>
                                        </b></label>
                                    <input type="text" name="nomecompromisso" id="nomecompromisso" class="form-control" placeholder="Nome do Compromisso" value="<?php echo $nomecompromisso ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="campos">
                            <div class="row">
                                <div class="col-12">
                                    <label><b>
                                            <h6 style="font-family: arial, sans-serif; font-size: 16px;">Classificação</h6>
                                        </b></label>
                                    <select name="classificacao" class="form-select">
                                        <option <?= ($classificacao == 'Audiência') ? 'selected' : '' ?>>Audiência</option>
                                        <option <?= ($classificacao == 'Reunião') ? 'selected' : '' ?>>Reunião</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="campos">
                            <div class="row">
                                <div class="col-12">
                                    <label><b>
                                            <h6 style="font-family: arial, sans-serif; font-size: 16px;">Processo</h6>
                                        </b></label>
                                    <select name="processo" class="form-select">
                                        <option <?= ($processo == 'Não consta') ? 'selected' : '' ?>>Não consta</option>
                                        <?php
                                        include_once('../../conexao_adm.php');

                                        $sql = "SELECT id FROM processo";
                                        $result = $conn->query($sql);

                                        while ($processoid = mysqli_fetch_assoc($result)) {

                                            $idprocesso = $processoid['id'];

                                            if ($processo == $idprocesso) {
                                                echo "<option selected>$idprocesso</option>";
                                            } else {
                                                echo "<option>$idprocesso</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="campos">
                            <div class="row">
                                <div class="col-12">
                                    <label><b>
                                            <h6 style="font-family: arial, sans-serif; font-size: 16px;">Local</h6>
                                        </b></label>
                                    <input type="text" name="local" id="local" class="form-control" placeholder="local" value="<?php echo $locall; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="campos">
                            <div class="row">
                                <div class="col-12">
                                    <label for="exampleFormControlTextarea1"><b>
                                            <h6 style="font-family: arial, sans-serif; font-size: 16px;">Observações</h6>
                                        </b></label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Descreva o compromisso" name="observacoes"><?php echo $observacoes; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="campos">
                            <div class="row">
                                <div class="col-12">
                                    <label><b>
                                            <h6 style="font-family: arial, sans-serif; font-size: 16px;">Advogado</h6>
                                        </b></label>
                                    <select name="nomeadvogado" class="form-select">
                                        <option <?= ($nomeadvogado == 'Não selecionado') ? 'selected' : ''; ?>>Não selecionado</option>
                                        <?php
                                        include_once('../../conexao_adm.php');

                                        $sqlAdvogado = "SELECT nome FROM usuario";
                                        $resultAdvogado = $conn->query($sqlAdvogado);

                                        while ($advogado = mysqli_fetch_assoc($resultAdvogado)) {
                                            $nome = $advogado['nome'];

                                            if ($nomeadvogado == $nome) {
                                                echo "<option selected>$nome</option>";
                                            } else {
                                                echo "<option>$nome</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="campos">
                            <div class="row">
                                <div class="col-12">
                                    <label><b>
                                            <h6 style="font-family: arial, sans-serif; font-size: 16px;">Cliente</h6>
                                        </b></label>
                                    <select name="nomecliente" class="form-select">
                                        <?php
                                        include_once('../../conexao_adm.php');

                                        $sql = "SELECT nomecliente FROM clientes";
                                        $result = $conn->query($sql);

                                        while ($clientenome = mysqli_fetch_assoc($result)) {
                                            $nomecliente = $clientenome['nomecliente'];

                                            if ($cliente == 'Não selecionado') {
                                                echo "<option selected>Não selecionado</option>";
                                            } elseif ($cliente == $nomecliente) {
                                                echo "<option selected>$nomecliente</option>";
                                            } else {
                                                echo "<option>$nomecliente</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="final">
                        <div class="row">
                            <div class="col-8">
                            </div>
                            <div class="col-2">
                                <div id="salvar">
                                    <a href="agenda_compromissos.php"><button type="button" class="btn btn-outline-secondary" id="voltar2">Cancelar</button></a>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                            <input type="hidden" name="mes" value="<?php echo date('F/Y') ?>">
                            <div class="col-2">
                                <div id="voltar">
                                    <a href="compromissos_save.php"><button type="submit" class="btn btn-success" name="up" id='up'>Atualizar</button></a>
                                </div>
                            </div>
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
</body>

</html>