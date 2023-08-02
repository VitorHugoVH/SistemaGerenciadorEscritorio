<?php

// VERIFICAÇÃO LOGIN
session_start();
$logged = $_SESSION['logged'] ?? NULL;

if (!$logged) {
  header('Location: /FragaeMelo/Site%20Fraga%20e%20Melo%20BootsTrap/login.php');
};

?>
<!DOCTYPE html>
<html lang="pt-br">
<?php
include_once('../../conexao_adm.php');

//DADOS PROCURAÇÃO

if (isset($_POST['enviar'])) {

    $nomecliente = $_POST['nomecliente'];
    $sexo = $_POST['sexo'];
    $nacionalidade = $_POST['nacionalidade'];
    $estadocivil = $_POST['estadocivil'];
    $profissao = $_POST['profissaocliente'];
    $portador = "portador";
    $cedula = $_POST['rg'];
    $cpf = $_POST['cpf'];
    $endereco = $_POST['endereco'];
    $dia = date('d');
    $mes = date('M');
    $ano = date('Y');

    //FUNÇÃO MES PORTUGUÊS

    $mes_extenso = array(
        'Jan' => 'Janeiro',
        'Feb' => 'Fevereiro',
        'Mar' => 'Março',
        'Apr' => 'Abril',
        'May' => 'Maio',
        'Jun' => 'Junho',
        'Jul' => 'Julho',
        'Aug' => 'Agosto',
        'Nov' => 'Novembro',
        'Sep' => 'Setembro',
        'Oct' => 'Outubro',
        'Dec' => 'Dezembro'
    );


    //FORMATAÇÃO ESTADO CIVIL

    switch ($estadocivil) {
        case 'Solteiro(a)':
            $estadocivil = 'solteiro';
            break;
        case 'Casado(a)':
            $estadocivil = 'casado';
            break;
        case 'Separado(a) judicialmente':
            $estadocivil = 'separado';
            break;
        case 'Divorciado(a)':
            $estadocivil = 'divorciado';
            break;
        case 'Viúvo(a)':
            $estadocivil = 'viúvo';
            break;
        case 'União estável':
            $estadocivil = 'união estável';
    }

    //FORMATAÇÃO SEXO CARACTERES

    if ($sexo == 'Feminino') {

        //NACIONALIDADE
        $letrafinalnacionalidade = substr($nacionalidade, -1);
        $nacionalidade = str_replace($letrafinalnacionalidade, 'a', $nacionalidade);

        //ESTADO CIVIL
        if ($estadocivil != 'união estável') {
            $letrafinalestadocivil = substr($estadocivil, -1);
            $estadocivil = str_replace($letrafinalestadocivil, 'a', $estadocivil);
        } else {
            $estadocivil = $estadocivil;
        }

        //PROFISSAO
        $letrafinalprofissao = substr($profissao, -1);
        $profissao = str_replace($letrafinalprofissao, 'a', $profissao);

        //PORTADOR
        $letrafinalportador = substr($portador, -1);
        $portador = str_replace($letrafinalportador, 'a', $portador);
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../estilosAdm.css" />
    <link rel="icon" type="image/x-icon" href="../../imagens/icon.png" />
    <link rel="stylesheet" type="text/css" href="../../fontawesome/css/all.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/35qnw3mr7vfcivpkll7h2mly3vod8u7kh8ujfb0q3qur0e4j/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
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
    <script>
        tinymce.init({
            selector: '#editor',
            plugins: 'autoresize',
            menubar: false,
        });
    </script>
    <title>Fraga e Melo Advogados Associados</title>
</head>

<body>
    <div class="wrapper">
        <div class="section">
            <div class="top_navbar">
                <a href="../../../../Site Fraga e Melo BootsTrap/index.php" class="link"><button class="button button4">Voltar</button></a>
            </div>
            <div class="container" id='main'>
                <form action="declaracoes_create.php" method="POST" target="_blanck">
                    <div class="row">
                        <div class="col-10">
                            <div class="bloco3">
                                <h3 class="text-muted">Criar declaração</h3>
                            </div>
                        </div>
                        <div class="col-2">

                        </div>
                    </div>
                    <div class="bloco4">
                        <div class="row">
                            <div class="titulo">
                                <h4 class="title"><b> Visualizar declaração</b></h4>
                            </div>
                        </div>
                        <div class="campos">
                            <textarea id="editor" name="descricao">
                                <h3 style="text-align: center;">DECLARAÇÃO</h3>
                                <p style="margin-left: 50px; margin-right: 50px; text-align: justify;"><b><?php echo mb_strtoupper($nomecliente) ?>,</b> <?php echo mb_strtolower($nacionalidade) ?>, <?php echo mb_strtolower($estadocivil) ?>, <?php echo mb_strtolower($profissao) ?>, portador da cédula de
                                identidade de nº <?php echo $cedula ?>, inscrito no CPF sob o nº <?php echo $cpf ?>, residente e domiciliado
                                na <?php echo $endereco ?>, neste Estado, declara que é pobre na acepção da
                                palavra e não doispõe de condições financeiras de arcar com as despesas e custas processuais
                                sem prejuízo do sustento próprio.
                                </p>
                                <p style="text-align: center;">Porto Alegre/RS, <?php echo $dia ?> de <?php echo $mes_extenso["$mes"] ?> de <?php echo $ano ?></p>
                                <br>
                                <hr style="width: 60%; color: black;">
                                <p style="text-align: center;"><b><?php echo mb_strtoupper($nomecliente) ?></b></p>
                            </textarea>
                        </div>
                    </div>
                    <input type="hidden" name="datacriacao" value="<?php echo date('d/m/Y') ?>">
                    <input type="hidden" name="nomecliente" id="nomecliente" value="<?php echo $nomecliente ?>">
                    <div class="final">
                        <div class="row">
                            <div class="col-8">

                            </div>
                            <div class="col-2">
                                <div id="voltar">
                                    <a href="declaracoes.php"><button type="button" class="btn btn-secondary" id='salvar'>Volar</button></a>
                                </div>
                            </div>
                            <div class="col-2">
                                <div id="voltar">
                                    <a href="#"><button type="submit" class="btn btn-success" name="enviar" id='salvar'>Concluir</button></a>
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
                            <a href="../../Financeiro/Despesas/despesas.php" class="active" style="width: 100%;">
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
                        <a href="#" class="active">
                            <span class="icon"><i class="fas fa-file"></i></span>
                            <span class="item">Arquivos</span>
                            <svg xmlns="http://www.w3.org/2000/svg" style="margin-left: 32%;" width="16" height="13" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                            </svg>
                        </a>
                    </li>
                    <div class="dropdown-content">
                        <li>
                            <a href="../Procuracoes/procuracoes.php" class="links" style="width: 100%;">
                                <span class="item2" style="margin-left: 15%;">Procuração</span>
                            </a>
                        </li>
                        <li>
                            <a href="declaracao.php" class="active" style="width: 100%;">
                                <span class="item2" style="margin-left: 15%;">Declaração</span>
                            </a>
                        </li>
                        <li>
                            <a href="../Contratos/contratos.php" class="links" style="width: 100%;">
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