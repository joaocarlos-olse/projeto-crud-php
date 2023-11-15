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
            
            .col-40{
                display: inline;
                margin: 0%;
                width: 40%;    
            }
            
            .col-50{
                display: inline;
                margin: 0%;
                width: 50%;    
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

            .logo-clientes img{
                display: inline-block;
                height: 60pt;
                width: auto;
                margin-right: 1%;
            }
            
            .logo-clientes-span{
                display: inline-block;
                vertical-align: middle;
                font-size: 28pt;
                font-weight: bold;
                line-height: 120%;
                text-align: left;
            }
            
            .titulo-clientes{
                display: block;
                margin: 5% 0% 5% 0%;
            }
            
            .titulo-clientes h1{
                font-size: 3.5vw;
                font-weight: bold;
                line-height: 50%;
                margin: 0px;
            }

            .pg-sem-titulo{
                margin-bottom: 6%;
            }

            .quebra-pag{
                page-break-before: always;
            } 
            
            /* CONTEUDO PRINCIPAL */
            .main{
                display: block;
                margin: auto 2% auto 2%;
                width: 96%;
            }
            
            .linha-clientes{
                display: inline-block;
                margin: 0%;
            }
            
            .legenda-m10{
                width: auto;
                margin: -0.5% 2% 0% 2%;
                padding: 0% 1%;
                font-size: 14pt;
                font-weight: bold;
                text-transform: uppercase;
            }
            
            .sessao-clientes{
                margin: auto 1% 4% 1%;
                padding: 3% 2% 0% 2%;
                border: 1.5pt solid #003049;
                border-radius: 10pt;
            }
            
            .sessao-label{
                display: inline-block;
                font-size: 12pt;
                font-weight: bold;
                line-height: 150%;
                margin: 0% 1% 0% 0%;
            }
            
            .sessao-span{
                display: inline-block;
                font-size: 12pt;
                font-weight: normal;
                line-height: 150%;
                margin: 0%;
            }
            
            .sessao-hr{
                border-top: 1% solid #003049;
                margin: 0% 0% 2% 0%;
            }
            
            /* RODAPÉ */
            .footer{
                position: absolute;
                bottom: 0%;
                width: 96%;
                margin: 1% auto;
            }
            
            .footer hr{
                display: block;
                border-top: 1.5% solid #003049;
                padding: 0% 1%;
                margin: auto 1% auto 1%;
            }
            
            .data-hora{
                display: block;
                margin-top: 1%;
                text-align: center;
            }
            
            .data-hora span{
                font-size: 12pt;
            }       
        </style>
        <title>RELATÓRIO</title>
    </head>
    <body>
        <!-- BARRA DE NAVEGAÇÃO -->
        <header class="header">
            <div class="logo logo-clientes">
                <img src="'.$caminhoProjeto.'/images/logo.png" alt="">
                <div class="logo-clientes-span">
                    <span class="texto-vermelho">Mercearia<br>5ºCiclo</span>
                </div>
            </div>
            <div class="titulo-clientes">
                <h1 class="texto-vermelho">RELATÓRIO - CADASTRO DE CLIENTES</h1>
            </div>
        </header>
        <main class="main">';
                for($i = 0; $i < count($registros); $i++){
                    $estado_cli;
                    foreach ($estados as $sigla => $estado) {
                        if($registros[$i]['estado'] == $sigla){
                            $estado_cli = $estado;
                        }
                    }
                    if($i > 0 && $i % 3 == 0){                    
                            $html .= '<div class="footer">
                                <hr>
                                <div class="data-hora">
                                    <span>Gerado por '.$_SESSION['nome'].', em '.date('d/m/Y').' às '.date('H:i:s').'</span>
                                </div>
                            </div>
                            <div class="header quebra-pag">
                                <div class="logo logo-clientes pg-sem-titulo">
                                    <img src="'.$caminhoProjeto.'/images/logo.png" alt="">
                                    <div class="logo-clientes-span">
                                        <span class="texto-vermelho">Mercearia<br>5ºCiclo</span>
                                    </div>
                                </div>
                            </div>';
                    }
                    $html .='<fieldset class="sessao-clientes">
                    <legend class="legenda-m10 texto-vermelho">ID '.$registros[$i]['id'].'</legend>
                    <div class="linha-clientes col-50" id="primeira-linha-clientes">
                        <div>
                            <label for="Nome" class="sessao-label texto-preto">Nome:</label>
                            <span class="sessao-span texto-preto">'.$registros[$i]['nome'].'</span>
                        </div>
                    </div>
                    <div class="linha-clientes col-40">
                        <div>
                            <label for="rg" class="sessao-label texto-preto">RG:</label>
                            <span class="sessao-span texto-preto">'.$registros[$i]['rg'].'</span>
                        </div>
                    </div>
                    <div class="linha-clientes col-50">
                        <div>
                            <label for="cpf_cnpj" class="sessao-label texto-preto">CPF/CNPJ:</label>
                            <span class="sessao-span texto-preto">'.$registros[$i]['cpf_cnpj'].'</span>
                        </div>
                    </div>
                    <div class="linha-clientes col-40">
                        <div>
                            <label for="data_nasc" class="sessao-label texto-preto">Data Nasc.:</label>
                            <span class="sessao-span texto-preto">'.$registros[$i]['data_nasc'].'</span>
                        </div>
                    </div>
                    <hr class="sessao-hr">
                    <div class="linha-clientes col-50">
                        <div>
                            <label for="endereco" class="sessao-label texto-preto">Logradouro:</label>
                            <span class="sessao-span texto-preto">'.$registros[$i]['endereco'].'</span>
                        </div>
                    </div>
                    <div class="linha-clientes col-40">
                        <div>
                            <label for="numero" class="sessao-label texto-preto">Número:</label>
                            <span class="sessao-span texto-preto">'.$registros[$i]['numero'].'</span>
                        </div>
                    </div>
                    <div class="linha-clientes col-50">
                        <div>
                            <label for="cidade" class="sessao-label texto-preto">Cidade:</label>
                            <span class="sessao-span texto-preto">'.$registros[$i]['cidade'].'</span>
                        </div>
                    </div>
                    <div class="linha-clientes col-40">
                        <div>
                            <label for="estado" class="sessao-label texto-preto">Estado:</label>
                            <span class="sessao-span texto-preto">'.$estado_cli.'</span>
                        </div>
                    </div>
                    <div class="linha-clientes col-50">
                        <div>
                            <label for="bairro" class="sessao-label texto-preto">Bairro:</label>
                            <span class="sessao-span texto-preto">'.$registros[$i]['bairro'].'</span>
                        </div>
                    </div>
                        <div class="linha-clientes col-40">
                        <div></div>
                    </div>
                    <hr class="sessao-hr">
                    <div class="linha-clientes col-50">
                        <div>
                            <label for="email" class="sessao-label texto-preto">E-mail:</label>
                            <span class="sessao-span texto-preto">'.$registros[$i]['email'].'</span>
                        </div>
                    </div>
                    </div>
                        <div class="linha-clientes col-40">
                        <div></div>
                    </div>
                    <div class="linha-clientes col-50">
                        <div>
                            <label for="celular" class="sessao-label texto-preto">Celular:</label>
                            <span class="sessao-span texto-preto">'.$registros[$i]['celular'].'</span>
                        </div>
                    </div>
                    <div class="linha-clientes col-40">
                        <div>
                            <label for="telefone" class="sessao-label texto-preto">Telefone:</label>
                            <span class="sessao-span texto-preto">'.$registros[$i]['telefone'].'</span>
                        </div>
                    </div>
                </fieldset>';
                if($i == 2 || $i == count($registros)-1){                    
                    $html .= '<div class="footer">
                        <hr>
                        <div class="data-hora">
                            <span>Gerado por '.$_SESSION['nome'].', em '.date('d/m/Y').' às '.date('H:i:s').'</span>
                        </div>
                    </div>';
                }
            }
        $html .= '</body>
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