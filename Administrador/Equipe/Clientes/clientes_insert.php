<?php
include_once('../../conexao_adm.php');

if (isset($_POST['enviar'])) {

    ##DADOS CPF/CNPJ##
    $nome = $_POST['nomecliente'];
    $documento = $_POST['tipodocumento'];
    $cpf = $_POST['numerocpf'];
    $cnpj = $_POST['numerocnpj'];
    $sexo = $_POST['sexo'];
    $resposavel = $_POST['resposavel'];
    $datanascimento = $_POST['datanascimento'];
    $datafundacao = $_POST['datafundacao'];
    $numerorg = $_POST['numerorg'];
    $tipoempresa = $_POST['tipoempresa'];
    $estadocivil = $_POST['estadocivil'];
    $atividadeprincipal = $_POST['atividadeprincipal'];
    $profissao = $_POST['profissao'];
    $inscricao = $_POST['inscricao'];
    $nacionalidade = $_POST['nacionalidade'];
    $observacoes = $_POST['observacoes'];

    #EMAILS##
    $email1 = $_POST['email'];
    $email2 = $_POST['email2'];
    $email3 = $_POST['email3'];

    ##TELEFONES##
    $tipocontato1 = $_POST['tipocontato'];
    $ddi1 = $_POST['ddi'];
    $ddd1 = $_POST['ddd'];
    $numero1 = $_POST['numero'];

    $tipocontato2 = $_POST['tipocontato2'];
    $ddi2 = $_POST['ddi2'];
    $ddd2 = $_POST['ddd2'];
    $numero2 = $_POST['numero2'];

    $tipocontato3 = $_POST['tipocontato3'];
    $ddi3 = $_POST['ddi3'];
    $ddd3 = $_POST['ddd3'];
    $numero3 = $_POST['numero3'];

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

    ##PRÉ ENVIO##
    if (!empty($senha)) {
        $md5senha = md5($senha);
        $sha1senha = sha1($md5senha);
    }

    ##COMANDOS SQL INSERT##
    $sql = "INSERT INTO clientes (nomecliente, tipodocumento, cpf, cnpj, sexo, responsavel, datanascimento, datafundacao, rg, tipoempresa, 
        estadocivil, atividade, profissao, inscricao, nacionalidade ,observacao, email1, email2, email3, tipocontato1, ddi1, ddd1, numero1, tipocontato2, 
        ddi2, ddd2, numero2, tipocontato3, ddi3, ddd3, numero3, cep1, numerocasa1, complemento1, bairro1, cidade1, estado1, cep2, numerocasa2, 
        complemento2, bairro2, cidade2, estado2, login, senha)

        VALUES ('$nome', '$documento', '$cpf', '$cnpj', '$sexo', '$resposavel', '$datanascimento', '$datafundacao', '$numerorg', '$tipoempresa', 
        '$estadocivil', '$atividadeprincipal', '$profissao', '$inscricao', '$nacionalidade', '$observacoes', '$email1', '$email2', '$email3', '$tipocontato1', '$ddi1', 
        '$ddd1', '$numero1', '$tipocontato2', '$ddi2', '$ddd2', '$numero2', '$tipocontato3', '$ddi3', '$ddd3', '$numero3', '$cep1', '$numerocasa1', '$complemento1', 
        '$bairro1', '$cidade1', '$estado1', '$cep2', '$numerocasa2', '$complemento2', '$bairro2', '$cidade2', '$estado2', '$login', '$sha1senha')";

    $result = $conn->query($sql);

    header('Location: clientes.php');
}
