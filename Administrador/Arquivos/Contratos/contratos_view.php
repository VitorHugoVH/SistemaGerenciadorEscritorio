<?php

include_once('../../conexao_adm.php');
require('../../sessao_usuarios.php');

// VERIFICAÇÃO LOGIN E NÍVEL DE USUÁRIO
verificarAcesso($conn);

?>
<!DOCTYPE html>
<html lang="pt-br">
<?php
include_once('../../conexao_adm.php');

//DADOS PROCURAÇÃO

if (isset($_POST['enviar'])) {

    $nomecliente = $_POST['nomecliente'];
    $numeroProcesso = $_POST['numeroprocesso'];
    $varadoProcesso = $_POST['nomedavara'];
    $numeroVara = $_POST['numerovara'];
    $valorHonorario = $_POST['valorhonorario'];
    $parcelas = $_POST['parcelas'];
    $primeiroPagamento = $_POST['primeiroPagamento'];
    
    // Remover o "R$" da string
    $valorSemCifrao = str_replace("R$", "", $valorHonorario);

    // Converter o valor em float
    $valorHonorarioFloat = floatval($valorSemCifrao);

    // Formatar o valor com duas casas decimais
    $valorHonorarioSemCifrao = number_format($valorHonorarioFloat, 2, ',', '');

    // Array associativo com os valores por extenso de 1 a 12
    $extenso = array(
        1 => "um",
        2 => "dois",
        3 => "três",
        4 => "quatro",
        5 => "cinco",
        6 => "seis",
        7 => "sete",
        8 => "oito",
        9 => "nove",
        10 => "dez",
        11 => "onze",
        12 => "doze",
        13 => "treze",
        14 => "catorze",
        15 => "quinze",
        16 => "dezesseis",
        17 => "dezessete",
        18 => "dezoito",
        19 => "dezenove",
        20 => "vinte",
        21 => "vinte e um",
        22 => "vinte e dois",
        23 => "vinte e três",
        24 => "vinte e quatro"
    );
    

    // Verificar se o valor da variável $parcelas está no intervalo de 1 a 12
    if ($parcelas >= 1 && $parcelas <= 24) {
        // Atribuir o valor por extenso à variável $parcelasExtenso
        $parcelasExtenso = $extenso[$parcelas];
    } else {
        // Caso o valor esteja fora do intervalo, atribuir uma mensagem padrão
        $parcelasExtenso = "Valor inválido";
    }

    // FORMATAÇÃO DAS DATAS

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

        // FORMATAÇÃO DIAS DE PAGAMENTO HONORÁRIOS

        // Tratamento do valor de $valorHonorarioSemCifrao para garantir que seja numérico
        $valorHonorarioSemCifrao = str_replace(',', '.', $valorHonorarioSemCifrao);

        // Verifica se $primeiroPagamento é uma data válida
        if (strtotime($primeiroPagamento) !== false) {
            $distribuicaoHonorarios = array();
            $valorParcela = (float) $valorHonorarioSemCifrao / $parcelas;
            $valorParcela = number_format($valorParcela, 2, '.', ''); // Arredonda para 2 casas decimais

            // Converte a data do primeiro pagamento para um objeto DateTime
            $dataPrimeiroPagamento = new DateTime($primeiroPagamento);

            for ($i = 1; $i <= $parcelas; $i++) {
                $dataVencimento = $dataPrimeiroPagamento->format('d/m/Y');
                $valorParcelaFormatado = number_format($valorParcela, 2, ',', '.'); // Formata o valor com 2 casas decimais
                $descricaoParcela = "{$i}) A ({$i}ª) parcela na quantia de R$ {$valorParcelaFormatado} a ser paga com vencimento para o dia {$dataVencimento};";
                $distribuicaoHonorarios[] = $descricaoParcela;

                // Adiciona um mês à data do primeiro pagamento para calcular a data da próxima parcela
                $dataPrimeiroPagamento->modify('+1 month');
            }
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
            <form action="contratos_create.php" method="POST" target="_blank">
                <div class="row">
                    <div class="col-10">
                        <div class="bloco3">
                            <h3 class="text-muted">Criar contrato</h3>
                        </div>
                    </div>
                    <div class="col-2">

                    </div>
                </div>
                <div class="bloco4">
                    <div class="row">
                        <div class="titulo">
                            <h4 class="title"><b> Visualizar contrato</b></h4>
                        </div>
                    </div>
                    <div class="campos">
                            <textarea id="editor" name="descricao">
                                <h3 style="text-align: center;">CONTRATO DE HONORÁRIOS ADVOCATÍCIOS</h3>
                                <p style="margin-left: 50px; margin-right: 50px; text-align: justify;"><b>CONTRATANTE:</b></p>
                                <p style="margin-left: 50px; margin-right: 50px; text-align: justify;">

                                    <b>CONTRATADOS: FRAGA E MELO ADVOGADOS ASSOCIADOS,</b> inscrita no OAB\RS sob o nº 4496, representada neste apto pelos sócios
                                    <b>SANDRO CARVALHO DE FRAGA</b>, brasileiro, divorciado, advogado, inscrito na OAB\RS sob o nº52230 e ELISETE CAMARGO DE MELO, brasileira, solteira, 
                                    advogada, inscrita na OAB/SC sob o n° 65356-B, com escritório profissional na Rua Juca Batista, 4625-
                                    Guatambu, 833- Bairro Hípica- nesta Capital, neste Estado.

                                </p>
                                <p style="margin-left: 50px; margin-right: 50px; text-align: justify;">

                                    O <b>CONTRATANTE</b>, acima qualificado, contrata os serviços profissionais de advocacia dos
                                    <b>CONTRATADOS</b>, conforme as cláusulas e condições seguintes: 

                                </p>
                                <p style="margin-left: 50px; margin-right: 50px; text-align: justify; margin-top: 20px;">
                                
                                    <b>DA NATUREZA DOS SERVIÇOS CONTRATADOS:</b>

                                </p>
                                <p style="margin-left: 50px; margin-right: 50px; text-align: justify;">

                                    <b>Cláusula Primeira:</b> As partes pactuam o Contrato de Honorários com a finalidade de apresentar defesa 
                                    em face da Ação proposta por <b> <?php  $nomecliente ?>, processo <?php echo $numeroProcesso ?>, a qual tramita junto a <?php echo $numeroVara ?> <?php echo mb_strtoupper($varadoProcesso) ?>
                                    DE PORTO ALEGRE-RS.</b>

                                </p>
                                <p style="margin-left: 50px; margin-right: 50px; text-align: justify;">

                                    <b>Cláusula Segunda:</b> A <b>CONTRATANTE</b> obriga-se a colocar à disposição dos <b>CONTRATADOS</b> toda a 
                                    documentação solicitada, bem como outorgar procuração quando necessária.                                    

                                </p>
                                <p style="margin-left: 50px; margin-right: 50px; text-align: justify; margin-top: 20px;">
                                
                                    <b>DA REMUNERAÇÃO E DESPESA:</b>

                                </p>
                                <p style="margin-left: 50px; margin-right: 50px; text-align: justify;">

                                    <b>Cláusula Terceira:</b> Como remuneração pelos serviços ora contratados o <b>CONTRATANTE</b> pagará aos <b>CONTRATADOS</b>
                                    a quantia equivalte a <b><?php echo $valorHonorario ?> (<?php echo $valorHonorarioSemCifrao ?> reais), em <?php echo $parcelas ?> (<?php echo $parcelasExtenso ?>) parcelas mensais,
                                    distribuidas da seguinte forma de pagamento: </b>

                                </p>
                                <p style="margin-left: 50px; margin-right: 50px; text-align: justify; font-size: 14px; white-space: nowrap;">
                                    <?php
                                        foreach ($distribuicaoHonorarios as $parcela) {
                                            echo '<strong>' . $parcela . '</strong><br>';
                                        }
                                    ?>
                                </p>
                                <p style="margin-left: 50px; margin-right: 50px; text-align: justify;">

                                    <b>Parágrafo Segundo: Os pagamentos serão efetuados através de deposito mensal na conta corrente 
                                    nº351033550-8, agência 0835, do Banco Banrisul, e nome de SANDRO CARVALHO DE FRAGA, 
                                    CPF/MF606580290-53 ou pela CHAVE PIX 606580290-53.</b>

                                </p>
                                <p style="margin-left: 50px; margin-right: 50px; text-align: justify;">

                                    <b>Parágrafo Terceiro:</b> Sempre que necessário, o <b>CONTRATANTE</b> adiantará aos <b>CONTRATADOS</b> o 
                                    valor estimado de custas e despesas, obrigando-se estes a prestarem contas ao final de cada caso

                                </p>
                                <p style="margin-left: 50px; margin-right: 50px; text-align: justify;">

                                    <b>Parágrafo Quarto:</b> Os honorários advocatícios percebidos em ações judiciais ou acordos extrajudiciais, 
                                    reverterão sempre em favor dos CONTRATADOS, sem prejuízo do disposto no item “1”acima.

                                </p>
                                <p style="margin-left: 50px; margin-right: 50px; text-align: justify;">

                                    <b>Parágrafo Quinto:</b> O não pagamento liberará o contratado de dar seguimento na ação, independente de 
                                    aviso, notificação ou interpelação.

                                </p>
                                <p style="margin-left: 50px; margin-right: 50px; text-align: justify; margin-top: 20px;">
                                
                                    <b>DO PRAZO DO CONTRATO E CONDIÇÕES GERAIS</b>

                                </p>
                                <p style="margin-left: 50px; margin-right: 50px; text-align: justify;">

                                    <b>Cláusula Quarta:</b> O presente contrato começa a vigorar na data de sua assinatura e terá prazo
                                    indeterminado, podendo a parte que quiser rescindí-lo, fazê-lo mediante simples carta protocolada com 
                                    antecedência de 30(trinta) dias.

                                </p>
                                <p style="margin-left: 50px; margin-right: 50px; text-align: justify;">

                                    <b>Cláusula Quinta:</b> Manifestada a rescisão contratual, as procurações outorgadas serão substabelecidas 
                                    pelos CONTRATADOS, aos advogados indicados pelo CONTRATANTE, prestando-se imediatamente 
                                    as contas das custas e despesas, liquidando eventuais diferenças, com que as partes dar-se-ão mútua e 
                                    recíproca quitação.

                                </p>
                                <p style="margin-left: 50px; margin-right: 50px; text-align: justify;">

                                    <b>Cláusula Sexta:</b> O ajuizamento ou defesa em outra ação, será estipulado o preço e a forma de pagamento 
                                    para esta nova medida, independente do valor ora ajustado.

                                </p>
                                <p style="margin-left: 50px; margin-right: 50px; text-align: justify;">

                                    Elegem o foro da cidade de Porto Alegre para questões resultantes deste contrato, com expressa renúncia 
                                    de qualquer outro.

                                </p>
                                <p style="margin-left: 50px; margin-right: 50px; text-align: justify;">

                                    E, por estarem assim justos e contratados, assinam o presente em (2)duas vias de igual teor e forma. 

                                </p>
                                <br>
                                <p style="text-align: center;">Porto Alegre/RS, <?php echo $dia ?> de <?php echo $mes_extenso["$mes"] ?> de <?php echo $ano ?></p>
                                <br>
                                <hr style="width: 60%; color: black;">
                                <p style="text-align: center;"><b><?php echo mb_strtoupper($nomecliente) ?></b></p>
                                <br>
                                <div style="display: flex; justify-content: center;">

                                    <div style="text-align: center; margin: 0 100px;">
                                        <p>
                                            <b>SANDRO CARVALHO DE FRAGA</b>
                                        </p>
                                        <p>
                                            <b>OAB/RS 52.230</b>
                                        </p>
                                    </div>

                                    <div style="text-align: center; margin: 0 100px;">
                                        <p>
                                            <b>ELISETE CAMARGO DE MELO</b>
                                        </p>
                                        <p>
                                            <b>OAB/SC Nº 65356-B</b>
                                        </p>
                                    </div>
                                </div>
                                <br><br><br><br><br><br>
                                <p style="font-size: 12px; margin-top:10px; text-align: center;">Rua Guatambú, nº833, Fone(051) 32129832- Hípica Porto Alegre/RS</p>
                            </textarea>
                    </div>
                </div>
                <input type="hidden" name="datacriacao" value="<?php echo date('d/m/Y') ?>">
                <input type="hidden" name="nomecliente" id="nomecliente" value="<?php echo mb_strtoupper($nomecliente) ?>">
                <div class="final">
                    <div class="row">
                        <div class="col-8">

                        </div>
                        <div class="col-2">
                            <div id="voltar">
                                <a href="contratos.php"><button type="button" class="btn btn-secondary" id='salvar'>Volar</button></a>
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
                        <span class="item">Dashboard</span>
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
                            <a href="../Declaracoes/declaracao.php" class="links" style="width: 100%;">
                                <span class="item2" style="margin-left: 15%;">Declaração</span>
                            </a>
                        </li>
                        <li>
                            <a href="contratos.php" class="active" style="width: 100%;">
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