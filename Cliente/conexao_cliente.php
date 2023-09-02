<?php
    $ip = "127.0.0.1";
    $login = "root";
    $senha = "";
    $banco = "fragaemeloadvogados_db";

    $conn = mysqli_connect($ip, $login, $senha, $banco);
    if ($conn) {
    }else {
        echo "Erro na conexão " . mysqli_connect_errno();
    }
?>