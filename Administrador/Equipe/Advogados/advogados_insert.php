<?php
    include_once('../../conexao_adm.php');

    require '../../../../vendor/autoload.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);


    // VERIFICAÇÃO LOGIN
    session_start();
    $logged = $_SESSION['logged'] ?? NULL;

    if (!$logged) {
    header('Location: /FragaeMelo/Site%20Fraga%20e%20Melo%20BootsTrap/login.php');
    };

    if(isset($_POST['enviar'])){

        $nomeadvogado = $_POST['nomeadvogado'];
        $funcao = $_POST['funcao'];
        $numerooab = $_POST['numerooab'];
        $estadooab = $_POST['estadooab'];
        $numerocpf = $_POST['numerocpf'];
        $sexo = $_POST['sexo'];
        $datanascimento = $_POST['datanascimento'];
        $numerorg = $_POST['numerorg'];
        $estadocivil = $_POST['estadocivil'];
        $profissao = $_POST['profissao'];
        $observacoes = $_POST['descricao'];
        $descricao = $_POST['descricao'];
        $email1 = $_POST['email'];
        $email2 = $_POST['email2'];
        $email3 = $_POST['email3'];
        $status = $_POST['status'];

        ##TELEFONES##
        $tipocontato1 = $_POST['tipocontato'];
        $ddi1 = $_POST['ddi'];
        $ddd1 = $_POST['ddd'];
        $numero1 = $_POST['numero'];
        $telefone1 = "(".$ddd1.")".$numero1;

        $tipocontato2 = $_POST['tipocontato2'];
        $ddi2 = $_POST['ddi2'];
        $ddd2 = $_POST['ddd2'];
        $numero2 = $_POST['numero2'];
        $telefone2 = "(".$ddd2.")".$numero2;

        $tipocontato3 = $_POST['tipocontato3'];
        $ddi3 = $_POST['ddi3'];
        $ddd3 = $_POST['ddd3'];
        $numero3 = $_POST['numero3'];
        $telefone3 = "(".$ddd3.")".$numero3;

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

        ##CONDIÇÕES##

        if($funcao == 'Não selecionado'){
            $funcao = 'Não selecionado';
        }else{
            $funcao = $funcao;
        }

        ##VERIFICAR SE O EMAIL JÁ ESTÁ SENDO USADO##

        $sqlVerificaEmailUsuario = "SELECT * FROM usuario 
        WHERE usuario = '$email1'
        OR email1 = '$email1'
        OR email2 = '$email1'
        OR email3 = '$email1'";
        
        $sqlVerificaEmailClientes = "SELECT * FROM clientes
        WHERE email1 = '$email1'
        OR email2 = '$email1'
        OR email3 = '$email1'";
        
        $resultVerificaEmailUsuario = $conn->query($sqlVerificaEmailUsuario);
        $resultVerificaEmailClientes = $conn->query($sqlVerificaEmailClientes);

        if ($resultVerificaEmailUsuario->num_rows > 0 || $resultVerificaEmailClientes->num_rows > 0) {
            echo "<script>alert('O email já está cadastrado.'); window.history.back();</script>";
            exit;
        } else {

            ##COMANDO SQL##

            $sqlInsert = "INSERT INTO usuario (nome, usuario, senha, funcao, oab, estadooab, cpf, sexo, datanascimento, rg, estadocivil, profissao, observacoes, email1, email2, email3, telefone1, numero1,tipocontato1, ddi1, ddd1, telefone2, numero2, tipocontato2, ddi2, ddd2, telefone3, numero3, tipocontato3, ddi3, ddd3, cep1, endereco1, numerocasa1, complemento1, bairro1, cidade1, estado1, cep2, endereco2, numerocasa2, complemento2, bairro2, cidade2, estado2, status)
            VALUES ('$nomeadvogado', '$login', '$senha' ,'$funcao', '$numerooab', '$estadooab', '$numerocpf', '$sexo', '$datanascimento', '$numerorg', '$estadocivil', '$profissao', '$observacoes', '$email1', '$email2', '$email3', '$telefone1', '$numero1', '$tipocontato1', '$ddi1', '$ddd1', '$telefone2', '$numero2', '$tipocontato2', '$ddi2', '$ddd2', '$telefone3', '$numero3', '$tipocontato3', '$ddi3', '$ddd3', '$cep1', '$endereco1', '$numerocasa1', '$complemento1', '$bairro1', '$cidade1', '$estado1', '$cep2', '$endereco2', '$numerocasa2', '$complemento2', '$bairro2', '$cidade2', '$estado2', '$status')";

            $result = $conn->query($sqlInsert);

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
                    $mail->addAddress($email1, $nomeadvogado);     //Add a recipient
                    $mail->addReplyTo('fragaemeloadvocacia@gmail.com', 'Information');
            
                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'Dados acesso sistema - Fraga e Melo';
                    $mail->Body    = "
                        <html>
                        <body>
                            <h1>Olá $nomeadvogado,</h1>
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
                    header('Location: advogados.php');
                    exit;
                    } catch (Exception $e) {
                        header('Location: advogados.php');
                        exit;
                    }
                }else{
                    header('Location: advogados.php');
                    exit;
                }
            }
        }
?>