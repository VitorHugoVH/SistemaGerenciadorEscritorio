<?php

// VERIFICAÇÃO LOGIN
session_start();
$logged = $_SESSION['logged'] ?? NULL;

if (!$logged) {
    header('Location: /FragaeMelo/Site%20Fraga%20e%20Melo%20BootsTrap/login.php');
};

$numerocnj = $_POST['cnjprocesso'];

if(!empty($numerocnj)){
    $anoajuizamento = substr($numerocnj, 11, 4);
    $poder = substr($numerocnj, 16, 1);

    $valor_data = $anoajuizamento . '-01-01';

    switch ($poder) {
        case 1:
            $poder = "Supremo Tribunal Federal";
            break;
        case 2:
            $poder = "Conselho Nacional de Justiça";
            break;
        case 3:
            $poder = "Superior Tribunal de Justiça";
            break;
        case 4:
            $poder = "Justiça Federal";
            break;
        case 5:
            $poder = "Justiça do Trabalho";
            break;
        case 6:
            $poder = "Justiça Eleitoral";
            break;
        case 7:
            $poder = "Justiça Militar da União";
            break;
        case 8:
            $poder = "Justiça dos Estados e do Distrito Federal e Territórios";
            break;
        case 9:
            $poder = "Justiça Militar Estadual";
    }
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
         class="link">
        <button class="button button4">Voltar</button>
      </a>
    </div>
    <div class="container" id='main'>
      <form action="processos_add3.php" method="POST">
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
              <h4 class="title"><b>Dados do Processo - Nº <?php echo $numerocnj; ?></b></h4>
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
              <select class="form-select" aria-label="Default select example" name="statusprocesso" required>
                <option selected value="1">Ativo</option>
                <option value="2">Suspenso</option>
                <option value="3">Baixado</option>
              </select>
            </div>
            <div class="campos">
              <label class="form-label">Fase</label>
              <select class="form-select" aria-label="Default select example" name="faseprocesso" required>
                <option selected value="1">Sem fase</option>
                <option value="2">Execução</option>
                <option value="3">Inicial</option>
                <option value="4">Recursal</option>
              </select>
            </div>
              <div class="campos">
                <label class="form-label">Poder Judiciário</label>
                  <select class="form-select" name="poderjudiciario" id="poderjudiciario" required>
                      <option value="1" <?= ($poder == "Supremo Tribunal Federal")?'selected':' '?>>Supremo Tribunal Federal</option>
                      <option value="2" <?= ($poder == "Conselho Nacional de Justiça")?'selected':' '?>>Conselho Nacional de Justiça</option>
                      <option value="3" <?= ($poder == "Superior Tribunal de Justiça")?'selected':' '?>>Superior Tribunal de Justiça</option>
                      <option value="4" <?= ($poder == "Justiça Federal")?'selected':' '?>>Justiça Federal</option>
                      <option value="5" <?= ($poder == "Justiça do Trabalho")?'selected':' '?>>Justiça do Trabalho</option>
                      <option value="6" <?= ($poder == "Justiça Eleitoral")?'selected':' '?>>Justiça Eleitoral</option>
                      <option value="7" <?= ($poder == "Justiça Militar da União")?'selected':' '?>>Justiça Militar da União</option>
                      <option value="8" <?= ($poder == "Justiça dos Estados e do Distrito Federal e Territórios")?'selected':' '?>>Justiça dos Estados e do Distrito Federal e Territórios</option>
                      <option value="9" <?= ($poder == "Justiça Militar Estadual")?'selected':' '?>>Justiça Militar Estadual</option>
                  </select>
              </div>
            <div class="campos">
              <div class="row">
                <label for="client1"><b>
                    <h6 style="font-family: arial, sans-serif; font-size: 16px;">Classe processual</h6>
                  </b></label>
                <div class="input-group">
                  <select class="form-select" aria-label="Default select example" name="classeprocesso"
                          id="classeprocesso" onchange="nfalecido()" required>
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
              <select class="form-select" aria-label="Default select example" name="naturezaprocesso" required>
                <option value="1">Civil</option>
                <option value="2">Criminal</option>
                <option value="3">Família</option>
                <option value="4">Trabalhista</option>
                <option value="5" selected >Não definido</option>
              </select>
            </div>
            <div class="campos">
              <label class="form-label">Nº da Vara</label>
              <input type="text" maxlength="7" class="form-control" name="numerovara" id="numerovara"
                     placeholder="0000000ª" onkeyup="formatarVara(this)" required>
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
                  <label class="form-label">Vara do Processo</label>
                  <div class="row">
                      <div class="input-group">
                          <select name="nomedavara" id="nomedavara" class="form-control" required>
                              <option>Vara Cível</option>
                              <option>Vara Criminal</option>
                              <option>Vara da Família</option>
                              <option>Vara do Trabalho</option>
                              <option>Vara da Infância e Juventude</option>
                              <option>Vara de Execução Penal</option>
                          </select>
                          <input type="hidden" name="outronomedavara" id="outronomedavara" class="form-control" placeholder="Vara processo">
                          <div class="input-group-append">
                              <button class="btn btn-secondary" name="txtnomedavara" id="txtnomedavara" type="button"
                                      onclick="adicionar()">Adicionar
                              </button>
                              <button class="btn btn-secondary" name="selnomedavara" id="selnomedavara" type="button"
                                      onclick="selecionar()" style="display: none;">Selecionar
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

                      function adicionar(){
                          camposelectvara.style.display = 'none';
                          campotextvara.type = 'text';
                          botaoadicionar.style.display = 'none';
                          botaoselecionar.style.display = 'block';
                      }

                      function selecionar(){
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
                              <h6 style="font-family: arial, sans-serif; font-size: 16px;">Nome da Comarca</h6>
                          </b></label>
                      <div class="input-group">
                          <select class="form-select" aria-label="Default select example" name="nomedacomarca"
                                  id="nomedacomarca" required>
                              <option>Porto Alegre-RS</option>
                              <option>São Paulo-SP</option>
                              <option>Rio de Janeiro-RJ</option>
                              <option>Belo Horizonte-MG</option>
                              <option>Brasília-DF</option>
                              <option>Curitiba-PR</option>
                              <option>Fortaleza-CE</option>
                              <option>Recife-PE</option>
                              <option>Salvador-BA</option>
                              <option>Belém-PA</option>
                              <option>Manaus-AM</option>
                              <option>Goiânia-GO</option>
                          </select>
                          <input type="hidden" name="outronomedacomarca" id="outronomedacomarca" class="form-control"
                                 placeholder="Ex: Florianópolis-SC">
                          <div class="input-group-append">
                              <button class="btn btn-secondary" name="textclassComarca" id="textclassComarca" type="button"
                                      onclick="classeaddComarca()">Adicionar
                              </button>
                              <button class="btn btn-secondary" name="selectclassComarca" id="selectclassComarca" type="button"
                                      onclick="classeselect()" style="display: none;">Selecionar
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
            <div class="campos">
              <label class="form-label">Data da abertura</label>
              <input type="date" name="dateabertura" id="dateabertura" class="form-control" value="<?php echo $valor_data; ?>" required>
            </div>
            <div class="campos">
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Observações</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Observações" name="observacoes" required></textarea>
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
                <input type="text" id="valorcausa" name="valorcausa" class="form-control" value="R$ 0,00" required/>
            </div>
              <script>
                  var input = document.getElementById('valorcausa');

                  input.addEventListener('input', function() {
                      var valor = this.value;

                      // Remove tudo que não é dígito
                      valor = valor.replace(/\D/g, '');

                      // Adiciona a vírgula para separar os centavos
                      valor = valor.slice(0, -2) + ',' + valor.slice(-2);

                      // Adiciona o símbolo R$
                      valor = 'R$ ' + valor;

                      // Atualiza o valor do input
                      this.value = valor;

                      // Verifica se o valor mínimo foi atingido
                      var valorNumerico = parseFloat(valor.replace(/[^0-9,-]+/g,"").replace(",", "."));
                      if (valorNumerico < 100) {
                          this.setCustomValidity('O valor mínimo é R$ 100,00');
                      } else {
                          this.setCustomValidity('');
                      }
                  });
              </script>
            <div class="campos">
              <label for="parcelas">Parcelas</label>
                <input type="number" name="parcelas" id="parcelas" class="form-control" value="1" placeholder="3" required/>
            </div>
            <div class="campos">
              <label class="form-label">Adicionar Receita</label>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="flexCheckDefault" name="cadreceita">
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
              <select class="form-select" aria-label="Default select example" name="posicaocliente" required>
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
              <select name="nomecliente" id="nomecliente" class="form-select" required>
                <option value="Não declarado">Selecione</option>
                  <?php
                  include_once('../conexao_adm.php');

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
                  <select name="advogadoatuando" class="form-select" required>
                    <option selected>Não consta</option>
                      <?php
                      include_once('../conexao_adm.php');

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
          <input type="hidden" name="numeroprocessocnj" value="<?php echo $numerocnj ?>">
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
            <svg xmlns="http://www.w3.org/2000/svg" style="margin-left: 40%;" width="16" height="13" fill="currentColor"
                 class="bi bi-caret-down-fill" viewBox="0 0 16 16">
              <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
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
            <a href="site_marketing.php" class="links">
                <span class="icon"><i class="fas fa-network-wired"></i></span>
                <span class="item">Site</span>
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
          <a href="#" class="links">
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
          <a href="#" class="links">
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