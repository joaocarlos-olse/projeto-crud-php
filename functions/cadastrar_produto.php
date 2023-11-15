<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
require("../common/config.php");

$nome = $_POST['nome'];
$qtde_estoque = $_POST['qtde_estoque'];
$valor_unitario = $_POST['valor_unitario'];
$unidade_medida = $_POST['unidade_medida'];

function ErrorMessage(string $message)
{
    $_SESSION['erro_cadastro'] = $message;
    header("Location: select_produto.php");
}

if (!$nome) {
    ErrorMessage("Nome não informado");
}
if (!$qtde_estoque) {
    ErrorMessage("Quantidade de estoque não informada");
}
if (!$valor_unitario) {
    ErrorMessage("Valor unitário não informado");
}
if (!$unidade_medida) {
    ErrorMessage("Unidade de medida não informada");
}

$verificar_campos_unicos = "SELECT * FROM produto WHERE nome = '$nome'";

$result_query_campos_unicos = mysqli_query($conexao, $verificar_campos_unicos);

if (mysqli_num_rows($result_query_campos_unicos) > 0) {
    mysqli_close($conexao);
    ErrorMessage("Produto já cadastrado!");
}

try {
    $sql = "INSERT INTO produto (nome, qtde_estoque, valor_unitario, unidade_medida) VALUES ('$nome', '$qtde_estoque', '$valor_unitario', '$unidade_medida')";

    $query = mysqli_query($conexao, $sql);

    $_SESSION['sucesso_cadastro'] = "<strong>FEITO:</strong> Cadastro realizado!";

    if (isset($_SESSION["id_cliente"])) {
        header("Location: select_produto.php");
    }

} catch (mysqli_exception $e) {
    mysqli_rollback($conexao);

    $_SESSION['erro_cadastro'] = "<strong>ERRO:</strong><br> Cadastro não foi realizado!";
    header("Location: select_produto.php");
} finally {
    mysqli_close($conexao);
}

?>