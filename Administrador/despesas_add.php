<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="estilosAdm.css" />
    <link rel="icon" type="image/x-icon" href="imagens/icon.png" />
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
            <div class="container" id='main'>
                <form action="despesas_insert.php" method="POST">
                    <div class="row">
                        <div class="col-10">
                            <div class="bloco3">
                                <h3 class="text-muted">Adicionar</h3>
                            </div>
                        </div>
                        <div class="col-2">
                            <div id="voltar">
                                <a href="despesas.php"><button type="button" class="btn btn-secondary" id='voltar1'>Volar</button></a>
                            </div>
                        </div>
                    </div>
                    <div class="bloco4">
                        <div class="row">
                            <div class="titulo">
                                <h4 class="title"><b>Cadastrar Despesas</b></h4>
                            </div>
                            <div class="campos">
                                <label><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Data vencimento</h6>
                                    </b></label>
                                <input type="date" name="vencimento" id="vencimento" class="form-control">
                            </div>
                            <div class="campos">
                                <label><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Valor</h6>
                                    </b></label>
                                <input type="number" name="valor" id="valor" placeholder="0,00" class="form-control" required>
                            </div>
                            <div class="campos">
                                <div class="row">
                                    <label for="categoria"><b>
                                            <h6 style="font-family: arial, sans-serif; font-size: 16px;">Categoria</h6>
                                        </b></label>
                                    <div class="col-10">
                                        <select name="categoria" id="categoria" class="form-control">
                                            <option value="Impostos">Impostos</option>
                                            <option value="Infra-estrutura">Infra-estrutura</option>
                                        </select>
                                        <input type="hidden" name="categoria2" id="alterar" class="form-control" placeholder="Adicionar outra...">
                                    </div>
                                    <div class="col-2">
                                        <button class="btn btn-secondary" name="botao" id="botao" onclick="mudar()" type="button">Adicionar</button>
                                        <button class="btn btn-secondary" name="botao2" id="botao2" style="display: none;" onclick="mudar2()" type="button">Selecionar</button>
                                    </div>
                                </div>
                            </div>
                            <div class="campos">
                                <div class="row">
                                    <label for="subcategoria3"><b>
                                            <h6 style="font-family: arial, sans-serif; font-size: 16px;">Subcategoria</h6>
                                        </b></label>
                                    <div class="col-10">
                                        <select name="subcategoria3" id="subcategoria3" class="form-control">
                                            <option value="IPTU">IPTU</option>
                                            <option value="IPVA">IPVA</option>
                                        </select>
                                        <input type="hidden" name="subcategoria4" id="alterar3" class="form-control" placeholder="Adicionar outra...">
                                    </div>
                                    <div class="col-2">
                                        <button class="btn btn-secondary" name="botao3" id="botao3" onclick="Sub()" type="button">Adicionar</button>
                                        <button class="btn btn-secondary" name="botao4" id="botao4" style="display: none;" onclick="Sub2()" type="button">Selecionar</button>
                                    </div>
                                </div>
                            </div>
                            <div class="campos">
                                <label for="desctarefa"><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Observação</h6>
                                    </b></label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="1" placeholder="Observação" name="observacoes" id="observacoes"></textarea>
                            </div>
                            <div class="campos">
                                <label><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Situação</h6>
                                    </b></label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Apagar" id="pagar" name="status">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        A pagar
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Pago" id="pago" onclick="Check()" name="status">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Pago
                                    </label>
                                </div>
                            </div>
                            <div id="campos3" style="margin-top: 2%; margin-bottom: 2%; display: none;">
                                <label for="datapagamento"><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Data do pagamento</h6>
                                    </b></label>
                                <input type="date" name="datapagamento" id="datapagamento" class="form-control" placeholder="00/00/0000">
                            </div>
                            <div class="campos">
                                <label for="juros"><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Valor do juros</h6>
                                    </b></label>
                                <input type="number" name="juros" id="juros" class="form-control" placeholder="0,00">
                            </div>
                            <div class="campos">
                                <label for="total"><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Total</h6>
                                    </b></label>
                                <input type="number" name="total" id="total" class="form-control" placeholder="0,00">
                            </div>
                            <div class="campos">
                                <label><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Repetir valor?</h6>
                                    </b></label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="uma" id="flexCheckDefault" name="repetir">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Desejo inserir este valor apenas um vez
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="repetir" id="flexCheckChecked" onclick="isChecked()" name="repetir">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Desejo repetir este valor
                                    </label>
                                </div>
                            </div>
                            <div id="campos2" style="margin-top: 2%; margin-bottom: 2%; display: none;">
                                <label><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Nº de parcelas:</h6>
                                    </b></label>
                                <input type="number" name="parcelas" id="parcelas" class="form-control" placeholder="3">
                            </div>
                        </div>
                    </div>
                    <div class="bloco5">
                        <div class="row">
                            <div class="titulo">
                                <h4 class="title"><b>Anexo</b></h4>
                            </div>
                            <div class="campos">
                                <input type="file" name="anexo" id="anexo" class="form-control">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="datacriacao" value="<?php echo date('d/m/Y') ?>">
                    <div class="final">
                        <div class="row">
                            <div class="col-8">

                            </div>
                            <div class="col-2">
                                <div>
                                    <a href="despesas_add.php"><button type="button" class="btn btn-outline-secondary" id="voltar2">Cancelar</button></a>
                                </div>
                            </div>
                            <div class="col-2">
                                <div id="voltar">
                                    <a href="despesas_insert.php"><button type="submit" class="btn btn-success" name="salvar" id='salvar'>Salvar</button></a>
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
                <img src="imagensADM/logoadmin.png" alt="profile_picture" width="35%">
                <h3>Advocacia</h3>
                <p>Fraga e Melo Advogados</p>
            </div>
            <ul class="lista">
                <li>
                    <a class="links" href="admin.php">
                        <span class="icon"><i class="fas fa-desktop"></i></span>
                        <span class="item">Deashboard</span>
                    </a>
                </li>
                <li>
                    <a href="processos.php" class="links">
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
                            <a href="agenda_compromissos.php" class="links" style="width: 100%;">
                                <span class="item2" style="margin-left: 15%;">Compromissos</span>
                            </a>
                        </li>
                        <li>
                            <a href="agenda_tarefas.php" class="links">
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
                    <a href="cobrança.php" class="links">
                        <span class="icon"><i class="fas fa-rocket"></i></span>
                        <span class="item">Marketing</span>
                    </a>
                </li>
                <div class="dropdown">
                    <li>
                        <a href="financeiro.php" class="active">
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
                        <a href="equipe.php" class="links">
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
                        <a href="equipe.php" class="links">
                            <span class="icon"><i class="fas fa-file"></i></span>
                            <span class="item">Arquivos</span>
                            <svg xmlns="http://www.w3.org/2000/svg" style="margin-left: 33%;" width="16" height="13" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
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
    <script>
        function mudar() {
            document.getElementById('categoria').style.display = "none";
            document.getElementById('alterar').type = "text";
            document.getElementById('botao').style.display = "none";
            document.getElementById('botao2').style.display = "block";
        }

        function mudar2() {
            document.getElementById('categoria').style.display = "block";
            document.getElementById('alterar').type = "hidden";
            document.getElementById('botao').style.display = "block";
            document.getElementById('botao2').style.display = "none";
        }

        function Sub() {
            document.getElementById('subcategoria3').style.display = "none";
            document.getElementById('alterar3').type = "text";
            document.getElementById('botao3').style.display = "none";
            document.getElementById('botao4').style.display = "block";
        }

        function Sub2() {
            document.getElementById('subcategoria3').style.display = "block";
            document.getElementById('alterar3').type = "hidden";
            document.getElementById('botao3').style.display = "block";
            document.getElementById('botao4').style.display = "none";
        }

        function Check() {
            if (document.getElementById("pago").checked) {
                document.getElementById("campos3").style.display = "block";
            } else {
                document.getElementById("campos3").style.display = "none";
            }
        }

        function isChecked() {
            if (document.getElementById("flexCheckChecked").checked) {
                document.getElementById("campos2").style.display = "block";
            } else {
                document.getElementById("campos2").style.display = "none";
            }
        }
    </script>
</body>

</html>