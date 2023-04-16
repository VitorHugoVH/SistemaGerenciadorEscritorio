<?php

// VERIFICAÇÃO LOGIN
session_start();
$logged = $_SESSION['logged'] ?? NULL;

if (!$logged) {
  header('Location: /FragaeMelo/Site%20Fraga%20e%20Melo%20BootsTrap/login.php');
};

    if(!empty($_GET['id'])){
        include_once('conexao_adm.php');

        $id = $_GET['id'];

        $sqlSelect = "SELECT * FROM prazo WHERE id=$id";

        $result = $conn->query($sqlSelect);

        if($result->num_rows > 0){

            while($data_comp = mysqli_fetch_assoc($result)){
                
                $datafinal = $data_comp['datafinal'];
                $horafinal = $data_comp['horafinal'];
                $descricao = $data_comp['descricao'];
                $processo = $data_comp['processo'];
                $atendido = $data_comp['atendido'];
                $nadvogado = $data_comp['advogado'];
                
            }

        }else{
            header('Location: agenda_prazos.php');
        }
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
    <title>Fraga e Melo Advogados Associados</title>
</head>
<body>
    <div class="wrapper">
       <div class="section">
    <div class="top_navbar">
      <a href="/Users/vh007/OneDrive/%C3%81rea%20de%20Trabalho/Tudo/Site%20TCC/Site%20Fraga%20e%20Melo%20BootsTrap/index.php" class="link"><button class="button button4">Voltar</button></a>
    </div>
    <div class="container" id='main'>
        <form action="prazos_save.php" method="POST">
            <div class="row">
                <div class="col-10">
                    <div class="bloco3">
                        <h3 class="text-muted">Editar</h3>
                    </div>
                </div>
                <div class="col-2">
                    <div id="voltar">
                        <a href="agenda_prazos.php"><button type="button" class="btn btn-secondary" id='voltar1'>Volar</button></a>
                    </div>
                </div>
            </div>
            <div class="bloco4">
                <div class="row">
                    <div class="titulo">
                        <h4 class="title"><b>Dados do Prazo</b></h4>
                    </div>
                </div>
                <div class="campos">
                    <div class="row">
                        <div class="col-12">
                            <label><b><h6 style="font-family: arial, sans-serif; font-size: 16px;">Data Final</h6></b></label>
                            <input type="date" name="datafinal" id="datafinal" class="form-control" aria-label="Default" value="<?php echo $datafinal ?>" required>
                        </div>
                    </div>
                </div>
                <div class="campos">
                    <div class="row">
                        <div class="col-12">
                            <label><b><h6 style="font-family: arial, sans-serif; font-size: 16px;">Hora final</h6></b></label>
                            <input type="time" name="horafinal" id="horafinal" class="form-control" value="<?php echo $horafinal ?>" required>
                        </div>
                    </div>
                </div>
                <div class="campos">
                    <div class="row">
                        <div class="col-12">
                            <label><b><h6 style="font-family: arial, sans-serif; font-size: 16px;">Descrição</h6></b></label>
                            <textarea class="form-control" col="1" name="descprazo" id="descprazo" placeholder="Descrição"><?php echo $descricao ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="campos">
                    <div class="row">
                        <div class="col-12">
                                <label><b><h6 style="font-family: arial, sans-serif; font-size: 16px;">Processo</h6></b></label>
                                <select name="processo" class="form-select">
                                <option <?=($processo == 'Não consta')?'selected':''?>>Não consta</option>
                                    <?php
                                        include_once('conexao_adm.php');

                                        $sql = "SELECT id FROM processo";
                                        $result = $conn->query($sql);

                                        while($processoid = mysqli_fetch_assoc($result)){

                                            $idprocesso = $processoid['id']; 
                                            
                                            if ($processo == $idprocesso){
                                                echo "<option selected>$idprocesso</option>";
                                            }else {
                                                echo "<option>$idprocesso</option>";
                                            }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="campos">
                    <div class="row">
                        <div class="col-12">
                            <label><b><h6 style="font-family: arial, sans-serif; font-size: 16px;">Prazo atendido? (Dar baixa)</h6></b></label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" <?=($atendido == 'Sim')?'checked':''?>>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Sim
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" <?=($atendido == 'Não')?'checked':''?>>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Não
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="campos">
                    <div class="row">
                        <div class="col-12">
                            <label><b><h6 style="font-family: arial, sans-serif; font-size: 16px;">Advogado</h6></b></label>
                            <select name="nomeadvogado" class="form-select">
                                <option <?=($nadvogado == 'Não selecionado')?'selected':'';?>>Não selecionado</option>
                                    <?php
                                        include_once('conexao_adm.php');

                                        $sqlAdvogado = "SELECT nome FROM usuario";
                                        $resultAdvogado = $conn->query($sqlAdvogado);

                                        while($advogado = mysqli_fetch_assoc($resultAdvogado)){
                                            $nome = $advogado['nome'];
                                            
                                            if($nadvogado == $nome){
                                                echo "<option selected>$nome</option>";
                                            }else{
                                                echo "<option>$nome</option>";
                                            }
                                        }
                                    ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="final">
                <div class="row">
                    <div class="col-8">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        </div>
                        <div class="col-2">
                            <div id="salvar">
                                <a href="agenda_prazos.php"><button type="button" class="btn btn-outline-secondary" id="voltar2">Cancelar</button></a>
                            </div>
                        </div>
                        <div class="col-2">
                            <div id="voltar">
                                <a href="prazos_save.php"><button type="submit" class="btn btn-success" name="up" id='up'>Atualizar</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
                    <a href= "processos.php" class="links">
                        <span class="icon"><i class="fas fa-scale-balanced"></i></span>
                        <span class="item">Processos</span>
                    </a>
                </li>
                <li>
                    <a href="agenda.php" class="active">
                        <span class="icon"><i class="fas fa-calendar-days"></i></span>
                        <span class="item">Agenda</span>
                    </a>
                </li>
                <li>
                    <a href="site_marketing.php" class="links">
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
</body>
</html>