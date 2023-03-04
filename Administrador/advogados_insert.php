<?php
    include_once('conexao_adm.php');

    if(isset($_POST['enviar'])){

        $nomeadvogado = $_POST['nomeadvogado'];
        $funcao = $_POST['funcao'];
        $numerooab = $_POST['numerooab'];
        $estadooab = $_POST['estadooab'];
        $numerocpf = $_POST['numerocpf'];
        $sexo = $_POST['sexo'];
        $datanascimento = $_POST['datanascimento'];
        $numerorg = $_POST['numerorg'];
        $estadocivil = $_POST['estadocivil'];
        $profissao = $_POST['profissao'];
        $observacoes = $_POST['descricao'];
        $descricao = $_POST['descricao'];
        $email1 = $_POST['email'];
        $email2 = $_POST['email2'];
        $email3 = $_POST['email3'];
        $status = $_POST['status'];

        ##TELEFONES##
        $tipocontato1 = $_POST['tipocontato'];
        $ddi1 = $_POST['ddi'];
        $ddd1 = $_POST['ddd'];
        $numero1 = $_POST['numero'];
        $telefone1 = "(".$ddd1.")".$numero1;

        $tipocontato2 = $_POST['tipocontato2'];
        $ddi2 = $_POST['ddi2'];
        $ddd2 = $_POST['ddd2'];
        $numero2 = $_POST['numero2'];
        $telefone2 = "(".$ddd2.")".$numero2;

        $tipocontato3 = $_POST['tipocontato3'];
        $ddi3 = $_POST['ddi3'];
        $ddd3 = $_POST['ddd3'];
        $numero3 = $_POST['numero3'];
        $telefone3 = "(".$ddd3.")".$numero3;

        ##ENDEREÇOS##
        $cep1 = $_POST['cep'];
        $endereco1 = $_POST['endereco'];
        $numerocasa1 = $_POST['numerocasa'];
        $complemento1 = $_POST['complemento'];
        $bairro1 = $_POST['bairro'];
        $cidade1 = $_POST['cidade'];
        $estado1 = $_POST['estado'];

        $cep2 = $_POST['cep2'];
        $endereco2 = $_POST['endereco2'];
        $numerocasa2 = $_POST['numerocasa2'];
        $complemento2 = $_POST['complemento2'];
        $bairro2 = $_POST['bairro2'];
        $cidade2 = $_POST['cidade2'];
        $estado2 = $_POST['estado2'];
        
        ##DADOS LOGIN##

        $login = $_POST['login'];
        $senha = $_POST['senha'];

        ##CONDIÇÕES##

        if($funcao == 'Não selecionado'){
            $funcao = 'Não selecionado';
        }else{
            $funcao = $funcao;
        }

        ##COMANDO SQL##

        $sqlInsert = "INSERT INTO usuario (nome, usuario, senha, funcao, oab, estadooab, cpf, sexo, datanascimento, rg, estadocivil, profissao, observacoes, email1, email2, email3, telefone1, numero1,tipocontato1, ddi1, ddd1, telefone2, numero2, tipocontato2, ddi2, ddd2, telefone3, numero3, tipocontato3, ddi3, ddd3, cep1, endereco1, numerocasa1, complemento1, bairro1, cidade1, estado1, cep2, endereco2, numerocasa2, complemento2, bairro2, cidade2, estado2, status)
        VALUES ('$nomeadvogado', '$login', '$senha' ,'$funcao', '$numerooab', '$estadooab', '$numerocpf', '$sexo', '$datanascimento', '$numerorg', '$estadocivil', '$profissao', '$observacoes', '$email1', '$email2', '$email3', '$telefone1', '$numero1', '$tipocontato1', '$ddi1', '$ddd1', '$telefone2', '$numero2', '$tipocontato2', '$ddi2', '$ddd2', '$telefone3', '$numero3', '$tipocontato3', '$ddi3', '$ddd3', '$cep1', '$endereco1', '$numerocasa1', '$complemento1', '$bairro1', '$cidade1', '$estado1', '$cep2', '$endereco2', '$numerocasa2', '$complemento2', '$bairro2', '$cidade2', '$estado2', '$status')";

        $result = $conn->query($sqlInsert);

        header('location: advogados.php');
    }
?>