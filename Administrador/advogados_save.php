<?php
    include_once('conexao_adm.php');

    // VERIFICAÇÃO LOGIN
    session_start();
    $logged = $_SESSION['logged'] ?? NULL;

    if (!$logged) {
    header('Location: /FragaeMelo/Site%20Fraga%20e%20Melo%20BootsTrap/login.php');
    };

    if(isset($_POST['enviar'])){

        $id = $_POST['id'];
        $newnomeadvogado = $_POST['nomeadvogado'];
        $newfuncao = $_POST['funcao'];
        $newnumerooab = $_POST['numerooab'];
        $newestadooab = $_POST['estadooab'];
        $newnumerocpf = $_POST['numerocpf'];
        $newsexo = $_POST['sexo'];
        $newdatanascimento = $_POST['datanascimento'];
        $newnumerorg = $_POST['numerorg'];
        $newestadocivil = $_POST['estadocivil'];
        $newprofissao = $_POST['profissao'];
        $newdescricao = $_POST['descricao'];

        ##EMAILS##
        $newemail1 = $_POST['email'];
        $newemail2 = $_POST['email2'];
        $newemail3 = $_POST['email3'];

        ##TELEFONES##
        $newtipocontato = $_POST['tipocontato'];
        $newddi = $_POST['ddi'];
        $newddd = $_POST['ddd'];
        $newnumero = $_POST['numero'];
        $newtelefone1 = "(".$newddd.")".$newnumero;

        $newtipocontato2 = $_POST['tipocontato2'];
        $newddi2 = $_POST['ddi2'];
        $newddd2 = $_POST['ddd2'];
        $newnumero2 = $_POST['numero2'];
        $newtelefone2 = "(".$newddd2.")".$newnumero2;

        $newtipocontato3 = $_POST['tipocontato3'];
        $newddi3 = $_POST['ddi3'];
        $newddd3 = $_POST['ddd3'];
        $newnumero3 = $_POST['numero3'];
        $newtelefone3 = "(".$newddd3.")".$newnumero3;

        ##ENDERECOS##
        $newcep = $_POST['cep'];
        $newendereco = $_POST['endereco'];
        $newnumerocasa = $_POST['numerocasa'];
        $newcomplemento = $_POST['complemento'];
        $newbairro = $_POST['bairro'];
        $newcidade = $_POST['cidade'];
        $newestado = $_POST['estado'];

        $newcep2 = $_POST['cep2'];
        $newendereco2 = $_POST['endereco2'];
        $newnumerocasa2 = $_POST['numerocasa2'];
        $newcomplemento2 = $_POST['complemento2'];
        $newbairro2 = $_POST['bairro2'];
        $newcidade2 = $_POST['cidade2'];
        $newestado2 = $_POST['estado2'];

        ##LOGIN##
        $newlogin = $_POST['login'];
        $newsenha = $_POST['senha'];
        $newstatus = $_POST['status'];

        ##COMANDOS SQL##

        $sqlUpdate = "UPDATE usuario SET nome='$newnomeadvogado', usuario='$newlogin', senha='$newsenha', funcao='$newfuncao', oab='$newnumerooab', estadooab='$newestadooab', cpf='$newnumerocpf', sexo='$newsexo', datanascimento='$newdatanascimento', rg='$newnumerorg', estadocivil='$newestadocivil', profissao='$newprofissao', observacoes='$newdescricao', email1='$newemail1', email2='$newemail2', email3='$newemail3', telefone1='$newtelefone1', numero1='$newnumero', tipocontato1='$newtipocontato', ddi1='$newddi', ddd1='$newddd', telefone2='$newtelefone2', numero2='$newnumero2', tipocontato2='$newtipocontato2', ddi2='$newddi2', ddd2='$newddd2', telefone3='$newtelefone3', numero3='$newnumero3', tipocontato3='$newtipocontato3', ddi3='$newddi3', ddd3='$newddd3', cep1='$newcep', endereco1='$newendereco', numerocasa1='$newnumerocasa', complemento1='$newcomplemento', bairro1='$newbairro', cidade1='$newcidade', estado1='$newestado', cep2='$newcep2', endereco2='$newendereco2', numerocasa2='$newnumerocasa2', complemento2='$newcomplemento2', bairro2='$newbairro2', cidade2='$newcidade2', estado2='$newestado2', status='$newstatus'
        WHERE idusuario='$id'";

        $resultUpdate = $conn->query($sqlUpdate);

        header('location: advogados.php');
    }
?>