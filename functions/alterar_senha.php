<?php
    if(session_status() != PHP_SESSION_ACTIVE){
        session_start();
    }

    include("../common/config.php");

    $id_login = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $novasenha = md5($_POST['novasenha']);
    $confirmacaosenha = md5($_POST['confirmacaosenha']);

    // Testa se a nova senha é igual ao cpf/cnpj
    if($novasenha == md5($_SESSION['cpf_cnpj'])){
        $_SESSION['validacao'] = "A senha não pode ser o CPF/CNPJ";
        header("Location: ../views/primeiro_acesso.php");
    }
    // Testa se a nova senha e a confimação são iguais
    elseif($novasenha != $confirmacaosenha){
        $_SESSION['validacao'] = "A senhas não são iguais!";
        header("Location: ../views/primeiro_acesso.php");
    }
    // Altera a senha
    else{
        $sql = "UPDATE login_usuarios SET senha='$novasenha' WHERE id='$id_login'";
        $query = mysqli_query($conexao, $sql);
        if(mysqli_affected_rows($conexao)){
            $_SESSION['validacao'] = "Senha alterada com sucesso!";
            header("Location: ../views/painel.php");
        }
        else{
            $_SESSION['validacao'] = "Erro ao alterar senha!";
            header("Location: ../views/primeiro_acesso.php");
        }        
    }

    mysqli_close($con);
?>