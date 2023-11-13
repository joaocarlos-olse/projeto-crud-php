
<?php

include("../../../common/config.php");

$id_item = $_GET['id_item'];
$id_pedido = $_GET['id_pedido'];

$sql_apagar_item_pedido = "DELETE FROM itens_pedido WHERE id_item = '$id_item'";

if (mysqli_query($conexao, $sql_apagar_item_pedido)) {
    header("Location: ../cadastrar_item_pedidos.php?id=$id_pedido");
} else {
    echo "Erro: " . mysqli_error($con);
}

mysqli_close($conexao);

?>
