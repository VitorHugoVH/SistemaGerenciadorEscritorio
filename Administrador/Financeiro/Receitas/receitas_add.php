<?php

// VERIFICAÇÃO LOGIN
session_start();
$logged = $_SESSION['logged'] ?? NULL;

if (!$logged) {
  header('Location: /FragaeMelo/Site%20Fraga%20e%20Melo%20BootsTrap/login.php');
};

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../estilosAdm.css" />
    <link rel="icon" type="image/x-icon" href="../../imagens/icon.png" />
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
                <form action="receitas_insert.php" method="POST">
                    <div class="row">
                        <div class="col-10">
                            <div class="bloco3">
                                <h3 class="text-muted">Adicionar</h3>
                            </div>
                        </div>
                        <div class="col-2">
                            <div id="voltar">
                                <a href="receitas.php"><button type="button" class="btn btn-secondary" id='voltar1'>Volar</button></a>
                            </div>
                        </div>
                    </div>
                    <div class="bloco4">
                        <div class="row">
                            <div class="titulo">
                                <h4 class="title"><b>Cadastrar Receitas</b></h4>
                            </div>
                            <div class="campos">
                                <div class="row">
                                    <label for="client1"><b>
                                            <h6 style="font-family: arial, sans-serif; font-size: 16px;">Cliente</h6>
                                        </b></label>
                                    <div class="input-group">
                                        <select name="client1" id="client1" class="form-select">
                                            <option>Nenhum</option>
                                            <?php
                                            include_once('../../conexao_adm.php');

                                            $sqlClient = "SELECT * FROM clientes ORDER BY id ASC";
                                            $resultClient = $conn->query($sqlClient);

                                            while ($data_client = mysqli_fetch_assoc($resultClient)) {

                                                echo "<option>" . $data_client['nomecliente'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                        <input type="hidden" name="client2" id="client2" class="form-control">
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary" name="textcli" id="textcli" type="button" onclick="clientadd()">Adicionar</button>
                                            <button class="btn btn-secondary" name="selectcli" id="selectcli" type="button" onclick="clientselect()" style="display: none;">Selecionar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="campos">
                                <label for="vencimento"><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Data vencimento</h6>
                                    </b></label>
                                <input type="date" name="vencimento" id="vencimento" class="form-control" placeholder="__/__/__">
                            </div>
                            <div class="campos">
                                <label class="form-label" for="valor">Valor</label>
                                <input type="text" id="valor" name="valor" class="form-control"
                                    value="0,00" maxlength="14" required />
                            </div>
                            <script>
                                var inputHonorario = document.getElementById('valor');
                            
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
                                formatarValor(inputHonorario);
                            </script>
                            <div class="campos">
                                <div class="row">
                                    <label for="categoria1"><b>
                                            <h6 style="font-family: arial, sans-serif; font-size: 16px;">Categoria</h6>
                                        </b></label>
                                    <div class="input-group">
                                        <select class="form-select" name="categoria1" id="categoria1">
                                            <option>Recebimentos</option>
                                        </select>
                                        <input type="hidden" name="categoria2" id="categoria2" class="form-control">
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary" name="adcategoria" id="adcategoria" type="button" onclick="addcategoria()">Adicionar</button>
                                            <button class="btn btn-secondary" name="seleccategoria" id="seleccategoria" type="button" onclick="selectcategoria()" style="display: none;">Selecionar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="campos">
                                <div class="row">
                                    <label for="subcategoria1"><b>
                                            <h6 style="font-family: arial, sans-serif; font-size: 16px;">Subcategoria</h6>
                                        </b></label>
                                    <div class="input-group">
                                        <select class="form-select" name="subcategoria1" id="subcategoria1">
                                            <option>Pensão alimentícia</option>
                                            <option>Salário</option>
                                            <option>Transferência</option>
                                        </select>
                                        <input type="hidden" name="subcategoria2" id="subcategoria2" class="form-control">
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary" type="button" id="adsub" onclick="addsubcategoria()">Adicionar</button>
                                            <button class="btn btn-secondary" type="button" id="selecsub" style="display: none;" onclick="selectsubcategoria()">Selecionar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="campos">
                                <label for="observacoes"><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Observações</h6>
                                    </b></label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="1" placeholder="Observação" name="observacoes" id="observacoes"></textarea>
                            </div>
                            <div class="campos">
                                <label for="flexCheckDefault"><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Situação</h6>
                                    </b></label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="receber" id="flexCheckDefault" name="status">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        A receber
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="recebido" id="flexCheckChecked" onclick="rece()" name="status">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Recebido
                                    </label>
                                </div>
                            </div>
                            <div id="campos3" style="margin-top: 2%; margin-bottom: 2%; display: none;">
                                <label><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Data do recebimento</h6>
                                    </b></label>
                                <input type="date" name="recebimentodata" id="recebimentodata" class="form-control" placeholder="__/__/__">
                            </div>
                            <div class="campos">
                                <label for="juros"><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Valor do juros</h6>
                                    </b></label>
                                <input type="number" name="juros" id="juros" placeholder="0,00" class="form-control">
                            </div>
                            <div class="campos">
                                <label for="multa"><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Valor da multa</h6>
                                    </b></label>
                                <input type="number" name="multa" id="multa" placeholder="0,00" class="form-control">
                            </div>
                            <div class="campos">
                                <label><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Repetir valor?</h6>
                                    </b></label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="uma" id="flexChe" name="repetir">
                                    <label class="form-check-label" for="flexChe">
                                        Desejo inserir este valor apenas um vez
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="repetir" id="flexCheck" onclick="isChecked()" name="repetir">
                                    <label class="form-check-label" for="flexCheck">
                                        Desejo repetir este valor
                                    </label>
                                </div>
                            </div>
                            <div id="campos2" style="margin-top: 2%; margin-bottom: 2%; display: none;">
                                <label for="parcelas"><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Nº de parcelas:</h6>
                                    </b></label>
                                <input type="number" name="parcelas" id="parcelas" class="form-control" placeholder="3">
                            </div>
                        </div>
                    </div>
                    <div class="bloco5">
                        <label for="anexo"><b>
                                <h6 style="font-family: arial, sans-serif; font-size: 16px;">Anexo</h6>
                            </b></label>
                        <input type="file" name="anexo" id="anexo" class="form-control">
                    </div>
                    <input type="hidden" name="datacriacao" value="<?php echo date('d/m/Y') ?>">
                    <div class="final">
                        <div class="row">
                            <div class="col-8">

                            </div>
                            <div class="col-2">
                                <div>
                                    <a href="receitas.php"><button type="button" class="btn btn-outline-secondary" id="voltar2">Cancelar</button></a>
                                </div>
                            </div>
                            <div class="col-2">
                                <div id="voltar">
                                    <a href="receitas_insert.php"><button type="submit" class="btn btn-success" name="salvar" id='salvar'>Salvar</button></a>
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
                        <a href="#" class="active">
                            <span class="icon"><i class="fas fa-dollar-sign"></i></span>
                            <span class="item">Financeiro</span>
                            <svg xmlns="http://www.w3.org/2000/svg" style="margin-left: 27%;" width="16" height="13" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                            </svg>
                        </a>
                    </li>
                    <div class="dropdown-content">
                        <li>
                            <a href="../Despesas/despesas.php" class="links" style="width: 100%;">
                                <span class="item2" style="margin-left: 15%;">Despesas</span>
                            </a>
                        </li>
                        <li>
                            <a href="receitas.php" class="active">
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
    <script>
        function clientadd() {
            document.getElementById('client1').style.display = "none";
            document.getElementById('client2').type = "text";
            document.getElementById('textcli').style.display = "none";
            document.getElementById('selectcli').style.display = "block";
        }

        function clientselect() {
            document.getElementById('client1').style.display = "block";
            document.getElementById('client2').type = "hidden";
            document.getElementById('textcli').style.display = "block";
            document.getElementById('selectcli').style.display = "none";
        }

        function addcategoria() {
            document.getElementById('categoria1').style.display = "none";
            document.getElementById('categoria2').type = "text";
            document.getElementById('adcategoria').style.display = "none";
            document.getElementById('seleccategoria').style.display = "block";
        }

        function selectcategoria() {
            document.getElementById('categoria1').style.display = "block";
            document.getElementById('categoria2').type = "hidden";
            document.getElementById('adcategoria').style.display = "block";
            document.getElementById('seleccategoria').style.display = "none";
        }

        function addsubcategoria() {
            document.getElementById('subcategoria1').style.display = "none";
            document.getElementById('subcategoria2').type = "text";
            document.getElementById('adsub').style.display = "none";
            document.getElementById('selecsub').style.display = "block";
        }

        function selectsubcategoria() {
            document.getElementById('subcategoria1').style.display = "block";
            document.getElementById('subcategoria2').type = "hidden";
            document.getElementById('adsub').style.display = "block";
            document.getElementById('selecsub').style.display = "none";
        }

        function rece() {
            if (document.getElementById('flexCheckChecked').checked) {
                document.getElementById('campos3').style.display = "block";
            } else {
                document.getElementById('campos3').style.display = "none";
            }
        }

        function isChecked() {
            if (document.getElementById("flexCheck").checked) {
                document.getElementById("campos2").style.display = "block";
            } else {
                document.getElementById("campos2").style.display = "none";
            }
        }
    </script>
</body>

</html>