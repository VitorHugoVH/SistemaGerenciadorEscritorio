<?php
if (!empty($_GET['id'])) {
    include_once '../conexao_adm.php';

    $id = $_GET['id'];

    $sqlSelect = "SELECT * FROM processo WHERE id=$id";

    $result = $conn->query($sqlSelect);

    if ($result->num_rows > 0) {
        while ($user_data = mysqli_fetch_assoc($result)) {
            $privado = $user_data['privado'];
            $status = $user_data['stat'];
            $fase = $user_data['fase'];
            $poderjudiciario = $user_data['poderjudiciario'];
            $classe = $user_data['classe'];
            $natureza = $user_data['natureza'];
            $nprocesso = $user_data['nprocesso'];
            $numerovara = $user_data['numerovara'];
            $nomedavara = $user_data['nomedavara'];
            $nomedacomarca = $user_data['nomedacomarca'];
            $valorCausa = $user_data['valorCausa'];
            $dataa = $user_data['dataa'];
            $valorhonorario = $user_data['valorHonorario'];
            $parcelas = $user_data['parcelas'];
            $cadreceita = $user_data['cadreceita'];
            $ob = $user_data['observacoes'];
            $posicao = $user_data['posicaocliente'];
            $nomecliente = $user_data['nomecliente'];
            $nomeadvogado = $user_data['nomeadvogado'];
            $nomefalecido = $user_data['falecido'];
        }
    } else {
        header('Location: processos.php');
    }
}
?>

<?php

// VERIFICAÇÃO LOGIN
session_start();
$logged = $_SESSION['logged'] ?? null;

