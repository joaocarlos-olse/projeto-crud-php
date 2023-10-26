<?php
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $nome_db = "atividade_2bim_db";

    // Cria a conexão
    $conexao = mysqli_connect($servidor, $usuario, $senha, $nome_db);

    // Testa se houve algum erro
    if(mysqli_connect_errno()){
        echo("Falha ao conectar ao banco de dados: ".mysqli_connect_errno());
    }
?>