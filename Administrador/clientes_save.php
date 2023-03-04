<?php
    include_once('conexao_adm.php');

    if(isset($_POST['enviar'])){

        $id = $_POST['id'];

        ##INFORMAÇÕES##
        $newnome = $_POST['nomecliente'];
        $newdocumento = $_POST['tipodocumento'];
        $newnumerocpf = $_POST['numerocpf'];
        $newnumerocnpj = $_POST['numerocnpj'];
        $newsexo = $_POST['sexo'];
        $newresposavel = $_POST['resposavel'];
        $newdatanascimento = $_POST['datanascimento'];
        $newdatafundacao = $_POST['datafundacao'];
        $newnumerorg = $_POST['numerorg'];
        $newtipoempresa = $_POST['tipoempresa'];
        $newestadocivil = $_POST['estadocivil'];
        $newatividadeprincipal = $_POST['atividadeprincipal'];
        $newprofissao = $_POST['profissao'];
        $newinscricao = $_POST['inscricao'];
        $newobservacoes= $_POST['observacoes'];

        ##EMAILS##
        $newemail1 = $_POST['email'];
        $newemail2 = $_POST['email2'];
        $newemail3 = $_POST['email3'];

        ##TELEFONES##
        $newtipocontato1 = $_POST['tipocontato'];
        $newddi1 = $_POST['ddi'];
        $newddd1 = $_POST['ddd'];
        $newnumero = $_POST['numero'];
        $newtipocontato2 = $_POST['tipocontato2'];
        $newddi2 = $_POST['ddi2'];
        $newddd2 = $_POST['ddd2'];
        $newnumero2 = $_POST['numero2'];
        $newtipocontato3 = $_POST['tipocontato3'];
        $newddi3 = $_POST['ddi3'];
        $newddd3 = $_POST['ddd3'];
        $newnumero3 = $_POST['numero3'];

        ##ENDEREÇOS##
        $newcep1 = $_POST['cep'];
        $newendereco1 = $_POST['endereco'];
        $newnumerocasa1 = $_POST['numerocasa'];
        $newcomplemento1 = $_POST['complemento'];
        $newbairro1 = $_POST['bairro'];
        $newcidade1 = $_POST['cidade'];
        $newestado1 = $_POST['estado'];
        $newcep2 = $_POST['cep2'];
        $newendereco2 = $_POST['endereco2'];
        $newnumerocasa2 = $_POST['numerocasa2'];
        $newcomplemento2 = $_POST['complemento2'];
        $newbairro2 = $_POST['bairro2'];
        $newcidade2 = $_POST['cidade2'];
        $newestado2 = $_POST['estado2'];
        $newlogin = $_POST['login'];
        $newsenha = $_POST['senha'];   

        ##COMANDOS UPDATE##
        $sqlUpdate = "UPDATE clientes SET nomecliente='$newnome', tipodocumento='$newdocumento', cpf='$newnumerocpf', cnpj='$newnumerocnpj', sexo='$newsexo', responsavel='$newresposavel', datanascimento='$newdatanascimento', datafundacao='$newdatafundacao', rg='$newnumerorg', tipoempresa='$newtipoempresa', estadocivil='$newestadocivil', atividade='$newatividadeprincipal', profissao='$newprofissao', inscricao='$newinscricao', observacao='$newobservacoes', email1='$newemail1', email2='$newemail2', email3='$newemail3', tipocontato1='$newtipocontato1', ddi1='$newddd1', ddd1='$newddd1', numero1='$newnumero', tipocontato2='$newtipocontato2', ddi2='$newddi2', ddd2='$newddd2', numero2='$newnumero2', tipocontato3='$newtipocontato3', ddi3='$newddi3', ddd3='$newddd3', numero3='$newnumero3', cep1='$newcep1', endereco1='$newendereco1', numerocasa1='$newnumerocasa1', complemento1='$newcomplemento1', bairro1='$newbairro1', cidade1='$newcidade1', estado1='$newestado1', cep2='$newcep2', endereco2='$newendereco2', numerocasa2='$newnumerocasa2', complemento2='$newcomplemento2', bairro2='$newbairro2', cidade2='$newcidade2', estado2='$newestado2', login='$newlogin', senha='$newsenha'
        WHERE id='$id'";

        $resultUpdate = $conn->query($sqlUpdate);

        header('location: clientes.php');
    }
?>