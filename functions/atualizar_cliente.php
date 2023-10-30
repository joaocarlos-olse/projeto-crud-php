<?php
    if(session_status() != PHP_SESSION_ACTIVE){
        session_start();        
    }

    include("../common/config.php");

    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $admin = isset($_POST['admin']) ? 1 : 0;
    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $email = $_POST['email'];
    $cpf_cnpj = $_POST['cpf_cnpj'];
    $rg = $_POST['rg'];
    $telefone = $_POST['telefone'];
    $celular = $_POST['celular'];
    $data_nasc = $_POST['data_nasc'];


    function ErrorMessage(string $message)
    {
        $_SESSION['erro_atualizacao'] = $message;
        header("Location: ../views/clientes.php");
    }

    if (!$nome){
        ErrorMessage("Nome não informado");
    }
    if (!$email){
        ErrorMessage("Email não informado");
    }
    if (!$cpf_cnpj){
        ErrorMessage("CPF/CNPJ não informado");
    }
    if (!$rg){
        ErrorMessage("RG não informado");
    }
    if (!$celular){
        ErrorMessage("Celular não informado");
    }
    if (!$data_nasc){
        ErrorMessage("Data de nascimento não informado");
    }

    $verificar_campos_unicos = "SELECT * FROM clientes WHERE email = '$email' OR cpf_cnpj = '$cpf_cnpj' OR rg = '$rg'";

    $result_query_campos_unicos = mysqli_query($conexao, $verificar_campos_unicos);
    $resu_query_campos_unicos = mysqli_fetch_assoc($result_query_campos_unicos);

    if (mysqli_num_rows($result_query_campos_unicos) > 0 && $resu_query_campos_unicos['id'] != $id) {
        mysqli_close($conexao);
        ErrorMessage("Email, CPF ou RG já cadastrado");
    }

    mysqli_begin_transaction($conexao) or die(mysqli_connect_error());

    try{
        $sql = "UPDATE clientes SET nome = '$nome', endereco = '$endereco', numero = '$numero', bairro = '$bairro', cidade = '$cidade', estado = '$estado', email = '$email', cpf_cnpj = '$cpf_cnpj', rg = '$rg', telefone = '$telefone', celular = '$celular', data_nasc = '$data_nasc' WHERE id='$id'";

        $query = mysqli_query($conexao, $sql);

        $sql = "UPDATE login_usuarios SET login = '$email', admin = $admin WHERE id_cliente='$id'";

        $query = mysqli_query($conexao, $sql);

        mysqli_commit($conexao);

        $_SESSION['sucesso_atualizacao'] = "<strong>FEITO:</strong> Cadastro atualizado!";
        header("Location: ../views/clientes.php");
    }
    catch (mysqli_exception $e){
        mysqli_rollback($conexao);

        throw $e;
        $_SESSION['erro_atualizacao'] = "<strong>ERRO:</strong><br> Cadastro não foi atualizado!";
        header("Location: ../views/clientes.php");
    }
    finally{
        mysqli_close($conexao);        
    }
?>