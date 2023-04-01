<?php

// VERIFICAÇÃO LOGIN
session_start();
$logged = $_SESSION['logged'] ?? NULL;

if (!$logged) {
    header('Location: /FragaeMelo/Site%20Fraga%20e%20Melo%20BootsTrap/login.php');
};


if (isset($_POST['enviar'])) {
    include_once('conexao_adm.php');

    $privado = $_POST['naovisualizar'];
    $status = $_POST['statusprocesso'];
    $fase = $_POST['faseprocesso'];
    $classe = $_POST['classeprocesso'];
    $natureza = $_POST['naturezaprocesso'];
    $dataa = $_POST['dateabertura'];
    $valor = $_POST['valorcausa'];
    $ob = $_POST['observacoes'];
    $posicao = $_POST['posicaocliente'];
    $nomecliente = $_POST['nomecliente'];
    $nomeadvogado = $_POST['advogadoatuando'];
    $nomefalecido = $_POST['nomefalecido'];
    $mes = $_POST['mes'];

    switch ($privado) {
        case 1:
            $privado = '(O cliente não poderá visualizar)';
            break;
        case 0:
            $privado = '(O cliente poderá visualizar)';
    }

    switch ($status) {
        case 1:
            $status = 'Ativo';
            break;
        case 2:
            $status = 'Suspenso';
            break;
        case 3:
            $status = 'Baixado';
    }

    switch ($fase) {
        case 1:
            $fase = 'Sem Fase';
            break;
        case 2:
            $fase = 'Execução';
            break;
        case 3:
            $fase = 'Inicial';
            break;
        case 4:
            $fase = 'Recursal';
    }

    switch ($posicao) {
        case 1:
            $posicao = 'Adverso';
            break;
        case 2:
            $posicao = 'Advogado';
            break;
        case 3:
            $posicao = 'Advogado Adverso';
            break;
        case 4:
            $posicao = 'Autor';
            break;
        case 5:
            $posicao = 'Reclamada';
            break;
        case 6:
            $posicao = 'Reclamante';
            break;
        case 7:
            $posicao = 'Relator';
            break;
        case 8:
            $posicao = 'Requerente';
            break;
        case 9:
            $posicao = 'Requerido';
            break;
        case 10:
            $posicao = 'Réu';
            break;
        case 11:
            $posicao = 'Testemunha';
    }

    if (!empty($outraclasse)) {
        $classeprocesso = $outraclasse;
    } else {
        $classeprocesso = $classeprocesso;
    }

    switch ($natureza) {
        case 1:
            $natureza = 'Cívil';
            break;
        case 2:
            $natureza = 'Criminal';
            break;
        case 3:
            $natureza = 'Família';
            break;
        case 4:
            $natureza = 'Trabalhista';
            break;
        case 5:
            $natureza = 'Não definido';
    }

    $result = mysqli_query($conn, "INSERT INTO processo (valor, stat, privado, posicaocliente, observacoes, nomecliente, nomeadvogado, natureza, fase, dataa, classe, falecido ,mes)
        VALUES ('$valor', '$status', '$privado', '$posicao', '$ob', '$nomecliente', '$nomeadvogado', '$natureza', '$fase', '$dataa', '$classe', '$nomefalecido', '$mes')");

    header('Location: processos.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="estilosAdm.css"/>
  <link rel="icon" type="image/x-icon" href="imagens/icon.png"/>
  <link rel="stylesheet" type="text/css" href="fontawesome/css/all.css"/>
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
      <a href="/Users/vh007/OneDrive/%C3%81rea%20de%20Trabalho/Tudo/Site%20TCC/Site%20Fraga%20e%20Melo%20BootsTrap/index.php"
         class="link">
        <button class="button button4">Voltar</button>
      </a>
    </div>
    <div class="container" id='main'>
      <form action="" method="POST">
        <div class="row">
          <div class="col-10">
            <div class="bloco3">
              <h3 class="text-muted">Adicionar</h3>
            </div>
          </div>
          <div class="col-2">
            <div id="voltar">
              <a href="processos.php">
                <button type="button" class="btn btn-secondary" id='voltar1'>Volar</button>
              </a>
            </div>
          </div>
        </div>
        <div class="bloco4">
          <div class="row">
            <div class="titulo">
              <h4 class="title"><b>Dados do Processo</b></h4>
            </div>
            <div class="campos">
              <label class="form-label">Privado</label>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="naovisualizar">
                <label class="form-check-label" for="flexCheckDefault">
                  (O cliente não poderá visualizar)
                </label>
              </div>
            </div>
            <div class="campos">
              <label class="form-label">Status do Processo</label>
              <select class="form-select" aria-label="Default select example" name="statusprocesso">
                <option selected value="1">Ativo</option>
                <option value="2">Suspenso</option>
                <option value="3">Baixado</option>
              </select>
            </div>
            <div class="campos">
              <label class="form-label">Fase</label>
              <select class="form-select" aria-label="Default select example" name="faseprocesso">
                <option selected value="1">Sem fase</option>
                <option value="2">Execução</option>
                <option value="3">Inicial</option>
                <option value="4">Recursal</option>
              </select>
            </div>
            <div class="campos">
              <div class="row">
                <label for="client1"><b>
                    <h6 style="font-family: arial, sans-serif; font-size: 16px;">Classe processual</h6>
                  </b></label>
                <div class="input-group">
                  <select class="form-select" aria-label="Default select example" name="classeprocesso"
                          id="classeprocesso" onchange="nfalecido()">
                    <option>Ação de cobrança</option>
                    <option>Ação de despejo</option>
                    <option>Ação de indenização</option>
                    <option>Divórcio</option>
                    <option>Execução de alimentos</option>
                    <option>Impugnação do valor da causa</option>
                    <option>Processo de inventário</option>
                  </select>
                  <input type="hidden" name="outraclasse" id="outraclasse" class="form-control"
                         placeholder="Nome da classe">
                  <div class="input-group-append">
                    <button class="btn btn-secondary" name="textclass" id="textclass" type="button"
                            onclick="classeadd()">Adicionar
                    </button>
                    <button class="btn btn-secondary" name="selectclass" id="selectclass" type="button"
                            onclick="classeselect()" style="display: none;">Selecionar
                    </button>
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
                     placeholder="Nome do falecido">
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
              <select class="form-select" aria-label="Default select example" name="naturezaprocesso">
                <option selected value="1">Cívil</option>
                <option value="2">Criminal</option>
                <option value="3">Família</option>
                <option value="4">Trabalhista</option>
                <option value="5">Não definido</option>
              </select>
            </div>
            <div class="campos">
              <label class="form-label">Nº Identificação processo</label>
              <input type="text" class="form-control" id="cnj" placeholder="0000.00.000000-0"
                     oninput="this.value = mascaraCNJ(this.value)" maxlength="16" minlength="16" required>
              <script>
                  // seleciona o input com id "cnj"
                  const cnjInput = document.querySelector("#cnj");

                  // adiciona o event listener para "input"
                  cnjInput.addEventListener("input", function () {
                      // obtém o valor atual do input
                      let value = this.value;
                      // remove todos os caracteres que não são números ou letras
                      value = value.replace(/[^\w]/gi, "");
                      // adiciona os pontos e o hífen na posição correta
                      if (value.length > 4) {
                          value = value.substr(0, 4) + "." + value.substr(4);
                      }
                      if (value.length > 7) {
                          value = value.substr(0, 7) + "." + value.substr(7);
                      }
                      if (value.length > 13) {
                          value = value.substr(0, 13) + "-" + value.substr(13);
                      }
                      // atualiza o valor do input com a máscara aplicada
                      this.value = value;
                  });
              </script>
            </div>
            <div class="campos">
              <label class="form-label">Nº da Vara</label>
              <input type="text" maxlength="7" class="form-control" name="numerovara" id="numerovara"
                     placeholder="0000000ª" onkeyup="formatarVara(this)">
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
            <div class="campos">
              <label class="form-label">Data da abertura</label>
              <input type="date" name="dateabertura" id="dateabertura" class="form-control">
            </div>
            <div class="campos">
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Observações</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Observações"
                          name="observacoes"></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="bloco5">
          <div class="row">
            <div class="titulo">
              <h4 class="title"><b>Honorários</b></h4>
            </div>
            <div class="campos">
              <label class="form-label">Valor da causa</label>
              <input type="text" name="valorcausa" id="valorcausa" class="form-control" value=" R$ 0,00">
            </div>
            <script>
                function formatarMoeda(valor) {
                    var formatter = new Intl.NumberFormat('pt-BR', {
                        style: 'currency',
                        currency: 'BRL',
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });

                    return formatter.format(valor).replace(/\D/g, '');
                }

                var input = document.getElementById('valorcausa');
                input.addEventListener('input', function () {
                    var valor = this.value;

                    // Remove tudo que não é dígito
                    valor = valor.replace(/\D/g, '');

                    // Converte para número e divide por 100 para obter o valor em reais
                    valor = parseFloat(valor) / 100;

                    // Formata o valor como moeda, com símbolo "R$" e duas casas decimais
                    valor = formatarMoeda(valor);

                    // Atualiza o valor do input
                    this.value = valor;

                    // Verifica se o valor mínimo foi atingido
                    var valorNumerico = parseFloat(valor.replace(/[^0-9,-]+/g, "").replace(",", "."));
                    if (valorNumerico < 100) {
                        this.setCustomValidity('O valor mínimo é R$ 100,00');
                    } else {
                        this.setCustomValidity('');
                    }

                    // Define 0 como valor padrão se o valor estiver vazio
                    if (this.value === '') {
                        this.value = 'R$ 0,00';
                    }
                });

            </script>
            <div class="campos">
              <label for="parcelas">Parcelas</label>
              <div class="input-group">
                <input type="number" name="parcelas" id="parcelas" class="form-control" placeholder="3" />
                <div class="input-group-append">
                  <button type="button" id="calcularParcelas" class="btn btn-primary">Calcular parcelas</button>
                </div>
              </div>
              <table id="tabelaParcelas" class="table" style="margin-top: 2%;">
                <thead>
                <tr>
                  <th>Mês da parcela</th>
                  <th>Valor da parcela</th>
                  <th>Vencimento</th>
                </tr>
                </thead>
                <tbody></tbody>
              </table>
              <script>
                  var inputValor = document.getElementById('valorcausa');
                  var inputParcelas = document.getElementById('parcelas');
                  var btnCalcular = document.getElementById('calcularParcelas');
                  var tabelaParcelas = document.getElementById('tabelaParcelas');

                  btnCalcular.addEventListener('click', function() {
                      // Pega o valor da causa e a quantidade de parcelas
                      var valor = parseFloat(inputValor.value.replace(/[^\d]+/g, ''));
                      var valor = (inputValor.value.replace(',', '.'));
                      var nparcelas = parseInt(inputParcelas.value);

                      // Calcula o valor de cada parcela
                      var valorParcela = valor / nparcelas;

                      // Adiciona as linhas na tabela de parcelas
                      var tbody = tabelaParcelas.getElementsByTagName('tbody')[0];
                      tbody.innerHTML = '';
                      var dataVencimento = new Date();
                      var diaVencimento = dataVencimento.getDate();
                      for (var i = 0; i < nparcelas; i++) {
                          // Soma um mês na data de vencimento para cada parcela
                          dataVencimento.setMonth(dataVencimento.getMonth() + 1);

                          // Formata o mês por extenso
                          var mesParcela = dataVencimento.toLocaleString('pt-BR', { month: 'long' });

                          // Adiciona uma linha na tabela com as informações da parcela
                          var tr = document.createElement('tr');
                          tr.innerHTML = '<td>' + (i + 1) + 'ª parcela - ' + mesParcela + '/' + dataVencimento.getFullYear() + '</td>' +
                              '<td>R$ ' + valorParcela.toFixed(2) + '</td>' +
                              '<td>' + diaVencimento + '/' + (dataVencimento.getMonth() + 1) + '/' + dataVencimento.getFullYear() + '</td>';
                          tbody.appendChild(tr);
                      }
                  });
              </script>
            </div>
            <div class="campos">
              <label class="form-label">Adicionar Receita</label>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
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
              <select class="form-select" aria-label="Default select example" name="posicaocliente">
                <option selected value="1">Adverso</option>
                <option value="2">Advogado</option>
                <option value="3">Advogado Adverso</option>
                <option value="4">Autor</option>
                <option value="5">Reclamada</option>
                <option value="6">Reclamante</option>
                <option value="7">Relator</option>
                <option value="8">Requerente</option>
                <option value="9">Requerido</option>
                <option value="10">Réu</option>
                <option value="11">Testemunha</option>
              </select>
            </div>
            <div class="campos">
              <label class="form-label">Cliente</label>
              <select name="nomecliente" id="nomecliente" class="form-select">
                <option value="Não declarado">Selecione</option>
                  <?php
                  include_once('conexao_adm.php');

                  $sqlcliente = "SELECT nomecliente FROM clientes";
                  $resultcliente = $conn->query($sqlcliente);

                  while ($data_cliente = mysqli_fetch_assoc($resultcliente)) {
                      echo "<option>" . $data_cliente['nomecliente'] . "</option>";
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
                  <select name="advogadoatuando" class="form-select">
                    <option selected>Não consta</option>
                      <?php
                      include_once('conexao_adm.php');

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
            </div>
          </div>
        </div>
        <input type="hidden" name="mes" value="<?php echo date('F/Y') ?>">
        <div class="final">
          <div class="row">
            <div class="col-8">

            </div>
            <div class="col-2">
              <div id="salvar">
                <a href="processos.php">
                  <button type="button" class="btn btn-outline-secondary" id="voltar2">Cancelar</button>
                </a>
              </div>
            </div>
            <div class="col-2">
              <div id="voltar">
                <a href="processos.php">
                  <button type="submit" class="btn btn-success" name="enviar" id='salvar'>Salvar</button>
                </a>
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
            <svg xmlns="http://www.w3.org/2000/svg" style="margin-left: 40%;" width="16" height="13" fill="currentColor"
                 class="bi bi-caret-down-fill" viewBox="0 0 16 16">
              <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
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
          <a href="financeiro.php" class="links">
            <span class="icon"><i class="fas fa-dollar-sign"></i></span>
            <span class="item">Financeiro</span>
            <svg xmlns="http://www.w3.org/2000/svg" style="margin-left: 27%;" width="16" height="13" fill="currentColor"
                 class="bi bi-caret-down-fill" viewBox="0 0 16 16">
              <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
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
            <svg xmlns="http://www.w3.org/2000/svg" style="margin-left: 41%;" width="16" height="13" fill="currentColor"
                 class="bi bi-caret-down-fill" viewBox="0 0 16 16">
              <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
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
            <svg xmlns="http://www.w3.org/2000/svg" style="margin-left: 32%;" width="16" height="13" fill="currentColor"
                 class="bi bi-caret-down-fill" viewBox="0 0 16 16">
              <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
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

</html>