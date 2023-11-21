<?php
    if(session_status() != PHP_SESSION_ACTIVE){
        session_start();        
    }

    if(!isset($_SESSION['id_cliente'])){            
        header("Location: login.php");
    }

    include("../common/config.php");

    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $pedido = filter_input(INPUT_GET, 'prod_pedido', FILTER_SANITIZE_STRING);
    $cad_pedido = filter_input(INPUT_GET, 'cad_pedido', FILTER_SANITIZE_STRING);

    
    if(isset($_GET['id'])){
        $sql = "SELECT * FROM produto WHERE '$id' = id";
    }
    elseif(!empty($nome)){
        $sql = "SELECT * FROM produto WHERE nome LIKE '%$nome%'";
    }
    else{
        $sql = "SELECT * FROM produto ORDER BY nome";
    }

    $resu = mysqli_query($conexao, $sql) or die (mysqli_connect_error());
    
    
    if(mysqli_num_rows($resu) > 0){
        $produtos = array();

        while($prod = mysqli_fetch_assoc($resu)){
            $produtos[] = $prod;
        }
        $_SESSION['produtos'] = $produtos;
        $_SESSION['relatorio_produtos'] = $produtos;
        $_SESSION['pedido_produtos'] = $produtos;
        if($relatorio == true){
            header("Location: ../common/relatorio_produtos_render.php");
        }
        elseif($cad_pedido == true){
            header("Location: ../views/cadastrar_itens_pedido.php");
        }
        elseif($pedido == true){
            header("Location: ../views/pedidos.php");
        }
        else{
            header("Location: ../views/produtos.php");
        }
        
    }else{
        $_SESSION['erro_select_cli'] = "Não foram localizados dados para o produto informado!";
        header("Location: ../views/produtos.php");
    }

    mysqli_close($conexao);
?>