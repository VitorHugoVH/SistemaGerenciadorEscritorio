<?php
include_once('conexao_adm.php');

// VERIFICAÇÃO LOGIN
session_start();
$logged = $_SESSION['logged'] ?? NULL;

if (!$logged) {
  header('Location: /FragaeMelo/Site%20Fraga%20e%20Melo%20BootsTrap/login.php');
};

$id = $_GET['id'];

if (!empty($_GET['id'])) {

    $sql = "SELECT * FROM clientes WHERE id=$id";
    $result = $conn->query($sql);

    while ($data = mysqli_fetch_assoc($result)) {

        $nomecliente = $data['nomecliente'];
        $tipodocumento = $data['tipodocumento'];
        $cpf = $data['cpf'];
        $cnpj = $data['cnpj'];
        $sexo = $data['sexo'];
        $responsavel = $data['responsavel'];
        $datanascimento = $data['datanascimento'];
        $datafundacao = $data['datafundacao'];
        $rg = $data['rg'];
        $tipoempresa = $data['tipoempresa'];
        $estadocivil = $data['estadocivil'];
        $atividade = $data['atividade'];
        $profissao = $data['profissao'];
        $inscricao = $data['inscricao'];
        $nacionalidade = $data['nacionalidade'];
        $observacoa = $data['observacao'];

        ##EMAILS##
        $email1 = $data['email1'];
        $email2 = $data['email2'];
        $email3 = $data['email3'];

        ##TELEFONES##
        $tipocontato = $data['tipocontato1'];
        $ddi1 = $data['ddi1'];
        $ddd1 = $data['ddd1'];
        $numero1 = $data['numero1'];
        $tipocontato2 = $data['tipocontato2'];
        $ddi2 = $data['ddi2'];
        $ddd2 = $data['ddd2'];
        $numero2 = $data['numero2'];
        $tipocontato3 = $data['tipocontato3'];
        $ddi3 = $data['ddi3'];
        $ddd3 = $data['ddd3'];
        $numero3 = $data['numero3'];

        ##ENDEREÇOS##
        $cep1 = $data['cep1'];
        $endereco1 = $data['endereco1'];
        $numerocasa1 = $data['numerocasa1'];
        $complemento1 = $data['complemento1'];
        $bairro1 = $data['bairro1'];
        $cidade1 = $data['cidade1'];
        $estado1 = $data['estado1'];

        $cep2 = $data['cep2'];
        $endereco2 = $data['endereco2'];
        $numerocasa2 = $data['numerocasa2'];
        $complemento2 = $data['complemento2'];
        $bairro2 = $data['bairro2'];
        $cidade2 = $data['cidade2'];
        $estado2 = $data['estado2'];

        ##DADOS LOGIN##
        $login = $data['login'];
        $senha = $data['senha'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="estilosAdm.css" />
    <link rel="icon" type="image/x-icon" href="imagens/icon.png" />
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar::-webkit-scrollbar {
            width: 10px;
        }

        .sidebar::-webkit-scrollbar-track {
            background-color: #fff;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background-color: #4d79ff;
            border-radius: 10px;
            opacity: 0.1;
            /* Define a opacidade da barra de rolagem */
        }
    </style>
    <title>Fraga e Melo Advogados Associados</title>
</head>

<body>
    <div class="wrapper">
        <div class="section">
            <div class="top_navbar">
                <a href="/Users/vh007/OneDrive/%C3%81rea%20de%20Trabalho/Tudo/Site%20TCC/Site%20Fraga%20e%20Melo%20BootsTrap/index.php" class="link"><button class="button button4">Voltar</button></a>
            </div>
            <div class="container" id='main'>
                <form action="clientes_save.php" method="POST">
                    <div class="row">
                        <div class="col-10">
                            <div class="bloco3">
                                <h3 class="text-muted">Adicionar</h3>
                            </div>
                        </div>
                        <div class="col-2">
                            <div id="voltar">
                                <a href="clientes.php"><button type="button" class="btn btn-secondary" id='voltar1'>Volar</button></a>
                            </div>
                        </div>
                    </div>
                    <div class="bloco4">
                        <div class="row">
                            <div class="titulo">
                                <h4 class="title"><b>Dados do cliente</b></h4>
                            </div>
                            <div class="campos">
                                <label><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Nome</h6>
                                    </b></label>
                                <input type="text" name="nomecliente" id="nomecliente" class="form-control" placeholder="Nome" value="<?php echo $nomecliente; ?>">
                            </div>
                            <div class="campos">
                                <div class="row">
                                    <label for="tipodocumento"><b>
                                            <h6 style="font-family: arial, sans-serif; font-size: 16px;">Documento</h6>
                                        </b></label>
                                    <div class="col-4">
                                        <select class="form-select" name="tipodocumento" id="tipodocumento" onchange="documento()">
                                            <option value="CPF" <?= ($tipodocumento == 'CPF') ? 'selected' : ' ' ?>>CPF</option>
                                            <option value="CNPJ" <?= ($tipodocumento == 'CNPJ') ? 'selected' : ' ' ?>>CNPJ</option>
                                        </select>
                                    </div>
                                    <div class="col-8">
                                        <input type="text" name="numerocpf" id="numerocpf" class="form-control" placeholder="Número do CPF" value="<?php echo $cpf ?>" maxlength="11" oninput="mascara(this)">
                                        <!-- Javascript--->
                                        <input type="hidden" name="numerocnpj" id="numerocnpj" class="form-control" placeholder="Número do CNPJ" value="<?php echo $cnpj ?>" maxlength="11" oninput="mascara(this)">
                                        <!-- Javascript--->
                                    </div>
                                    <script>
                                        function mascara(i) {

                                            var v = i.value;

                                            if (isNaN(v[v.length - 1])) { // impede entrar outro caractere que não seja número
                                                i.value = v.substring(0, v.length - 1);
                                                return;
                                            }

                                            i.setAttribute("maxlength", "14");
                                            if (v.length == 3 || v.length == 7) i.value += ".";
                                            if (v.length == 11) i.value += "-";

                                        }
                                    </script>
                                </div>
                            </div>
                            <div id="campos3" style="margin-top: 0%; margin-bottom: 2%; display:block;">
                                <label for="sexo"><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Sexo</h6>
                                    </b></label>
                                <select class="form-select" name="sexo" id="sexo">
                                    <option <?= ($sexo == 'Masculino') ? 'selected' : ' ' ?>>Masculino</option>
                                    <option <?= ($sexo == 'Feminino') ? 'selected' : ' ' ?>>Feminino</option>
                                </select>
                            </div>
                            <!-- Javascript--->
                            <div id="segundacampos2" style="display: none; margin-top: 0%; margin-bottom: 2%;">
                                <label for="responsavel"><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Responsável</h6>
                                    </b></label>
                                <input type="text" name="resposavel" id="responsavel" placeholder="Responsável" class="form-control" value="<?php echo $responsavel; ?>">
                            </div>
                            <!-- Javascript--->
                            <div id="campos4" style="margin-top: 0%; margin-bottom: 2%; display: block;">
                                <label for="datanascimento"><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Data de nascimento</h6>
                                    </b></label>
                                <input type="date" name="datanascimento" id="datanascimento" class="form-control" placeholder="__/__/__" value="<?php echo $datanascimento; ?>">
                            </div>
                            <!-- Javascript--->
                            <div id="segundacampos3" style="display: none; margin-top: 0%; margin-bottom: 2%;">
                                <label><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Data da fundação</h6>
                                    </b></label>
                                <input type="date" name="datafundacao" id="datafundacao" class="form-control" placeholder="__/__/__" value="<?php echo $datafundacao; ?>">
                            </div>
                            <!-- Javascript--->
                            <div id="campos5" style="  margin-top: 0%; margin-bottom: 2%; display:block;">
                                <label for="numerorg"><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">RG</h6>
                                    </b></label>
                                <input type="text" name="numerorg" id="numerorg" class="form-control" placeholder="Número do RG" value="<?php echo $rg; ?>">
                            </div>
                            <!-- Javascript--->
                            <div id="segundacampos4" style="display: none; margin-top: 0%; margin-bottom: 2%;">
                                <label for="tipoempresa"><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Tipo de empresa</h6>
                                    </b></label>
                                <input type="text" name="tipoempresa" id="tipoempresa" class="form-control" placeholder="Tipo de empresa" value="<?php echo $tipoempresa; ?>">
                            </div>
                            <!-- Javascript--->
                            <div id="campos6" style="  margin-top: 0%; margin-bottom: 2%; display:block;">
                                <label for="estadocivil"><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Estado civil</h6>
                                    </b></label>
                                <select class="form-select" name="estadocivil" id="estadocivil">
                                    <option <?= ($estadocivil == 'Solteiro(a)') ? 'selected' : ' ' ?>>Solteiro(a)</option>
                                    <option <?= ($estadocivil == 'Casado(a)') ? 'selected' : ' ' ?>>Casado(a)</option>
                                    <option <?= ($estadocivil == 'Separado(a) judicialmente') ? 'selected' : ' ' ?>>Separado(a) judicialmente</option>
                                    <option <?= ($estadocivil == 'Divorciado(a)') ? 'selected' : ' ' ?>>Divorciado(a)</option>
                                    <option <?= ($estadocivil == 'Viúvo(a)') ? 'selected' : ' ' ?>>Viúvo(a)</option>
                                    <option <?= ($estadocivil == 'União estável') ? 'selected' : ' ' ?>>União estável</option>
                                </select>
                            </div>
                            <!-- Javascript--->
                            <div id="segundacampos5" style="display: none; margin-top: 0%; margin-bottom: 2%;">
                                <label for="atividadeprincipal"><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Atividade principal</h6>
                                    </b></label>
                                <input type="text" name="atividadeprincipal" id="atividadeprincipal" class="form-control" placeholder="Atividade principal" value="<?php echo $atividade; ?>">
                            </div>
                            <!-- Javascript--->
                            <div id="campos7" style="  margin-top: 0%; margin-bottom: 2%; display:block;">
                                <label for="profissao"><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Profissão</h6>
                                    </b></label>
                                <input type="text" name="profissao" id="profissao" placeholder="Profissão" class="form-control" value="<?php echo $profissao; ?>">
                            </div>
                            <!-- Javascript--->
                            <div id="segundacampos6" style="display: none; margin-top: 0%; margin-bottom: 2%;">
                                <label for="inscricao"><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Inscrição estadual</h6>
                                    </b></label>
                                <input type="text" name="inscricao" id="inscricao" placeholder="Inscrição estadual" class="form-control" value="<?php echo $inscricao; ?>">
                            </div>
                            <!-- Javascript--->
                            <div class="campos">
                                <label for="nacionalidade"><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Nacionalidade</h6>
                                    </b></label>
                                <select class="form-select" name="nacionalidade" id="nacionalidade">
                                    <option <?= ($nacionalidade == 'brasileiro') ? 'selected' : ' ' ?>>brasileiro</option>
                                    <option <?= ($nacionalidade == 'argentino') ? 'selected' : ' ' ?>>argentino</option>
                                    <option <?= ($nacionalidade == 'colombiano') ? 'selected' : ' ' ?>>colombiano</option>
                                    <option <?= ($nacionalidade == 'peruano') ? 'selected' : ' ' ?>>peruano</option>
                                    <option <?= ($nacionalidade == 'chileno') ? 'selected' : ' ' ?>>chileno</option>
                                    <option <?= ($nacionalidade == 'equatoriano') ? 'selected' : ' ' ?>>equatoriano</option>
                                    <option <?= ($nacionalidade == 'uruguaiano') ? 'selected' : ' ' ?>>uruguaiano</option>
                                    <option <?= ($nacionalidade == 'venezuelano') ? 'selected' : ' ' ?>>venezuelano</option>
                                    <option <?= ($nacionalidade == 'boliviano') ? 'selected' : ' ' ?>>boliviano</option>
                                    <option <?= ($nacionalidade == 'guianense') ? 'selected' : ' ' ?>>guianense</option>
                                    <option <?= ($nacionalidade == 'surinamense') ? 'selected' : ' ' ?>>surinamense</option>
                                    <option <?= ($nacionalidade == 'paraguaiano') ? 'selected' : ' ' ?>>paraguaiano</option>
                                    <option <?= ($nacionalidade == 'franco-guianense') ? 'selected' : ' ' ?>>franco-guianense</option>
                                </select>
                            </div>
                            <div class="campos">
                                <label for="observacoes"><b>
                                        <h6 style="font-family: arial, sans-serif; font-size: 16px;">Observação</h6>
                                    </b></label>
                                <textarea name="observacoes" id="observacoes" col="3" class="form-control" placeholder="Observação"><?php echo $observacoa; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="bloco5">
                        <div class="row">
                            <div class="titulo">
                                <h4 class="title"><b>Emails</b></h4>
                            </div>
                            <div class="campos">
                                <div class="input-group">
                                    <input type="email" name="email" id="email" placeholder="Email" class="form-control" value="<?php echo $email1; ?>">
                                    <div class="input-group-append">
                                        <input type="button" value="Adicionar e-mail" name="addemail" id="addemail" class="btn btn-secondary" onclick="adde1()">
                                    </div>
                                </div>
                                <div id="email2" style="margin-top: 2%; margin-bottom: 2%; display: none;">
                                    <div class="input-group">
                                        <input type="email" name="email2" id="email2" placeholder="Email" class="form-control" value="<?php echo $email2; ?>">
                                        <div class="input-group-append">
                                            <input type="button" value="Adicionar e-mail" name="addemail2" id="addemail2" class="btn btn-secondary" onclick="adde2()">
                                        </div>
                                    </div>
                                </div>
                                <div id="email3" style="margin-top: 2%; margin-bottom: 2%; display: none;">
                                    <div class="input-group">
                                        <input type="email" name="email3" id="email3" placeholder="Email" class="form-control" value="<?php echo $email3; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bloco5">
                        <div class="row">
                            <div class="titulo">
                                <h4 class="title"><b>Telefones</b></h4>
                            </div>
                            <div class="campos">
                                <div class="row">
                                    <div class="col-3">
                                        <label for="tipocontato"><b>
                                                <h6 style="font-family: arial, sans-serif; font-size: 16px;">Tipo contato</h6>
                                            </b></label>
                                        <select class="form-select" name="tipocontato" id="tipocontato">
                                            <option <?= ($tipocontato == 'Telefone') ? 'selected' : ' ' ?>>Telefone</option>
                                            <option <?= ($tipocontato == 'Fax') ? 'selected' : ' ' ?>>Fax</option>
                                            <option <?= ($tipocontato == 'Celular') ? 'selected' : ' ' ?>>Celular</option>
                                            <option <?= ($tipocontato == 'Residencial') ? 'selected' : ' ' ?>>Residencial</option>
                                            <option <?= ($tipocontato == 'Comercial') ? 'selected' : ' ' ?>>Comercial</option>
                                            <option <?= ($tipocontato == 'Nextel') ? 'selected' : ' ' ?>>Nextel</option>
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <label for="ddi"><b>
                                                <h6 style="font-family: arial, sans-serif; font-size: 16px;">DDI</h6>
                                            </b></label>
                                        <input type="number" name="ddi" id="ddi" class="form-control" maxlength="2" placeholder="55" value="<?php echo $ddi1; ?>">
                                    </div>
                                    <div class="col-2">
                                        <label for="ddd"><b>
                                                <h6 style="font-family: arial, sans-serif; font-size: 16px;">DDD</h6>
                                            </b></label>
                                        <input type="number" name="ddd" id="ddd" class="form-control" maxlength="2" placeholder="DDD" value="<?php echo $ddd1; ?>">
                                    </div>
                                    <div class="col-5">
                                        <label for="numero"><b>
                                                <h6 style="font-family: arial, sans-serif; font-size: 16px;">Número</h6>
                                            </b></label>
                                        <input type="number" name="numero" id="numero" class="form-control" maxlength="2" placeholder="Telefone" value="<?php echo $numero1; ?>">
                                    </div>
                                </div>
                                <!--Javascript Telefone2--->
                                <div id="telefone2" style="  margin-top: 2%; margin-bottom: 2%; display: none;">
                                    <div class="row">
                                        <div class="col-3">
                                            <label for="tipocontato2"><b>
                                                    <h6 style="font-family: arial, sans-serif; font-size: 16px;">Tipo contato</h6>
                                                </b></label>
                                            <select class="form-select" name="tipocontato2" id="tipocontato2">
                                                <option <?= ($tipocontato2 == 'Telefone') ? 'selected' : ' ' ?>>Telefone</option>
                                                <option <?= ($tipocontato2 == 'Fax') ? 'selected' : ' ' ?>>Fax</option>
                                                <option <?= ($tipocontato2 == 'Celular') ? 'selected' : ' ' ?>>Celular</option>
                                                <option <?= ($tipocontato2 == 'Residencial') ? 'selected' : ' ' ?>>Residencial</option>
                                                <option <?= ($tipocontato2 == 'Comercial') ? 'selected' : ' ' ?>>Comercial</option>
                                                <option <?= ($tipocontato2 == 'Nextel') ? 'selected' : ' ' ?>>Nextel</option>
                                            </select>
                                        </div>
                                        <div class="col-2">
                                            <label for="ddi2"><b>
                                                    <h6 style="font-family: arial, sans-serif; font-size: 16px;">DDI</h6>
                                                </b></label>
                                            <input type="number" name="ddi2" id="ddi2" class="form-control" maxlength="2" placeholder="55" value="<?php echo $ddi2; ?>">
                                        </div>
                                        <div class="col-2">
                                            <label for="ddd2"><b>
                                                    <h6 style="font-family: arial, sans-serif; font-size: 16px;">DDD</h6>
                                                </b></label>
                                            <input type="number" name="ddd2" id="ddd2" class="form-control" maxlength="2" placeholder="DDD" value="<?php echo $ddd2; ?>">
                                        </div>
                                        <div class="col-5">
                                            <label for="numero2"><b>
                                                    <h6 style="font-family: arial, sans-serif; font-size: 16px;">Número</h6>
                                                </b></label>
                                            <input type="number" name="numero2" id="numero2" class="form-control" maxlength="2" placeholder="Telefone" value="<?php echo $numero2; ?>">
                                        </div>
                                    </div>
                                </div>
                                <!--Javascript Telefone3--->
                                <div id="telefone3" style="  margin-top: 2%; margin-bottom: 2%; display: none;">
                                    <div class="row">
                                        <div class="col-3">
                                            <label for="tipocontato3"><b>
                                                    <h6 style="font-family: arial, sans-serif; font-size: 16px;">Tipo contato</h6>
                                                </b></label>
                                            <select class="form-select" name="tipocontato3" id="tipocontato3">
                                                <option <?= ($tipocontato3 == 'Telefone') ? 'selected' : ' ' ?>>Telefone</option>
                                                <option <?= ($tipocontato3 == 'Fax') ? 'selected' : ' ' ?>>Fax</option>
                                                <option <?= ($tipocontato3 == 'Celular') ? 'selected' : ' ' ?>>Celular</option>
                                                <option <?= ($tipocontato3 == 'Residencial') ? 'selected' : ' ' ?>>Residencial</option>
                                                <option <?= ($tipocontato3 == 'Comercial') ? 'selected' : ' ' ?>>Comercial</option>
                                                <option <?= ($tipocontato3 == 'Nextel') ? 'selected' : ' ' ?>>Nextel</option>
                                            </select>
                                        </div>
                                        <div class="col-2">
                                            <label for="ddi3"><b>
                                                    <h6 style="font-family: arial, sans-serif; font-size: 16px;">DDI</h6>
                                                </b></label>
                                            <input type="number" name="ddi3" id="ddi3" class="form-control" maxlength="2" placeholder="55" value="<?php echo $ddi3; ?>">
                                        </div>
                                        <div class="col-2">
                                            <label for="ddd3"><b>
                                                    <h6 style="font-family: arial, sans-serif; font-size: 16px;">DDD</h6>
                                                </b></label>
                                            <input type="number" name="ddd3" id="ddd3" class="form-control" maxlength="2" placeholder="DDD" value="<?php echo $ddd3; ?>">
                                        </div>
                                        <div class="col-5">
                                            <label for="numero3"><b>
                                                    <h6 style="font-family: arial, sans-serif; font-size: 16px;">Número</h6>
                                                </b></label>
                                            <input type="number" name="numero3" id="numero3" class="form-control" maxlength="2" placeholder="Telefone" value="<?php echo $numero3; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="campos">
                                <input type="button" value="Adicionar telefone" name="addmais1" id="addmais1" class="btn btn-secondary" onclick="addtel1()">
                                <input type="hidden" value="Adicionar telefone" name="addmais2" id="addmais2" class="btn btn-secondary" onclick="addtel2()">
                            </div>
                        </div>
                    </div>
                    <div class="bloco5">
                        <div class="titulo">
                            <h4 class="title"><b>Endereço</b></h4>
                        </div>
                        <div class="campos">
                            <label for="cep"><b>
                                    <h6 style="font-family: arial, sans-serif; font-size: 16px;">CEP</h6>
                                </b></label>
                            <input type="text" name="cep" id="cep" class="form-control" placeholder="CEP" maxlength="8" value="<?php echo $cep1; ?>">
                        </div>
                        <div class="campos">
                            <div class="row">
                                <div class="col-9">
                                    <label for="endereco"><b>
                                            <h6 style="font-family: arial, sans-serif; font-size: 16px;">Endereço</h6>
                                        </b></label>
                                    <input type="text" name="endereco" id="endereco" class="form-control" placeholder="Endereço" value="<?php echo $endereco1; ?>">
                                </div>
                                <div class="col-3">
                                    <label for="numerocasa"><b>
                                            <h6 style="font-family: arial, sans-serif; font-size: 16px;">Número</h6>
                                        </b></label>
                                    <input type="text" name="numerocasa" id="numerocasa" class="form-control" placeholder="Número" value="<?php echo $numerocasa1; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="campos">
                            <label for="complemento"><b>
                                    <h6 style="font-family: arial, sans-serif; font-size: 16px;">Complemento</h6>
                                </b></label>
                            <input type="text" name="complemento" id="complemento" class="form-control" placeholder="Complemento" value="<?php echo $complemento1; ?>">
                        </div>
                        <div class="campos">
                            <div class="row">
                                <div class="col-4">
                                    <label for="bairro"><b>
                                            <h6 style="font-family: arial, sans-serif; font-size: 16px;">Bairro</h6>
                                        </b></label>
                                    <input type="text" name="bairro" id="bairro" class="form-control" placeholder="Bairro" value="<?php echo $bairro1; ?>">
                                </div>
                                <div class="col-4">
                                    <label for="cidade"><b>
                                            <h6 style="font-family: arial, sans-serif; font-size: 16px;">Cidade</h6>
                                        </b></label>
                                    <input type="text" name="cidade" id="cidade" class="form-control" placeholder="Cidade" value="<?php echo $cidade1; ?>">
                                </div>
                                <div class="col-4">
                                    <label for="estado"><b>
                                            <h6 style="font-family: arial, sans-serif; font-size: 16px;">Estado</h6>
                                        </b></label>
                                    <select class="form-select" id="estado" name="estado">
                                        <option value="">Selecione</option>
                                        <option value="AC" <?= ($estado1 == 'AC') ? 'selected' : ' ' ?>>AC</option>
                                        <option value="AL" <?= ($estado1 == 'AL') ? 'selected' : ' ' ?>>AL</option>
                                        <option value="AP" <?= ($estado1 == 'AP') ? 'selected' : ' ' ?>>AP</option>
                                        <option value="AM" <?= ($estado1 == 'AM') ? 'selected' : ' ' ?>>AM</option>
                                        <option value="BA" <?= ($estado1 == 'BA') ? 'selected' : ' ' ?>>BA</option>
                                        <option value="CE" <?= ($estado1 == 'CE') ? 'selected' : ' ' ?>>CE</option>
                                        <option value="DF" <?= ($estado1 == 'DF') ? 'selected' : ' ' ?>>DF</option>
                                        <option value="ES" <?= ($estado1 == 'ES') ? 'selected' : ' ' ?>>ES</option>
                                        <option value="GO" <?= ($estado1 == 'GO') ? 'selected' : ' ' ?>>GO</option>
                                        <option value="MA" <?= ($estado1 == 'MA') ? 'selected' : ' ' ?>>MA</option>
                                        <option value="MS" <?= ($estado1 == 'MS') ? 'selected' : ' ' ?>>MS</option>
                                        <option value="MT" <?= ($estado1 == 'MT') ? 'selected' : ' ' ?>>MT</option>
                                        <option value="MG" <?= ($estado1 == 'MG') ? 'selected' : ' ' ?>>MG</option>
                                        <option value="PA" <?= ($estado1 == 'PA') ? 'selected' : ' ' ?>>PA</option>
                                        <option value="PB" <?= ($estado1 == 'PB') ? 'selected' : ' ' ?>>PB</option>
                                        <option value="PR" <?= ($estado1 == 'PR') ? 'selected' : ' ' ?>>PR</option>
                                        <option value="PE" <?= ($estado1 == 'PE') ? 'selected' : ' ' ?>>PE</option>
                                        <option value="PI" <?= ($estado1 == 'PI') ? 'selected' : ' ' ?>>PI</option>
                                        <option value="RJ" <?= ($estado1 == 'RJ') ? 'selected' : ' ' ?>>RJ</option>
                                        <option value="RN" <?= ($estado1 == 'RN') ? 'selected' : ' ' ?>>RN</option>
                                        <option value="RS" <?= ($estado1 == 'RS') ? 'selected' : ' ' ?>>RS</option>
                                        <option value="RO" <?= ($estado1 == 'RO') ? 'selected' : ' ' ?>>RO</option>
                                        <option value="RR" <?= ($estado1 == 'RR') ? 'selected' : ' ' ?>>RR</option>
                                        <option value="SC" <?= ($estado1 == 'SC') ? 'selected' : ' ' ?>>SC</option>
                                        <option value="SP" <?= ($estado1 == 'SP') ? 'selected' : ' ' ?>>SP</option>
                                        <option value="SE" <?= ($estado1 == 'SE') ? 'selected' : ' ' ?>>SE</option>
                                        <option value="TO" <?= ($estado1 == 'TO') ? 'selected' : ' ' ?>>TO</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="campos">
                            <input type="button" value="Adicionar endereço" name="addmaisendereco" id="addmaisendereco" class="btn btn-secondary" onclick="addcep()">
                        </div>
                    </div>
                    <!--Javascript Add Endereço---->
                    <div id="addendereco" style="background-color: #fcfcfc; padding: 2%; margin-top: 5%; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; display: none;">
                        <div class="titulo">
                            <h4 class="title"><b>Endereço 2</b></h4>
                        </div>
                        <div class="campos">
                            <label for="cep2"><b>
                                    <h6 style="font-family: arial, sans-serif; font-size: 16px;">CEP</h6>
                                </b></label>
                            <input type="text" name="cep2" id="cep2" class="form-control" placeholder="CEP" maxlength="8" value="<?php echo $cep2; ?>">
                        </div>
                        <div class="campos">
                            <div class="row">
                                <div class="col-9">
                                    <label for="endereco2"><b>
                                            <h6 style="font-family: arial, sans-serif; font-size: 16px;">Endereço</h6>
                                        </b></label>
                                    <input type="text" name="endereco2" id="endereco2" class="form-control" placeholder="Endereço" value="<?php echo $endereco2; ?>">
                                </div>
                                <div class="col-3">
                                    <label for="numerocasa2"><b>
                                            <h6 style="font-family: arial, sans-serif; font-size: 16px;">Número</h6>
                                        </b></label>
                                    <input type="text" name="numerocasa2" id="numerocasa2" class="form-control" placeholder="Número" value="<?php echo $numerocasa2; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="campos">
                            <label for="complemento2"><b>
                                    <h6 style="font-family: arial, sans-serif; font-size: 16px;">Complemento</h6>
                                </b></label>
                            <input type="text" name="complemento2" id="complemento2" class="form-control" placeholder="Complemento" value="<?php echo $complemento2; ?>">
                        </div>
                        <div class="campos">
                            <div class="row">
                                <div class="col-4">
                                    <label for="bairro2"><b>
                                            <h6 style="font-family: arial, sans-serif; font-size: 16px;">Bairro</h6>
                                        </b></label>
                                    <input type="text" name="bairro2" id="bairro2" class="form-control" placeholder="Bairro" value="<?php echo $bairro2; ?>">
                                </div>
                                <div class="col-4">
                                    <label for="cidade2"><b>
                                            <h6 style="font-family: arial, sans-serif; font-size: 16px;">Cidade</h6>
                                        </b></label>
                                    <input type="text" name="cidade2" id="cidade2" class="form-control" placeholder="Cidade" value="<?php echo $cidade2; ?>">
                                </div>
                                <div class="col-4">
                                    <label for="estado2"><b>
                                            <h6 style="font-family: arial, sans-serif; font-size: 16px;">Estado</h6>
                                        </b></label>
                                    <select class="form-select" id="estado2" name="estado2">
                                        <option value="">Selecione</option>
                                        <option value="AC" <?= ($estado2 == 'AC') ? 'selected' : ' ' ?>>AC</option>
                                        <option value="AL" <?= ($estado2 == 'AL') ? 'selected' : ' ' ?>>AL</option>
                                        <option value="AP" <?= ($estado2 == 'AP') ? 'selected' : ' ' ?>>AP</option>
                                        <option value="AM" <?= ($estado2 == 'AM') ? 'selected' : ' ' ?>>AM</option>
                                        <option value="BA" <?= ($estado2 == 'BA') ? 'selected' : ' ' ?>>BA</option>
                                        <option value="CE" <?= ($estado2 == 'CE') ? 'selected' : ' ' ?>>CE</option>
                                        <option value="DF" <?= ($estado2 == 'DF') ? 'selected' : ' ' ?>>DF</option>
                                        <option value="ES" <?= ($estado2 == 'ES') ? 'selected' : ' ' ?>>ES</option>
                                        <option value="GO" <?= ($estado2 == 'GO') ? 'selected' : ' ' ?>>GO</option>
                                        <option value="MA" <?= ($estado2 == 'MA') ? 'selected' : ' ' ?>>MA</option>
                                        <option value="MS" <?= ($estado2 == 'MS') ? 'selected' : ' ' ?>>MS</option>
                                        <option value="MT" <?= ($estado2 == 'MT') ? 'selected' : ' ' ?>>MT</option>
                                        <option value="MG" <?= ($estado2 == 'MG') ? 'selected' : ' ' ?>>MG</option>
                                        <option value="PA" <?= ($estado2 == 'PA') ? 'selected' : ' ' ?>>PA</option>
                                        <option value="PB" <?= ($estado2 == 'PB') ? 'selected' : ' ' ?>>PB</option>
                                        <option value="PR" <?= ($estado2 == 'PR') ? 'selected' : ' ' ?>>PR</option>
                                        <option value="PE" <?= ($estado2 == 'PE') ? 'selected' : ' ' ?>>PE</option>
                                        <option value="PI" <?= ($estado2 == 'PI') ? 'selected' : ' ' ?>>PI</option>
                                        <option value="RJ" <?= ($estado2 == 'RJ') ? 'selected' : ' ' ?>>RJ</option>
                                        <option value="RN" <?= ($estado2 == 'RN') ? 'selected' : ' ' ?>>RN</option>
                                        <option value="RS" <?= ($estado2 == 'RS') ? 'selected' : ' ' ?>>RS</option>
                                        <option value="RO" <?= ($estado2 == 'RO') ? 'selected' : ' ' ?>>RO</option>
                                        <option value="RR" <?= ($estado2 == 'RR') ? 'selected' : ' ' ?>>RR</option>
                                        <option value="SC" <?= ($estado2 == 'SC') ? 'selected' : ' ' ?>>SC</option>
                                        <option value="SP" <?= ($estado2 == 'SP') ? 'selected' : ' ' ?>>SP</option>
                                        <option value="SE" <?= ($estado2 == 'SE') ? 'selected' : ' ' ?>>SE</option>
                                        <option value="TO" <?= ($estado2 == 'TO') ? 'selected' : ' ' ?>>TO</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="campos">
                            <input type="button" value="Excluir endereço" name="retirarendereco" id="retirarendereco" class="btn btn-primary" onclick="retirar()">
                        </div>
                    </div>
                    <!--Final Add Endereço---->
                    <div class="bloco5">
                        <div class="titulo">
                            <h4 class="title"><b>Dados para acesso</b></h4>
                        </div>
                        <div class="campos">
                            <label for="login"><b>
                                    <h6 style="font-family: arial, sans-serif; font-size: 16px;">Login</h6>
                                </b></label>
                            <input type="text" name="login" id="login" class="form-control" placeholder="Login" value="<?php echo $login; ?>">
                        </div>
                        <div class="campos">
                            <label for="senha"><b>
                                    <h6 style="font-family: arial, sans-serif; font-size: 16px;">Senha</h6>
                                </b></label>
                            <div class="input-group">
                                <input type="password" name="senha" id="senha" class="form-control" placeholder="Senha" value="<?php echo $senha; ?>">
                                <div class="input-group-append" name="notview" id="notview" style="display: block;">
                                    <a class='btn btn-sm btn-primary' onclick="view()">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="30" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16">
                                            <path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z" />
                                            <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z" />
                                        </svg>
                                    </a>
                                </div>
                                <div class="input-group-append" name="view" id="view" style="display: none;">
                                    <a class='btn btn-sm btn-primary' onclick="notview()">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="30" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="datacriacao" value="<?php echo date('d/m/Y') ?>">
                    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                    <div class="final">
                        <div class="row">
                            <div class="col-8">

                            </div>
                            <div class="col-2">
                                <div id="salvar">
                                    <a href="clientes.php"><button type="button" class="btn btn-outline-secondary" id="voltar2">Cancelar</button></a>
                                </div>
                            </div>
                            <div class="col-2">
                                <div id="voltar">
                                    <a href="clientes_insert.php"><button type="submit" class="btn btn-success" name="enviar" id="salvar">Atualizar</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--INÍCIO NAVEGAÇÃO-->
        <div class="sidebar" style="overflow-y: scroll; ">
            <div class="profile">
                <img src="imagensADM/logoadmin.png" alt="profile_picture" width="35%">
                <h3>Advocacia</h3>
                <p>Fraga e Melo Advogados</p>
            </div>
            <ul class="lista">
                <li>
                    <a class="active">
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
                <div class="dropdown">
                    <li>
                        <a class="links">
                            <span class="icon"><i class="fas fa-calendar-days"></i></span>
                            <span class="item">Agenda</span>
                            <svg xmlns="http://www.w3.org/2000/svg" style="margin-left: 40%;" width="16" height="13" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                            </svg>
                        </a>
                    </li>
                    <div class="dropdown-content">
                        <li>
                            <a href="agenda_compromissos.php" class="links" style="width: 100%;">
                                <span class="item2" style="margin-left: 15%;">Compromissos</span>
                            </a>
                        </li>
                        <li>
                            <a href="agenda_tarefas.php" class="links">
                                <span class="item2" style="margin-left: 15%; width: 100%;">Tarefas</span>
                            </a>
                        </li>
                        <li>
                            <a href="agenda_prazos.php" class="links">
                                <span class="item2" style="margin-left: 15%;">Prazos</span>
                            </a>
                        </li>
                    </div>
                </div>
                <li>
                    <a href="site_marketing.php" class="links">
                        <span class="icon"><i class="fas fa-rocket"></i></span>
                        <span class="item">Marketing</span>
                    </a>
                </li>
                <div class="dropdown">
                    <li>
                        <a href="financeiro.php" class="links">
                            <span class="icon"><i class="fas fa-dollar-sign"></i></span>
                            <span class="item">Financeiro</span>
                            <svg xmlns="http://www.w3.org/2000/svg" style="margin-left: 27%;" width="16" height="13" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
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
                            <a href="receitas.php" class="links">
                                <span class="item2" style="margin-left: 15%; width: 100%;">Receitas</span>
                            </a>
                        </li>
                    </div>
                </div>
                <div class="dropdown">
                    <li>
                        <a href="#" class="active">
                            <span class="icon"><i class="fas fa-users"></i></span>
                            <span class="item">Equipe</span>
                            <svg xmlns="http://www.w3.org/2000/svg" style="margin-left: 41%;" width="16" height="13" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                            </svg>
                        </a>
                    </li>
                    <div class="dropdown-content">
                        <li>
                            <a href="clientes.php" class="active" style="width: 100%;">
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
                <div class="dropdown">
                    <li>
                        <a href="#" class="links">
                            <span class="icon"><i class="fas fa-file"></i></span>
                            <span class="item">Arquivos</span>
                            <svg xmlns="http://www.w3.org/2000/svg" style="margin-left: 33%;" width="16" height="13" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                            </svg>
                        </a>
                    </li>
                    <div class="dropdown-content">
                        <li>
                            <a href="procuracoes.php" class="links" style="width: 100%;">
                                <span class="item2" style="margin-left: 15%;">Procuração</span>
                            </a>
                        </li>
                        <li>
                            <a href="declaracoes.php" class="links" style="width: 100%;">
                                <span class="item2" style="margin-left: 15%;">Declaração</span>
                            </a>
                        </li>
                        <li>
                            <a href="contrato.php" class="links" style="width: 100%;">
                                <span class="item2" style="margin-left: 15%;">Contrato</span>
                            </a>
                        </li>
                    </div>
                </div>
                <li>
                    <a href="configuracoes.php" class="links">
                        <span class="icon"><i class="fas fa-edit"></i></span>
                        <span class="item">Editor de Texto</span>
                    </a>
                </li>
            </ul>
        </div>
        <!--FIM NAVEGAÇÃO-->
</body>
<script>
    function documento() {
        if (document.getElementById('tipodocumento').value == 'CNPJ') {
            document.getElementById('numerocpf').type = 'hidden';
            document.getElementById('numerocnpj').type = 'text';

            /*Javascript CPF*/
            document.getElementById('campos3').style.display = 'none';
            document.getElementById('campos4').style.display = 'none';
            document.getElementById('campos5').style.display = 'none';
            document.getElementById('campos6').style.display = 'none';
            document.getElementById('campos7').style.display = 'none';

            /*Javascript CNPJ*/
            document.getElementById('segundacampos2').style.display = 'block';
            document.getElementById('segundacampos3').style.display = 'block';
            document.getElementById('segundacampos4').style.display = 'block';
            document.getElementById('segundacampos5').style.display = 'block';
            document.getElementById('segundacampos6').style.display = 'block';
            document.getElementById('segundacampos7').style.display = 'block';

        } else {
            document.getElementById('numerocpf').type = 'text';
            document.getElementById('numerocnpj').type = 'hidden';

            document.getElementById('campos3').style.display = 'block';
            document.getElementById('campos4').style.display = 'block';
            document.getElementById('campos5').style.display = 'block';
            document.getElementById('campos6').style.display = 'block';
            document.getElementById('campos7').style.display = 'block';

            document.getElementById('segundacampos2').style.display = 'none';
            document.getElementById('segundacampos3').style.display = 'none';
            document.getElementById('segundacampos4').style.display = 'none';
            document.getElementById('segundacampos5').style.display = 'none';
            document.getElementById('segundacampos6').style.display = 'none';
            document.getElementById('segundacampos7').style.display = 'none';
        }
    }

    function adde1() {
        document.getElementById('email2').style.display = 'block';
        document.getElementById('addemail').type = 'hidden';
    }

    function adde2() {
        document.getElementById('email3').style.display = 'block';
        document.getElementById('addemail2').type = 'hidden';
    }

    function addtel1() {
        document.getElementById('telefone2').style.display = 'block';
        document.getElementById('addmais1').type = 'hidden';
        document.getElementById('addmais2').type = 'button';
    }

    function addtel2() {
        document.getElementById('telefone3').style.display = 'block';
        document.getElementById('addmais2').type = 'hidden';
        document.getElementById('addmais2').type = 'hidden';
    }

    function addcep() {
        document.getElementById('addmaisendereco').type = 'hidden';
        document.getElementById('addendereco').style.display = 'block';
    }

    function retirar() {
        document.getElementById('addendereco').style.display = 'none';
    }

    /*Javascript API Busca CEP 1*/

    let cep = document.querySelector('#cep');
    let rua = document.querySelector('#endereco');
    let bairro = document.querySelector('#bairro');
    let cidade = document.querySelector('#cidade');
    let estado = document.querySelector('#estado');


    cep.addEventListener('blur', function(e) {
        let cep = e.target.value;
        let script = document.createElement('script');
        script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=popularForm';
        document.body.appendChild(script);
    });

    function popularForm(resposta) {

        if ("erro" in resposta) {
            alert('CEP não encontrado');
            return;
        }

        rua.value = resposta.logradouro;
        bairro.value = resposta.bairro;
        cidade.value = resposta.cidade;
        estado.value = resposta.uf;
    }
    /*Javascript API Busca CEP 2*/

    let cep2 = document.querySelector('#cep2');
    let rua2 = document.querySelector('#endereco2');
    let bairro2 = document.querySelector('#bairro2');
    let cidade2 = document.querySelector('#cidade2');
    let estado2 = document.querySelector('#estado2');


    cep2.addEventListener('blur2', function(e2) {
        let cep2 = e2.target.value;
        let script2 = document.createElement('script2');
        script2.src = 'https://viacep.com.br/ws/' + cep2 + '/json/?callback=popularForm';
        document.body.appendChild(script2);
    });

    function popularForm2(resposta2) {

        if ("erro" in resposta2) {
            alert('CEP não encontrado');
            return;
        }

        rua2.value = resposta2.logradouro;
        bairro2.value = resposta2.bairro;
        cidade2.value = resposta2.cidade;
        estado2.value = resposta2.uf;
    }

    function view() {
        document.getElementById('senha').type = 'text';
        document.getElementById('notview').style.display = 'none';
        document.getElementById('view').style.display = 'block';
    }

    function notview() {
        document.getElementById('senha').type = 'password';
        document.getElementById('notview').style.display = 'block';
        document.getElementById('view').style.display = 'none';
    }
</script>

</html>