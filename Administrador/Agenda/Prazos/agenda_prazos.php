<?php
include_once '../../conexao_adm.php';

// VERIFICAÇÃO LOGIN
session_start();
$logged = $_SESSION['logged'] ?? null;

if (!$logged) {
    header('Location: /FragaeMelo/Site%20Fraga%20e%20Melo%20BootsTrap/login.php');
}

#Variáveis

if (isset($_POST['enviar'])) {
    $termino = $_POST['datafinall'];
    $htermino = $_POST['horafinall'];
    $desprazo = $_POST['descprazo'];
    $processoprazo = $_POST['processo'];
    $atendido = $_POST['flexRadioDefault'];
    $advprazo = $_POST['nomeadvogado'];

    if ($atendido == 'nao') {
        $atendido = 'Não';
    } else {
        $atendido = 'Sim';
    }

    if (!empty($processoprazo)) {
        $numeroprocesso = $processoprazo;

        $sqlCliente = "SELECT * FROM processo WHERE id='$numeroprocesso'";
        $resultCliente = $conn->query($sqlCliente);

        while ($data_cli = mysqli_fetch_assoc($resultCliente)) {
            $nomecliente = $data_cli['nomecliente'];
        }
    }

    $sqlPrazo = "INSERT INTO prazo (datafinal, horafinal, descricao, processo, atendido, advogado, cliente)
        VALUES ('$termino', '$htermino', '$desprazo', '$numeroprocesso', '$atendido', '$advprazo', '$nomecliente')";

    $resultPrazo = $conn->query($sqlPrazo);

    header('Location: agenda_prazos.php');
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
                            <h3 class="text-muted">Prazos</h3>
                            <?php
                            include_once '../../conexao_adm.php';
                            
                            $sqlqT = 'SELECT * FROM prazo';
                            $resultqT = $conn->query($sqlqT);
                            
                            $quantidade = 0;
                            while ($qt = mysqli_fetch_assoc($resultqT)) {
                                $quantidade += 1;
                            }
                            ?>
                            <small class="text-muted">Exibindo <?php echo $quantidade; ?> resultado(s)</small>
                            <small class="text-muted">
                                <table style="white-space: nowrap;">
                                    <tr>
                                        <td>
                                            <img src="../../imagensADM/verde.png" alt="ativo"
                                                style="width: 1%;">prazo em dia
                                            <img src="../../imagensADM/amarelo.png" alt="expirando"
                                                style="width: 1%; margin-left: 1%;">prazo expirando
                                            <img src="../../imagensADM/vermelho.png" alt="expirado"
                                                style="width: 1%; margin-left: 1%;">prazo expirado
                                            <img src="../../imagensADM/cinza.png" alt="baixado"
                                                style="width: 1%; margin-left: 1%;">prazo baixado
                                        </td>
                                    </tr>
                                </table>
                            </small>
                        </div>
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#exampleModal" id="add1">
                            Adicionar
                        </button>
                    </div>
                    <!--ÁREA MODAL--->
                    <form action="" method="POST">
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Adicionar prazo</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <label><b>
                                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">
                                                            Data Final</h6>
                                                    </b></label>
                                                <input type="date" name="datafinall" id="datafinall"
                                                    class="form-control" aria-label="Default" required>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 2%;">
                                            <div class="col-12">
                                                <label><b>
                                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">
                                                            Hora final</h6>
                                                    </b></label>
                                                <input type="time" name="horafinall" id="horafinall"
                                                    class="form-control" value="09:00">
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 2%;">
                                            <div class="col-12">
                                                <label><b>
                                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">
                                                            Descrição</h6>
                                                    </b></label>
                                                <textarea class="form-control" col="1" name="descprazo" id="descprazo" placeholder="Descrição"></textarea>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 2%;">
                                            <div class="col-12">
                                                <label><b>
                                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">
                                                            Processo</h6>
                                                    </b></label>
                                                <select name="processo" class="form-select">
                                                    <?php
                                                    echo '<option selected>Não consta</option>';
                                                    
                                                    include_once '../../conexao_adm.php';
                                                    
                                                    $sql = 'SELECT * FROM processo';
                                                    $resultProcesso = $conn->query($sql);
                                                    
                                                    while ($processo = mysqli_fetch_assoc($resultProcesso)) {
                                                        $idprocessso = $processo['id'];
                                                        $classeprocesso = $processo['classe'];
                                                        echo "<option value='$idprocessso'>" . $idprocessso . ' - ' . $classeprocesso . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 2%;">
                                            <div class="col-12">
                                                <label><b>
                                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">
                                                            Prazo atendido? (Dar baixa)</h6>
                                                    </b></label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        name="flexRadioDefault" id="flexRadioDefault1"
                                                        value="sim">
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        Sim
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        name="flexRadioDefault" id="flexRadioDefault2"
                                                        value="nao">
                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                        Não
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 2%;">
                                            <div class="col-12">
                                                <label><b>
                                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">
                                                            Advogado</h6>
                                                    </b></label>
                                                <select name="nomeadvogado" class="form-select">
                                                    <option selected>Não consta</option>
                                                    <?php
                                                    include_once '../../conexao_adm.php';
                                                    
                                                    $sqlAdvogado = 'SELECT nome FROM usuario';
                                                    $resultAdvogado = $conn->query($sqlAdvogado);
                                                    
                                                    while ($advogado = mysqli_fetch_assoc($resultAdvogado)) {
                                                        $nomeadvogado = $advogado['nome'];
                                                    
                                                        echo "<option>$nomeadvogado</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="mes" value="<?php echo date('F/Y'); ?>">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light"
                                            data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-success" name="enviar">Enviar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <?php
                ?>
                <div class="bloco">
                    <form action="" method="GET">
                        <div class="row">
                            <div class="col-3">
                                <p>Prazo atendido (baixado)</p>
                                <select name="atendidon" id="atendidon" aria-label="Default select example"
                                    class="form-select">
                                    <option selected>Todos</option>
                                    <option>Não</option>
                                    <option>Sim</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <p>Final</p>
                                <input type="date" name="datafinall" id="datafinal" class="form-control"
                                    aria-label="Default">
                            </div>
                            <div class="col-3">
                                <p>Advogados</p>
                                <select class="form-select" aria-label="Default select example" name="advogadoss"
                                    id="advogado">
                                    <option selected>Selecionar...</option>
                                    <?php
                                    include_once '../../conexao_adm.php';
                                    
                                    $sqlAD = 'SELECT nome FROM usuario';
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
                                    <button class="btn btn-outline-secondary" name="buscar" type="submit"
                                        style=" width: 100%;">Localizar</button>
                                </div>
                            </div>
                        </div>
                        <?php
                        include_once '../../conexao_adm.php';
                        $sql = 'SELECT * FROM prazo ORDER BY id ASC';
                        
                        if (!empty($_GET['atendidon'])) {
                            $status = $_GET['atendidon'];
                            if ($status != 'Todos') {
                                $sql = "SELECT * FROM prazo WHERE atendido='$status'";
                            }
                        }
                        
                        if (!empty($_GET['datafinall'])) {
                            $datafin = $_GET['datafinall'];
                            $sql = "SELECT * FROM prazo WHERE datafinal LIKE '%$datafin%' ORDER BY id ASC";
                        }
                        if (!empty($_GET['advogadoss'])) {
                            $nomeadv = $_GET['advogadoss'];
                            if ($nomeadv != 'Selecionar...') {
                                $sql = "SELECT * FROM tarefas WHERE advogado LIKE '%$nomeadv%' ORDER BY id ASC";
                            }
                        }
                        
                        $resultTable = $conn->query($sql);
                        
                        ?>
                    </form>
                </div>
                <div class="bloco">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" style="white-space: nowrap;">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Data</th>
                                    <th>Hora</th>
                                    <th>Prazo atendido</th>
                                    <th>Processo</th>
                                    <th>Advogado</th>
                                    <th>Cliente</th>
                                    <th>Opções</th>
                                </tr>
                            </thead>
                            <?php
                            include_once '../../conexao_adm.php';
                            
                            $resultTable = $conn->query($sql);
                            $dataatual = date('d/m/Y');
                            
                            while ($data_prazo = mysqli_fetch_assoc($resultTable)) {
                                /*FORMATADOR DE DATAS*/
                            
                                $datap = $data_prazo['datafinal'];
                                $datap = date('d/m/Y', strtotime($datap));
                            
                                /*FORMATADOR DE DATAS*/
                            
                                echo '</tr>';
                                echo '<td>' . $data_prazo['id'] . '</td>';
                            
                                if ($data_prazo['atendido'] == 'Sim') {
                                    $url = '../../imagensADM/cinza.png';
                                } elseif ($data_prazo['datafinal'] > $dataatual) {
                                    $url = '../../imagensADM/verde.png';
                                } elseif ($data_prazo['datafinal'] < $dataatual) {
                                    $url = '../../imagensADM/vermelho.png';
                                } elseif ($data_prazo['datafinal'] == $dataatual) {
                                    $url = '../../imagensADM/amarelo.png';
                                }
                            
                                echo '<td>' . "<img src='$url' style='width: 0.5em; margin-right: 5%;'>" . $datap . '</td>';
                                echo '<td>' . $data_prazo['horafinal'] . '</td>';
                                echo "<td style='text-align: center;'>" . $data_prazo['atendido'] . '</td>';
                                echo '<td>' . $data_prazo['processo'] . '</td>';
                                echo '<td>' . $data_prazo['advogado'] . '</td>';
                                echo '<td>' . $data_prazo['cliente'] . '</td>';
                                echo "  <td>
                                            <a class='btn btn-sm btn-primary' href='prazos_edit.php?id=$data_prazo[id]'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                                                    <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/>
                                                </svg>
                                            </a>
                                            <a class='btn btn-sm btn-danger' href='prazos_delete.php?id=$data_prazo[id]' onclick='confirma()'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                                    <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                                                </svg>
                                            </a>
                                            <a class='btn btn-sm btn-success' href='prazos_check.php?id=$data_prazo[id]'>
                                                 <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check-square-fill' viewBox='0 0 16 16'>
                                                    <path d='M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z'/>
                                                </svg>
                                            </a>
                                        </td>";
                            }
                            ?>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--INÍCIO NAVEGAÇÃO-->
        <div class="sidebar" style="overflow-y: scroll; ">
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
                        <a class="active">
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
                            <a href="../Compromissos/agenda_compromissos.php" class="links" style="width: 100%;">
                                <span class="item2" style="margin-left: 15%;">Compromissos</span>
                            </a>
                        </li>
                        <li>
                            <a href="../Tarefas/agenda_tarefas.php" class="links">
                                <span class="item2" style="margin-left: 15%; width: 100%;">Tarefas</span>
                            </a>
                        </li>
                        <li>
                            <a href="agenda_prazos.php" class="active">
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
                            <svg xmlns="http://www.w3.org/2000/svg" style="margin-left: 33%;" width="16"
                                height="13" fill="currentColor" class="bi bi-caret-down-fill"
                                viewBox="0 0 16 16">
                                <path
                                    d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
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
                            <a href="declaracoes.php" class="links" style="width: 100%;">
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
