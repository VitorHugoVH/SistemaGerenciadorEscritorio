<?php
include_once('../../conexao_adm.php');
require '../../../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

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
    $statusUsuario = $_POST['status'];

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
    $senha = $_POST['senhaUser'];
    $enviarEmail = $_POST['enviarEmailUsuario'];

    ##COMANDOS SQL INSERT##
    $sql = "INSERT INTO clientes (nomecliente, tipodocumento, cpf, cnpj, sexo, responsavel, datanascimento, datafundacao, rg, tipoempresa, 
        estadocivil, atividade, profissao, inscricao, nacionalidade ,observacao, email1, email2, email3, tipocontato1, ddi1, ddd1, numero1, tipocontato2, 
        ddi2, ddd2, numero2, tipocontato3, ddi3, ddd3, numero3, cep1, numerocasa1, complemento1, bairro1, cidade1, estado1, cep2, numerocasa2, 
        complemento2, bairro2, cidade2, estado2, login, senha, status)

        VALUES ('$nome', '$documento', '$cpf', '$cnpj', '$sexo', '$resposavel', '$datanascimento', '$datafundacao', '$numerorg', '$tipoempresa', 
        '$estadocivil', '$atividadeprincipal', '$profissao', '$inscricao', '$nacionalidade', '$observacoes', '$email1', '$email2', '$email3', '$tipocontato1', '$ddi1', 
        '$ddd1', '$numero1', '$tipocontato2', '$ddi2', '$ddd2', '$numero2', '$tipocontato3', '$ddi3', '$ddd3', '$numero3', '$cep1', '$numerocasa1', '$complemento1', 
        '$bairro1', '$cidade1', '$estado1', '$cep2', '$numerocasa2', '$complemento2', '$bairro2', '$cidade2', '$estado2', '$login', '$senha', '$statusUsuario')";

    $result = $conn->query($sql);


    ##ENVIAR EMAIL CLIENTE##

    if($enviarEmail == 'true'){

    try {
        //Server settings
        $mail->SMTPDebug = false;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'fragaemeloadvocacia@gmail.com';                     //SMTP username
        $mail->Password   = 'jefjshmigdlbsxyj';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('fragaemeloadvocacia@gmail.com', 'Fraga e Melo Advogados Associados');
        $mail->addAddress($email1, $nome);     //Add a recipient
        $mail->addReplyTo('fragaemeloadvocacia@gmail.com', 'Information');

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Dados acesso sistema - Fraga e Melo';
        $mail->Body    = "
            <html>
            <body>
                <h1>Olá Caro Cliente,</h1>
                <p>Segue abaixo os seus dados de acesso ao Sistema do Escritório Fraga e Melo:</p>
                <p><strong>Login:</strong> $login</p>
                <p><strong>Senha:</strong> $senha</p>
                <p>Por favor, mantenha esses dados em segurança e não os compartilhe com ninguém.</p>
                <p>Agradecemos pela confiança em nossos serviços.</p>
                <p>Atenciosamente,</p>
                <p>Fraga e Melo - Escritório de Advocacia</p>
            </body>
            </html>
        ";

        $mail->send();
        header('Location: clientes.php');
        exit;
        } catch (Exception $e) {
            header('Location: clientes.php');
            exit;
        }
    }else{
        header('Location: clientes.php');
        exit;
    }
}
