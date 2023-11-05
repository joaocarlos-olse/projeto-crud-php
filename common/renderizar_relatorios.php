<?php
    // if(session_status() != PHP_SESSION_ACTIVE){
    //     session_start();        
    // }

    // if(!isset($_SESSION['id_cliente'])){            
    //     header("Location: ../views/login.php");
    // }

    // Carrega o Composer autoloader
    require ('../dompdf/vendor/autoload.php');

    use Dompdf\Dompdf;
    use Dompdf\Options;

    // Crie uma nova instância do Options
    $Options = new Options();
    $Options->setChroot('../'.__DIR__);

    // Crie uma nova instância do Dompdf
    $dompdf = new Dompdf(['enable_remote' => true]);

    // Carregue o HTML no Dompdf
    $dompdf->loadHtmlFile("../common/relatorio_cliente.php");

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