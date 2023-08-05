<?php
    include_once('../../conexao_adm.php');
    require('../../sessao_usuarios.php');

    // VERIFICAÇÃO LOGIN E NÍVEL DE USUÁRIO
    verificarAcesso($conn);

    if(isset($_POST['up'])){
        
        $id = $_POST['id'];
        $datafinal = $_POST['datafinal'];
        $horafinal = $_POST['horafinal'];
        $descricao = $_POST['descprazo'];
        $processo = $_POST['processo'];
        $atendido = $_POST['flexRadioDefault'];
        $advogado = $_POST['nomeadvogado'];

        if($atendido == 'nao'){
            $atendido = 'Não';
        }else{
            $atendido = 'Sim';
        }

        if(!empty($processoprazo)){
            $idprocessso = explode(' - ', $processoprazo)[0];

            $sqlCliente = "SELECT * FROM processo WHERE id=$idprocessso";
            $resultCliente = $conn->query($sqlCliente);

            while($data_cli = mysqli_fetch_assoc($resultCliente)){
                $nomecliente = $data_cli['nomecliente'];
            }
        }

        $sqlUpdate = "UPDATE prazo SET datafinal='$datafinal', horafinal='$horafinal', descricao='$descricao', processo='$processo', atendido='$atendido', advogado='$advogado', cliente='$nomecliente'
        WHERE id='$id'";

        $resultUpdate = $conn->query($sqlUpdate);

        header('Location: agenda_prazos.php');
    }
?>