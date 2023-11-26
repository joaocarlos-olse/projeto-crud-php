<?php
    if(session_status() != PHP_SESSION_ACTIVE){
        session_start();        
    }

    if(!isset($_SESSION['id_cliente'])){            
        header("Location: login.php");
    }

    // Select cliente(s)
    if(!isset($_SESSION['pedido_cliente'])){
        if($_SESSION['admin'] == 1){
            header("Location: ../functions/select_cliente.php?cli_pedido=true");            
        }
        else{
            header('Location: ../functions/select_cliente.php?cli_pedido=true&id='.$_SESSION['id_cliente'].'');
        }        
    }

    // Select produtos
    if(!isset($_SESSION['pedido_produtos'])){
        header("Location: ../functions/select_produto.php?prod_pedido=true");
    }

    // Select pedidos
    if(!isset($_SESSION['pedidos']) && !isset($_SESSION['erro_select_pedido'])){     
        if($_SESSION['admin'] == 1){
            header("Location: ../functions/select_pedido.php");            
        }
        else{
            header('Location: ../functions/select_pedido.php?id='.$_SESSION['id_cliente'].'');
        }        
    }

    // Definição de variáveis
    $pedidos = array();
    if(isset($_SESSION['pedidos'])){            
        $pedidos = $_SESSION['pedidos'];
    }
    if(isset($_SESSION['pedido_produtos'])){            
        $produtos = $_SESSION['pedido_produtos'];
    }
    if(isset($_SESSION['pedido_cliente'])){            
        $clientes = $_SESSION['pedido_cliente'];
    }
    if(isset($_SESSION['pedidos']) && isset($_SESSION['pedido_produtos']) && isset($_SESSION['pedido_cliente'])){            
        unset($_SESSION['pedidos']);
        unset($_SESSION['pedido_cliente']);
        unset($_SESSION['pedido_produtos']);
    }

    date_default_timezone_set('America/Sao_Paulo'); 

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
    <!-- JS BOOTSTRAP -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous" defer></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous" defer></script>    
    <!-- FONTS DO GOOGLE -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- MEU CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- MEU JS -->
    <script src="../js/script_pedido.js"></script>
    <!-- MEU FAVICON -->
    <link rel="shortcut icon" href="../images/icons/logo.ico" type="image/x-icon">
    <title>Cadastro de Pedidos</title>
</head>

