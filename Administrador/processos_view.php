<!DOCTYPE html>
<html lang="pt-BR">
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
<?php
        require_once('conexao_adm.php');
        $id = $_GET['id'];
        $sql = "SELECT * FROM processo WHERE id=$id";
        $rs = mysqli_query($conn, $sql);
        $linha = mysqli_fetch_array($rs);
?>
<?php
        include('C:\xampp\htdocs\FragaeMelo\Site Fraga e Melo BootsTrap\config.php');

        $sql2 = "SELECT * FROM usuario WHERE idusuario=$id";
        $rs2 = mysqli_query($conn, $sql2);
        $linha2 = mysqli_fetch_array($rs2);
?>
<body>
    <div class="wrapper">
       <div class="section">
    <div class="top_navbar">
      <a href="/Users/vh007/OneDrive/%C3%81rea%20de%20Trabalho/Tudo/Site%20TCC/Site%20Fraga%20e%20Melo%20BootsTrap/index.php" class="link"><button class="button button4">Voltar</button></a>
    </div>
    <div class="container" id='main'>
        <div class="row">
            <div class="col-10">
                <div class="bloco3">
                    <h3 class="text-muted">Relatório de Processos</h3>
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
                <div class="col-5">
                    <div class="bloco03">
                        <h3 class="txt">Relatório</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <p id="txti">Partes e dados processuais / Processo Nº <?php echo $id ?></p>  
            </div>
            <div class="row">
                <hr style="border-color:#aaaaaa !important;">
            </div>
            <div class="row">
                <table class="table">
                    <thead class="tabelarelatorio">
                        <div class="row">
                            <tr>
                                <th class="linhas">Natureza da Ação</th>
                                <td class="linhas"><?php echo $linha['natureza']; ?></td>
                            </tr>
                        </div>
                        <div class="row">
                            <tr>
                                <th class="linhas">Data de cadastro sistema</th>
                                <td class="linhas"><?php echo $linha['dataa']; ?></td>
                            </tr>
                        </div>
                        <div class="row">
                            <tr>
                                <th class="linhas">Classe Processual</th>
                                <td class="linhas"><?php echo  $linha['classe']; ?></td>
                            </tr>
                        </div>
                        <div class="row">
                            <tr>
                                <th class="linhas">Valor da causa</th>
                                <td class="linhas"><?php echo $linha['valor']; ?></td>
                            </tr>
                        </div>
                        <div class="row">
                            <tr>
                                <th class="linhas">Status do processo</th>
                                <td class="linhas"><?php echo $linha['stat']; ?></td>
                            </tr>
                        </div>
                        <div class="row">
                            <tr>
                                <th class="linhas">Observações</th>
                                <td class="linhas"><?php echo $linha['observacoes']; ?></td>
                            </tr>
                        </div>        
                    </thead>
                </table>
            </div>
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" style="white-space: nowrap;">
                        <tbody>
                                <tr>
                                <td></td>
                                <td>Nome</td>
                                <td>Telefone</td>
                                <td>E-mail</td>
                                </tr>
                                <tr>
                                <th>Cliente (<?php echo $linha['posicaocliente']; ?>)</th>
                                <td><?php echo $linha['nomecliente']; $nome = $linha['nomecliente']; ?></td>
                                <?php
                                    include_once('conexao_adm.php');

                                    $sqlcliente = "SELECT * FROM clientes WHERE nomecliente='$nome'";
                                    $resultcliente = $conn->query($sqlcliente);
                                    
                                    while($data_client = mysqli_fetch_assoc($resultcliente)){
                                        echo "<td>"."(".$data_client['ddd1'].")".$data_client['numero1']."</td>";
                                        echo "<td>".$data_client['email1']."</td>";
                                    }
                                ?>
                                </tr>
                                <tr>
                                <th>Advogado</th>
                                <td><?php echo $linha['nomeadvogado']; $nomeadv = $linha['nomeadvogado'];?></td>
                                <?php
                                    include_once('conexao_adm.php');

                                    if($nomeadv == 'Sandro Carvalho de Fraga'){
                                        echo "<td>(51)984026629</td>";
                                        echo "<td>sandro@fragaemeloadvogados.adv.br</td>";
                                    }else{
                                        echo "<td>(51)94156949</td>";
                                        echo "<td>elisete@fragaemeloadvogados.adv.br</td>";
                                    }
                                ?>
                                </tr>
                            </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <hr style="border-color:#aaaaaa !important;">
            </div>
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
                            <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                        </svg>
                        </a>
                    </li>
                    <div class="dropdown-content">
                        <li>
                        <a href="#" class="links" style="width: 100%;">
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
                <li>
                    <a href="equipe.php" class="links">
                        <span class="icon"><i class="fas fa-users"></i></span>
                        <span class="item">Equipe</span>
                    </a>
                </li>
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