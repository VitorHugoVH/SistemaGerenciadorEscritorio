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
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <title>Fraga e Melo Advogados Associados</title>
</head>
<body>
    <div class="wrapper">
       <div class="section">
    <div class="top_navbar">
      <a href="/Users/vh007/OneDrive/%C3%81rea%20de%20Trabalho/Tudo/Site%20TCC/Site%20Fraga%20e%20Melo%20BootsTrap/index.php" class="link"><button class="button button4">Voltar</button></a>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-10">
                <div class="bloco3">
                    <h3 class="text-muted">Despesas</h3>
                    <?php
                        include_once('conexao_adm.php');

                        $sqlqT = "SELECT * FROM despesa";
                        $resultqT = $conn->query($sqlqT);

                        $quantidade = 0;
                        while($qt = mysqli_fetch_assoc($resultqT)){
                            $quantidade += 1;
                        }
                    ?>
                    <small class="text-muted">Exibindo <?php echo $quantidade; ?> resultado(s)</small>
                </div>
            </div>
            <div class="col-2">
                <div id="enviar">
                    <a href="despesas_add.php"><button type="button" class="btn btn-success" id='add1'>Adicionar</button></a>
                </div>
            </div>
        </div>
        <div class="bloco">
            <form action="" method="GET">
                <div class="row">
                    <div class="col-3">
                        <p><small>Mês</small></p>
                        <select class="form-select" aria-label="Default select example" name="mess" id="mess">
                            <option>Todos</option>
                            <?php
                                include_once('conexao_adm.php');

                                $sqlMes = "SELECT * FROM despesa";
                                $resultMes = $conn->query($sqlMes);

                                while($data_mes = mysqli_fetch_assoc($resultMes)){
                                    echo "<option>". $data_mes['datacriacao'] ."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-3">
                        <p><small>Categoria</small></p>
                        <select class="form-select" aria-label="Default select example" name="categoriaa" id="categoriaa">
                            <option>Todas</option>
                            <?php
                                include_once('conexao_adm.php');

                                $sqlCategorias = "SELECT * FROM despesa";
                                $resultCategorias = $conn->query($sqlCategorias);

                                while($data_categ = mysqli_fetch_assoc($resultCategorias)){
                                        if($data_categ['categoria'] != ' '){
                                            echo "<option>". $data_categ['categoria']."</option>";
                                        }else {
                                            echo "<option>". $data_categ['categoria2']."</option>";
                                        }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-4">
                        <p><small>Situação</small></p>
                        <select class="form-select" aria-label="Default select example" name="statuss" id="statuss">
                            <option><p style="font-size:medium;">Todas</p></option>
                            <option><p style="font-size:medium;">Somente realizadas</p></option>
                            <option><p style="font-size:medium;">Somente em aberto</p></option>
                        </select>
                    </div>
                    <div class="col-2">
                        <p><small>Buscar</small></p>
                        <div class="input-group mb-3">
                            <button class="btn btn-outline-secondary" name="buscar" type="submit" style=" width: 100%;">Localizar</button>
                        </div>
                    </div>
                    <?php
                        include_once('conexao_adm.php');
                        $sql = "SELECT * FROM despesa ORDER BY id ASC";

                        if(!empty($_GET['mess'])){
                            $mes = $_GET['mess'];
                                if($mes != "Todos"){
                                    $sql = "SELECT * FROM despesa WHERE datacriacao=$mes ORDER BY id ASC";
                                }
                        }
                        
                        if(!empty($_GET['categoriaa'])){
                            $categoria = $_GET['categoriaa'];
                                if($categoria != "Todas"){
                                    $sql = "SELECT * FROM despesa WHERE categoria, categoria2 LIKE '%$categoria%' ORDER BY id ASC";
                                }
                        }

                        if(!empty($_GET['statuss'])){ 
                            $status = $_GET['statuss'];
                                if($status != "Todas"){
                                    if($status == "Somente realizadas"){
                                        $status = "Pago";
                                    }else{
                                        $status = "Á pagar";
                                    }
                                    $sql = "SELECT * FROM despesa WHERE situacao LIKE '%$status%' ORDER BY id ASC";
                                }
                        }                    

                        $result = $conn->query($sql);
                    ?>
                </div>
            </form>
        </div>
        <div class="bloco">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" style="white-space: nowrap;">
                    <thead>
                        <tr>
                            <th>Data Vencimento</th>
                            <th>Categoria</th>
                            <th>Subcategoria</th>
                            <th>Valor</th>
                            <th>Situação</th>
                            <th>Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while($data = mysqli_fetch_assoc($result)){
                                echo "<tr>";
                                echo "<td>".$data['datavencimento']."</td>";
                                echo "<td>".$data['categoria'].$data['categoria2']."</td>";
                                echo "<td>".$data['subcategoria'].$data['subcategoria2']."</td>";
                                echo "<td>".$data['total']."</td>";
                                echo "<td>".$data['situacao']."</td>";
                                echo "  <td>
                                            <a class='btn btn-sm btn-primary' href='despesas_edit.php?id=$data[id]'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                                                    <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/>
                                                </svg>
                                            </a>
                                            <a class='btn btn-sm btn-danger' href='despesas_delete.php?id=$data[id]' onclick='confirma()'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                                    <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                                                </svg>
                                            </a>
                                            <a class='btn btn-sm btn-success' href='despesas_check.php?id=$data[id]'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-currency-dollar' viewBox='0 0 16 16'>
                                                    <path d='M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z'/>
                                                </svg>
                                            </a>
                                        </td>";

                            }
                        ?>
                    </tbody>    
                </table>
            </div>
        </div>
    </div>
  </div>
        <div class="sidebar" style="overflow-y: auto;">
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
                    <a class="links" href="processos.php">
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
                        <a class="active">
                        <span class="icon"><i class="fas fa-dollar-sign"></i></span>
                        <span class="item">Financeiro</span>
                        <svg xmlns="http://www.w3.org/2000/svg" style="margin-left: 27%;" width="16" height="13" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
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
    </div>
</body>
<script>
    function confirma(id){
        if (confirm("Deseja realmente excluir este processo?")){
            location.href = "processos_delete.php?id=" + id;
        }
    }
</script>
</html>