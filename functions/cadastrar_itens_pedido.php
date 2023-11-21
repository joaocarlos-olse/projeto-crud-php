<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
require("../common/config.php");

//Dados cliente
$id_cliente = $_POST['id_cliente'];

//Dados Pedido
$cond_pagamento = $_POST['cond_pagamento'];
$prazo_entrega = $_POST['prazo_entrega'];
$data_pedido = $_POST['data_pedido'];
$observacao = $_POST['observacao'];

//Dados Produtos
$produtos = $_POST['produtos'];
$quantidades = $_POST['quantidades'];


mysqli_begin_transaction($conexao) or die(mysqli_connect_error());

try {
    $sql_criar_pedido = "INSERT INTO pedidos (data_pedido, id_cliente, observacao, cond_pagamento, prazo_entrega) VALUES ('$data_pedido', '$id_cliente', '$observacao', '$cond_pagamento', '$prazo_entrega')";

    $query = mysqli_query($conexao, $sql_criar_pedido);





    mysqli_commit($conexao);
    
} catch (mysqli_exception $e) {
    mysqli_rollback($conexao);

    $_SESSION['erro_cadastro'] = "<strong>ERRO:</strong><br> Pedido não foi realizado!";
    header("Location: ../views/pedidos.php");
    
} finally {
    mysqli_close($conexao);
}









mysqli_insert_id = ultimo id inserido