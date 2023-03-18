<?php
    include_once('conexao_adm.php');

    // VERIFICAÇÃO LOGIN
    session_start();
    $logged = $_SESSION['logged'] ?? NULL;

    if (!$logged) {
    header('Location: /FragaeMelo/Site%20Fraga%20e%20Melo%20BootsTrap/login.php');
    };



    if(isset($_POST['up'])){
        
        $id = $_POST['id'];
        $datafinal = $_POST['datafinal'];
        $horafinal = $_POST['horafinal'];
        $descricao = $_POST['descprazo'];
        $processo = $_POST['processo'];
        $atendido = $_POST['flexRadioDefault'];
        $advogado = $_POST['nomeadvogado'];

        if($atendido == 'on'){
            $atendido = 'Não';
        }else{
            $atendido = 'Sim';
        }

        if(!empty($processo)){
            $nprocesso = $processo;

            $sqlSearch = "SELECT * FROM processo WHERE id=$nprocesso";
            $resultSearch = $conn->query($sqlSearch);
            
            while($data = mysqli_fetch_assoc($resultSearch)){
                $nomecliente = $data['nomecliente'];
            }
        }

        if(!empty($datafinal)){
            $datafinal2 = date('d/m/Y', strtotime($datafinal));
        }

        $sqlUpdate = "UPDATE prazo SET datafinal='$datafinal', horafinal='$horafinal', descricao='$descricao', processo='$processo', atendido='$atendido', advogado='$advogado', cliente='$nomecliente'
        WHERE id='$id'";

        $resultUpdate = $conn->query($sqlUpdate);

        header('Location: agenda_prazos.php');
    }
?>