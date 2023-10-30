<?php
    if(session_status() != PHP_SESSION_ACTIVE){
        session_start();        
    }

    include("../common/config.php");

    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $sql = "SELECT cli.*, log.admin FROM clientes cli INNER JOIN login_usuarios log ON cli.id = log.id_cliente WHERE '$id' = cli.id";
    $resu = mysqli_query($conexao, $sql) or die (mysqli_connect_error());

    if($reg = mysqli_fetch_assoc($resu)){
        $_SESSION['cli_id'] = $reg['id'];      
        $_SESSION['cli_admin'] = $reg['admin'];
        $_SESSION['cli_nome'] = $reg['nome'];
        $_SESSION['cli_endereco'] = $reg['endereco'];
        $_SESSION['cli_numero'] = $reg['numero'];
        $_SESSION['cli_bairro'] = $reg['bairro'];
        $_SESSION['cli_cidade'] = $reg['cidade'];
        $_SESSION['cli_estado'] = $reg['estado'];
        $_SESSION['cli_email'] = $reg['email'];
        $_SESSION['cli_cpf_cnpj'] = $reg['cpf_cnpj'];
        $_SESSION['cli_rg'] = $reg['rg'];
        $_SESSION['cli_telefone'] = $reg['telefone'];
        $_SESSION['cli_celular'] = $reg['celular'];
        $_SESSION['cli_data_nasc'] = $reg['data_nasc'];
        header("Location: ../views/clientes.php");
    }else{
        $_SESSION['erro_select_cli'] = "Não foram localizados dados para o id informado!";
        header("Location: ../views/clientes.php");
    }

    mysqli_close($conexao);
?>