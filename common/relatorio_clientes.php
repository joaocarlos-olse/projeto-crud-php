<?php
    if(session_status() != PHP_SESSION_ACTIVE){
        session_start();        
    }

    if(!isset($_SESSION['id_cliente'])){            
        header("Location: login.php");
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
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">         
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
        <div class="logo logo-clientes">
            <img src="../images/logo.png" alt="Home">
            <div class="logo-clientes-span">
                <span class="texto-vermelho">Mercearia<br>5ºCiclo</span>
            </div>
        </div>
        <div class="titulo-clientes">
            <h1 class="texto-vermelho">RELATÓRIO - CADASTRO DE CLIENTES</h1>
        </div>
    </header>
    <main class="main">
        <?php 
            for($i = 0; $i < count($registros); $i++){
                $estado_cli;
                foreach ($estados as $sigla => $estado) {
                    if($registros[$i]['estado'] == $sigla){
                        $estado_cli = $estado;
                    }
                }
                if($i > 0 && $i % 3 == 0){                    
                    echo('
                        <div class="header">
                            <div class="logo logo-clientes">
                                <img src="../images/logo.png" alt="Home">
                                <div class="logo-clientes-span">
                                    <span class="texto-vermelho">Mercearia<br>5ºCiclo</span>
                                </div>
                            </div>
                            <div class="titulo-clientes">
                                <h1 class="texto-vermelho">RELATÓRIO - CADASTRO DE CLIENTES</h1>
                            </div>
                        </div>
                    ');
                }
                echo('
                    <fieldset class="sessao-clientes">
                        <legend class="legenda-m10 texto-vermelho">ID '.$registros[$i]['id'].'</legend>
                        <div class="linha-clientes" id="primeira-linha-clientes">
                            <div class="col-60">
                                <label for="Nome" class="sessao-label texto-preto">Nome:</label>
                                <span class="sessao-span texto-preto">'.$registros[$i]['nome'].'</span>
                            </div>
                            <div class="col-40">
                                <label for="rg" class="sessao-label texto-preto">RG:</label>
                                <span class="sessao-span texto-preto">'.$registros[$i]['rg'].'</span>
                            </div>
                        </div>
                        <div class="linha-clientes">
                            <div class="col-60">
                                <label for="cpf_cnpj" class="sessao-label texto-preto">CPF/CNPJ:</label>
                                <span class="sessao-span texto-preto">'.$registros[$i]['cpf_cnpj'].'</span>
                            </div>
                            <div class="col-40">
                                <label for="data_nasc" class="sessao-label texto-preto">Data Nasc.:</label>
                                <span class="sessao-span texto-preto">'.$registros[$i]['data_nasc'].'</span>
                            </div>
                        </div>
                        <hr class="sessao-hr">
                        <div class="linha-clientes">
                            <div class="col-60">
                                <label for="logradouro" class="sessao-label texto-preto">Logradouro:</label>
                                <span class="sessao-span texto-preto">'.$registros[$i]['endereco'].'</span>
                            </div>
                            <div class="col-40">
                                <label for="numero" class="sessao-label texto-preto">Número:</label>
                                <span class="sessao-span texto-preto">'.$registros[$i]['numero'].'</span>
                            </div>
                        </div>
                        <div class="linha-clientes">
                            <div class="col-60">
                                <label for="cidade" class="sessao-label texto-preto">Cidade:</label>
                                <span class="sessao-span texto-preto">'.$registros[$i]['cidade'].'</span>
                            </div>
                            <div class="col-40">
                                <label for="estado" class="sessao-label texto-preto">Estado:</label>
                                <span class="sessao-span texto-preto">'.$estado_cli.'</span>

                            </div>
                        </div>
                        <div class="linha-clientes">
                            <div class="col-90">
                                <label for="bairro" class="sessao-label texto-preto">Bairro:</label>
                                <span class="sessao-span texto-preto">'.$registros[$i]['bairro'].'</span>
                            </div>
                        </div>
                        <hr class="sessao-hr">
                        <div class="linha-clientes">
                            <div class="col-90">
                                <label for="email" class="sessao-label texto-preto">E-mail:</label>
                                <span class="sessao-span texto-preto">'.$registros[$i]['email'].'</span>
                            </div>
                        </div>
                        <div class="linha-clientes">
                            <div class="col-60">
                                <label for="celular" class="sessao-label texto-preto">Telefone Celular:</label>
                                <span class="sessao-span texto-preto">'.$registros[$i]['telefone'].'</span>
                            </div>
                            <div class="col-40">
                                <label for="telefone" class="sessao-label texto-preto">Telefone Fixo:</label>
                                <span class="sessao-span texto-preto">'.$registros[$i]['celular'].'</span>
                            </div>
                        </div>
                    </fieldset>                
                ');
            } 
        ?>
    </main>
    <footer class="footer">
        <hr>
        <div class="data-hora">
            <span>Gerado por <?php echo($_SESSION['nome'])?>, em <?php echo(date('d/m/Y'))?> às <?php echo((date('H:i:s'))) ?></span>
        </div>
    </footer>    
</body>
</html>