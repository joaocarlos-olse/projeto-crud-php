<?php
include("../../../common/config.php");



$data_pedido = $_POST['data_pedido'];
$id_cliente= $_POST['id_cliente'];
$observacao = $_POST['observacao'];
$cond_pagamento = $_POST['cond_pagamento'];
$prazo_entrega = $_POST['prazo_entrega'];


$sql_criar_pedido= "INSERT INTO pedidos (data_pedido, id_cliente, observacao, cond_pagamento, prazo_entrega) VALUES ('$data_pedido', '$id_cliente', '$observacao', '$cond_pagamento', '$prazo_entrega') ";

if (mysqli_query($conexao, $sql_criar_pedido)) {
    header("Location: ../");
} else {
    echo "Erro: " . mysqli_error($con);
}
