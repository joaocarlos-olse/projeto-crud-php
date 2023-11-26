<?php
    if(session_status() != PHP_SESSION_ACTIVE){
        session_start();        
    }

    if(!isset($_SESSION['id_cliente'])){            
        header("Location: login.php");
    }

    if(isset($_SESSION['id_cliente']) && !isset($_SESSION['registros'])){     
        if($_SESSION['admin'] == 1){
            header("Location: ../functions/select_cliente.php");            
        }
        else{
            header('Location: ../functions/select_cliente.php?id='.$_SESSION['id_cliente'].'');
        }        
    }

    if(isset($_SESSION['registros'])){            
        $registros = $_SESSION['registros'];
        unset($_SESSION['registros']);
    }

    $estados = array("AC" => "Acre", "AL" => "Alagoas", "AP" => "Amapá", "AM" => "Amazonas", "BA" => "Bahia", "CE" => "Ceará", "DF" => "Distrito Federal", "ES" => "Espírito Santo", "GO" => "Goiás", "MA" => "Maranhão", "MT" => "Mato Grosso", "MS" => "Mato Grosso do Sul", "MG" => "Minas Gerais", "PA" => "Pará", "PB" => "Paraíba", "PR" => "Paraná", "PE" => "Pernambuco", "PI" => "Piauí", "RJ" => "Rio de Janeiro", "RN" => "Rio Grande do Norte", "RS" => "Rio Grande do Sul", "RO" => "Rondônia", "RR" => "Roraima", "SC" => "Santa Catarina", "SP" => "São Paulo", "SE" => "Sergipe", "TO" => "Tocantins");
    
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
    <script src="../js/script_cliente.js"></script>
    <!-- MEU FAVICON -->
    <link rel="shortcut icon" href="../images/icons/logo.ico" type="image/x-icon">
    <title>Cadastro de Clientes</title>
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
                <li class="nav-item active">
                    <a class="nav-link cor-primaria" href="clientes.php">Clientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link cor-primaria" href="pedidos.php">Pedidos</a>
                </li>
                <li class="nav-item">
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
        <div class="container-fluid">

            <h2 class="title mb-4 mt-5 cor-destaque">Cadastro de Clientes</h2>

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
                        '.$_SESSION['sucesso_cadastro'].'<br>
                        Usuário: '.$_SESSION['usuario'].'<br>
                        Senha: '.$_SESSION['senha_provisoria'].'
                    </div>
                    ');
                    unset($_SESSION['sucesso_cadastro']);
                    unset($_SESSION['usuario']);
                    unset($_SESSION['senha_provisoria']);
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
                <?php
                    if($_SESSION['admin'] == 1){
                        echo('
                            <a href="" data-toggle="modal" data-target="#ModalConsulta" class="btn-tabela bg-destaque cor-primaria">
                                <i class="bi bi-search "></i>
                                <span>Consultar</span>
                            </a>
                            <a href="" data-toggle="modal" data-target="#ModalCadastro" class="btn-tabela bg-destaque cor-primaria">
                                <i class="bi bi-plus-lg "></i>
                                <span>Novo Cadastro</span>
                            </a>
                        ');
                    }
                ?>
                <a href="" data-toggle="modal" data-target="#ModalAlterarSenha" class="btn-tabela bg-destaque cor-primaria">
                    <i class="bi bi-key "></i>
                    <span>Alterar Senha</span>
                </a>
                <?php
                    if($_SESSION['admin'] == 0){
                        echo('
                            <a href="../common/relatorio_cliente_render.php" target="_blank" class="btn-tabela bg-cor-secundaria cor-primaria">
                                <i class="bi bi-file-earmark-pdf "></i>
                                <span>Emitir Relatório</span>
                            </a>                        
                        ');
                    }
                    else{
                        echo('
                            <a href="../common/relatorio_clientes_render.php" target="_blank" class="btn-tabela bg-cor-secundaria cor-primaria">
                                <i class="bi bi-file-earmark-pdf "></i>
                                <span>Emitir Relatório</span>
                            </a>
                        ');
                    }
                ?>
            </div>

            <?php
                if($_SESSION['admin'] == 1 && !isset($_SESSION['cli_id'])){
                    echo('
                        <div class="table-responsive">
                            <table class="table table-hover mb-3">
                                <thead class="bg-destaque cor-primaria">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col">E-mail</th>
                                        <th scope="col">RG</th>
                                        <th scope="col">CPF/CNPJ</th>
                                        <th scope="col">Data Nasc.</th>
                                        <th scope="col">Endereço</th>
                                        <th scope="col">Nº</th>
                                        <th scope="col">Bairro</th>
                                        <th scope="col">Cidade</th>
                                        <th scope="col">UF</th>
                                        <th scope="col">Telefone</th>
                                        <th scope="col">Celular</th>
                                        <th scope="col">Tipo</th>
                                        <th scope="col">Editar</th>
                                        <th scope="col">Excuir</th>
                                    </tr>
                                </thead>
                                <tbody>
                    ');
                    if(count($registros) > 0){
                        foreach($registros as $reg){
                            echo('                             
                                <tr>
                                    <th scope="row">'.$reg['id'].'</th>
                                    <td id="nome'.$reg['id'].'">'.$reg['nome'].'</td>
                                    <td id="email'.$reg['id'].'">'.$reg['email'].'</td>
                                    <td id="rg'.$reg['id'].'">'.$reg['rg'].'</td>
                                    <td id="cpf_cnpj'.$reg['id'].'">'.$reg['cpf_cnpj'].'</td>
                                    <td id="data_nasc'.$reg['id'].'">'.$reg['data_nasc'].'</td>
                                    <td id="endereco'.$reg['id'].'">'.$reg['endereco'].'</td>
                                    <td id="numero'.$reg['id'].'">'.$reg['numero'].'</td>
                                    <td id="bairro'.$reg['id'].'">'.$reg['bairro'].'</td>
                                    <td id="cidade'.$reg['id'].'">'.$reg['cidade'].'</td>
                                    <td id="estado'.$reg['id'].'">'.$reg['estado'].'</td>
                                    <td id="telefone'.$reg['id'].'">'.$reg['telefone'].'</td>
                                    <td id="celular'.$reg['id'].'">'.$reg['celular'].'</td>
                                    <td id="admin'.$reg['id'].'">'.$reg['admin'].'</td>
                                    <td class="td-icone-acoes">
                                        <button type="button" class="bi bi-pencil-fill icone-acoes cor-secundaria" onclick="alterarCliId('.$reg['id'].');"></button>
                                    </td>
                                    <td class="td-icone-acoes">
                                        <button type="button" class="bi bi-trash-fill icone-acoes cor-destaque" onclick="excluirCliId('.$reg['id'].');"></button>
                                    </td>
                                </tr>                                           
                            ');                                    
                        }
                    }
                    else{
                        if(isset($_SESSION['erro_select_cli'])){            
                            echo('<td colspan="8">'.$_SESSION['erro_select_cli'].'</td>');
                            unset($_SESSION['erro_select_cli']);
                        }                         
                    }
                    echo('
                            </tbody>
                        </table>
                    </div>
                    ');
                }                
                else{
                    echo('
                        <form name="formAtualizar" method="post" action="../functions/atualizar_cliente.php">
                            <input type="hidden" name="id" value="'.$registros[0]['id'].'">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="TituloModalLongoExemplo">MEU CADASTRO</h5>
                                </div>
                                <div class="modal-body">                        
                                    <div class="form-group">
                                        <label>Nome</label>
                                        <input name="nome" type="text" class="form-control" value="'.$registros[0]['nome'].'" required>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-10">
                                            <label>Endereço</label>
                                            <input name="endereco" type="text" class="form-control" value="'.$registros[0]['endereco'].'">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Nº</label>
                                            <input name="numero" type="text" class="form-control" value="'.$registros[0]['numero'].'">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Cidade</label>
                                        <input name="cidade" type="text" class="form-control" value="'.$registros[0]['cidade'].'" required>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Bairro</label>
                                            <input name="bairro" type="text" class="form-control" value="'.$registros[0]['bairro'].'">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label name="'.$registros[0]['estado'].'" id="label_estado_cliente">Estado</label>
                                            <select name="estado" id="estado_cliente" class="form-control">
                                                <option selected></option>');
                                            foreach ($estados as $sigla => $estado) {
                                                echo('<option value="'.$sigla.'">'.$estado.'</option>');
                                            }
                                        echo('
                                            </select>
                                        </div>                            
                                    </div>
                                    <div class="form-group">
                                        <label>E-mail</label>
                                        <input name="email" type="text" class="form-control" value="'.$registros[0]['email'].'" required>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>RG</label>
                                            <input name="rg" type="text" class="form-control" value="'.$registros[0]['rg'].'" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>CPF/CNPJ</label>
                                            <input name="cpf_cnpj" type="text" class="form-control" value="'.$registros[0]['cpf_cnpj'].'" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label>Telefone</label>
                                            <input name="telefone" type="text" class="form-control" value="'.$registros[0]['telefone'].'" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Celular</label>
                                            <input name="celular" type="text" class="form-control" value="'.$registros[0]['celular'].'" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Data Nasc.</label>
                                            <input name="data_nasc" type="date" class="form-control" value="'.$registros[0]['data_nasc'].'" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-outline-dark cor-secundaria btn-entrar" data-toggle="modal" data-target="#ModalConfirmarExcluir" type="button" onclick="excluirCliId('.$_SESSION['id_cliente'].');">Excluir Cadastro</button>
                                    <button class="btn btn-outline-dark cor-secundaria btn-entrar" type="submit">Atualizar Cadastro</button>
                                </div>
                            </div>
                        </form>
                    ');
                }
            ?>
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
                    <form name="formCadastro" method="post" action="../functions/cadastrar_cliente.php">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="TituloModalLongoExemplo">Formulário de Cadastro</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true"><i class="bi bi-x cor-destaque"></i></span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-row justify-content-end">
                                    <label class="form-check-label col-md-4" for="defaultCheck1">
                                    Administrador
                                    </label>
                                    <input name="admin" class="form-check-input col-md-1" type="checkbox" value="1" id="defaultCheck1">
                                </div>                         
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input name="nome" type="text" class="form-control" required>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-10">
                                        <label>Endereço</label>
                                        <input name="endereco" type="text" class="form-control">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Nº</label>
                                        <input name="numero" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Cidade</label>
                                    <input name="cidade" type="text" class="form-control" required>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Bairro</label>
                                        <input name="bairro" type="text" class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Estado</label>
                                        <select name="estado" class="form-control">
                                        <option selected></option>');
                                            foreach ($estados as $sigla => $estado) {
                                                echo('<option value="'.$sigla.'">'.$estado.'</option>');
                                            }
                                        echo('
                                        </select>
                                    </div>                            
                                </div>
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input name="email" type="text" class="form-control" required>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>RG</label>
                                        <input name="rg" type="text" class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>CPF/CNPJ</label>
                                        <input name="cpf_cnpj" type="text" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>Telefone</label>
                                        <input name="telefone" type="text" class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Celular</label>
                                        <input name="celular" type="text" class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Data Nasc.</label>
                                        <input name="data_nasc" type="date" class="form-control" required>
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
                    <form name="formAtualizar" method="post" action="../functions/atualizar_cliente.php">
                        <input type="hidden" name="id" id="id_cli">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="TituloModalLongoExemplo">Atualizar Cadastro</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true"><i class="bi bi-x cor-destaque"></i></span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-row justify-content-end">
                                    <label class="form-check-label col-md-4" for="defaultCheck1">
                                    Administrador
                                    </label>
                                    <input name="admin" id="admin_cli" class="form-check-input col-md-1" type="checkbox" value="1">
                                </div>                         
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input name="nome" id="nome_cli" type="text" class="form-control" required>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-10">
                                        <label>Endereço</label>
                                        <input name="endereco" id="endereco_cli" type="text" class="form-control">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Nº</label>
                                        <input name="numero" id="numero_cli" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Cidade</label>
                                    <input name="cidade" id="cidade_cli" type="text" class="form-control" required>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Bairro</label>
                                        <input name="bairro" id="bairro_cli" type="text" class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Estado</label>
                                        <select name="estado" id="estado_cli" class="form-control">
                                            <option selected></option>');
                                        foreach ($estados as $sigla => $estado) {
                                            echo('<option value="'.$sigla.'">'.$estado.'</option>');
                                        }
                                        echo('
                                        </select>
                                    </div>                            
                                </div>
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input name="email" id="email_cli" type="text" class="form-control" required>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>RG</label>
                                        <input name="rg" id="rg_cli" type="text" class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>CPF/CNPJ</label>
                                        <input name="cpf_cnpj" id="cpf_cnpj_cli" type="text" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>Telefone</label>
                                        <input name="telefone" id="telefone_cli" type="text" class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Celular</label>
                                        <input name="celular" id="celular_cli" type="text" class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Data Nasc.</label>
                                        <input name="data_nasc" id="data_nasc_cli" type="date" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="" id="linkRelatorio" target="_blank" class="btn-tabela bg-cor-secundaria cor-primaria">
                                    <i class="bi bi-file-earmark-pdf "></i>
                                    <span>Emitir Relatório</span>
                                </a>
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
            <form name="formCadastro" method="post" action="../functions/select_cliente.php">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="TituloModalLongoExemplo">Consultar Cliente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true"><i class="bi bi-x cor-destaque"></i></span>
                        </button>
                    </div>
                    <div class="modal-body">                       
                        <div class="form-group">
                            <label>Nome</label>
                            <input name="nome" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Cidade</label>
                            <input name="cidade" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>CPF/CNPJ</label>
                            <input name="cpf_cnpj" type="text" class="form-control">
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
                    Tem certeza que deseja excluir seu cadastro?
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

    <!-- Modal Alterar Senha -->
    <div class="modal fade" id="ModalAlterarSenha" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true"><i class="bi bi-x cor-destaque"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-signin" name="formLogin" method="post" action="../functions/alterar_senha.php">
                    <input type="hidden" name="id" value="<?php echo($_SESSION['id_login']);?>">
                    <h1 class="h1 mb-3 alterar-senha">ALTERAR SENHA</h1>
                    <!-- NOVA SENHA 1 -->
                    <div class="input-group">
                        <div class="input-group-prepend bg-cor-secundaria">
                            <i class="bi bi-key icone-input"></i>
                        </div>
                        <input name="novasenha" type="password" class="form-control" id="validationCustomUsername" placeholder="Nova Senha" aria-describedby="inputGroupPrepend" required>
                    </div>
                    <!-- NOVA SENHA 2 -->
                    <div class="input-group">
                        <div class="input-group-prepend bg-cor-secundaria">
                            <i class="bi bi-key icone-input"></i>
                        </div>
                        <input name="confirmacaosenha" type="password" class="form-control" id="validationCustomPass" placeholder="Repita a senha" aria-describedby="inputGroupPrepend" required>
                    </div>
                    <?php
                        if(isset($_SESSION['validacao'])){            
                            echo('
                            <div class="alert alert-danger erro-login" role="alert">
                                '.$_SESSION['validacao'].'
                            </div>
                            ');
                            unset($_SESSION['validacao']);
                        }
                    ?>
                    <div class="botao-cadastro">
                        <button class="btn btn-outline-dark cor-secundaria btn-entrar" type="submit">ALTERAR</button>
                    </div>
                </fomr>
            </div>
        </div>
    </div>
</body>
</html>