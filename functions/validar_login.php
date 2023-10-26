<?php
    if(session_status() != PHP_SESSION_ACTIVE){
        session_start();
    }

    include("../common/config.php");

    $usuario = filter_var($_POST['usuario'], FILTER_VALIDATE_EMAIL);
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM login_usuarios WHERE login = '$usuario'";
    $query = mysqli_query($conexao, $sql);
    $resultado = mysqli_fetch_assoc($query);

    if(password_verify($senha, $resultado['senha'])){

        $_SESSION['id_cliente'] = $resultado['id_cliente'];
        $_SESSION['id_login'] = $resultado['id'];
        $_SESSION['senha'] = $resultado['senha'];
        $_SESSION['admin'] = $resultado['admin'];

        $id = $resultado['id_cliente'];
        $sql = "SELECT * FROM clientes WHERE id = $id";
        $query = mysqli_query($conexao, $sql);
        $cliente = mysqli_fetch_assoc($query);

        $_SESSION['nome'] = $cliente['nome'];
        $_SESSION['endereco'] = $cliente['endereco'];
        $_SESSION['numero'] = $cliente['numero'];
        $_SESSION['bairro'] = $cliente['bairro'];
        $_SESSION['cidade'] = $cliente['cidade'];
        $_SESSION['estado'] = $cliente['estado'];
        $_SESSION['email'] = $cliente['email'];
        $_SESSION['cpf_cnpj'] = $cliente['cpf_cnpj'];
        $_SESSION['rg'] = $cliente['rg'];
        $_SESSION['telefone'] = $cliente['telefone'];
        $_SESSION['celular'] = $cliente['celular'];
        $_SESSION['data_nasc'] = $cliente['data_nasc'];

        if(password_verify($cliente['cpf_cnpj'], $resultado['senha'])){
            header("Location: ../views/primeiro_acesso.php");
        }else{
            header("Location: ../views/painel.php");
        }
        
    }else{
        $_SESSION['validacao'] = "Usuário e/ou senha incorreto(s)!";
        header("Location: ../views/login.php");
    }

    mysqli_close($conexao);
?>
