<?php
    if(session_status() != PHP_SESSION_ACTIVE){
        session_start();        
    }

    if(!isset($_SESSION['id_cliente'])){            
        header("Location: login.php");
    }

    if(isset($_SESSION['relatorio_itens_pedidos'])){
        $itens_ped = $_SESSION['relatorio_itens_pedidos'];
        unset($_SESSION['relatorio_itens_pedidos']);
    }
    else{
        $_SESSION['erro_select_pedido'] = "Não foi possível emitir o relatório!";
        header("Location: ../views/pedidos.php");
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
            
            .col-90{
                display: inline;
                margin: 0%;
                width: 90%;    
            }
            
            .col-50{
                display: inline;
                margin: 0%;
                width: 50%;    
            }
            
            .col-40{
                display: inline;
                margin: 0%;
                width: 40%;    
            }
            
            .col-25{
                display: inline;
                margin: 0%;
                width: 25%;    
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
                text-align: center;
            }

            .table td, .table th {
                padding: .75rem;
                vertical-align: top;
                border-bottom: 1px solid #003049;
                text-align: left;
            }

            th {
                text-align: center;
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
            <div class="titulo-clientes">
                <h1 class="texto-vermelho">RELATÓRIO - DETALHES DO PEDIDO</h1>
            </div>
        </header>
        <main class="main">
            <fieldset class="sessao-clientes">
                <legend class="legenda-m40 texto-vermelho">Dados Pessoais</legend>
                <div class="linha-clientes col-50">
                    <div>
                        <label for="ID" class="sessao-label texto-preto">Nome:</label>
                        <span class="sessao-span texto-preto">'.$itens_ped[0]['nome'].'</span>
                    </div>
                </div>
                <div class="linha-clientes col-40">
                    <div>
                        <label for="Nome" class="sessao-label texto-preto">CPF/CNPJ:</label>
                        <span class="sessao-span texto-preto">'.$itens_ped[0]['cpf_cnpj'].'</span>
                    </div>
                </div>
                <div class="linha-clientes col-50">
                    <div>
                        <label for="ID" class="sessao-label texto-preto">E-mail:</label>
                        <span class="sessao-span texto-preto">'.$itens_ped[0]['email'].'</span>
                    </div>
                </div>
                <div class="linha-clientes col-40">
                    <div>
                        <label for="Nome" class="sessao-label texto-preto">Celular:</label>
                        <span class="sessao-span texto-preto">'.$itens_ped[0]['celular'].'</span>
                    </div>
                </div>
            </fieldset>
            <fieldset class="sessao-clientes">
                <legend class="legenda-m40 texto-vermelho">Informações do Pedido</legend>
                <div class="linha-clientes col-50">
                    <div>
                        <label for="Nome" class="sessao-label texto-preto">Condição Pagto.:</label>
                        <span class="sessao-span texto-preto">'.$itens_ped[0]['cond_pagamento'].'</span>
                    </div>
                </div>                
                <div class="linha-clientes col-40">
                    <div>
                        <label for="Nome" class="sessao-label texto-preto">Prazo de entrega:</label>
                        <span class="sessao-span texto-preto">'.$itens_ped[0]['prazo_entrega'].'</span>
                    </div>
                </div>                
                <div class="linha-clientes col-50">
                    <div>
                        <label for="Nome" class="sessao-label texto-preto">Data do Pedido:</label>
                        <span class="sessao-span texto-preto">'.$itens_ped[0]['data_pedido'].'</span>
                    </div>
                </div>                
                <div class="linha-clientes col-90">
                    <div>
                        <label for="Nome" class="sessao-label texto-preto">Observação:</label>
                        <span class="sessao-span texto-preto">'.$itens_ped[0]['observacao'].'</span>
                    </div>
                </div>                
            </fieldset>
            <fieldset class="sessao-clientes">
                <legend class="legenda-m40 texto-vermelho">Produtos do Pedido</legend>
                <div class="table-responsive">
                    <table class="table table-hover mb-3">
                        <thead class="texto-vermelho">
                            <tr>
                                <th scope="col">Descrição</th>
                                <th scope="col">Quantidade</th>
                                <th scope="col">Unidade de Medida</th>
                            </tr>
                        </thead>
                        <tbody>';
                            for($i = 0; $i < count($itens_ped); $i++){
                                $html .=' <tr>
                                    <th scope="row">'.$itens_ped[$i]['descricao'].'</th>
                                    <td>'.$itens_ped[$i]['qtde'].'</td>
                                    <td>'.$itens_ped[$i]['unidade_medida'].'</td>
                                </tr>';
                            }
                $html .= '</tbody>
                    </table>
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