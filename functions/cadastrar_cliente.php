<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
require("../common/config.php");

$admin = $_POST['admin'] == 1 ? 1 : 0;
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
    $_SESSION['erro_cadastro'] = $message;
    header("Location: ../views/login.php");
}

if (!$nome) {
    ErrorMessage("Nome não informado");
}
if (!$email) {
    ErrorMessage("Email não informado");
}
if (!$cpf_cnpj) {
    ErrorMessage("CPF/CNPJ não informado");
}
if (!$rg) {
    ErrorMessage("RG não informado");
}
if (!$celular) {
    ErrorMessage("Celular não informado");
}
if (!$data_nasc) {
    ErrorMessage("Data de nascimento não informado");
}

$verificar_campos_unicos = "SELECT * FROM clientes WHERE email = '$email' OR cpf_cnpj = '$cpf_cnpj' OR rg = '$rg'";

$result_query_campos_unicos = mysqli_query($conexao, $verificar_campos_unicos);

if (mysqli_num_rows($result_query_campos_unicos) > 0) {
    mysqli_close($conexao);
    ErrorMessage("Email, CPF ou RG já cadastrado");
}

mysqli_begin_transaction($conexao) or die(mysqli_connect_error());

try {
    $sql = "INSERT INTO clientes (nome, endereco, numero, bairro, cidade, estado, email, cpf_cnpj, rg, telefone, celular, data_nasc) VALUES ('$nome', '$endereco', '$numero', '$bairro', '$cidade', '$estado', '$email', '$cpf_cnpj', '$rg', '$telefone', '$celular', '$data_nasc')";

    $query = mysqli_query($conexao, $sql);

    $sql = "SELECT * FROM clientes WHERE cpf_cnpj = '$cpf_cnpj'";
    $query = mysqli_query($conexao, $sql);
    $cliente_inserido = mysqli_fetch_assoc($query);

    $senha = password_hash($cpf_cnpj, PASSWORD_DEFAULT);
    $id_cliente = $cliente_inserido['id'];
    $sql = "INSERT INTO login_usuarios (login, senha, admin, id_cliente) VALUES ('$email', '$senha', $admin, '$id_cliente')";

    $query = mysqli_query($conexao, $sql);

    $_SESSION['sucesso_cadastro'] = "<strong>FEITO:</strong> Cadastro realizado!";
    $_SESSION['usuario'] = $email;
    $_SESSION['senha_provisoria'] = $cpf_cnpj;

    mysqli_commit($conexao);

    if (isset($_SESSION["id_cliente"])) {
        header("Location: select_cliente.php");
    } else {
        header("Location: ../views/login.php");
    }
} catch (mysqli_exception $e) {
    mysqli_rollback($conexao);

    $_SESSION['erro_cadastro'] = "<strong>ERRO:</strong><br> Cadastro não foi realizado!";
    header("Location: ../views/login.php");
    
} finally {
    mysqli_close($conexao);
}
