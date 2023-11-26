<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
require("../common/config.php");

// Select produtos
if(!isset($_SESSION['pedido_produtos'])){
    header("Location: ../functions/select_produto.php?cad_pedido=true");
}
if(isset($_SESSION['pedido_produtos'])){            
    $produtos_db = $_SESSION['pedido_produtos'];
    unset($_SESSION['pedido_produtos']);
}

//Dados cliente
$id_cliente = $_POST['id_cli'];

//Dados Pedido
$cond_pagamento = $_POST['cond_pagamento'];
$prazo_entrega = $_POST['prazo_entrega'];
$data_pedido = $_POST['data_pedido'];
$observacao = $_POST['observacao'];

//Dados Produtos
$produtos = $_POST['produtos'];
$quantidades = $_POST['quantidades'];


function ErrorMessage(string $message)
{
    $_SESSION['erro_cadastro'] = $message;
    header("Location: ../views/login.php");
}

mysqli_begin_transaction($conexao) or die(mysqli_connect_error());

try {
    $sql_criar_pedido = "INSERT INTO pedidos (data_pedido, id_cliente, observacao, cond_pagamento, prazo_entrega) VALUES ('$data_pedido', '$id_cliente', '$observacao', '$cond_pagamento', '$prazo_entrega')";

    $query = mysqli_query($conexao, $sql_criar_pedido);

    $id_pedido = mysqli_insert_id($conexao);

    for($i = 0; $i < count($produtos); $i++){
        foreach($produtos_db as $prod_db){
            if($produtos[$i] == $prod_db['id'] && $quantidades[$i] <= $prod_db['qtde_estoque']){
                $sql_itens_pedido = "INSERT INTO itens_pedido (id_pedido, id_produto, qtde) VALUES ('$id_pedido', '$produtos[$i]', '$quantidades[$i]');";
                mysqli_query($conexao, $sql_itens_pedido);
        
                $sql_select_prod_id = "SELECT * FROM produto WHERE id = '$produtos[$i]'";
                $resu = mysqli_query($conexao, $sql_select_prod_id) or die (mysqli_connect_error());
                
                $prod = mysqli_fetch_assoc($resu);
                $nova_qtde_estoque = $prod['qtde_estoque'] - $quantidades[$i];
                $sql_qtde_estoque = "UPDATE produto SET qtde_estoque = $nova_qtde_estoque WHERE id='$produtos[$i]'";
                mysqli_query($conexao, $sql_qtde_estoque);               
            }
            else{
                ErrorMessage("ERRO: Quantidade inserida para o produto ".$prod_db['nome']." é maior que a quantidade em estoque! (Estoque: ".$prod_db['qtde_estoque']); 
            }
        }
    }

    mysqli_commit($conexao);
    //header("Location: select_pedido.php");
    
} catch (mysqli_exception $e) {
    mysqli_rollback($conexao);

    $_SESSION['erro_cadastro'] = "<strong>ERRO:</strong><br> Pedido não foi realizado!";
    //header("Location: ../views/pedidos.php");
    
} finally {
    mysqli_close($conexao);
}

?>