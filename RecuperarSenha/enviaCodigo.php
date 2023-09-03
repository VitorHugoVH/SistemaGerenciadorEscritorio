<?php
session_start();
include_once("../config.php");

require '../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);


// Configurações de conexão ao banco de dados
$dbHOST = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'fragaemeloadvogados_db';

// Inicialize a conexão ao banco de dados usando MySQLi
$conexao = new mysqli($dbHOST, $dbUsername, $dbPassword, $dbName);

// Verifique se ocorreu algum erro na conexão
if ($conexao->connect_errno) {
    die("Erro na conexão com o banco de dados: " . $conexao->connect_error);
}

if (isset($_POST['enviarCodigo'])) {
    $email = $_POST['emailRecuperacao'];
    $codigo = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

    $_SESSION['codigo_recuperacao'] = $codigo;
    $_SESSION['emailRecuperacao'] = $email;

    // Consultar o banco de dados para verificar a existência do email em clientes
    $sqlClientes = "SELECT * FROM clientes WHERE email1 = '$email'";
    $resultClientes = $conexao->query($sqlClientes);

    // Consultar o banco de dados para verificar a existência do email em usuario
    $sqlUsuario = "SELECT * FROM usuario WHERE email1 = '$email'";
    $resultUsuario = $conexao->query($sqlUsuario);

    // Verificar se as consultas SQL falharam
    if ($resultClientes === false || $resultUsuario === false) {
        die("Erro na consulta SQL: " . $conexao->error);
    }

    if ($resultClientes->num_rows == 1 || $resultUsuario->num_rows == 1) {
        // Email encontrado em uma das tabelas, enviar o email de recuperação
        try {
            //Server settings
            $mail->SMTPDebug = false;
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'fragaemeloadvocacia@gmail.com';
            $mail->Password   = 'jefjshmigdlbsxyj';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;

            //Recipients
            $mail->setFrom('fragaemeloadvocacia@gmail.com', 'Fraga e Melo Advogados Associados');
            $mail->addAddress($email, 'Email de Recuperação');
            $mail->addReplyTo('fragaemeloadvocacia@gmail.com', 'Information');

            //Content
            $mail->isHTML(true);
            $mail->Subject = 'Código Recuperação de Senha- Fraga e Melo';
            $mail->Body    = "
                <html>
                <body>
                    <h1>Olá Caro Cliente,</h1>
                    <p>Segue abaixo o seu código de recuperação de senha - Sistema do Escritório Fraga e Melo:</p>
                    <p><strong>Código:</strong> $codigo</p>
                    <p>Por favor, mantenha esse código em segurança e não o compartilhe com ninguém.</p>
                    <p>Agradecemos pela confiança em nossos serviços.</p>
                    <p>Atenciosamente,</p>
                    <p>Fraga e Melo - Escritório de Advocacia</p>
                </body>
                </html>
            ";

            $mail->send();
            $_SESSION['mensagem'] = "Email de recuperação enviado com sucesso!";
            header('Location: recuperarSenha2.php');
            exit;
        } catch (Exception $e) {
            $_SESSION['erro'] = "Houve um erro ao enviar o email de recuperação. Por favor, tente novamente.";
            header('Location: recuperarSenha1.php');
            exit;
        }
    } else {
        // Email não encontrado em nenhuma das tabelas
        $_SESSION['erro'] = "O endereço de email informado não foi encontrado em nossos registros.";
        header('Location: recuperarSenha1.php');
        exit;
    }
} else {
    header('Location: recuperarSenha1.php');
    exit;
}
?>
