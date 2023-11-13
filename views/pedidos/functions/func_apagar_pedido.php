<?php
include("../../../common/config.php");

// Use $_POST em vez de $_GET
$id = $_GET['id_pedido'];

// Use prepared statement para evitar SQL injection
$sql_apagar_pedido = "DELETE FROM pedidos WHERE id = ?";

$stmt = mysqli_prepare($conexao, $sql_apagar_pedido);

// Vincule o parâmetro
mysqli_stmt_bind_param($stmt, "i", $id);

// Execute a consulta
if (mysqli_stmt_execute($stmt)) {
    header("Location: ../index.php");
} else {
    echo "Erro: " . mysqli_error($conexao);
}

// Feche o statement
mysqli_stmt_close($stmt);

// Feche a conexão
mysqli_close($conexao);