<body>
    <!-- BARRA DE NAVEGAÇÃO -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-destaque">
        <div class="container py-2">
            <a class="navbar-brand" href="index.php">
                <img src="../images/logo_outline.png" alt="Home" id="logo">
                <span>Mercearia<br>5ºCiclo</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#textoNavbar" aria-controls="textoNavbar" aria-expanded="false" aria-label="Alterna navegação">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="textoNavbar">
                <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link cor-primaria" href="painel.php">Painel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link cor-primaria" href="clientes.php">Clientes</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link cor-primaria" href="pedidos.php">Pedidos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link cor-primaria" href="produtos.php">Produtos</a>
                    </li>
                </ul>
                <?php
                if (isset($_SESSION['id_cliente'])) {
                    echo ('
                            <span class="cor-primaria">Olá,</span><a href="../painel.php" class="nav-link cor-primaria">' . $_SESSION['nome'] . '</a><a href="../functions/logout.php"><button type="button" class="btn btn-outline-light cor-primaria btn-sm btn-boas-vindas">Sair</button></a>
                        ');
                } else {
                    echo ('
                            <a href="login.php"><button type="button" class="btn btn-outline-light cor-primaria btn-index-login">Login</button></a>                        
                        ');
                }
                ?>
            </div>
        </div>
    </nav>

    <!-- CONTEUDO PRINCIPAL -->
    <div class="altura-minima mb-5">
        <div class="container">

            <h2 class="title mb-4 mt-5 cor-destaque">Cadastro de Pedidos</h2>

            <?php
                if(isset($_SESSION['erro_cadastro'])){            
                    echo('
                    <div class="alert alert-danger erro-login" role="alert">
                        '.$_SESSION['erro_cadastro'].'
                    </div>
                    ');
                    unset($_SESSION['erro_cadastro']);
                }
                if(isset($_SESSION['sucesso_cadastro'])){            
                    echo('
                    <div class="alert alert-success erro-login" role="alert">
                        '.$_SESSION['sucesso_cadastro'].'
                    </div>
                    ');
                    unset($_SESSION['sucesso_cadastro']);
                }
                if(isset($_SESSION['erro_excluir'])){            
                    echo('
                    <div class="alert alert-danger erro-login" role="alert">
                        '.$_SESSION['erro_excluir'].'
                    </div>
                    ');
                    unset($_SESSION['erro_excluir']);
                }
                if(isset($_SESSION['sucesso_excluir'])){            
                    echo('
                    <div class="alert alert-success erro-login" role="alert">
                        '.$_SESSION['sucesso_excluir'].'
                    </div>
                    ');
                    unset($_SESSION['sucesso_excluir']);
                }             
            ?>

            <div class="gap-2 d-md-flex justify-content-end d-flex">
                <a href="" data-toggle="modal" data-target="#ModalConsulta" class="btn-tabela bg-destaque cor-primaria">
                    <i class="bi bi-search "></i>
                    <span>Consultar</span>
                </a>
                <a href="" data-toggle="modal" data-target="#ModalCadastro" class="btn-tabela bg-destaque cor-primaria">
                    <i class="bi bi-plus-lg"></i>
                    <span>Novo Pedido</span>
                </a>
                <a href="../common/relatorio_pedidos_render.php" target="_blank" class="btn-tabela bg-cor-secundaria cor-primaria justify-content-center d-flex align-items-center">
                    <i class="bi bi-file-earmark-pdf "></i>
                    <span>Emitir Relatório</span>
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-3">
                    <thead class="bg-destaque cor-primaria">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Data Pedido</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Observação</th>
                            <th scope="col">Cond. Pagamentos</th>
                            <th scope="col">Prazo de Entrega</th>
                            <?php
                                if($_SESSION['admin'] == 1){
                                echo('
                                    <th scope="col">Visualizar</th>
                                    <th scope="col">Excuir</th>                                                
                                ');
                                }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(count($pedidos) > 0){
                            foreach ($pedidos as $ped) {
                                echo ('                             
                                <tr>
                                    <th scope="row">' . $ped['id'] . '</th>
                                    <td id="data_pedido' . $ped['id'] . '">' . $ped['data_pedido'] . '</td>
                                    <td id="id_cliente' . $ped['id'] . '">' . $ped['nome'] . '</td>
                                    <td id="observacao' . $ped['id'] . '">' . $ped['observacao'] . '</td>
                                    <td id="cond_pagamento' . $ped['id'] . '">' . $ped['cond_pagamento'] . '</td>
                                    <td id="prazo_entrega' . $ped['id'] . '">' . $ped['prazo_entrega'] . '</td>
                                ');
                                if ($_SESSION['admin'] == 1) {
                                    echo ('                        
                                    <td class="td-icone-acoes">
                                        <a href="../functions/select_itens_pedido.php?id=' . $ped['id'] . '" target="_blank" class="bi bi-eye icone-acoes cor-destaque"></a>
                                    </td>
                                    <td class="td-icone-acoes">
                                        <button type="button" class="bi bi-trash-fill icone-acoes cor-destaque" onclick="excluirPedidoId(' . $ped['id'] . ');" ></button>
                                    </td>
                                </tr>
                                ');
                                }
                            }
                        }
                        else{
                            if(isset($_SESSION['erro_select_pedido'])){            
                                echo('<td colspan="8">'.$_SESSION['erro_select_pedido'].'</td>');
                                unset($_SESSION['erro_select_pedido']);
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- RODAPÉ -->
    <footer class="container-fluid bg-escuro" id="rodape-container">
        <div class="container">
            <div class="row">
                <!-- TOPO RODAPÉ -->
                <div class="col-12" id="rodape-topo">
                    <div class="row justify-content-between">
                        <div class="col-4">
                            <h2>Mercearia 5ºCiclo</h2>
                        </div>
                        <div class="col-4" id="redes-sociais-icones">
                            <i class="bi bi-facebook"></i>
                            <i class="bi bi-instagram"></i>
                            <i class="bi bi-youtube"></i>
                            <i class="bi bi-pinterest"></i>
                        </div>
                    </div>
                </div>
                <!-- CONTEUDO RODAPÉ -->
                <div class="col-12" id="rodape-conteudo">
                    <div class="row">
                        <div class="col-12 col-md-4" id="novidades-container">
                            <h4>Fique por dentro das novidades</h4>
                            <p>
                                Inscreva-se para saber em primeira mão
                            </p>
                            <form>
                                <div class="mb-3">
                                    <input type="email" class="form-control" placeholder="Digite o seu e-mail" />
                                </div>
                                <button class="btn btn-outline-light cor-primaria">Inscrever-se</button>
                            </form>
                        </div>
                        <div class="col-12 col-md-5"></div>
                        <div class="col-12 col-md-3" id="contact-container">
                            <h4>Formas de contato</h4>
                            <p>(99)9999-9999</p>
                            <p>contato@mercearia5ciclo.com</p>
                        </div>
                    </div>
                </div>
                <!-- FIM RODAPÉ -->
                <div class="col-12" id="rodape-fim">
                    <div class="row justify-content-between">
                        <div class="col-12 col-md-4">
                            <p class="cor-primaria">Mercearia 5ºCiclo &copy; 2023</p>
                        </div>
                        <div class="col-12 col-md-4">
                            <p class="cor-primaria">
                                Atendendo nossos clientes com todo
                                <i class="bi bi-heart"></i>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Modal Formulário de Cadastro -->
    <div class="modal fade" id="ModalCadastro" tabindex="-1" role="dialog" aria-labelledby="TituloModalLongoExemplo" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form name="formCadastro" method="post" action="../functions/cadastrar_itens_pedido.php">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="TituloModalLongoExemplo">Novo Pedido</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true"><i class="bi bi-x cor-destaque"></i></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <span class="sessao-modal cor-destaque">Dados Pessoais</span>
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label>Cliente</label>
                                <?php
                                    if($_SESSION['admin'] == 1){
                                        echo('
                                            <select name="id_cli" id="select_nome_cli" class="form-control" onchange="setDadosCli()">
                                                <option selected disabled>Selecione</option>');
                                        foreach ($clientes as $cli) {
                                            echo('<option value="'.$cli['id'].'" name="'.$cli['cpf_cnpj'].'&'.$cli['email'].'&'.$cli['celular'].'">'.$cli['nome'].'</option>');
                                        }
                                        echo('</select>');
                                    }
                                    else{
                                        echo('<input type="hidden" name="id_cli" value="'.$_SESSION['id_cliente'].'">
                                            <input name="nome_cli" type="text" class="form-control" value="'.$_SESSION['nome'].'" disabled>');
                                    }
                                ?>                             
                            </div>
                            <div class="form-group col-md-4">
                                <label>CPF/CNPJ</label>
                                <?php
                                    if($_SESSION['admin'] == 1){
                                        echo('<input name="cpf_cnpj" id="cpf_cnpj" type="text" class="form-control" value="" disabled>');
                                    }
                                    else{
                                        echo('<input name="cpf_cnpj" type="text" class="form-control" value="'.$_SESSION['cpf_cnpj'].'" disabled>');
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label>E-mail</label>
                                <?php
                                    if($_SESSION['admin'] == 1){
                                        echo('<input name="email" id="email" type="text" class="form-control" value="" disabled>');
                                    }
                                    else{
                                        echo('<input name="email" type="text" class="form-control" value="'.$_SESSION['email'].'" disabled>');
                                    }
                                ?>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Celular</label>
                                <?php
                                    if($_SESSION['admin'] == 1){
                                        echo('<input name="celular" id="celular" type="text" class="form-control" value="" disabled>');
                                    }
                                    else{
                                        echo('<input name="celular" type="text" class="form-control" value="'.$_SESSION['celular'].'" disabled>');
                                    }
                                ?>
                            </div>
                        </div>
                        <span class="sessao-modal cor-destaque">Informações do Pedido</span>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="cond_pagamento">Condição Pagto.</label>
                                <select name="cond_pagamento" class="form-control">
                                <option selected disabled>Selecione</option>
                                    <option value="À vista">À vista</option>
                                    <option value="À prazo">À prazo</option>
                                    <option value="15 dias">15 dias</option>
                                    <option value="30 dias">30 dias</option>
                                    <option value="45 dias">45 dias</option>
                                    <option value="60 dias">60 dias</option>
                                    <option value="90 dias">90 dias</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="prazo_entrega">Prazo de entrega</label>
                                <select name="prazo_entrega" class="form-control">
                                    <option selected disabled>Selecione</option>
                                    <option value="10 dias">10 dias</option>
                                    <option value="15 dias">15 dias</option>
                                    <option value="30 dias">30 dias</option>
                                    <option value="45 dias">45 dias</option>
                                    <option value="60 dias">60 dias</option>
                                    <option value="90 dias">90 dias</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Data do Pedido</label>
                                <input name="data_pedido" type="date" class="form-control" value="<?php echo(date('Y-m-d')) ?>">
                            </div>
                        </div>
                        <div class="form-group">
                                <label>Observação</label>
                                <textarea name="observacao" maxlength="250" class="form-control"></textarea>
                            </div>
                        <span class="sessao-modal cor-destaque">Produtos Selecionados</span>
                        <div class="form-row" id="linha_produtos">
                            <div class="form-group col-md-8" id="lista_produtos">
                                <label>Produto</label>
                                <select name="produtos[]" id="select-original" class="form-control">
                                    <option selected disabled>Selecione</option>
                                    <?php
                                        foreach ($produtos as $prod) {
                                            echo('<option name="'.$prod['qtde_estoque'].'" value="'.$prod['id'].'">'.$prod['nome'].'</option>');
                                        }
                                        echo('</select>');
                                    ?>                                
                            </div>
                            <div class="form-group col-md-4" id="lista_qtde_produtos">
                                <label>Quantidade</label>
                                <input name="quantidades[]" type="number" min="1" max="" placeholder="" class="form-control">'
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="button" onclick="addProduto()" class="btn btn-outline-dark cor-secundaria btn-entrar" title="Adicionar Produto">
                                <i class="bi bi-plus-lg"></i>
                            </button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-dark cor-secundaria btn-entrar">
                            <i class="bi bi-floppy"></i>
                            Salvar Pedido
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Consulta -->
    <div class="modal fade" id="ModalConsulta" tabindex="-1" role="dialog" aria-labelledby="TituloModalLongoExemplo" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form name="formCadastro" method="post" action="../functions/select_pedido.php">
                <?php
                    if ($_SESSION['admin'] != 1) {
                        echo ('
                        <input type="hidden" name="id" value="'.$_SESSION['id_cliente'].'">                                               
                        ');
                    }
                ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="TituloModalLongoExemplo">Consultar Pedido</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true"><i class="bi bi-x cor-destaque"></i></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Data Inicial</label>
                                <input name="data_inicial" type="date" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Data Final</label>
                                <input name="data_final" type="date" class="form-control">
                            </div>                            
                        </div>                        
                    </div>
                    <div class="modal-footer">
                        <button id="btn-consulta" type="submit" class="btn btn-outline-dark cor-secundaria btn-entrar">Consultar</button>
                    </div>                    
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Confirmação de exclusão -->
    <div class="modal fade" id="ModalConfirmarExcluir" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="TituloModalCentralizado">ATENÇÃO!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true"><i class="bi bi-x cor-destaque"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    Tem certeza que deseja excluir o pedido?
                </div>
                <div class="modal-footer">
                    <a href="" data-dismiss="modal" class="btn-tabela bg-destaque cor-primaria">
                        <i class="bi bi-hand-thumbs-down "></i>
                        <span>Não</span>
                    </a>
                    <a href="" id="linkExcluir" class="btn-tabela bg-cor-secundaria cor-primaria">
                        <i class="bi bi-hand-thumbs-up "></i>
                        <span>Sim</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


<script>
    function buscarPedidos() {
        var data_inicial = document.getElementById("data_inicial").value;
        var data_final = document.getElementById("data_final").value;


        if (data_inicial == "" && data_final == "") {
            console.log("entrou1")
            window.location.href = "index.php";
        } else if (data_final == "" && data_inicial != "") {
            console.log("entrou2")
            window.location.href = "index.php?data_inicial=" + data_inicial;
        } else if (data_inicial == "" && data_final != "") {
            console.log("entrou3")
            window.location.href = "index.php?data_final=" + data_final;
        } else if (data_inicial != "" && data_final != "") {
            console.log("entrou4")
            window.location.href = "index.php?data_inicial=" + data_inicial + "&data_final=" + data_final;

        }
    }
</script>