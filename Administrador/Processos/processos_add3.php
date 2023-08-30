<?php
include_once '../conexao_adm.php';
require('../sessao_usuarios.php');

// VERIFICAÇÃO LOGIN E NÍVEL DE USUÁRIO
verificarAcesso($conn);

if (isset($_POST['enviar'])) {
  $privado = $_POST['naovisualizar'];
  $status = $_POST['statusprocesso'];
  $fase = $_POST['faseprocesso'];
  $poderjudiciario = $_POST['poderjudiciario'];
  $classe = $_POST['classeprocesso'];
  $natureza = $_POST['naturezaprocesso'];
  $ritoProcessoSelect = $_POST['ritoProcesso'];
  $ritoProcessoAdd = $_POST['ritoProcessoAdd'];
  $nprocesso = $_POST['numeroprocessocnj'];
  $numerovara = $_POST['numerovara'];
  $nomedavara = $_POST['nomedavara'];
  $outravara = $_POST['outronomedavara'];
  $nomedacomarca = $_POST['nomedacomarca'];
  $outronomedacomarca = $_POST['outronomedacomarca'];
  $valorCausa = $_POST['valorCausa'];
  $dataa = $_POST['dateabertura'];
  $valorhonorario = $_POST['valorhonorario'];
  $parcelas = $_POST['parcelas'];
  $cadreceita = $_POST['cadreceita'];
  $ob = $_POST['observacoes'];
  $posicao = $_POST['posicaocliente'];
  $nomecliente = $_POST['nomecliente'];
  $nomeadvogado = $_POST['advogadoatuando'];
  $segundoAdvogado = $_POST['segundoAdvogado'];
  $terceiroAdvogado = $_POST['terceiroAdvogado'];
  $nomefalecido = $_POST['nomefalecido'];
  $mes = $_POST['mes'];

  if ($ritoProcessoAdd != ''){
    $ritoProcesso = $ritoProcessoAdd;
  }else {
    $ritoProcesso = $ritoProcessoSelect;
  }

  if ($cadreceita != 'on') {
    $cadreceita = 'Desligado';
  } else {
    $cadreceita = 'Ligado';
  }

  if (!empty($outravara)) {
    $varadoprocesso = $outravara;
  } else {
    $varadoprocesso = $nomedavara;
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
    $classeprocesso = $outraclasse;
  } else {
    $classeprocesso = $classe;
  }

  switch ($poderjudiciario) {
    case 1:
      $poderjudiciario = 'Supremo Tribunal Federal';
      break;
    case 2:
      $poderjudiciario = 'Conselho Nacional de Justiça';
      break;
    case 3:
      $poderjudiciario = 'Superior Tribunal de Justiça';
      break;
    case 4:
      $poderjudiciario = 'Justiça Federal';
      break;
    case 5:
      $poderjudiciario = 'Justiça do Trabalho';
      break;
    case 6:
      $poderjudiciario = 'Justiça Eleitoral';
      break;
    case 7:
      $poderjudiciario = 'Justiça Militar da União';
      break;
    case 8:
      $poderjudiciario = 'Justiça dos Estados e do Distrito Federal e Territórios';
      break;
    case 9:
      $poderjudiciario = 'Justiça Militar Estadual';
  }

  if (!empty($outronomedacomarca)) {
    $nomecomarca = $outronomedacomarca;
  } else {
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
      $natureza = 'Previdencial';
      break;
    case 6:
      $natureza = 'Tributário';
      break;
    case 7:
      $natureza = 'Não definido';
  }

  // VERIFICAÇÃO CASO O CADASTRAR RECEITA FOI ATIVADO

  if($cadreceita == 'Ligado'){
    $result = mysqli_query(
      $conn,
      "INSERT INTO processo (valorHonorario, parcelas, cadreceita, stat, privado, posicaocliente, observacoes, nomecliente, nomeadvogado, segundoAdvogado, terceiroAdvogado, natureza, ritoProcesso, nprocesso, poderjudiciario, numerovara, nomedavara, nomedacomarca, valorCausa, fase, dataa, classe, falecido, mes)
          VALUES ('$valorhonorario', '$parcelas', '$cadreceita', '$status', '$privado', '$posicao', '$ob', '$nomecliente', '$nomeadvogado', '$segundoAdvogado', '$terceiroAdvogado', '$natureza', '$ritoProcesso', '$nprocesso', '$poderjudiciario', '$numerovara', '$varadoprocesso', '$nomecomarca', '$valorCausa', '$fase', '$dataa', '$classeprocesso', '$nomefalecido', '$mes')",
    );

    // DEFININDO AS VARIÁVEIS DE SESSÃO
    
    $_SESSION['nomeClienteProcesso'] = $nomecliente;
    $_SESSION['valorHonorarioProcesso'] = $valorhonorario;
    $_SESSION['observacoesProcesso'] = $ob;

    header('Location: ../Financeiro/Receitas/receitas_add.php');
    exit;
  }else{
    $result = mysqli_query(
      $conn,
      "INSERT INTO processo (valorHonorario, parcelas, cadreceita, stat, privado, posicaocliente, observacoes, nomecliente, nomeadvogado, segundoAdvogado, terceiroAdvogado, natureza, ritoProcesso, nprocesso, poderjudiciario, numerovara, nomedavara, nomedacomarca, valorCausa, fase, dataa, classe, falecido, mes)
          VALUES ('$valorhonorario', '$parcelas', '$cadreceita', '$status', '$privado', '$posicao', '$ob', '$nomecliente', '$nomeadvogado', '$segundoAdvogado', '$terceiroAdvogado', '$natureza', '$ritoProcesso', '$nprocesso', '$poderjudiciario', '$numerovara', '$varadoprocesso', '$nomecomarca', '$valorCausa', '$fase', '$dataa', '$classeprocesso', '$nomefalecido', '$mes')",
    );

    header('Location: processos.php');
    exit;
  }
}
