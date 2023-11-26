<?php
    if(session_status() != PHP_SESSION_ACTIVE){
        session_start();        
    }

    if(!isset($_SESSION['id_cliente'])){            
        header("Location: login.php");
    }

    include("../common/config.php");

    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    
    $sql = "SELECT item.*, ped.*, cli.nome, cli.cpf_cnpj, cli.email, cli.celular, prod.nome AS descricao, prod.unidade_medida FROM itens_pedido item 
            INNER JOIN pedidos ped ON item.id_pedido = ped.id
            INNER JOIN produto prod ON  item.id_produto = prod.id
            INNER JOIN clientes cli ON ped.id_cliente = cli.id     
            WHERE item.id_pedido = '$id'";

    $resu = mysqli_query($conexao, $sql) or die (mysqli_connect_error());
    
    if(mysqli_num_rows($resu) > 0){
        $itens = array();

        while($pedido = mysqli_fetch_assoc($resu)){
            $itens[] = $pedido;
        }
        $_SESSION['relatorio_itens_pedidos'] = $itens;
        header("Location: ../common/relatorio_pedido_render.php");
        
    }else{
        $_SESSION['erro_select_pedido'] = "Erro desconhecido!";
        header("Location: ../views/pedidos.php");
    }

    mysqli_close($conexao);
?>