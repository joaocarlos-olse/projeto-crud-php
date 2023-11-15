<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
require("../common/config.php");

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$nome = $_POST['nome'];
$qtde_estoque = $_POST['qtde_estoque'];
$valor_unitario = $_POST['valor_unitario'];
$unidade_medida = $_POST['unidade_medida'];

function ErrorMessage(string $message)
{
    $_SESSION['erro_atualizacao'] = $message;
    header("Location: select_produto.php");
}

$verificar_campos_unicos = "SELECT id FROM produto WHERE nome = '$nome'";
$result_query_campos_unicos = mysqli_query($conexao, $verificar_campos_unicos);
$id_result_query_campos_unicos = mysqli_fetch_assoc($result_query_campos_unicos);

if (!$nome) {
    ErrorMessage("Nome não informado");
}
elseif (!$qtde_estoque) {
    ErrorMessage("Quantidade de estoque não informada");
}
elseif (!$valor_unitario) {
    ErrorMessage("Valor unitário não informado");
}
elseif (!$unidade_medida) {
    ErrorMessage("Unidade de medida não informada");
}
elseif (mysqli_num_rows($result_query_campos_unicos) > 0 && $id_result_query_campos_unicos['id'] != $id) {
    ErrorMessage("Produto já cadastrado!");
}
else{
    try {
        $sql = "UPDATE produto SET nome = '$nome', qtde_estoque = '$qtde_estoque', valor_unitario = '$valor_unitario', unidade_medida = '$unidade_medida' WHERE id='$id'";
    
        $query = mysqli_query($conexao, $sql);
    
        $_SESSION['sucesso_cadastro'] = "<strong>FEITO:</strong> Cadastro atualizado!";
    
        if (isset($_SESSION["id_cliente"])) {
            header("Location: select_produto.php");
        }
    
    } catch (mysqli_exception $e) {
        mysqli_rollback($conexao);
    
        $_SESSION['erro_cadastro'] = "<strong>ERRO:</strong><br> Cadastro não foi realizado!";
        header("Location: select_produto.php");
    }
}

mysqli_close($conexao);
?>