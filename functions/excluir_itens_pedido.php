<?php
    if(session_status() != PHP_SESSION_ACTIVE){
        session_start();        
    }

    include("../common/config.php");

    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    try{
        $sql = "DELETE FROM pedidos WHERE id = '$id'";

        $query = mysqli_query($conexao, $sql);

        $_SESSION['sucesso_excluir'] = "<strong>FEITO:</strong> Pedido excluido!";
        header("Location: select_pedido.php");
        
    }
    catch (mysqli_exception $e){
        mysqli_rollback($conexao);
        
        $_SESSION['erro_excluir'] = "<strong>ERRO:</strong><br> Pedido não foi excluido!";
        header("Location: select_pedido.php");
    }
    finally{
        mysqli_close($conexao);        
    }
?>