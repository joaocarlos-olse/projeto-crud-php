<?php
    if(session_status() != PHP_SESSION_ACTIVE){
        session_start();        
    }

    if(!isset($_SESSION['id_cliente'])){            
        header("Location: login.php");
    }

    if(isset($_SESSION['relatorio_cliente'])){
        $registros = $_SESSION['relatorio_cliente'];
        unset($_SESSION['relatorio_cliente']);
    }
    else{
        $_SESSION['erro_select_cli'] = "Não foi possível emitir o relatório!";
        header("Location: ../views/clientes.php");
    }

    include_once('config.php');
    date_default_timezone_set('America/Sao_Paulo');

    $estados = array("AC" => "Acre", "AL" => "Alagoas", "AP" => "Amapá", "AM" => "Amazonas", "BA" => "Bahia", "CE" => "Ceará", "DF" => "Distrito Federal", "ES" => "Espírito Santo", "GO" => "Goiás", "MA" => "Maranhão", "MT" => "Mato Grosso", "MS" => "Mato Grosso do Sul", "MG" => "Minas Gerais", "PA" => "Pará", "PB" => "Paraíba", "PR" => "Paraná", "PE" => "Pernambuco", "PI" => "Piauí", "RJ" => "Rio de Janeiro", "RN" => "Rio Grande do Norte", "RS" => "Rio Grande do Sul", "RO" => "Rondônia", "RR" => "Roraima", "SC" => "Santa Catarina", "SP" => "São Paulo", "SE" => "Sergipe", "TO" => "Tocantins");

    $estado_cli;
    foreach ($estados as $sigla => $estado) {
        if($registros[0]['estado'] == $sigla){
            $estado_cli = $estado;
        }
    }

    // include autoloader
    require_once '../dompdf/autoload.inc.php';

    use Dompdf\Dompdf;
    use Dompdf\Options;

    // Crie uma nova instância do Dompdf
    $options = new Options();
    $options->set('isRemoteEnabled', true);
    $dompdf = new Dompdf($options);

    $html = '<!DOCTYPE html>
    <html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <!-- MEU CSS -->
        <style>
            body{
                margin: 0;
                padding: 0;
                font-family: Arial, Helvetica, sans-serif;
            }
            
            @page {
                size: A4;
                margin: 4% 2% 2% 2%;
            }
            
            .texto-branco{
                color: #F7F7FF;
            }
            
            .texto-preto{
                color: #040403;
            }
            
            .texto-azul{
                color: #003049;
            }
            
            .texto-vermelho{
                color: #780000;
            }
            
            .col-90{
                display: inline;
                margin: 0%;
                width: 90%;    
            }
            
            /* CABEÇALHO */
            .header{
                display: block;
                margin: 0% 2% 2% 2%;
                width: 96%;
                text-align: center;
            }
            
            .logo{
                display: block;
                vertical-align: middle;
                width: 100%;
            }
            
            .logo-cliente img{
                display: inline-block;
                height: 70pt;
                width: auto;
                margin-right: 1%;
            }
            
            .logo-cliente-span{
                display: inline-block;
                vertical-align: middle;
                font-size: 32pt;
                font-weight: bold;
                line-height: 120%;
                text-align: left;
            }
            
            .titulo-cliente{
                display: block;
                margin: 7% 0% 0% 0%;
            }
            
            .titulo-cliente h1{
                font-size: 4%;
                font-weight: bold;
                line-height: 50%;
                margin: 0px;
            }
            
            /* CONTEUDO PRINCIPAL */
            .main{
                display: block;
                margin: auto 2% auto 2%;
                width: 96%;
            }
            
            .linha-cliente{
                display: block;
                line-height: 250%;
            }
            
            .legenda-m40{
                width: auto;
                margin: -0.5% 2% 0% 2%;
                padding: 0% 1%;
                font-size: 16pt;
                font-weight: bold;
                text-transform: uppercase;
            }
            
            .sessao-cliente{
                margin: auto 1% 4% 1%;
                padding: 3% 2% 3% 2%;
                border: 1.5pt solid #003049;
                border-radius: 10pt;
            }
            
            .sessao-label{
                display: inline-block;
                font-size: 13pt;
                font-weight: bold;
                line-height: 150%;
                margin: 0% 1% 0% 0%;
            }
            
            .sessao-span{
                display: inline-block;
                font-size: 13pt;
                font-weight: normal;
                line-height: 150%;
                margin: 0%;
            }
            
            /* RODAPÉ */
            .footer{
                diplay: block;
                position: absolute;
                bottom: 0%;
                width: 96%;
                margin: auto 2% auto 2%;
                text-align: center;
            }
            
            .footer hr{
                display: block;
                border-top: 1.5% solid #003049;
                padding: 0% 1%;
                margin: auto;
                
            }
            
            .data-hora{
                display: block;
                margin-top: 1%;
                text-align: center;
            }
            
            .data-hora span{
                text-align: center;
                font-size: 12pt;
            }
        </style>
        <title>RELATÓRIO</title>
    </head>
    <body>
        <!-- BARRA DE NAVEGAÇÃO -->
        <header class="header">
            <div class="logo logo-cliente">
                <img src="'.$caminhoProjeto.'/images/logo.png" alt="">
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
                    <span class="sessao-span texto-preto">'.$registros[0]['id'].'</span>
                </div>
                <div class="linha-cliente">
                    <label for="Nome" class="sessao-label texto-preto">Nome:</label>
                    <span class="sessao-span texto-preto">'.$registros[0]['nome'].'</span>
                </div>
                <div class="linha-cliente">
                    <label for="rg" class="sessao-label texto-preto">RG:</label>
                    <span class="sessao-span texto-preto">'.$registros[0]['rg'].'</span>
                </div>
                <div class="linha-cliente">
                    <label for="cpf_cnpj" class="sessao-label texto-preto">CPF/CNPJ:</label>
                    <span class="sessao-span texto-preto">'.$registros[0]['cpf_cnpj'].'</span>
                </div>
                <div class="linha-cliente">
                    <label for="data_nasc" class="sessao-label texto-preto">Data de Nascimento:</label>
                    <span class="sessao-span texto-preto">'.$registros[0]['data_nasc'].'</span>
                </div>
            </fieldset>
            <fieldset class="sessao-cliente">
                <legend class="legenda-m40 texto-vermelho">Endereço</legend>
                <div class="linha-cliente">
                    <label for="logradouro" class="sessao-label texto-preto">Logradouro:</label>
                    <span class="sessao-span texto-preto">'.$registros[0]['endereco'].'</span>
                </div>
                <div class="linha-cliente">
                    <label for="numero" class="sessao-label texto-preto">Número:</label>
                    <span class="sessao-span texto-preto">'.$registros[0]['numero'].'</span>
                </div>
                <div class="linha-cliente">
                    <label for="cidade" class="sessao-label texto-preto">Cidade:</label>
                    <span class="sessao-span texto-preto">'.$registros[0]['cidade'].'</span>
                </div>
                <div class="linha-cliente">
                    <label for="bairro" class="sessao-label texto-preto">Bairro:</label>
                    <span class="sessao-span texto-preto">'.$registros[0]['bairro'].'</span>
                </div>
                <div class="linha-cliente">
                    <label for="estado" class="sessao-label texto-preto">Estado:</label>
                    <span class="sessao-span texto-preto">'.$estado_cli.'</span>
                </div>
            </fieldset>
            </fieldset>
            <fieldset class="sessao-cliente">
                <legend class="legenda-m40 texto-vermelho">Dados para Contato</legend>
                <div class="linha-cliente">
                    <label for="email" class="sessao-label texto-preto">E-mail:</label>
                    <span class="sessao-span texto-preto">'.$registros[0]['email'].'</span>
                </div>
                <div class="linha-cliente">
                    <label for="telefone" class="sessao-label texto-preto">Telefone Fixo:</label>
                    <span class="sessao-span texto-preto">'.$registros[0]['telefone'].'</span>
                </div>
                <div class="linha-cliente">
                    <label for="celular" class="sessao-label texto-preto">Telefone Celular:</label>
                    <span class="sessao-span texto-preto">'.$registros[0]['celular'].'</span>
                </div>
            </fieldset>
        </main>
        <footer class="footer">
            <hr>
            <div class="data-hora">
                <span>Gerado por '.$_SESSION['nome'].', em '.date('d/m/Y').' às '.date('H:i:s').'</span>
            </div>
        </footer>    
    </body>
    </html>';

    // Carregue o HTML no Dompdf
    $dompdf->loadHtml($html);

    // Configuração e orientação da página
    $dompdf->setPaper('A4', 'portrait');

    // Renderize o HTML em PDF
    $dompdf->render();

    // Gere o arquivo PDF
    $dompdf->stream(
        "Relatório",
        array(
            "Attachment" => False
        )
    );
?>