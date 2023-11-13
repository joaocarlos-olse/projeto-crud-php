<?php

include("../../../common/config.php");

$id_pedido = $_POST['id_pedido'];
$id_produto = $_POST['select-item'];
$quantidade = $_POST['quantidade'];

$sql_criar_item_pedido = "INSERT INTO itens_pedido (id_pedido, id_produto, qtde) VALUES ('$id_pedido', '$id_produto', '$quantidade')";

if (mysqli_query($conexao, $sql_criar_item_pedido)) {
    header("Location: ../cadastrar_item_pedidos.php?id=$id_pedido");
} else {
    echo "Erro: " . mysqli_error($con);
}

mysqli_close($conexao);
