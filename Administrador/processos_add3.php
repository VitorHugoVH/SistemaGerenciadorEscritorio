<?php

// VERIFICAÇÃO LOGIN
session_start();
$logged = $_SESSION['logged'] ?? NULL;

if (!$logged) {
    header('Location: /FragaeMelo/Site%20Fraga%20e%20Melo%20BootsTrap/login.php');
};


if (isset($_POST['enviar'])) {
    include_once('conexao_adm.php');

    $privado = $_POST['naovisualizar'];
    $status = $_POST['statusprocesso'];
    $fase = $_POST['faseprocesso'];
    $poderjuduciario = $_POST['poderjuduciario'];
    $classe = $_POST['classeprocesso'];
    $natureza = $_POST['naturezaprocesso'];
    $nprocesso = $_POST['numeroprocessocnj'];
    $numerovara = $_POST['numerovara'];
    $nomedavara = $_POST['nomedavara'];
    $nomedacomarca = $_POST['nomedacomarca'];
    $outronomedacomarca = $_POST['outronomedacomarca'];
    $dataa = $_POST['dateabertura'];
    $valor = $_POST['valorcausa'];
    $parcelas = $_POST['parcelas'];
    $cadreceita = $_POST['cadreceita'];
    $ob = $_POST['observacoes'];
    $posicao = $_POST['posicaocliente'];
    $nomecliente = $_POST['nomecliente'];
    $nomeadvogado = $_POST['advogadoatuando'];
    $nomefalecido = $_POST['nomefalecido'];
    $mes = $_POST['mes'];

    if($cadreceita != 'on'){
        $cadreceita = "Ligado";
    }else{
        $cadreceita = "Desligado";
    }

    switch ($privado) {
        case 1:
            $privado = '(O cliente não poderá visualizar)';
            break;
        case 0:
            $privado = '(O cliente poderá visualizar)';
    }

    switch ($status) {
        case 1:
            $status = 'Ativo';
            break;
        case 2:
            $status = 'Suspenso';
            break;
        case 3:
            $status = 'Baixado';
    }

    switch ($fase) {
        case 1:
            $fase = 'Sem Fase';
            break;
        case 2:
            $fase = 'Execução';
            break;
        case 3:
            $fase = 'Inicial';
            break;
        case 4:
            $fase = 'Recursal';
    }

    switch ($posicao) {
        case 1:
            $posicao = 'Adverso';
            break;
        case 2:
            $posicao = 'Advogado';
            break;
        case 3:
            $posicao = 'Advogado Adverso';
            break;
        case 4:
            $posicao = 'Autor';
            break;
        case 5:
            $posicao = 'Reclamada';
            break;
        case 6:
            $posicao = 'Reclamante';
            break;
        case 7:
            $posicao = 'Relator';
            break;
        case 8:
            $posicao = 'Requerente';
            break;
        case 9:
            $posicao = 'Requerido';
            break;
        case 10:
            $posicao = 'Réu';
            break;
        case 11:
            $posicao = 'Testemunha';
    }

    if (!empty($outraclasse)) {
        $classe = $outraclasse;
    } else {
        $classe = $classe;
    }

    switch ($poderjuduciario) {
        case 1:
            $poderjuduciario = "Supremo Tribunal Federal";
            break;
        case 2:
            $poderjuduciario = "Conselho Nacional de Justiça";
            break;
        case 3:
            $poderjuduciario = "Superior Tribunal de Justiça";
            break;
        case 4:
            $poderjuduciario = "Justiça Federal";
            break;
        case 5:
            $poderjuduciario = "Justiça do Trabalho";
            break;
        case 6:
            $poderjuduciario = "Justiça Eleitoral";
            break;
        case 7:
            $poderjuduciario = "Justiça Militar da União";
            break;
        case 8:
            $poderjuduciario = "Justiça dos Estados e do Distrito Federal e Territórios";
            break;
        case 9:
            $poderjuduciario = "Justiça Militar Estadual";
    }

    if(!empty($outronomedacomarca)) {
        $nomecomarca = $outronomedacomarca;
    }else {
        $nomecomarca = $nomedacomarca;
    }

    switch ($natureza) {
        case 1:
            $natureza = 'Civil';
            break;
        case 2:
            $natureza = 'Criminal';
            break;
        case 3:
            $natureza = 'Família';
            break;
        case 4:
            $natureza = 'Trabalhista';
            break;
        case 5:
            $natureza = 'Não definido';
    }

    $result = mysqli_query($conn, "INSERT INTO processo (valor, parcelas, cadreceita, stat, privado,
                      posicaocliente, observacoes, nomecliente, nomeadvogado, natureza, nprocesso, numerovara, nomedavara, nomedacomarca,fase,
                      poderjudiciario, dataa, classe, falecido ,mes)
        VALUES ('$valor', '$parcelas', '$cadreceita', '$status', '$privado', '$posicao', '$ob', '$nomecliente',
                '$nomeadvogado', '$natureza', '$nprocesso', '$numerovara', '$nomedavara', '$nomecomarca', '$fase', '$poderjuduciario', '$dataa', '$classe',
                '$nomefalecido', '$mes')");

    header('Location: processos.php');
}