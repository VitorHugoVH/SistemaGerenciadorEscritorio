<?php
include_once('../../conexao_adm.php');

// VERIFICAÇÃO LOGIN
session_start();
$logged = $_SESSION['logged'] ?? NULL;

if (!$logged) {
    header('Location: /FragaeMelo/Site%20Fraga%20e%20Melo%20BootsTrap/login.php');
};

$id = $_POST['nprocesso'];

if (!empty($_POST['nprocesso'])) {

    //DADOS TABELA PROCESSO

    $sqlProcesso = "SELECT * FROM processo WHERE id=$id";
    $resultProcesso = $conn->query($sqlProcesso);

    while ($data_pro = mysqli_fetch_assoc($resultProcesso)) {

        $nomecliente = $data_pro['nomecliente'];
        $nomeadvogado = $data_pro['nomeadvogado'];
        $classeprocesso = $data_pro['classe'];
        $nomefalecido = $data_pro['falecido'];
        $nprocesso = $data_pro['nprocesso'];
        $numerovara = $data_pro['numerovara'];
        $parcelas = $data_pro['parcelas'];
        $valorcausa = $data_pro['valor'];
    }

    //DADOS TABELA CLIENTE

    $sqlCliente = "SELECT * FROM clientes WHERE nomecliente LIKE '%$nomecliente%'";
    $resultCliente = $conn->query($sqlCliente);

    while ($data_cli = mysqli_fetch_assoc($resultCliente)) {

        $cpf = $data_cli['cpf'];
        $sexo = $data_cli['sexo'];
        $rg = $data_cli['rg'];
        $estadocivil = $data_cli['estadocivil'];
        $profissao = $data_cli['profissao'];
        $nacionalidade = $data_cli['nacionalidade'];
        $rua = $data_cli['endereco1'];
        $numerocasa = $data_cli['numerocasa1'];
        $bairro = $data_cli['bairro1'];
        $cidade = $data_cli['cidade1'];
        $estado = $data_cli['estado1'];
        $endereco = $rua . ", " . $numerocasa . " - " . $bairro . ", " . $cidade . "/" . $estado;
    }

    //DADOS TABELA USUARIO

    $sqlAdvogado = "SELECT * FROM usuario WHERE nome LIKE '%$nomeadvogado%'";
    $resultAdvogado = $conn->query($sqlAdvogado);

    while ($data_adv = mysqli_fetch_assoc($resultAdvogado)) {

        $oab = $data_adv['oab'];
        $estadooab = $data_adv['estadooab'];
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../../estilosAdm.css" />
  <link rel="icon" type="image/x-icon" href="imagens/icon.png" />
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
      <form action="contratos_view.php" method="POST">
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
              <h4 class="title"><b>Confirmar dados contrato</b></h4>
            </div>
            <div class="campos">
              <label for="nomecliente"><b>
                  <h6 style="font-family: arial, sans-serif; font-size: 16px;">Contratante</h6>
                </b></label>
              <select class="form-select" name="nomecliente" id="nomecliente">
                  <?php
                  include_once('../../conexao_adm.php');

                  $sqlcliente = "SELECT nomecliente FROM clientes";
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
            <div class="campos">
              <label for="nomeadvogado"><b>
                  <h6 style="font-family: arial, sans-serif; font-size: 16px;">Contratado</h6>
                </b></label>
              <select class="form-select" name="nomeadvogado" id="nomeadvogado">
                  <?php
                  include_once('../../conexao_adm.php');

                  $sqlUsuario = "SELECT * FROM usuario";
                  $resultUsuario = $conn->query($sqlUsuario);

                  while ($data_user = mysqli_fetch_assoc($resultUsuario)) {
                      $nomeadv = $data_user['nome'];

                      if ($nomeadv == $nomeadvogado) {
                          echo "<option selected>" . $nomeadv . "</option>";
                      } else {
                          echo "<option>" . $nomeadv . "</option>";
                      }
                  }
                  ?>
              </select>
            </div>
            <div class="campos">
              <div class="row">
                <label for="client1"><b>
                    <h6 style="font-family: arial, sans-serif; font-size: 16px;">Classe processual</h6>
                  </b></label>
                <div class="input-group">
                  <select class="form-select" aria-label="Default select example" name="classeprocesso" id="classeprocesso" onchange="nfalecido()">
                    <option <?= ($classeprocesso == 'Ação de cobrança') ? 'selected' : ' ' ?>>Ação de cobrança</option>
                    <option <?= ($classeprocesso == 'Ação de despejo') ? 'selected' : ' ' ?>>Ação de despejo</option>
                    <option <?= ($classeprocesso == 'Ação de indenização') ? 'selected' : ' ' ?>>Ação de indenização</option>
                    <option <?= ($classeprocesso == 'Divórcio') ? 'selected' : ' ' ?>>Divórcio</option>
                    <option <?= ($classeprocesso == 'Execução de alimentos') ? 'selected' : ' ' ?>>Execução de alimentos</option>
                    <option <?= ($classeprocesso == 'Impugnação do valor da causa') ? 'selected' : ' ' ?>>Impugnação do valor da causa</option>
                    <option <?= ($classeprocesso == 'Processo de inventário') ? 'selected' : ' ' ?>>Processo de inventário</option>
                  </select>
                  <input type="hidden" name="outraclasse" id="outraclasse" class="form-control" placeholder="Nome da classe">
                  <div class="input-group-append">
                    <button class="btn btn-secondary" name="textclass" id="textclass" type="button" onclick="classeadd()">Adicionar</button>
                    <button class="btn btn-secondary" name="selectclass" id="selectclass" type="button" onclick="classeselect()" style="display: none;">Selecionar</button>
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
            <div class="campos">
              <label for="nomeadvogado"><b>
                  <h6 style="font-family: arial, sans-serif; font-size: 16px;">Nº Identificação processo</h6>
                </b></label>
              <input type="text" class="form-control" id="cnj" placeholder="0000.00.000000-0" oninput="this.value = mascaraCNJ(this.value)" maxlength="16" minlength="16" value="<?php echo $nprocesso ?>" required>
              <script>
                  // seleciona o input com id "cnj"
                  const cnjInput = document.querySelector("#cnj");

                  // adiciona o event listener para "input"
                  cnjInput.addEventListener("input", function() {
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
              <label for="nomeadvogado"><b>
                  <h6 style="font-family: arial, sans-serif; font-size: 16px;">Nº da Vara</h6>
                </b></label>
                <input type="text" maxlength="7" class="form-control" name="numerovara" id="numerovara" placeholder="0000000ª" onkeyup="formatarVara(this)" value="<?php echo $numerovara ?>">
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
              <label for="nomeadvogado"><b>
                  <h6 style="font-family: arial, sans-serif; font-size: 16px;">Órgão Judicial</h6>
                </b></label>
                <input type="text" class="form-control" name="orgaojudicial" id="orgaojudicial" placeholder="Ex: Tribunal de Justiça do Estado de São Paulo">
            </div>
            <!---Javascript Falecido--->
            <div id="falecidoarea" style="  margin-top: 1%; margin-bottom: 2%; display: none;">
              <label class="form-label">Nome do falecido</label>
              <input type="text" name="nomefalecido" id="nomefalecido" class="form-control" placeholder="Nome do falecido" value="<?php echo $nomefalecido ?>">
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
                  <label class="form-label">Valor da causa</label>
                  <input type="text" id="valorcausa" name="valorcausa" class="form-control" value="<?php echo $valorcausa; ?>" />
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
                  <label for="nomeadvogado"><b>
                          <h6 style="font-family: arial, sans-serif; font-size: 16px;">Parcelas</h6>
                      </b></label>
                  <input type="number" name="parcelas" id="parcelas" class="form-control" placeholder="3" value="<?php echo $parcelas ?>"/>
              </div>
          </div>
        </div>
        <input type="hidden" name="datacriacao" value="<?php echo date('d/m/Y') ?>">
        <input type="hidden" name="sexo" value="<?php echo $sexo ?>">
        <div class="final">
          <div class="row">
            <div class="col-8">

            </div>
            <div class="col-2">
              <div id="voltar">
                <a href="contratos.php"><button type="button" class="btn btn-secondary" id='salvar'>Voltar</button></a>
              </div>
            </div>
            <div class="col-2">
              <div id="voltar">
                <a href="#"><button type="submit" class="btn btn-success" name="enviar" id='salvar'>Próximo</button></a>
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
    function add() {
        document.getElementById('classeprocesso').style.display = 'none';
        document.getElementById('outraclasse').type = 'text';
        document.getElementById('adicionar').type = 'hidden';
        document.getElementById('selecionar').type = 'button';
    }
</script>

</html>