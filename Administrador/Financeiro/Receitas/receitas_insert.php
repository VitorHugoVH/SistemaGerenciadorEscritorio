<?php
    include_once('../../conexao_adm.php');

    if(isset($_POST['salvar'])){

        $cliente1 = $_POST['client1'];
        $cliente2 = $_POST['client2'];
        $vencimento = $_POST['vencimento'];
        $valor = $_POST['valor'];
        $categoria1 = $_POST['categoria1'];
        $categoria2 = $_POST['categoria2'];
        $subcategoria1 = $_POST['subcategoria1'];
        $subcategoria2 = $_POST['subcategoria2'];
        $observacoes = $_POST['observacoes'];
        $status = $_POST['status'];
        $recebimentodata = $_POST['recebimentodata'];
        $juros = $_POST['juros'];
        $multa = $_POST['multa'];
        $repetir = $_POST['repetir'];
        $parcelas = $_POST['parcelas'];
        $anexo = $_POST['anexo'];
        $datacriacao = $_POST['datacriacao'];

        if($recebimentodata == ''){
            $recebimentodata = "";
        }

        if($status == 'receber'){
            $status = "A receber";
        }else{
            $status = "Recebido";
        }

        if($cliente1 != ''){
            $cliente2 = "";
        }else{
            $cliente1 = "";
        }

        if($categoria1 != ''){
            $categoria2 = "";
        }else{
            $categoria1 = "";
        }

        if($subcategoria1 != ''){
            $subcategoria2 = "";
        }else {
            $subcategoria1 = "";
        }
        
        $sqlEnviar = "INSERT INTO receita (cliente1, cliente2, vencimento, valor, categoria1, categoria2, subcategoria1, subcategoria2, observacoes, statuss, recebimentodata, juros, multa, repetir, parcelas, anexo, datacriacao)
        VALUES ('$cliente1', '$cliente2', '$vencimento', '$valor', '$categoria1', '$categoria2', '$subcategoria1', '$subcategoria2', '$observacoes', '$status', '$recebimentodata', '$juros', '$multa', '$repetir', '$parcelas', '$anexo', '$datacriacao')";

        $resultEnviar = $conn->query($sqlEnviar);

        ##INICIO SISTEMA REPETIÇÃO##

            $repeticao = 0;
                if(!empty($_POST['parcelas'])){
                    $repeticao = $parcelas;
                    $mesatual = date('d/m/Y');
                    $nextmonth = date('d/m/Y', strtotime("+1 months", strtotime($datacriacao)));
                        while($repeticao <= 0){
                                        
                            if($nextmonth = $mesatual){
                                $sqlEnviar2 = "INSERT INTO receita (cliente1, cliente2, vencimento, valor, categoria1, categoria2, subcategoria1, subcategoria2, observacoes, statuss, recebimentodata, juros, multa, repetir, parcelas, anexo)
                                VALUES ('$cliente1', '$cliente2', '$vencimento', '$valor', '$categoria1', '$categoria2', '$subcategoria1', '$subcategoria2', '$observacoes', '$status', '$recebimentodata', '$juros', '$multa', '$repetir', '$parcelas', '$anexo')";
                        
                                $resultEnviar2 = $conn->query($sqlEnviar2);
                        
                            }
                            $repeticao = $repeticao -= 1;
                        }
                }
                
        ##FINAL SISTEMA REPETIÇÃO##  

        header('Location: receitas.php');
    }
?>