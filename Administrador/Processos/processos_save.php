<?php
include_once('../conexao_adm.php');
require('../sessao_usuarios.php');

// VERIFICAÇÃO LOGIN E NÍVEL DE USUÁRIO
verificarAcesso($conn);

if (isset($_POST['update'])) {

    $id = $_POST['id'];
    $mes = $_POST['mes'];
    $naovisualizar = $_POST['naovisualizar'];
    $status = $_POST['statusprocesso'];
    $faseprocesso = $_POST['faseprocesso'];
    $poderjudiciario = $_POST['poderjudiciario'];
    $classeprocesso = $_POST['classeprocesso'];
    $naturezaprocesso = $_POST['naturezaprocesso'];
    $ritoProcessoSelect = $_POST['ritoProcesso'];
    $ritoProcessoAdd = $_POST['ritoProcessoAdd'];
    $nprocesso = $_POST['nprocesso'];
    $numerovara = $_POST['numerovara'];
    $nomedavara = $_POST['nomedavara'];
    $outravara = $_POST['outronomedavara'];
    $nomedacomarca = $_POST['nomedacomarca'];
    $outracomarca = $_POST['outronomedacomarca'];
    $valorCausa = $_POST['valorCausa'];
    $dateabertura = $_POST['dateabertura'];
    $valorhonorario = $_POST['valorhonorario'];
    $parcelas = $_POST['parcelas'];
    $cadreceita = $_POST['cadreceita'];
    $observacoes = $_POST['observacoes'];
    $posicaocliente = $_POST['posicaocliente'];
    $nomecliente = $_POST['nomecliente'];
    $advogadoatuando = $_POST['advogadoatuando'];
    $segundoAdvogado = $_POST['segundoAdvogado'];
    $terceiroAdvogado = $_POST['terceiroAdvogado'];
    $nomefalecido = $_POST['nomefalecido'];
    $outraclasse = $_POST['outraclasse'];

      if ($ritoProcessoAdd != ''){
            $ritoProcesso = $ritoProcessoAdd;
        }else {
            $ritoProcesso = $ritoProcessoSelect;
        }

    if(!empty($outracomarca)) {
        $nomecomarca = $outracomarca;
    }else {
        $nomecomarca = $nomedacomarca;
    }

    if(!empty($outravara)){
        $varadoprocesso = $outravara;
    }else {
        $varadoprocesso = $nomedavara;
    }

        if(!empty($nprocesso)){
        $poderjudiciario = substr($nprocesso, 16, 1);
    }

    if($cadreceita != 'on'){
        $cadreceita = "Desligado";
    }else{
        $cadreceita = "Ligado";
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

    switch ($poderjudiciario) {
        case 1:
            $poderjudiciario = "Supremo Tribunal Federal";
            break;
        case 2:
            $poderjudiciario = "Conselho Nacional de Justiça";
            break;
        case 3:
            $poderjudiciario = "Superior Tribunal de Justiça";
            break;
        case 4:
            $poderjudiciario = "Justiça Federal";
            break;
        case 5:
            $poderjudiciario = "Justiça do Trabalho";
            break;
        case 6:
            $poderjudiciario = "Justiça Eleitoral";
            break;
        case 7:
            $poderjudiciario = "Justiça Militar da União";
            break;
        case 8:
            $poderjudiciario = "Justiça dos Estados e do Distrito Federal e Territórios";
            break;
        case 9:
            $poderjudiciario = "Justiça Militar Estadual";
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
            $naturezaprocesso = 'Previdencial';
            break;
        case 6:
            $naturezaprocesso = 'Tributário';
            break;
        case 7:
            $naturezaprocesso = 'Não definido';
    }

    $sqlUpdate = "UPDATE processo SET valor='$valorcausa', parcelas='$parcelas', cadreceita='$cadreceita',stat='$status', privado='$naovisualizar', posicaocliente='$posicaocliente', observacoes='$observacoes', nomecliente='$nomecliente', nomeadvogado='$advogadoatuando', segundoAdvogado='$segundoAdvogado', terceiroAdvogado='$terceiroAdvogado', natureza='$naturezaprocesso', nprocesso='$nprocesso', poderjudiciario='$poderjudiciario', numerovara='$numerovara', nomedavara='$varadoprocesso', nomedacomarca='$nomecomarca', valorCausa='$valorCausa', fase='$faseprocesso', dataa='$dateabertura', classe='$classeprocesso', falecido='$nomefalecido', mes='$mes'
    WHERE id='$id'";

    $result = $conn->query($sqlUpdate);
}
header('Location: processos.php');
