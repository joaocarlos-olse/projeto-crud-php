<?php
    if(session_status() != PHP_SESSION_ACTIVE){
        session_start();        
    }

    include("../common/config.php");

    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    mysqli_begin_transaction($conexao) or die(mysqli_connect_error());

    try{
        $sql = "DELETE FROM login_usuarios WHERE id_cliente='$id'";

        $query = mysqli_query($conexao, $sql);

        $sql = "DELETE FROM clientes WHERE id ='$id'";

        $query = mysqli_query($conexao, $sql);

        mysqli_commit($conexao);

        $_SESSION['sucesso_excluir'] = "<strong>FEITO:</strong> Cadastro excluido!";
        if($id != $_SESSION['id_cliente']){
            header("Location: ../views/clientes.php");
        }
        else{
            $_SESSION['destruir_sessao'] = 1;
            header("Location: ../views/clientes.php");
        }
        
    }
    catch (mysqli_exception $e){
        mysqli_rollback($conexao);

        throw $e;
        $_SESSION['erro_excluir'] = "<strong>ERRO:</strong><br> Cadastro não foi atualizado!";
        header("Location: ../views/clientes.php");
    }
    finally{
        mysqli_close($conexao);        
    }
?>