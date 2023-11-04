<?php
    if(session_status() != PHP_SESSION_ACTIVE){
        session_start();
    }

    include("../common/config.php");

    $id_login = "";
    $cpf_cnpj = isset($_SESSION['cpf_cnpj']) ? $_SESSION['cpf_cnpj'] : "";
    $novasenha = $_POST['novasenha'];
    $confirmacaosenha = $_POST['confirmacaosenha'];

    if(isset($_POST['id'])){
        $id_login = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    }
    elseif(isset($_POST['email'])){
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $sql = "SELECT * FROM clientes WHERE email = '$email'";
        $resu = mysqli_query($conexao, $sql) or die (mysqli_connect_error());
        if(mysqli_affected_rows($conexao)){  
            $row = mysqli_fetch_assoc($resu);
            $id_login = $row['id'];
            $cpf_cnpj = $row['cpf_cnpj'];
        }
        else{
            $_SESSION['erro_usuario'] = "Usuário não localizado!";
            header("Location: ../views/login.php");
        }
    }        

    // Testa se a nova senha é igual ao cpf/cnpj
    if($novasenha == $cpf_cnpj){
        $_SESSION['validacao'] = "A senha não pode ser o CPF/CNPJ";
        if(isset($_SESSION['id_cliente'])){
            header("Location: ../views/primeiro_acesso.php");
        }else{
            header("Location: ../views/login.php");
        }
    }
    // Testa se a nova senha e a confimação são iguais
    elseif($novasenha != $confirmacaosenha){
        $_SESSION['validacao'] = "A senhas não são iguais!";
        if(isset($_SESSION['id_cliente'])){
            header("Location: ../views/primeiro_acesso.php");
        }else{
            header("Location: ../views/login.php");
        }
    }
    // Altera a senha
    else{
        $novasenha = password_hash($novasenha, PASSWORD_DEFAULT);
        $sql = "UPDATE login_usuarios SET senha='$novasenha' WHERE id='$id_login'";
        $query = mysqli_query($conexao, $sql);
        if(mysqli_affected_rows($conexao)){
            if(isset($_SESSION['id_cliente'])){
                $_SESSION['validacao'] = "Senha alterada com sucesso!";
                header("Location: ../views/painel.php");
            }else{
                $_SESSION['sucesso_senha'] = "Senha alterada com sucesso!";
                header("Location: ../views/login.php");
            }
        }
        else{
            $_SESSION['validacao'] = "Erro ao alterar senha!";
            header("Location: ../views/primeiro_acesso.php");
        }        
    }
    mysqli_close($conexao);
?>