<?php
include_once('conexao_adm.php');

if (isset($_POST['update'])) {

    $id = $_POST['id'];
    $mes = $_POST['mes'];
    $naovisualizar = $_POST['naovisualizar'];
    $status = $_POST['statusprocesso'];
    $faseprocesso = $_POST['faseprocesso'];
    $poderjudiciario = $_POST['poderjuduciario'];
    $classeprocesso = $_POST['classeprocesso'];
    $naturezaprocesso = $_POST['naturezaprocesso'];
    $nprocesso = $_POST['nprocesso'];
    $numerovara = $_POST['numerovara'];
    $nomedavara = $_POST['nomedavara'];
    $dateabertura = $_POST['dateabertura'];
    $valorcausa = $_POST['valorcausa'];
    $parcelas = $_POST['parcelas'];
    $observacoes = $_POST['observacoes'];
    $posicaocliente = $_POST['posicaocliente'];
    $nomecliente = $_POST['nomecliente'];
    $advogadoatuando = $_POST['advogadoatuando'];
    $nomefalecido = $_POST['nomefalecido'];
    $outraclasse = $_POST['outraclasse'];

    if($cadreceita != 'on'){
        $cadreceita = "Ligado";
    }else{
        $cadreceita = "Desligado";
    }

    switch ($naovisualizar) {
        case 1:
            $naovisualizar = '(O cliente não poderá visualizar)';
            break;
        case 0:
            $naovisualizar = '(O cliente poderá visualizar)';
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

    switch ($faseprocesso) {
        case 1:
            $faseprocesso = 'Sem Fase';
            break;
        case 2:
            $faseprocesso = 'Execução';
            break;
        case 3:
            $faseprocesso = 'Inicial';
            break;
        case 4:
            $faseprocesso = 'Recursal';
    }

    switch ($posicaocliente) {
        case 1:
            $posicaocliente = 'Adverso';
            break;
        case 2:
            $posicaocliente = 'Advogado';
            break;
        case 3:
            $posicaocliente = 'Advogado Adverso';
            break;
        case 4:
            $posicaocliente = 'Autor';
            break;
        case 5:
            $posicaocliente = 'Reclamada';
            break;
        case 6:
            $posicaocliente = 'Reclamante';
            break;
        case 7:
            $posicaocliente = 'Relator';
            break;
        case 8:
            $posicaocliente = 'Requerente';
            break;
        case 9:
            $posicaocliente = 'Requerido';
            break;
        case 10:
            $posicaocliente = 'Réu';
            break;
        case 11:
            $posicaocliente = 'Testemunha';
    }

    if (!empty($outraclasse)) {
        $classeprocesso = $outraclasse;
    } else {
        switch ($classeprocesso) {
            case 1:
                $classeprocesso = 'Ação de cobrança';
                break;
            case 2:
                $classeprocesso = 'Ação de despejo';
                break;
            case 3:
                $classeprocesso = 'Ação de indenização';
                break;
            case 4:
                $classeprocesso = 'Divórcio';
                break;
            case 5:
                $classeprocesso = 'Execução de Alimentos';
                break;
            case 6:
                $classeprocesso = 'Impugnação do valor da causa';
        }
    }

    switch ($naturezaprocesso) {
        case 1:
            $naturezaprocesso = 'Civil';
            break;
        case 2:
            $naturezaprocesso = 'Criminal';
            break;
        case 3:
            $naturezaprocesso = 'Família';
            break;
        case 4:
            $naturezaprocesso = 'Trabalhista';
            break;
        case 5:
            $naturezaprocesso = 'Não definido';
    }

    $sqlUpdate = "UPDATE processo SET valor='$valorcausa', parcelas='$parcelas', cadreceita='$cadreceita',
                    stat='$status', privado='$naovisualizar', posicaocliente='$posicaocliente',
                    observacoes='$observacoes', nomecliente='$nomecliente', nomeadvogado='$advogadoatuando',
                    natureza='$naturezaprocesso', nprocesso='$nprocesso', numerovara='$numerovara', nomedavara='$nomedavara',
                    fase='$faseprocesso', poderjuduciario='$poderjuduciario', dataa='$dateabertura', classe='$classeprocesso', falecido='$nomefalecido'
    WHERE id='$id'";

    $result = $conn->query($sqlUpdate);
}
header('Location: processos.php');
