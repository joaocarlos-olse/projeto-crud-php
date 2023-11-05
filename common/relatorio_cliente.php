<?php
    if(session_status() != PHP_SESSION_ACTIVE){
        session_start();        
    }

    if(!isset($_SESSION['id_cliente'])){            
        header("Location: ../views/login.php");
    }

    if(isset($_SESSION['relatorio_cliente'])){
        $registros = $_SESSION['relatorio_cliente'];
        unset($_SESSION['registros']);
    }
    else{
        $_SESSION['erro_select_cli'] = "Não foi possível emitir o relatório!";
        header("Location: ../views/clientes.php");
    }

    date_default_timezone_set('America/Sao_Paulo');

    $estados = array("AC" => "Acre", "AL" => "Alagoas", "AP" => "Amapá", "AM" => "Amazonas", "BA" => "Bahia", "CE" => "Ceará", "DF" => "Distrito Federal", "ES" => "Espírito Santo", "GO" => "Goiás", "MA" => "Maranhão", "MT" => "Mato Grosso", "MS" => "Mato Grosso do Sul", "MG" => "Minas Gerais", "PA" => "Pará", "PB" => "Paraíba", "PR" => "Paraná", "PE" => "Pernambuco", "PI" => "Piauí", "RJ" => "Rio de Janeiro", "RN" => "Rio Grande do Norte", "RS" => "Rio Grande do Sul", "RO" => "Rondônia", "RR" => "Roraima", "SC" => "Santa Catarina", "SP" => "São Paulo", "SE" => "Sergipe", "TO" => "Tocantins");

    $estado_cli;
    foreach ($estados as $sigla => $estado) {
        if($registros[0]['estado'] == $sigla){
            $estado_cli = $estado;
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS BOOTSTRAP -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">            
    <!-- ICONES BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"> 
    <!-- FONTS DO GOOGLE -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- MEU CSS -->
    <link rel="stylesheet" href="../css/style_relatorio.css">
    <title>RELATÓRIO</title>
</head>
<body>
    <!-- BARRA DE NAVEGAÇÃO -->
    <header class="header">
        <div class="logo logo-cliente">
            <img src="../images/logo.png" alt="Home">
            <div class="logo-cliente-span">
                <span class="texto-vermelho">Mercearia<br>5ºCiclo</span>
            </div>
        </div>
        <div class="titulo-cliente">
            <h1 class="texto-vermelho">RELATÓRIO - CADASTRO DE CLIENTE</h1>
        </div>
    </header>
    <main class="main">
        <fieldset class="sessao-cliente">
            <legend class="legenda-m40 texto-vermelho">Dados Pessoais</legend>
            <div class="linha-cliente">
                <label for="ID" class="sessao-label texto-preto">ID:</label>
                <span class="sessao-span texto-preto"><?php echo($registros[0]['id']) ?></span>
            </div>
            <div class="linha-cliente">
                <label for="Nome" class="sessao-label texto-preto">Nome:</label>
                <span class="sessao-span texto-preto"><?php echo($registros[0]['nome']) ?></span>
            </div>
            <div class="linha-cliente">
                <label for="rg" class="sessao-label texto-preto">RG:</label>
                <span class="sessao-span texto-preto"><?php echo($registros[0]['rg']) ?></span>
            </div>
            <div class="linha-cliente">
                <label for="cpf_cnpj" class="sessao-label texto-preto">CPF/CNPJ:</label>
                <span class="sessao-span texto-preto"><?php echo($registros[0]['cpf_cnpj']) ?></span>
            </div>
            <div class="linha-cliente">
                <label for="data_nasc" class="sessao-label texto-preto">Data de Nascimento:</label>
                <span class="sessao-span texto-preto"><?php echo($registros[0]['data_nasc']) ?></span>
            </div>
        </fieldset>
        <fieldset class="sessao-cliente">
            <legend class="legenda-m40 texto-vermelho">Endereço</legend>
            <div class="linha-cliente">
                <label for="logradouro" class="sessao-label texto-preto">Logradouro:</label>
                <span class="sessao-span texto-preto"><?php echo($registros[0]['endereco']) ?></span>
            </div>
            <div class="linha-cliente">
                <label for="numero" class="sessao-label texto-preto">Número:</label>
                <span class="sessao-span texto-preto"><?php echo($registros[0]['numero']) ?></span>
            </div>
            <div class="linha-cliente">
                <label for="cidade" class="sessao-label texto-preto">Cidade:</label>
                <span class="sessao-span texto-preto"><?php echo($registros[0]['cidade']) ?></span>
            </div>
            <div class="linha-cliente">
                <label for="bairro" class="sessao-label texto-preto">Bairro:</label>
                <span class="sessao-span texto-preto"><?php echo($registros[0]['bairro']) ?></span>
            </div>
            <div class="linha-cliente">
                <label for="estado" class="sessao-label texto-preto">Estado:</label>
                <span class="sessao-span texto-preto"><?php echo($estado_cli) ?></span>
            </div>
        </fieldset>
        </fieldset>
        <fieldset class="sessao-cliente">
            <legend class="legenda-m40 texto-vermelho">Dados para Contato</legend>
            <div class="linha-cliente">
                <label for="email" class="sessao-label texto-preto">E-mail:</label>
                <span class="sessao-span texto-preto"><?php echo($registros[0]['email']) ?></span>
            </div>
            <div class="linha-cliente">
                <label for="telefone" class="sessao-label texto-preto">Telefone Fixo:</label>
                <span class="sessao-span texto-preto"><?php echo($registros[0]['telefone']) ?></span>
            </div>
            <div class="linha-cliente">
                <label for="celular" class="sessao-label texto-preto">Telefone Celular:</label>
                <span class="sessao-span texto-preto"><?php echo($registros[0]['celular']) ?></span>
            </div>
        </fieldset>
    </main>
    <footer class="footer">
        <hr>
        <div class="data-hora">
            <span>Gerado por <?php echo($_SESSION['nome'])?>, em <?php echo(date('d/m/Y'))?> às <?php echo((date('H:i:s'))) ?></span>
        </div>
    </footer>    
</body>
</html>