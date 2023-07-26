<?php

// VERIFICAÇÃO LOGIN
session_start();
$logged = $_SESSION['logged'] ?? null;

if (!$logged) {
    header('Location: /FragaeMelo/Site%20Fraga%20e%20Melo%20BootsTrap/login.php');
}

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
include_once '../conexao_adm.php';
$id = $_GET['id'];
$sql = "SELECT * FROM processo WHERE id=$id";
$rs = mysqli_query($conn, $sql);
$linha = mysqli_fetch_array($rs);

$numeroProcesso = $linha['nprocesso'];
$nomePrimeiroAdvogado = $linha['nomeadvogado'];
$nomeSegundoAdvogado = $linha['segundoAdvogado'];
$nomeTerceiroAdvogado = $linha['terceiroAdvogado'];
$nomeCliente = $linha['nomecliente'];

?>
<?php
include 'C:\xampp\htdocs\FragaeMelo\Site Fraga e Melo BootsTrap\config.php';

$sql2 = "SELECT * FROM usuario WHERE idusuario=$id";
$rs2 = mysqli_query($conn, $sql2);
$linha2 = mysqli_fetch_array($rs2);
?>

<body>
    <div class="wrapper">
        <div class="section">
            <div class="top_navbar">
                <a href="../../../Site Fraga e Melo BootsTrap/index.php" class="link"><button
                        class="button button4">Voltar</button></a>
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
                            <a href="processos.php"><button type="button" class="btn btn-secondary"
                                    id='voltar1'>Volar</button></a>
                        </div>
                    </div>
                </div>
                <div class="bloco4">
                    <form action="processos_create.php" method="POST" target="_blank">
                        <div class="row">
                            <div class="col-5">
                                <div class="bloco03">
                                    <h3 class="txt">Relatório</h3>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <p id="txti">Processo Nº <?php echo $linha['nprocesso']; ?></p>
                        </div>
                        <div class="row">
                            <hr style="border-color:#aaaaaa !important;">
                        </div>
                        <div class="row">
                            <table class="table table-bordered">
                                <thead class="tabelarelatorio">
                                    <div class="row">
                                        <tr>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <input type="checkbox" class="form-check-input" id="customCheck1"
                                                    name="statusProcesso" value="on" checked>
                                            </td>
                                            <td class="custom-control">Satus processo</td>
                                            <td class="custom-control"><?php echo $linha['stat']; ?></td>
                                        </tr>
                                    </div>
                                    <div class="row">
                                        <tr>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <input type="checkbox" class="form-check-input" id="customCheck2"
                                                    name="faseProcesso" value="on" checked>
                                            </td>
                                            <td class="custom-control">Fase Processo</td>
                                            <td class="custom-control"><?php echo $linha['fase']; ?></td>
                                        </tr>
                                    </div>
                                    <div class="row">
                                        <tr>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <input type="checkbox" class="form-check-input" id="customCheck3"
                                                    name="poderProcesso" value="on" checked>
                                            </td>
                                            <td class="custom-control">Poder judiciário</td>
                                            <td class="custom-control"><?php echo $linha['poderjudiciario']; ?></td>
                                        </tr>
                                    </div>
                                    <div class="row">
                                        <tr>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <input type="checkbox" class="form-check-input" id="customCheck4"
                                                    name="classeProcesso" value="on" checked>
                                            </td>
                                            <td class="custom-control">Classe processual</td>
                                            <td class="custom-control"><?php echo $linha['classe']; ?></td>
                                        </tr>
                                    </div>
                                    <div class="row">
                                        <tr>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <input type="checkbox" class="form-check-input" id="customCheck5"
                                                    name="naturezaProcesso" value="on" checked>
                                            </td>
                                            <td class="custom-control">Natureza da Ação</td>
                                            <td class="custom-control"><?php echo $linha['natureza']; ?></td>
                                        </tr>
                                    </div>
                                    <div class="row">
                                        <tr>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <input type="checkbox" class="form-check-input" id="customCheck6"
                                                    name="ritoProcesso" value="on" checked>
                                            </td>
                                            <td class="custom-control">Rito</td>
                                            <td class="custom-control"><?php echo $linha['ritoProcesso']; ?></td>
                                        </tr>
                                    </div>
                                    <div class="row">
                                        <tr>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <input type="checkbox" class="form-check-input" id="customCheck7"
                                                    name="varaProcesso" value="on" checked>
                                            </td>
                                            <td class="custom-control">Vara do processo</td>
                                            <td class="custom-control"><?php echo $linha['numerovara'] . ' - ' . $linha['nomedavara']; ?></td>
                                        </tr>
                                    </div>
                                    <div class="row">
                                        <tr>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <input type="checkbox" class="form-check-input" id="customCheck8"
                                                    name="comarcaProcesso" value="on" checked>
                                            </td>
                                            <td class="custom-control">Nome da comarca</td>
                                            <td class="custom-control"><?php echo $linha['nomedacomarca']; ?></td>
                                        </tr>
                                    </div>
                                    <div class="row">
                                        <tr>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <input type="checkbox" class="form-check-input" id="customCheck9"
                                                    name="valorCausaProcesso" value="on" checked>
                                            </td>
                                            <td class="custom-control">Valor da causa</td>
                                            <td class="custom-control"><?php echo $linha['valorCausa']; ?></td>
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
                                            <td style="text-align: center; vertical-align: middle;">
                                                <input type="checkbox" class="form-check-input" id="customCheck10"
                                                    name="aberturaProcesso" value="on" checked>
                                            </td>
                                            <td class="custom-control">Data de abertura</td>
                                            <td class="custom-control"><?php echo $dataformatada; ?></td>
                                        </tr>
                                    </div>
                                    <div class="row">
                                        <tr>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <input type="checkbox" class="form-check-input" id="customCheck11"
                                                    name="valorHonorarioProcesso" value="on" checked>
                                            </td>
                                            <td class="custom-control">Valor honorário</td>
                                            <td class="custom-control"><?php echo $linha['valorHonorario']; ?></td>
                                        </tr>
                                    </div>
                                    <div class="row">
                                        <tr>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <input type="checkbox" class="form-check-input" id="customCheck12"
                                                    name="parcelasProcesso" value="on" checked>
                                            </td>
                                            <td class="custom-control">Nº Parcelas</td>
                                            <td class="custom-control"><?php echo $linha['parcelas'] . ' parcelas'; ?></td>
                                        </tr>
                                    </div>
                                    <div class="row">
                                        <tr>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <input type="checkbox" class="form-check-input" id="customCheck13"
                                                    name="observacoesProcesso" value="on" checked>
                                            </td>
                                            <td class="custom-control">Observações</td>
                                            <td class="custom-control"><?php echo $linha['observacoes']; ?></td>
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
                                            include_once '../conexao_adm.php';
                                            
                                            $sqlcliente = "SELECT * FROM clientes WHERE nomecliente='$nome'";
                                            $resultcliente = $conn->query($sqlcliente);
                                            
                                            while ($data_client = mysqli_fetch_assoc($resultcliente)) {
                                                echo '<td>' . '(' . $data_client['ddd1'] . ')' . $data_client['numero1'] . '</td>';
                                                echo '<td>' . $data_client['email1'] . '</td>';
                                            }
                                            ?>
                                        </tr>
                                        <tr>
                                            <th>Advogado</th>
                                            <td><?php echo $linha['nomeadvogado']; ?></td>
                                            <?php
                                            include_once '../conexao_adm.php';
                                            
                                            $advogado = $linha['nomeadvogado'];
                                            $advogado = explode('-', $advogado);
                                            $nomeAdvogado = trim($advogado[0]);
                                            
                                            $sqlAdvogado = "SELECT * FROM usuario WHERE nome='$nomeAdvogado'";
                                            $resultAdvogado = $conn->query($sqlAdvogado);
                                            
                                            while ($dados = mysqli_fetch_assoc($resultAdvogado)) {
                                                echo '<td>' . $dados['telefone1'] . '</td>';
                                                echo '<td>' . $dados['email1'] . '</td>';
                                            }
                                            ?>
                                        </tr>

                                        <!--VERIFICAÇÃO SEGUNDO ADVOGADO-->

                                        <input type="hidden" name="nomesegundoAdvogado" id="nomesegundoAdvogado"
                                            value="<?php echo $linha['segundoAdvogado']; ?>">

                                        <script>
                                            document.addEventListener("DOMContentLoaded", function() {
                                                var valor = document.getElementById("nomesegundoAdvogado").value;
                                                var trElement = document.getElementById("segundoAdvogadoRow");

                                                if (valor == 'Não consta') {
                                                    trElement.style.display = "none";
                                                } else {
                                                    trElement.style.display = "table-row";
                                                }
                                            });
                                        </script>

                                        <!--VERIFICAÇÃO SEGUNDO ADVOGADO-->

                                        <tr id="segundoAdvogadoRow">
                                            <th>Advogado</th>
                                            <td><?php echo $linha['segundoAdvogado']; ?></td>
                                            <?php
                                            $segundoAdvogado = $linha['segundoAdvogado'];
                                            $segundoAdvogado = explode('-', $segundoAdvogado);
                                            $nomeSegundoAdvogado = trim($segundoAdvogado[0]);
                                            
                                            $sqlSegundoAdvogado = "SELECT * FROM usuario WHERE nome='$nomeSegundoAdvogado'";
                                            $resultSegundoAdvogado = $conn->query($sqlSegundoAdvogado);
                                            
                                            while ($dados2 = mysqli_fetch_assoc($resultSegundoAdvogado)) {
                                                echo '<td>' . $dados2['telefone1'] . '</td>';
                                                echo '<td>' . $dados2['email1'] . '</td>';
                                            }
                                            ?>
                                        </tr>

                                        <!--VERIFICAÇÃO TERCEIRO ADVOGADO-->

                                        <input type="hidden" name="nometerceiroAdvogado" id="nometerceiroAdvogado"
                                        value="<?php echo $linha['terceiroAdvogado']; ?>">

                                    <script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                            var valor = document.getElementById("nometerceiroAdvogado").value;
                                            var trElement = document.getElementById("terceiroAdvogadoRow");

                                            if (valor == 'Não consta') {
                                                trElement.style.display = "none";
                                            } else {
                                                trElement.style.display = "table-row";
                                            }
                                        });
                                    </script>

                                    <!--VERIFICAÇÃO TERCEIRO ADVOGADO-->

                                    <tr id="terceiroAdvogadoRow">
                                        <th>Advogado</th>
                                        <td><?php echo $linha['terceiroAdvogado']; ?></td>
                                        <?php
                                        $terceiroAdvogado = $linha['terceiroAdvogado'];
                                        $terceiroAdvogado = explode('-', $terceiroAdvogado);
                                        $nomeTerceiroAdvogado = trim($terceiroAdvogado[0]);
                                        
                                        $sqlTerceiroAdvogado = "SELECT * FROM usuario WHERE nome='$nomeTerceiroAdvogado'";
                                        $resultTerceiroAdvogado = $conn->query($sqlTerceiroAdvogado);
                                        
                                        while ($dados3 = mysqli_fetch_assoc($resultTerceiroAdvogado)) {
                                            echo '<td>' . $dados3['telefone1'] . '</td>';
                                            echo '<td>' . $dados3['email1'] . '</td>';
                                        }
                                        ?>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <hr style="border-color:#aaaaaa !important; margin-bottom: 30px; margin-top: 10px;">
                        </div>
                        <div class="row">
                            <div class="col-10">

                            </div>
                            <div class="col-2">
                                <div id="voltar">
                                    <a href="#"><button type="submit" class="btn btn-success" name="enviar"
                                            id='salvar'>Gerar PDF</button></a>
                                </div>
                            </div>
                        </div>
                        <!--ENVIO INPUTS COM INFORMAÇÕES IMPORTANTES-->

                        <input type="hidden" name="numeroProcesso" value="<?php echo $numeroProcesso; ?>">
                        <input type="hidden" name="nomePrimeiroAdvogado" value="<?php echo $nomePrimeiroAdvogado; ?>">
                        <input type="hidden" name="nomeSegundoAdvogado" value="<?php echo $nomeSegundoAdvogado; ?>">
                        <input type="hidden" name="nomeTerceiroAdvogado" value="<?php echo $nomeTerceiroAdvogado; ?>">
                        <input type="hidden" name="nomeCliente" value="<?php echo $nomeCliente; ?>">
                        <input type="hidden" name="idProcesso" value="<?php echo $id; ?>">

                        <!--ENVIO INPUTS COM INFORMAÇÕES IMPORTANTES-->
                    </form>
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
                        <a href="processos.php" class="active">
                            <span class="icon"><i class="fas fa-scale-balanced"></i></span>
                            <span class="item">Processos</span>
                        </a>
                    </li>
                    <div class="dropdown">
                        <li>
                            <a class="links">
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
                                <a href="../Agenda/Compromissos/agenda_compromissos.php" class="links"
                                    style="width: 100%;">
                                    <span class="item2" style="margin-left: 15%;">Compromissos</span>
                                </a>
                            </li>
                            <li>
                                <a href="../Agenda/Tarefas/agenda_tarefas.php" class="links">
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
                        <a href="../Site_Marketing/site_marketing.php" class="links">
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
                                <svg xmlns="http://www.w3.org/2000/svg" style="margin-left: 32%;" width="16"
                                    height="13" fill="currentColor" class="bi bi-caret-down-fill"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                                </svg>
                            </a>
                        </li>
                        <div class="dropdown-content">
                            <li>
                                <a href="../Arquivos/Procuracoes/procuracoes.php" class="links"
                                    style="width: 100%;">
                                    <span class="item2" style="margin-left: 15%;">Procuração</span>
                                </a>
                            </li>
                            <li>
                                <a href="../Arquivos/Declaracoes/declaracoes.php" class="links"
                                    style="width: 100%;">
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
