<?php
include_once('../../conexao_adm.php');

// VERIFICAÇÃO LOGIN
session_start();
$logged = $_SESSION['logged'] ?? NULL;

if (!$logged) {
  header('Location: /FragaeMelo/Site%20Fraga%20e%20Melo%20BootsTrap/login.php');
};

$id = $_GET['id'];

if (isset($_GET['id'])) {

    $sqlEdit = "SELECT * FROM tarefas WHERE id=$id";
    $resultEdit = $conn->query($sqlEdit);

    if ($resultEdit->num_rows > 0) {
        while ($user_data = mysqli_fetch_assoc($resultEdit)) {
            $tipotarefa = $user_data['tipotarefa'];
            $responsavel = $user_data['advogado'];
            $prazodate = $user_data['prazo'];
            $tituloprazo = $user_data['titulo'];
            $desctarefa = $user_data['tarefa'];
            $status = $user_data['stat'];
            $datacriacao = $user_data['datacriacao'];
        }
    } else {
        header('Location: agenda_tarefas.php');
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
                <a href="../../../../Site Fraga e Melo BootsTrap/index.php" class="link"><button class="button button4">Voltar</button></a>
            </div>
            <div class="container" id='main'>
                <form action="tarefas_save.php" method="POST">
                    <div class="row">
                        <div class="col-10">
                            <div class="bloco3">
                                <h3 class="text-muted">Adicionar</h3>
                            </div>
                        </div>
                        <div class="col-2">
                            <div id="voltar">
                                <a href="agenda_tarefas.php"><button type="button" class="btn btn-secondary" id='voltar1'>Volar</button></a>
                            </div>
                        </div>
                    </div>
                    <div class="bloco4">
                        <div class="row">
                            <div class="titulo">
                                <h4 class="title"><b>Dados da tarefa</b></h4>
                            </div>
                            <div class="campos">
                                <label><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Tipo tarefa</h6>
                                    </b></p></label>
                                <select class="form-select" aria-label="Default select example" name="tipotarefa" id="tipotarefa">
                                    <option <?= ($tipotarefa == 'Interna') ? 'selected' : '' ?>>Interna</option>
                                    <option <?= ($tipotarefa == 'Externa') ? 'selected' : '' ?>>Externa</option>
                                </select>
                            </div>
                            <div class="campos">
                                <label><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Advogado</h6>
                                    </b></label>
                                <select name="nomeadvogado" class="form-select">
                                    <option <?= ($responsavel == 'Não consta') ? 'selected' : '' ?>>Não consta</option>
                                    <?php
                                    include_once('../../conexao_adm.php');

                                    $sqlAdvogado = "SELECT nome FROM usuario";
                                    $resultAdvogado = $conn->query($sqlAdvogado);

                                    while ($advogado = mysqli_fetch_assoc($resultAdvogado)) {
                                        $nomeadvogado = $advogado['nome'];

                                        if ($responsavel == $nomeadvogado) {
                                            echo "<option selected>$nomeadvogado</option>";
                                        } else {
                                            echo "<option>$nomeadvogado</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="campos">
                                <label><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Prazo</h6>
                                    </b></label>
                                <input type="date" name="prazodate" id="prazodate" class="form-control" aria-label="Default select example" value="<?php echo $prazodate ?>">
                            </div>
                            <div class="campos">
                                <label><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Título</h6>
                                    </b></label>
                                <input type="text" name="tituloprazo" id="tituloprazo" class="form-control" placeholder="Título" value="<?php echo $tituloprazo ?>">
                            </div>
                            <div class="campos">
                                <label><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Tarefa</h6>
                                    </b></label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="10" placeholder="Descrição da tarefa" name="desctarefa"><?php echo $desctarefa ?></textarea>
                            </div>
                            <div class="campos">
                                <label><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">A tarefa foi finalizada?</h6>
                                    </b></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" value="option1" id="inlineRadio1" <?= ($status == 'Finalizado') ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="inlineRadio1">Sim</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" value="option2" id="inlineRadio2" <?= ($status == 'Não finalizado') ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="inlineRadio2">Não</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="datacriacao" value="<?php echo date('d/m/Y') ?>">
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <div class="final">
                        <div class="row">
                            <div class="col-8">

                            </div>
                            <div class="col-2">
                                <div id="salvar">
                                    <a href="agenda_tarefas.php"><button type="button" class="btn btn-outline-secondary" id="voltar2">Cancelar</button></a>
                                </div>
                            </div>
                            <div class="col-2">
                                <div id="voltar">
                                    <a href="agenda_tarefas.php"><button type="submit" class="btn btn-success" name="update" id='salvar'>Atualizar</button></a>
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
                            <a href="../Compromissos/agenda_compromissos.php" class="links" style="width: 100%;">
                                <span class="item2" style="margin-left: 15%;">Compromissos</span>
                            </a>
                        </li>
                        <li>
                            <a href="agenda_tarefas.php" class="active">
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
            </ul>
        </div>
        <!--FIM NAVEGAÇÃO-->
    </div>
</body>

</html>