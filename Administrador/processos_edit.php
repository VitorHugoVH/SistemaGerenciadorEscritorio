<?php
if (!empty($_GET['id'])) {
    include_once('conexao_adm.php');

    $id = $_GET['id'];

    $sqlSelect = "SELECT * FROM processo WHERE id=$id";

    $result = $conn->query($sqlSelect);

    if ($result->num_rows > 0) {

        while ($user_data = mysqli_fetch_assoc($result)) {

            $privado = $user_data['privado'];
            $status = $user_data['stat'];
            $fase = $user_data['fase'];
            $classe = $user_data['classe'];
            $natureza = $user_data['natureza'];
            $dataa = $user_data['dataa'];
            $valor = $user_data['valor'];
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
                <form action="processos_save.php" method="POST">
                    <div class="row">
                        <div class="col-10">
                            <div class="bloco3">
                                <h3 class="text-muted">Editar</h3>
                            </div>
                        </div>
                        <div class="col-2">
                            <div id="voltar">
                                <a href="processos.php"><button type="button" class="btn btn-secondary" id='voltar1'>Volar</button></a>
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
                                    <input class="form-check-input" type="checkbox" value="1" <?= ($privado == '(O cliente não poderá visualizar)') ? 'checked' : '' ?> id="flexCheckDefault" name="naovisualizar">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        (O cliente não poderá visualizar)
                                    </label>
                                </div>
                            </div>
                            <div class="campos">
                                <label class="form-label">Status do Processo</label>
                                <select class="form-select" aria-label="Default select example" name="statusprocesso">
                                    <option value="1" <?= ($status == 'Ativo') ? 'selected' : '' ?>>Ativo</option>
                                    <option value="2" <?= ($status == 'Suspenso') ? 'selected' : '' ?>>Suspenso</option>
                                    <option value="3" <?= ($status == 'Baixado') ? 'selected' : '' ?>>Baixado</option>
                                </select>
                            </div>
                            <div class="campos">
                                <label class="form-label">Fase</label>
                                <select class="form-select" aria-label="Default select example" name="faseprocesso">
                                    <option value="1" <?= ($fase == 'Sem fase') ? 'selected' : '' ?>>Sem fase</option>
                                    <option value="2" <?= ($fase == 'Execução') ? 'selected' : '' ?>>Execução</option>
                                    <option value="3" <?= ($fase == 'Inicial') ? 'selected' : '' ?>>Inicial</option>
                                    <option value="4" <?= ($fase == 'Recursal') ? 'selected' : '' ?>>Recursal</option>
                                </select>
                            </div>
                            <div class="campos">
                                <div class="row">
                                    <label for="client1"><b>
                                            <h6 style="font-family: arial, sans-serif; font-size: 16px;">Classe processual</h6>
                                        </b></label>
                                    <div class="input-group">
                                        <select class="form-select" aria-label="Default select example" name="classeprocesso" id="classeprocesso" onchange="nfalecido()">
                                            <option <?= ($classe == 'Ação de cobrança') ? 'selected' : ' ' ?>>Ação de cobrança</option>
                                            <option <?= ($classe == 'Ação de despejo') ? 'selected' : ' ' ?>>Ação de despejo</option>
                                            <option <?= ($classe == 'Ação de indenização') ? 'selected' : ' ' ?>>Ação de indenização</option>
                                            <option <?= ($classe == 'Divórcio') ? 'selected' : ' ' ?>>Divórcio</option>
                                            <option <?= ($classe == 'Execução de alimentos') ? 'selected' : ' ' ?>>Execução de alimentos</option>
                                            <option <?= ($classe == 'Impugnação do valor da causa') ? 'selected' : ' ' ?>>Impugnação do valor da causa</option>
                                            <option <?= ($classe == 'Processo de inventário') ? 'selected' : ' ' ?>>Processo de inventário</option>
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
                                <label class="form-label">Natureza da ação</label>
                                <select class="form-select" aria-label="Default select example" name="naturezaprocesso">
                                    <option value="1" <?= ($natureza == 'Cívil') ? 'selected' : '' ?>>Cívil</option>
                                    <option value="2" <?= ($natureza == 'Criminal') ? 'selected' : '' ?>>Criminal</option>
                                    <option value="3" <?= ($natureza == 'Família') ? 'selected' : '' ?>>Família</option>
                                    <option value="4" <?= ($natureza == 'Trabalhista') ? 'selected' : '' ?>>Trabalhista</option>
                                    <option value="5" <?= ($natureza == 'Não definido') ? 'selected' : '' ?>>Não definido</option>
                                </select>
                            </div>
                            <div class="campos">
                                <label class="form-label">Data da abertura</label>
                                <input type="date" name="dateabertura" id="dateabertura" class="form-control" value="<?php echo $dataa ?>">
                            </div>
                            <div class="campos">
                                <label class="form-label">Valor da causa</label>
                                <input type="number" name="valorcausa" id="valorcausa" step="0.01" min="0.01" class="form-control" placeholder="0.00" value="<?php echo $valor ?>">
                            </div>
                            <div class="campos">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Observações</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Observações" name="observacoes"><?php echo $ob ?></textarea>
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
                                    <option value="1" <?= ($posicao == 'Adverso') ? 'selected' : '' ?>>Adverso</option>
                                    <option value="2" <?= ($posicao == 'Advogado') ? 'selected' : '' ?>>Advogado</option>
                                    <option value="3" <?= ($posicao == 'Advogado Adverso') ? 'selected' : '' ?>>Advogado Adverso</option>
                                    <option value="4" <?= ($posicao == 'Autor') ? 'selected' : '' ?>>Autor</option>
                                    <option value="5" <?= ($posicao == 'Reclamada') ? 'selected' : '' ?>>Reclamada</option>
                                    <option value="6" <?= ($posicao == 'Reclamante') ? 'selected' : '' ?>>Reclamante</option>
                                    <option value="7" <?= ($posicao == 'Relator') ? 'selected' : '' ?>>Relator</option>
                                    <option value="8" <?= ($posicao == 'Requerente') ? 'selected' : '' ?>>Requerente</option>
                                    <option value="9" <?= ($posicao == 'Requerido') ? 'selected' : '' ?>>Requerido</option>
                                    <option value="10" <?= ($posicao == 'Réu') ? 'selected' : '' ?>>Réu</option>
                                    <option value="11" <?= ($posicao == 'Testemunha') ? 'selected' : '' ?>>Testemunha</option>
                                </select>
                            </div>
                            <div class="campos">
                                <label class="form-label">Cliente</label>
                                <select name="nomecliente" id="nomecliente" class="form-select">
                                    <option value="Não declarado" <?= ($nomecliente == 'Não declarado') ? 'selected' : ' ' ?>>Selecione</option>
                                    <?php
                                    include_once('conexao_adm.php');

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
                                            <option <?= ($nomeadvogado == 'Não consta') ? 'selected' : ''; ?>>Não consta</option>
                                            <?php
                                            include_once('conexao_adm.php');

                                            $sqlAdvogado = "SELECT nome FROM usuario";
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
                                    <a href="processos.php"><button type="button" class="btn btn-outline-secondary" id="voltar2">Cancelar</button></a>
                                </div>
                            </div>
                            <div class="col-2">
                                <div id="voltar">
                                    <a href="processos.php"><button type="submit" class="btn btn-success" name="update" id='update'>Atualizar</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <input type="hidden" name="mes" value="<?php echo date('F/Y') ?>">
                </form>
            </div>
        </div>
        <div class="sidebar">
            <div class="profile">
                <img src="imagensADM/logoadmin.png" alt="profile_picture" width="35%">
                <h3>Advocacia</h3>
                <p>Fraga e Melo Advogados</p>
            </div>
            <ul class="lista">
                <li>
                    <a href="admin.php" class="links">
                        <span class="icon"><i class="fas fa-desktop"></i></span>
                        <span class="item">Deashboard</span>
                    </a>
                </li>
                <li>
                    <a class="active">
                        <span class="icon"><i class="fas fa-scale-balanced"></i></span>
                        <span class="item">Processos</span>
                    </a>
                </li>
                <li>
                    <a href="agenda.php" class="links">
                        <span class="icon"><i class="fas fa-calendar-days"></i></span>
                        <span class="item">Agenda</span>
                    </a>
                </li>
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
                            <svg xmlns="http://www.w3.org/2000/svg" style="margin-left: 30%;" width="16" height="13" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
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
                            <a href="#" class="links">
                                <span class="item2" style="margin-left: 15%; width: 100%;">Receitas</span>
                            </a>
                        </li>
                    </div>
                </div>
                <div class="dropdown">
                    <li>
                        <a class="links">
                            <span class="icon"><i class="fas fa-dollar-sign"></i></span>
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
                <li>
                    <a href="estatisticas.php" class="links">
                        <span class="icon"><i class="fas fa-cloud"></i></span>
                        <span class="item">Arquivos</span>
                    </a>
                </li>
                <li>
                    <a href="configuracoes.php" class="links">
                        <span class="icon"><i class="fas fa-edit"></i></span>
                        <span class="item">Editor de Texto</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</body>

</html>