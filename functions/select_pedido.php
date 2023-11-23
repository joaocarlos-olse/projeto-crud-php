<?php
    if(session_status() != PHP_SESSION_ACTIVE){
        session_start();        
    }

    if(!isset($_SESSION['id_cliente'])){            
        header("Location: login.php");
    }

    include("../common/config.php");

    if(isset($_POST['id'])){
        $id = filter_input(INPUT_POST, 'id_cli', FILTER_SANITIZE_NUMBER_INT);
    }
    else{
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    }
    $data_inicial = filter_input(INPUT_POST, 'data_inicial', FILTER_SANITIZE_STRING);
    $data_final = filter_input(INPUT_POST, 'data_final', FILTER_SANITIZE_STRING);

    
    if(!empty($id) && empty($data_inicial) && empty($data_final)){
        $sql = "SELECT p.*, c.nome FROM pedidos p INNER JOIN clientes c ON c.id = p.id_cliente WHERE p.id_cliente = '$id'";
    }
    elseif(empty($id) && !empty($data_inicial) && empty($data_final)){
        $sql = "SELECT p.*, c.nome FROM pedidos p INNER JOIN clientes c ON c.id = p.id_cliente WHERE p.data_pedido >= '$data_inicial'";
    }
    elseif(empty($id) && empty($data_inicial) && !empty($data_final)){
        $sql = "SELECT p.*, c.nome FROM pedidos p INNER JOIN clientes c ON c.id = p.id_cliente WHERE p.data_pedido <= '$data_final'";
    }
    elseif(!empty($id) && !empty($data_inicial) && empty($data_final)){
        $sql = "SELECT p.*, c.nome FROM pedidos p INNER JOIN clientes c ON c.id = p.id_cliente WHERE p.id_cliente = '$id' AND p.data_pedido >= '$data_inicial'";
    }
    elseif(!empty($id) && empty($data_inicial) && !empty($data_final)){
        $sql = "SELECT p.*, c.nome FROM pedidos p INNER JOIN clientes c ON c.id = p.id_cliente WHERE p.id_cliente = '$id' AND p.data_pedido <= '$data_final'";
    }
    elseif(empty($id) && !empty($data_inicial) && !empty($data_final)){
        $sql = "SELECT p.*, c.nome FROM pedidos p INNER JOIN clientes c ON c.id = p.id_cliente WHERE p.data_pedido BETWEEN $data_inicial AND $data_final";
    }
    elseif(!empty($id) && !empty($data_inicial) && !empty($data_final)){
        $sql = "SELECT p.*, c.nome FROM pedidos p INNER JOIN clientes c ON c.id = p.id_cliente WHERE p.id_cliente = '$id' AND p.data_pedido BETWEEN $data_inicial AND $data_final";
    }
    else{
        $sql = "SELECT p.*, c.nome FROM pedidos p INNER JOIN clientes c ON c.id = p.id_cliente ORDER BY data_pedido";
    }

    $resu = mysqli_query($conexao, $sql) or die (mysqli_connect_error());
    
    
    if(mysqli_num_rows($resu) > 0){
        $pedidos = array();

        while($pedido = mysqli_fetch_assoc($resu)){
            $pedidos[] = $pedido;
        }
        $_SESSION['pedidos'] = $pedidos;
        $_SESSION['relatorio_pedidos'] = $pedidos;
        if($relatorio == true){
            header("Location: ../common/relatorio_pedidos_render.php");
        }
        else{
            header("Location: ../views/pedidos.php");
        }
        
    }else{
        $_SESSION['erro_select_pedido'] = "Nenhum registro encontrado!";
        header("Location: ../views/pedidos.php");
    }

    mysqli_close($conexao);
?>