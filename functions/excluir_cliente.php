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

        if($_SESSION['admin'] == 1 && $id != $_SESSION['id_cliente']){
            $_SESSION['sucesso_excluir'] = "<strong>FEITO:</strong> Cadastro excluido!";
            header("Location: select_cliente.php");
        }
        else{
            session_destroy();
            header("Location: ../views/login.php");
        }
        
    }
    catch (mysqli_exception $e){
        mysqli_rollback($conexao);

        throw $e;
        $_SESSION['erro_excluir'] = "<strong>ERRO:</strong><br> Cadastro não foi atualizado!";
        header("Location: select_cliente.php");
    }
    finally{
        mysqli_close($conexao);        
    }
?>