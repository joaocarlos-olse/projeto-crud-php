<?php
    if(session_status() != PHP_SESSION_ACTIVE){
        session_start();        
    }

    if(!isset($_SESSION['id_cliente'])){            
        header("Location: login.php");
    }

    if(isset($_SESSION['relatorio_produtos'])){
        $produtos = $_SESSION['relatorio_produtos'];
        unset($_SESSION['relatorio_produtos']);
    }
    else{
        $_SESSION['erro_select_prod'] = "Não foi possível emitir o relatório!";
        header("Location: ../functions/select_produto.php");
    }

    include_once('config.php');
    date_default_timezone_set('America/Sao_Paulo');

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

            .fundo-vermelho{
                background-color: #780000;
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

            .table-responsive {
                display: block;
                width: 100%;
                overflow-x: auto;
            }

            .mb-3, .my-3 {
                margin-bottom: 1rem !important;
            }

            .table {
                width: 100%;
                margin-bottom: 1rem;
                background-color: transparent;
            }

            table {
                border-collapse: collapse;
            }

            .table td, .table th {
                padding: .75rem;
                vertical-align: top;
                border-bottom: 1px solid #003049;
            }

            th {
                text-align: inherit;
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
                <h1 class="texto-vermelho">RELATÓRIO - CADASTRO DE PRODUTOS</h1>
            </div>
        </header>
        <main class="main">
            <div class="table-responsive">
                <table class="table table-hover mb-3">
                    <thead class="fundo-vermelho texto-branco">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Qtd. Estoque</th>
                            <th scope="col">Valor (R$)</th>
                            <th scope="col">Uni. Medida</th>
                        </tr>
                    </thead>
                    <tbody>';

                foreach($produtos as $prod){
                    $html .= '                             
                        <tr>
                            <th scope="row">'.$prod['id'].'</th>
                            <td id="nome'.$prod['id'].'">'.$prod['nome'].'</td>
                            <td id="qtde_estoque'.$prod['id'].'">'.$prod['qtde_estoque'].'</td>
                            <td id="valor_unitario'.$prod['id'].'">'.$prod['valor_unitario'].'</td>
                            <td id="unidade_medida'.$prod['id'].'">'.$prod['unidade_medida'].'</td>
                        </tr>
                    ';
                }

        $html .= '</tbody>
                </table>
            </div>
            <div class="footer">
                <hr>
                <div class="data-hora">
                    <span>Gerado por '.$_SESSION['nome'].', em '.date('d/m/Y').' às '.date('H:i:s').'</span>
                </div>
            </div>
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