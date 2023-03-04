<?php
    include_once('conexao_adm.php');

    $id = $_GET['id'];

    if(!empty($_GET['id'])){

        $sql = "SELECT * FROM receita WHERE id=$id";
        $result = $conn->query($sql);

        while($data = mysqli_fetch_assoc($result)){
            $cliente1 = $data['cliente1'];
            $cliente2 = $data['cliente2'];
            $vencimento = $data['vencimento'];
            $valor = $data['valor'];
            $categoria1 = $data['categoria1'];
            $categoria2 = $data['categoria2'];
            $subcategoria1 = $data['subcategoria1'];
            $subcategoria2 = $data['subcategoria2'];
            $observacoes = $data['observacoes'];
            $status = $data['statuss'];
            $recebimentodata = $data['recebimentodata'];
            $juros = $data['juros'];
            $multa = $data['multa'];
            $repetir = $data['repetir'];
            $parcelas = $data['parcelas'];
            $anexo = $data['anexo'];
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
        <form action="receitas_save.php" method="POST">
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
                            <label for="client1"><b><h6 style="font-family: arial, sans-serif; font-size: 16px;">Cliente</h6></b></label>
                            <div class="input-group">
                                <select name="client1" id="client1" class="form-select">
                                    <option <?= ($cliente1 == 'Nenhum')?'selected':' ' ?>>Nenhum</option>
                                    <?php
                                        include_once('conexao_adm.php');

                                        $sqlClient = "SELECT * FROM processo ORDER BY id ASC";
                                        $resultClient = $conn->query($sqlClient);

                                        while($data_client = mysqli_fetch_assoc($resultClient)){
                                            $nome = $data_client['nomedocliente'];

                                            if($cliente1 == $nome){
                                                echo "<option selected>$nome</option>";
                                            }else{
                                                echo "<option>$nome</option>";
                                            }
                                        }
                                    ?>
                                </select>
                                <input type="hidden" name="client2" id="client2" class="form-control" value="<?php echo $cliente2; ?>">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" name="textcli" id="textcli" type="button" onclick="clientadd()">Adicionar</button>
                                    <button class="btn btn-secondary" name="selectcli" id="selectcli" type="button" onclick="clientselect()" style="display: none;">Selecionar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="campos">
                        <label for="vencimento"><b><h6 style="font-family: arial, sans-serif; font-size: 16px;">Data vencimento</h6></b></label>      
                        <input type="date" name="vencimento" id="vencimento" class="form-control" placeholder="__/__/__" value="<?php echo $vencimento; ?>">
                    </div>
                    <div class="campos">
                        <label for="valor"><b><h6 style="font-family: arial, sans-serif; font-size: 16px;">Valor</h6></b></label> 
                        <input type="number" name="valor" id="valor" class="form-control" placeholder="0,00" value="<?php echo $valor; ?>">    
                    </div>
                    <div class="campos">
                        <div class="row">
                            <label for="categoria1"><b><h6 style="font-family: arial, sans-serif; font-size: 16px;">Categoria</h6></b></label>
                            <div class="input-group">
                                <select class="form-select" name="categoria1" id="categoria1">
                                    <option <?= ($categoria1 == 'Recebimentos')?'selected':' '; ?>>Recebimentos</option>
                                </select>
                                <input type="hidden" name="categoria2" id="categoria2" class="form-control" value="<?php echo $categoria2; ?>">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" name="adcategoria" id="adcategoria" type="button" onclick="addcategoria()">Adicionar</button>
                                    <button class="btn btn-secondary" name="seleccategoria" id="seleccategoria" type="button" onclick="selectcategoria()" style="display: none;">Selecionar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="campos">
                        <div class="row">
                            <label for="subcategoria1"><b><h6 style="font-family: arial, sans-serif; font-size: 16px;">Subcategoria</h6></b></label>
                            <div class="input-group">
                                <select class="form-select" name="subcategoria1" id="subcategoria1">
                                    <option <?= ($subcategoria1 == 'Pensão alimentícia')?'selected':' '; ?>>Pensão alimentícia</option>
                                    <option <?= ($subcategoria1 == 'Salário')?'selected':' ';?>>Salário</option>
                                    <option <?= ($subcategoria1 == 'Transferência')?'selected':' ';?>>Transferência</option>
                                </select>
                                <input type="hidden" name="subcategoria2" id="subcategoria2" class="form-control" value="<?php echo $subcategoria2 ?>">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="button" id="adsub" onclick="addsubcategoria()">Adicionar</button>
                                    <button class="btn btn-secondary" type="button" id="selecsub" style="display: none;" onclick="selectsubcategoria()">Selecionar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="campos">
                        <label for="observacoes"><b><h6 style="font-family: arial, sans-serif; font-size: 16px;">Observações</h6></b></label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="1" placeholder="Observação" name="observacoes" id="observacoes"><?php echo $observacoes ?></textarea>
                    </div>
                    <div class="campos">
                        <label for="flexCheckDefault"><b><h6 style="font-family: arial, sans-serif; font-size: 16px;">Situação</h6></b></label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="receber" id="flexCheckDefault" name="status" <?= ($status == 'A receber')?"checked":' '; ?>>
                            <label class="form-check-label" for="flexCheckDefault">
                                A receber
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="recebido" id="flexCheckChecked" onclick="rece()" name="status" <?= ($status == 'Recebido')?"checked":' '; ?>>
                            <label class="form-check-label" for="flexCheckChecked">
                                Recebido
                            </label>
                        </div>
                    </div>
                    <div id="campos3" style="margin-top: 2%; margin-bottom: 2%; display: none;">
                        <label><b><h6 style="font-family: arial, sans-serif; font-size: 16px;">Data do recebimento</h6></b></label>
                        <input type="date" name="recebimentodata" id="recebimentodata" class="form-control" placeholder="__/__/__" value="<?php echo $recebimentodata; ?>">
                    </div>
                    <div class="campos">
                        <label for="juros"><b><h6 style="font-family: arial, sans-serif; font-size: 16px;">Valor do juros</h6></b></label>
                        <input type="number" name="juros" id="juros" placeholder="0,00" class="form-control" value="<?php echo $juros; ?>">
                    </div>
                    <div class="campos">
                        <label for="multa"><b><h6 style="font-family: arial, sans-serif; font-size: 16px;">Valor da multa</h6></b></label>
                        <input type="number" name="multa" id="multa" placeholder="0,00" class="form-control" value="<?php echo $multa; ?>">
                    </div>
                    <div class="campos">
                        <label><b><h6 style="font-family: arial, sans-serif; font-size: 16px;">Repetir valor?</h6></b></label>   
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="uma" id="flexChe" name="repetir" <?= ($repetir == 'uma')?"checked":' '; ?>>
                            <label class="form-check-label" for="flexChe">
                                Desejo inserir este valor apenas um vez
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="repetir" id="flexCheck" onclick="isChecked()" name="repetir" <?= ($repetir == 'repetir')?"checked":' '; ?>>
                            <label class="form-check-label" for="flexCheck">
                                Desejo repetir este valor
                            </label>
                        </div>
                    </div>
                    <div id="campos2" style="margin-top: 2%; margin-bottom: 2%; display: none;">
                        <label for="parcelas"><b><h6 style="font-family: arial, sans-serif; font-size: 16px;">Nº de parcelas:</h6></b></label>   
                        <input type="number" name="parcelas" id="parcelas" class="form-control" placeholder="3" value="<?php echo $parcelas ?>">
                    </div>
                </div>
            </div>
            <div class="bloco5">
                <label for="anexo"><b><h6 style="font-family: arial, sans-serif; font-size: 16px;">Anexo</h6></b></label>   
                <input type="file" name="anexo" id="anexo" class="form-control">
            </div>
            <input type="hidden" name="datacriacao" value="<?php echo date('d/m/Y') ?>">
            <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
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
                    <a href="processos.php" class="links">
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
                        <a href="#" class="active">
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
    </div>
    <script>
        function clientadd(){
            document.getElementById('client1').style.display = "none";
            document.getElementById('client2'). type = "text";
            document.getElementById('textcli').style.display = "none";
            document.getElementById('selectcli').style.display = "block";
        }
        
        function clientselect(){
            document.getElementById('client1').style.display = "block";
            document.getElementById('client2'). type = "hidden";
            document.getElementById('textcli').style.display = "block";
            document.getElementById('selectcli').style.display = "none";
        }

        function addcategoria(){
            document.getElementById('categoria1').style.display = "none";
            document.getElementById('categoria2').type = "text";
            document.getElementById('adcategoria').style.display = "none";
            document.getElementById('seleccategoria').style.display = "block";
        }

        function selectcategoria(){
            document.getElementById('categoria1').style.display = "block";
            document.getElementById('categoria2').type = "hidden";
            document.getElementById('adcategoria').style.display = "block";
            document.getElementById('seleccategoria').style.display = "none";
        }

        function addsubcategoria(){
            document.getElementById('subcategoria1').style.display = "none";
            document.getElementById('subcategoria2').type = "text";
            document.getElementById('adsub').style.display = "none";
            document.getElementById('selecsub').style.display = "block";
        }

        function selectsubcategoria(){
            document.getElementById('subcategoria1').style.display = "block";
            document.getElementById('subcategoria2').type = "hidden";
            document.getElementById('adsub').style.display = "block";
            document.getElementById('selecsub').style.display = "none";
        }

        function rece(){
            if(document.getElementById('flexCheckChecked').checked){
                document.getElementById('campos3').style.display = "block";
            }else{
                document.getElementById('campos3').style.display = "none";
            }
        }

        function isChecked(){
            if(document.getElementById("flexCheck").checked){
                document.getElementById("campos2").style.display = "block";
            }else {
                document.getElementById("campos2").style.display = "none";
            }
        }
    </script>
</body>
</html>