if (!$logged) {
    header('Location: /FragaeMelo/Site%20Fraga%20e%20Melo%20BootsTrap/login.php');
}

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
                <a href="/Users/vh007/OneDrive/%C3%81rea%20de%20Trabalho/Tudo/Site%20TCC/Site%20Fraga%20e%20Melo%20BootsTrap/index.php"
                    class="link"><button class="button button4">Voltar</button></a>
            </div>
            <div class="container" id='main'>
                <form action="processos_save.php" method="POST">
                    <div class="row">
                        <div class="col-10">
                            <div class="bloco3">
                                <h3 class="text-muted">Editar</h3>
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
                        <div class="row">
                            <div class="titulo">
                                <h4 class="title"><b>Dados do Processo - Nº <?php echo $nprocesso; ?></b></h4>
                            </div>
                            <div class="campos">
                                <label class="form-label">Privado</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1"
                                        <?= $privado == '(O cliente não poderá visualizar)' ? 'checked' : '' ?>
                                        id="flexCheckDefault" name="naovisualizar">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        (O cliente não poderá visualizar)
                                    </label>
                                </div>
                            </div>
                            <div class="campos">
                                <label class="form-label">Status do Processo</label>
                                <select class="form-select" aria-label="Default select example" name="statusprocesso"
                                    required>
                                    <option value="1" <?= $status == 'Ativo' ? 'selected' : '' ?>>Ativo</option>
                                    <option value="2" <?= $status == 'Suspenso' ? 'selected' : '' ?>>Suspenso
                                    </option>
                                    <option value="3" <?= $status == 'Baixado' ? 'selected' : '' ?>>Baixado
                                    </option>
                                </select>
                            </div>
                            <div class="campos">
                                <label class="form-label">Fase</label>
                                <select class="form-select" aria-label="Default select example" name="faseprocesso"
                                    required>
                                    <option value="1" <?= $fase == 'Sem fase' ? 'selected' : '' ?>>Sem fase
                                    </option>
                                    <option value="2" <?= $fase == 'Execução' ? 'selected' : '' ?>>Execução
                                    </option>
                                    <option value="3" <?= $fase == 'Inicial' ? 'selected' : '' ?>>Inicial</option>
                                    <option value="4" <?= $fase == 'Recursal' ? 'selected' : '' ?>>Recursal
                                    </option>
                                </select>
                            </div>
                            <div class="campos">
                                <label class="form-label">Poder Judiciário</label>
                                <select class="form-select" name="poderjudiciario" id="poderjudiciario" required>
                                    <option value="1"
                                        <?= $poderjudiciario == 'Supremo Tribunal Federal' ? 'selected' : ' ' ?>>Supremo
                                        Tribunal Federal</option>
                                    <option value="2"
                                        <?= $poderjudiciario == 'Conselho Nacional de Justiça' ? 'selected' : ' ' ?>>
                                        Conselho Nacional de Justiça</option>
                                    <option value="3"
                                        <?= $poderjudiciario == 'Superior Tribunal de Justiça' ? 'selected' : ' ' ?>>
                                        Superior Tribunal de Justiça</option>
                                    <option value="4"
                                        <?= $poderjudiciario == 'Justiça Federal' ? 'selected' : ' ' ?>>Justiça Federal
                                    </option>
                                    <option value="5"
                                        <?= $poderjudiciario == 'Justiça do Trabalho' ? 'selected' : ' ' ?>>Justiça do
                                        Trabalho</option>
                                    <option value="6"
                                        <?= $poderjudiciario == 'Justiça Eleitoral' ? 'selected' : ' ' ?>>Justiça
                                        Eleitoral</option>
                                    <option value="7"
                                        <?= $poderjudiciario == 'Justiça Militar da União' ? 'selected' : ' ' ?>>Justiça
                                        Militar da União</option>
                                    <option value="8"
                                        <?= $poderjudiciario == 'Justiça dos Estados e do Distrito Federal e Territórios' ? 'selected' : ' ' ?>>
                                        Justiça dos Estados e do Distrito Federal e Territórios</option>
                                    <option value="9"
                                        <?= $poderjudiciario == 'Justiça Militar Estadual' ? 'selected' : ' ' ?>>Justiça
                                        Militar Estadual</option>
                                </select>
                            </div>
                            <div class="campos">
                                <div class="row">
                                    <label for="client1"><b>
                                            <h6 style="font-family: arial, sans-serif; font-size: 16px;">Classe
                                                processual</h6>
                                        </b></label>
                                    <div class="input-group">
                                        <select class="form-select" aria-label="Default select example"
                                            name="classeprocesso" id="classeprocesso" onchange="nfalecido()" required>
                                            <option <?= $classe == 'Ação de cobrança' ? 'selected' : ' ' ?>>Ação de
                                                cobrança</option>
                                            <option <?= $classe == 'Ação de despejo' ? 'selected' : ' ' ?>>Ação de
                                                despejo</option>
                                            <option <?= $classe == 'Ação de indenização' ? 'selected' : ' ' ?>>Ação de
                                                indenização</option>
                                            <option <?= $classe == 'Divórcio' ? 'selected' : ' ' ?>>Divórcio</option>
                                            <option <?= $classe == 'Execução de alimentos' ? 'selected' : ' ' ?>>
                                                Execução de alimentos</option>
                                            <option <?= $classe == 'Impugnação do valor da causa' ? 'selected' : ' ' ?>>
                                                Impugnação do valor da causa</option>
                                            <option <?= $classe == 'Processo de inventário' ? 'selected' : ' ' ?>>
                                                Processo de inventário</option>
                                        </select>
                                        <input type="hidden" name="outraclasse" id="outraclasse" class="form-control"
                                            placeholder="Nome da classe">
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary" name="textclass" id="textclass"
                                                type="button" onclick="classeadd()">Adicionar</button>
                                            <button class="btn btn-secondary" name="selectclass" id="selectclass"
                                                type="button" onclick="classeselect()"
                                                style="display: none;">Selecionar</button>
                                        </div>
                                        <script>
                                            function classeadd() {
                                                document.getElementById('classeprocesso').style.display = "none";
                                                document.getElementById('outraclasse').type = "text";
                                                document.getElementById('textclass').style.display = "none";
                                                document.getElementById('selectclass').style.display = "block";
                                            }

                                            function classeselect() {
                                                document.getElementById('classeprocesso').style.display = "block";
                                                document.getElementById('outraclasse').type = "hidden";
                                                document.getElementById('textclass').style.display = "block";
                                                document.getElementById('selectclass').style.display = "none";
                                            }
                                        </script>
                                    </div>
                                </div>
                            </div>
                            <!---Javascript Falecido--->
                            <div id="falecidoarea" style="  margin-top: 1%; margin-bottom: 2%; display: none;">
                                <label class="form-label">Nome do falecido</label>
                                <input type="text" name="nomefalecido" id="nomefalecido" class="form-control"
                                    placeholder="Nome do falecido" value="<?php echo $nomefalecido; ?>">
                            </div>
                            <script>
                                function nfalecido() {
                                    if (document.getElementById('classeprocesso').value == 'Processo de inventário') {
                                        document.getElementById('falecidoarea').style.display = 'block';
                                    } else {
                                        document.getElementById('falecidoarea').style.display = 'none';
                                    }
                                }
                            </script>
                            <!---Javascript Falecido Final--->
                            <div class="campos">
                                <label class="form-label">Natureza da ação</label>
                                <select class="form-select" aria-label="Default select example"
                                    name="naturezaprocesso" required>
                                    <option value="1" <?= $natureza == 'Civil' ? 'selected' : '' ?>>Cívil</option>
                                    <option value="2" <?= $natureza == 'Criminal' ? 'selected' : '' ?>>Criminal</option>
                                    <option value="3" <?= $natureza == 'Família' ? 'selected' : '' ?>>Família</option>
                                    <option value="4" <?= $natureza == 'Trabalhista' ? 'selected' : '' ?>>Trabalhista</option>
                                    <option value="5" <?= $natureza == 'Previdencial' ? 'selected' : '' ?>>Previdencial</option>
                                    <option value="6" <?= $natureza == 'Tributário' ? 'selected' : '' ?>>Tributário</option>
                                </select>
                            </div>
                            <div class="campos">
                                <label class="form-label">Nº de identificação</label>
                                <input type="text" name="nprocesso" id="nprocesso" class="form-control"
                                    maxlength="25" placeholder="Número do processo - CNJ" value="<?php echo $nprocesso; ?>"
                                    required>
                                <script>
                                    const cnjInput = document.getElementById('nprocesso');
                                    cnjInput.addEventListener('input', (event) => {
                                        const input = event.target;
                                        const value = input.value;
                                        const newValue = value.replace(/[^\d]/g, ''); // Remove tudo que não for número
                                        let maskedValue = '';
                                        if (newValue.length > 7) {
                                            maskedValue += `${newValue.substring(0, 7)}-`;
                                            if (newValue.length > 9) {
                                                maskedValue += `${newValue.substring(7, 9)}.`;
                                                if (newValue.length > 13) {
                                                    maskedValue += `${newValue.substring(9, 13)}.`;
                                                    if (newValue.length > 14) {
                                                        maskedValue += `${newValue.substring(13, 14)}.`;
                                                        if (newValue.length > 18) {
                                                            maskedValue += `${newValue.substring(14, 18)}-`;
                                                            if (newValue.length > 18) {
                                                                maskedValue += `${newValue.substring(18)}`;
                                                            }
                                                        } else {
                                                            maskedValue += `${newValue.substring(14)}`;
                                                        }
                                                    } else {
                                                        maskedValue += `${newValue.substring(13)}`;
                                                    }
                                                } else {
                                                    maskedValue += `${newValue.substring(9)}`;
                                                }
                                            } else {
                                                maskedValue += `${newValue.substring(7)}`;
                                            }
                                        } else {
                                            maskedValue = newValue;
                                        }
                                        input.value = maskedValue;
                                    });
                                </script>
                            </div>
                            <div class="campos">
                                <label class="form-label">Nº da Vara</label>
                                <input type="text" maxlength="7" class="form-control" name="numerovara"
                                    id="numerovara" placeholder="0000000ª" onkeyup="formatarVara(this)"
                                    value="<?php echo $numerovara; ?>" required>
                                <script>
                                    function formatarVara(input) {
                                        // remove caracteres não numéricos
                                        let num = input.value.replace(/[^\d]/g, '');

                                        // adiciona 'ª' como último caractere, se houver número
                                        if (num) {
                                            num += 'ª';
                                        }

                                        // atualiza o valor do input com a string formatada
                                        input.value = num;
                                    }
                                </script>
                            </div>
                        </div>
                        <div class="campos">
                            <label class="form-label">Vara do Processo</label>
                            <div class="row">
                                <div class="input-group">
                                    <select name="nomedavara" id="nomedavara" class="form-control" required>
                                        <option <?= $nomedavara == 'Vara Cívil' ? 'selected' : ' ' ?>>Vara Cível
                                        </option>
                                        <option <?= $nomedavara == 'Vara Criminal' ? 'selected' : ' ' ?>>Vara Criminal
                                        </option>
                                        <option <?= $nomedavara == 'Vara da Família' ? 'selected' : ' ' ?>>Vara da
                                            Família</option>
                                        <option <?= $nomedavara == 'Vara do Trabalho' ? 'selected' : ' ' ?>>Vara do
                                            Trabalho</option>
                                        <option <?= $nomedavara == 'Vara da Infância e Juventude' ? 'selected' : ' ' ?>>
                                            Vara da Infância e Juventude</option>
                                        <option <?= $nomedavara == 'Vara de Execução Penal' ? 'selected' : ' ' ?>>Vara
                                            de Execução Penal</option>
                                    </select>
                                    <input type="hidden" name="outronomedavara" id="outronomedavara"
                                        class="form-control" placeholder="Vara processo">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary" name="txtnomedavara" id="txtnomedavara"
                                            type="button" onclick="adicionar()">Adicionar
                                        </button>
                                        <button class="btn btn-secondary" name="selnomedavara" id="selnomedavara"
                                            type="button" onclick="selecionar()" style="display: none;">Selecionar
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!--ADICIONAR OUTRO CAMPO VARA DO PROCESSO--->
                            <script>
                                // RECEBER E DECLARAR VARIÁVEIS

                                let camposelectvara = document.getElementById('nomedavara');
                                let campotextvara = document.getElementById('outronomedavara');
                                let botaoadicionar = document.getElementById('txtnomedavara');
                                let botaoselecionar = document.getElementById('selnomedavara');

                                // DEFINIR AS FUNÇÕES

                                function adicionar() {
                                    camposelectvara.style.display = 'none';
                                    campotextvara.type = 'text';
                                    botaoadicionar.style.display = 'none';
                                    botaoselecionar.style.display = 'block';
                                }

                                function selecionar() {
                                    camposelectvara.style.display = 'block';
                                    campotextvara.type = 'hidden';
                                    botaoadicionar.style.display = 'block';
                                    botaoselecionar.style.display = 'none';
                                }
                            </script>
                            <!--FIM ADICIONAR OUTRO CAMPO VARA DO PROCESSO--->
                        </div>
                        <div class="campos">
                            <div class="row">
                                <label for="nomedacomarca"><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Nome da Comarca
                                        </h6>
                                    </b></label>
                                <div class="input-group">
                                    <select class="form-select" aria-label="Default select example"
                                        name="nomedacomarca" id="nomedacomarca" style="display: block;" required>
                                        <option <?= $nomedacomarca == 'Porto Alegre-RS' ? 'selected' : ' ' ?>>Porto
                                            Alegre-RS</option>
                                        <option <?= $nomedacomarca == 'São Paulo-SP' ? 'selected' : ' ' ?>>São Paulo-SP
                                        </option>
                                        <option <?= $nomedacomarca == 'Rio de Janeiro-RJ' ? 'selected' : ' ' ?>>Rio de
                                            Janeiro-RJ</option>
                                        <option <?= $nomedacomarca == 'Belo Horizonte-MG' ? 'selected' : ' ' ?>>Belo
                                            Horizonte-MG</option>
                                        <option <?= $nomedacomarca == 'Brasília-DF' ? 'selected' : ' ' ?>>Brasília-DF
                                        </option>
                                        <option <?= $nomedacomarca == 'Curitiba-PR' ? 'selected' : ' ' ?>>Curitiba-PR
                                        </option>
                                        <option <?= $nomedacomarca == 'Fortaleza-CE' ? 'selected' : ' ' ?>>Fortaleza-CE
                                        </option>
                                        <option <?= $nomedacomarca == 'Recife-PE' ? 'selected' : ' ' ?>>Recife-PE
                                        </option>
                                        <option <?= $nomedacomarca == 'Salvador-BA' ? 'selected' : ' ' ?>>Salvador-BA
                                        </option>
                                        <option <?= $nomedacomarca == 'Belém-PA' ? 'selected' : ' ' ?>>Belém-PA</option>
                                        <option <?= $nomedacomarca == 'Manaus-AM' ? 'selected' : ' ' ?>>Manaus-AM
                                        </option>
                                        <option <?= $nomedacomarca == 'Goiânia-GO' ? 'selected' : ' ' ?>>Goiânia-GO
                                        </option>
                                    </select>
                                    <input type="hidden" name="outronomedacomarca" id="outronomedacomarca"
                                        class="form-control" placeholder="Ex: Florianópolis-SC">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary" name="textclassComarca"
                                            id="textclassComarca" type="button"
                                            onclick="classeaddComarca()">Adicionar
                                        </button>
                                        <button class="btn btn-secondary" name="selectclassComarca"
                                            id="selectclassComarca" type="button" onclick="classeselect()"
                                            style="display: none;">Selecionar
                                        </button>
                                    </div>
                                    <script>
                                        function classeaddComarca() {
                                            document.getElementById('nomedacomarca').style.display = "none";
                                            document.getElementById('outronomedacomarca').type = "text";
                                            document.getElementById('textclassComarca').style.display = "none";
                                            document.getElementById('selectclassComarca').style.display = "block";
                                        }

                                        function classeselect() {
                                            document.getElementById('nomedacomarca').style.display = "block";
                                            document.getElementById('outronomedacomarca').type = "hidden";
                                            document.getElementById('textclassComarca').style.display = "block";
                                            document.getElementById('selectclassComarca').style.display = "none";
                                        }
                                    </script>
                                </div>
                            </div>
                        </div>
                        <!--REFATORAçÃO VALORES CUSA E HONORÁRIOS---->
                            <?php

                                $valorCausa = substr($valorCausa, 2);
                                $valorhonorario = substr($valorhonorario, 2);

                            ?>
                        <!--REFATORAçÃO VALORES CUSA E HONORÁRIOS---->
                        <div class="campos">
                          <label class="form-label">Valor da causa</label>
                          <input type="text" id="valorCausa" name="valorCausa" class="form-control"
                              value="<?php echo $valorCausa; ?>" required />
                        </div>
                        <div class="campos">
                            <label class="form-label">Data da abertura</label>
                            <input type="date" name="dateabertura" id="dateabertura" class="form-control"
                                value="<?php echo $dataa; ?>" required>
                        </div>
                        <div class="campos">
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Observações</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Observações"
                                    name="observacoes" required><?php echo $ob; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="bloco5">
                        <div class="row">
                            <div class="titulo">
                                <h4 class="title"><b>Honorários</b></h4>
                            </div>
                            <div class="campos">
                                <label class="form-label">Valor Honorário</label>
                                <input type="text" id="valorhonorario" name="valorhonorario" class="form-control"
                                    value="<?php echo $valorhonorario; ?>" required />
                            </div>
                              <script>
                                var inputCausa = document.getElementById('valorCausa');
                                var inputHonorario = document.getElementById('valorhonorario');

                                inputCausa.addEventListener('input', function() {
                                  formatarValor(this);
                                });

                                inputHonorario.addEventListener('input', function() {
                                  formatarValor(this);
                                });

                                function formatarValor(input) {
                                  var valor = input.value;

                                  // Remove tudo que não é dígito
                                  valor = valor.replace(/\D/g, '');

                                  // Adiciona a vírgula para separar os centavos
                                  valor = valor.slice(0, -2) + ',' + valor.slice(-2);

                                  // Adiciona o símbolo R$
                                  valor = 'R$ ' + valor;

                                  // Atualiza o valor do input
                                  input.value = valor;

                                  // Verifica se o valor mínimo foi atingido
                                  var valorNumerico = parseFloat(valor.replace(/[^0-9,-]+/g, "").replace(",", "."));
                                  if (valorNumerico < 100) {
                                    input.setCustomValidity('O valor mínimo é R$ 100,00');
                                  } else {
                                    input.setCustomValidity('');
                                  }
                                }

                                // Chama a função de formatação inicialmente
                                formatarValor(inputCausa);
                                formatarValor(inputHonorario);
                              </script>
                            <div class="campos">
                                <label for="parcelas">Parcelas</label>
                                <input type="number" name="parcelas" id="parcelas" class="form-control"
                                    placeholder="3" value="<?php echo $parcelas; ?>" required />
                            </div>
                            <div class="campos">
                                <label class="form-label">Adicionar Receita</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="flexCheckDefault"
                                        name="cadreceita" <?= $cadreceita == 'Ligado' ? 'checked' : ' ' ?>>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Cadastrar como nova receita após finalização
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bloco5">
                        <div class="row">
                            <div class="titulo">
                                <h4 class="title"><b>Cliente</b></h4>
                            </div>
                            <div class="campos">
                                <label class="form-label">Posição do cliente</label>
                                <select class="form-select" aria-label="Default select example" name="posicaocliente"
                                    required>
                                    <option value="1" <?= $posicao == 'Adverso' ? 'selected' : '' ?>>Adverso
                                    </option>
                                    <option value="2" <?= $posicao == 'Advogado' ? 'selected' : '' ?>>Advogado
                                    </option>
                                    <option value="3" <?= $posicao == 'Advogado Adverso' ? 'selected' : '' ?>>
                                        Advogado Adverso</option>
                                    <option value="4" <?= $posicao == 'Autor' ? 'selected' : '' ?>>Autor</option>
                                    <option value="5" <?= $posicao == 'Reclamada' ? 'selected' : '' ?>>Reclamada
                                    </option>
                                    <option value="6" <?= $posicao == 'Reclamante' ? 'selected' : '' ?>>Reclamante
                                    </option>
                                    <option value="7" <?= $posicao == 'Relator' ? 'selected' : '' ?>>Relator
                                    </option>
                                    <option value="8" <?= $posicao == 'Requerente' ? 'selected' : '' ?>>Requerente
                                    </option>
                                    <option value="9" <?= $posicao == 'Requerido' ? 'selected' : '' ?>>Requerido
                                    </option>
                                    <option value="10" <?= $posicao == 'Réu' ? 'selected' : '' ?>>Réu</option>
                                    <option value="11" <?= $posicao == 'Testemunha' ? 'selected' : '' ?>>Testemunha
                                    </option>
                                </select>
                            </div>
                            <div class="campos">
                                <label class="form-label">Cliente</label>
                                <select name="nomecliente" id="nomecliente" class="form-select" required>
                                    <option value="Não declarado"
                                        <?= $nomecliente == 'Não declarado' ? 'selected' : ' ' ?>>Selecione</option>
                                    <?php
                                    include_once '../conexao_adm.php';
                                    
                                    $sqlcliente = 'SELECT nomecliente FROM clientes';
                                    $resultcliente = $conn->query($sqlcliente);
                                    
                                    while ($data_cliente = mysqli_fetch_assoc($resultcliente)) {
                                        $nomecli = $data_cliente['nomecliente'];
                                    
                                        if ($nomecliente == $nomecli) {
                                            echo "<option selected>$nomecli</option>";
                                        } else {
                                            echo "<option>$nomecli</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="bloco6">
                        <div class="row">
                            <div class="titulo">
                                <h4 class="title"><b>Advogado / Equipe</b></h4>
                            </div>
                            <div class="campos">
                                <div class="outro">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-sm">Advogado</span>
                                        </div>
                                        <select name="advogadoatuando" class="form-select" required>
                                            <option <?= $nomeadvogado == 'Não consta' ? 'selected' : '' ?>>Não consta
                                            </option>
                                            <?php
                                            include_once '../conexao_adm.php';
                                            
                                            $sqlAdvogado = 'SELECT nome FROM usuario';
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
                        </div>
                    </div>
                    <div class="final">
                        <div class="row">
                            <div class="col-8">

                            </div>
                            <div class="col-2">
                                <div id="salvar">
                                    <a href="processos.php"><button type="button" class="btn btn-outline-secondary"
                                            id="voltar2">Cancelar</button></a>
                                </div>
                            </div>
                            <div class="col-2">
                                <div id="voltar">
                                    <a href="processos.php"><button type="submit" class="btn btn-success"
                                            name="update" id='update'>Atualizar</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
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
                            <a href="../Agenda/Tarefas/agenda_tarefas.php" class="links">
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
                            <svg xmlns="http://www.w3.org/2000/svg" style="margin-left: 27%;" width="16" height="13" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                            </svg>
                        </a>
                    </li>
                    <div class="dropdown-content">
                        <li>
                            <a href="../Financeiro/Despesas/despesas.php" class="links" style="width: 100%;">
                                <span class="item2" style="margin-left: 15%;">Despesas</span>
                            </a>
                        </li>
                        <li>
                            <a href="../Financeiro/Receitas/receitas.php" class="links">
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
                            <a href="../Equipe/Clientes/clientes.php" class="links" style="width: 100%;">
                                <span class="item2" style="margin-left: 15%;">Clientes</span>
                            </a>
                        </li>
                        <li>
                            <a href="../Equipe/Advogados/advogados.php" class="links" style="width: 100%;">
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

</html>
