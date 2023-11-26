<?php
    if(session_status() != PHP_SESSION_ACTIVE){
        session_start();        
    }

    if(!isset($_SESSION['id_cliente'])){            
        header("Location: login.php");
    }

    if(!isset($_SESSION['produtos'])){
        header("Location: ../functions/select_produto.php");
    }        

    if(isset($_SESSION['produtos'])){            
        $produtos = $_SESSION['produtos'];
        unset($_SESSION['produtos']);
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
    <!-- JS BOOTSTRAP -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous" defer></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous" defer></script>    
    <!-- FONTS DO GOOGLE -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- MEU CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- MEU JS -->
    <script src="../js/script_produto.js"></script>
    <!-- MEU FAVICON -->
    <link rel="shortcut icon" href="../images/icons/logo.ico" type="image/x-icon">
    <title>Cadastro de Produtos</title>
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
                <li class="nav-item">
                    <a class="nav-link cor-primaria" href="pedidos.php">Pedidos</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link cor-primaria" href="produtos.php">Produtos</a>
                </li>
                </ul>
                <?php
                    if(isset($_SESSION['id_cliente'])){            
                        echo('
                            <span class="cor-primaria">Olá,</span><a href="painel.php" class="nav-link cor-primaria">'.$_SESSION['nome'].'</a><a href="../functions/logout.php"><button type="button" class="btn btn-outline-light cor-primaria btn-sm btn-boas-vindas">Sair</button></a>
                        ');
                    }else{
                        echo('
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

            <h2 class="title mb-4 mt-5 cor-destaque">Cadastro de Produtos</h2>

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
                if(isset($_SESSION['erro_atualizacao'])){            
                    echo('
                    <div class="alert alert-danger erro-login" role="alert">
                        '.$_SESSION['erro_atualizacao'].'
                    </div>
                    ');
                    unset($_SESSION['erro_atualizacao']);
                }
                if(isset($_SESSION['sucesso_atualizacao'])){            
                    echo('
                    <div class="alert alert-success erro-login" role="alert">
                        '.$_SESSION['sucesso_atualizacao'].'
                    </div>
                    ');
                    unset($_SESSION['sucesso_atualizacao']);
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
            
            <div class="gap-2 d-md-flex justify-content-end">       
                <a href="" data-toggle="modal" data-target="#ModalConsulta" class="btn-tabela bg-destaque cor-primaria">
                    <i class="bi bi-search "></i>
                    <span>Consultar</span>
                </a>
                <?php
                    if($_SESSION['admin'] == 1){
                        echo('
                            <a href="" data-toggle="modal" data-target="#ModalCadastro" class="btn-tabela bg-destaque cor-primaria">
                                <i class="bi bi-plus-lg "></i>
                                <span>Novo Cadastro</span>
                            </a>
                            <a href="../common/relatorio_produtos_render.php" target="_blank" class="btn-tabela bg-cor-secundaria cor-primaria">
                                <i class="bi bi-file-earmark-pdf "></i>
                                <span>Emitir Relatório</span>
                            </a>
                        ');
                    }
                ?>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-3">
                    <thead class="bg-destaque cor-primaria">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Qtd. Estoque</th>
                            <th scope="col">Valor (R$)</th>
                            <th scope="col">Uni. Medida</th>
                            <?php
                                if($_SESSION['admin'] == 1){
                                echo('
                                    <th scope="col">Editar</th>
                                    <th scope="col">Excuir</th>                                                
                                ');
                                }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(count($produtos) > 0){
                        foreach($produtos as $prod){
                            echo('                             
                                <tr>
                                    <th scope="row">'.$prod['id'].'</th>
                                    <td id="nome'.$prod['id'].'">'.$prod['nome'].'</td>
                                    <td id="qtde_estoque'.$prod['id'].'">'.$prod['qtde_estoque'].'</td>
                                    <td id="valor_unitario'.$prod['id'].'">'.$prod['valor_unitario'].'</td>
                                    <td id="unidade_medida'.$prod['id'].'">'.$prod['unidade_medida'].'</td>
                            ');
                            if($_SESSION['admin'] == 1){
                                echo('
                                    <td class="td-icone-acoes">
                                        <button type="button" class="bi bi-pencil-fill icone-acoes cor-secundaria" onclick="alterarProdId('.$prod['id'].');"></button>
                                    </td>
                            
                                    <td class="td-icone-acoes">
                                        <button type="button" class="bi bi-trash-fill icone-acoes cor-destaque" onclick="excluirProdId('.$prod['id'].');"></button>
                                    </td>
                                </tr>
                                ');
                            }
    
                        }
                    }
                    else{
                        if(isset($_SESSION['erro_select_prod'])){            
                            echo('<td colspan="8">'.$_SESSION['erro_select_prod'].'</td>');
                            unset($_SESSION['erro_select_prod']);
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
                        <div class="col-4"><h2>Mercearia 5ºCiclo</h2></div>
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
                                <input
                                type="email"
                                class="form-control"
                                placeholder="Digite o seu e-mail"
                                />
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
    <?php
        if($_SESSION['admin'] == 1){
            echo('
                <div class="modal fade" id="ModalCadastro" tabindex="-1" role="dialog" aria-labelledby="TituloModalLongoExemplo" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form name="formCadastro" method="post" action="../functions/cadastrar_produto.php">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="TituloModalLongoExemplo">Formulário de Cadastro</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true"><i class="bi bi-x cor-destaque"></i></span>
                                </button>
                            </div>
                            <div class="modal-body">                        
                                <div class="form-group">
                                    <label>Descrição</label>
                                    <input name="nome" type="text" class="form-control" required>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>Qtd. Estoque</label>
                                        <input name="qtde_estoque" type="number" min="0" class="form-control">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Valor Unitário R$</label>
                                        <input name="valor_unitario" min="0.01" step="0.01" type="number" class="form-control">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Uni. de Medida</label>
                                        <input name="unidade_medida" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-outline-dark cor-secundaria btn-entrar">Cadastrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        ');
        }
    ?>

    <!-- Modal Atualizar Cadastro -->
    <?php
        if($_SESSION['admin'] == 1){
            echo('
                <div class="modal fade" id="ModalAtualizar" tabindex="-1" role="dialog" aria-labelledby="TituloModalLongoExemplo" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form name="formAtualizar" method="post" action="../functions/atualizar_produto.php">
                        <input type="hidden" name="id" id="id_prod">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="TituloModalLongoExemplo">Atualizar Cadastro</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true"><i class="bi bi-x cor-destaque"></i></span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Descrição</label>
                                    <input name="nome" id="nome_prod" type="text" class="form-control" required>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>Qtd. Estoque</label>
                                        <input name="qtde_estoque" id="qtde_estoque_prod" min="0" type="number" class="form-control">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Valor Unitário R$</label>
                                        <input name="valor_unitario" id="valor_unitario_prod" min="0.01" step="0.01" type="number" class="form-control">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Uni. de Medida</label>
                                        <input name="unidade_medida" id="unidade_medida_prod" type="text" class="form-control">
                                    </div>
                                </div>                                
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn-tabela bg-destaque cor-primaria">Atualizar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        ');
        }
    ?>

    <!-- Modal Consulta -->
    <div class="modal fade" id="ModalConsulta" tabindex="-1" role="dialog" aria-labelledby="TituloModalLongoExemplo" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form name="formCadastro" method="post" action="../functions/select_produto.php">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="TituloModalLongoExemplo">Consultar Produto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true"><i class="bi bi-x cor-destaque"></i></span>
                        </button>
                    </div>
                    <div class="modal-body"> 
                        <div class="form-group">
                            <label>Descrição</label>
                            <input name="nome" type="text" class="form-control">
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
                    Tem certeza que deseja excluir o produto?
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