<?php

    $dbHOST = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'fragaemeloadvogados_db';

    $conexao = new mysqli($dbHOST,$dbUsername,$dbPassword,$dbName);

    //if($conexao->connect_errno){
       // echo "Erro";
    //}else{
      //  echo "Conexão realizada com sucesso";
    //}

?>