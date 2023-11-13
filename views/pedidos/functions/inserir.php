[25/10 20:34] SABRINA REGINA DE BARROS
<?php
include("../../../utils/verificar_login.php");
include("../../../conexao.php");
verificar_admin();

$data_pedido = $_POST['data_pedido'];
$id_cliente = $_POST['id_cliente'];
$observacao = $_POST['observacao'];
$cond_pagamento = $_POST['cond_pagto'];
$prazo_entrega = $_POST['prazo_entrega'];

// Inserir o pedido
$sql_criar_pedido = "INSERT INTO pedidos (data_pedido, id_cliente, observacao, cond_pagamento, prazo_entrega) VALUES (?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($con, $sql_criar_pedido);
mysqli_stmt_bind_param($stmt, "sssss", $data_pedido, $id_cliente, $observacao, $cond_pagamento, $prazo_entrega);
mysqli_stmt_execute($stmt);
$id_pedido = mysqli_insert_id($con);

//  array para armazenar as quantidades por produto
$quantidades_por_produto = array();

// itens
if (!empty($_POST['itens_pedido']['produto'])) {
    $itensAdicionados = count($_POST['itens_pedido']['produto']);

    for ($i = 0; $i < $itensAdicionados; $i++) {
        $id_produto = $_POST['itens_pedido']['produto'][$i];
        $qtde = $_POST['itens_pedido']['quantidade'][$i][0];

        // Verificar se o produto já existe no array
        if (array_key_exists($id_produto, $quantidades_por_produto)) {
            // Se existir, acumular a quantidade
            $quantidades_por_produto[$id_produto] += $qtde;
        } else {
            //  adicionar ao array
            $quantidades_por_produto[$id_produto] = $qtde;
        }
    }


    foreach ($quantidades_por_produto as $id_produto => $qtde_total) {
        // Verificar se o item já existe no pedido
        $sql_verificar_item = "SELECT id, qtde FROM itens_pedido WHERE id_pedido = ? AND id_produto = ?";
        $stmt_verificar_item = mysqli_prepare($con, $sql_verificar_item);
        mysqli_stmt_bind_param($stmt_verificar_item, "ss", $id_pedido, $id_produto);
        mysqli_stmt_execute($stmt_verificar_item);
        mysqli_stmt_store_result($stmt_verificar_item);

        if (mysqli_stmt_num_rows($stmt_verificar_item) > 0) {
            // Se EXISTIR SOMAR
            mysqli_stmt_bind_result($stmt_verificar_item, $id_item_existente, $qtde_existente);
            mysqli_stmt_fetch($stmt_verificar_item);

            $qtde_total += $qtde_existente;

            // Atualizar a quantidade do item existente
            $sql_atualizar_item = "UPDATE itens_pedido SET qtde = ? WHERE id = ?";
            $stmt_atualizar_item = mysqli_prepare($con, $sql_atualizar_item);
            mysqli_stmt_bind_param($stmt_atualizar_item, "ss", $qtde_total, $id_item_existente);
            mysqli_stmt_execute($stmt_atualizar_item);
        } else {
            // Se o item não existe, adicionar um novo
            $sql_adicionar_item = "INSERT INTO itens_pedido (id_pedido, id_produto, qtde) VALUES (?, ?, ?)";
            $stmt_adicionar_item = mysqli_prepare($con, $sql_adicionar_item);
            mysqli_stmt_bind_param($stmt_adicionar_item, "sss", $id_pedido, $id_produto, $qtde_total);
            mysqli_stmt_execute($stmt_adicionar_item);
        }
    }
}

header("Location: ../pedidos");
?>