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
    $cidade = filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_STRING);
    $cpf_cnpj = filter_input(INPUT_POST, 'cpf_cnpj', FILTER_SANITIZE_STRING);
    $relatorio = filter_input(INPUT_GET, 'relatorio', FILTER_SANITIZE_STRING);
    $pedido = filter_input(INPUT_GET, 'cli_pedido', FILTER_SANITIZE_STRING);

    
    if(isset($_GET['id'])){
        $sql = "SELECT cli.*, log.admin FROM clientes cli INNER JOIN login_usuarios log ON cli.id = log.id_cliente WHERE '$id' = cli.id";
    }
    elseif(!empty($nome) && empty($cidade) && empty($cpf_cnpj)){
        $sql = "SELECT cli.*, log.admin FROM clientes cli INNER JOIN login_usuarios log ON cli.id = log.id_cliente WHERE cli.nome LIKE '%$nome%'";
    }    
    elseif(empty($nome) && !empty($cidade) && empty($cpf_cnpj)){
        $sql = "SELECT cli.*, log.admin FROM clientes cli INNER JOIN login_usuarios log ON cli.id = log.id_cliente WHERE cli.cidade LIKE '%$cidade%'";
    }    
    elseif(empty($nome) && empty($cidade) && !empty($cpf_cnpj)){
        $sql = "SELECT cli.*, log.admin FROM clientes cli INNER JOIN login_usuarios log ON cli.id = log.id_cliente WHERE cli.cpf_cnpj = '$cpf_cnpj'";
    }    
    elseif(!empty($nome) && !empty($cidade) && empty($cpf_cnpj)){
        $sql = "SELECT cli.*, log.admin FROM clientes cli INNER JOIN login_usuarios log ON cli.id = log.id_cliente WHERE cli.nome LIKE '%$nome%' OR cli.cidade LIKE '%$cidade%'";
    }
    elseif(!empty($nome) && !empty($cidade) && !empty($cpf_cnpj)){
        $sql = "SELECT cli.*, log.admin FROM clientes cli INNER JOIN login_usuarios log ON cli.id = log.id_cliente WHERE cli.nome LIKE '%$nome%' OR cli.cidade LIKE '%$cidade%' OR cli.cpf_cnpj = '$cpf_cnpj'";
    }
    else{
        $sql = "SELECT cli.*, log.admin FROM clientes cli INNER JOIN login_usuarios log ON cli.id = log.id_cliente ORDER BY cli.id";
    }

    $resu = mysqli_query($conexao, $sql) or die (mysqli_connect_error());
    
    
    if(mysqli_num_rows($resu) > 0){
        $registros = array();

        while($reg = mysqli_fetch_assoc($resu)){
            $registros[] = $reg;
        }
        $_SESSION['registros'] = $registros;
        $_SESSION['relatorio_cliente'] = $registros;
        $_SESSION['pedido_cliente'] = $registros;
        if($relatorio == true){
            header("Location: ../common/relatorio_cliente_render.php");
        }
        elseif($pedido == true){
            header("Location: ../views/pedidos.php");
        }
        else{
            header("Location: ../views/clientes.php");
        }
        
    }else{
        $_SESSION['erro_select_cli'] = "Não foram localizados dados para o id informado!";
        header("Location: ../views/clientes.php");
    }

    mysqli_close($conexao);
?>