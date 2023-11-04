<?php
    if(session_status() != PHP_SESSION_ACTIVE){
        session_start();
    }

    if(isset($_SESSION['id_cliente'])){
        header("Location: painel.php");
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- ICONES DO GOOGLE -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- MEU CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- MEU FAVICON -->
    <link rel="shortcut icon" href="../images/icons/logo.ico" type="image/x-icon">    
    <title>Login</title>
</head>
    <!-- BARRA DE NAVEGAÇÃO -->
    <nav class="bg-destaque nav-login">
        <a class="navbar-brand" href="index.php">
            <img src="../images/logo_outline.png" alt="Home" id="logo">
            <span class="cor-primaria">Mercearia<br>5ºCiclo</span>
        </a>
    </nav>

   <!-- CONTAINER LOGIN -->
   <div class="container login-container">
        <div class="col-md-4 login-form">
            <form class="form-signin" name="formLogin" method="post" action="../functions/validar_login.php">
                <div class="col-12 img-login-container">
                    <img class="mb-4 img-login" src="../images/logo.png" alt="">
                    <span class="h2 mb-4 title-login-container cor-destaque">Mercearia<br>5ºCiclo</span>
                    </div>
                <h1 class="h3 mb-3 cor-secundaria alterar-senha">ENTRAR</h1>
                <!-- USUÁRIO -->
                <div class="input-group">
                    <div class="input-group-prepend bg-cor-secundaria">
                        <i class="bi bi-person icone-input"></i>
                    </div>
                    <input name="usuario" type="email" class="form-control" id="validationCustomUsername" placeholder="Usuário" aria-describedby="inputGroupPrepend" required>
                </div>
                <!-- SENHA -->
                <div class="input-group">
                    <div class="input-group-prepend bg-cor-secundaria">
                        <i class="bi bi-key icone-input"></i>
                    </div>
                    <input name="senha" type="password" class="form-control" id="validationCustomPass" placeholder="Senha" aria-describedby="inputGroupPrepend" required>
                </div>
                <div class="col-12">
                    <?php
                        if(isset($_SESSION['validacao'])){            
                            echo('
                            <div class="alert alert-danger erro-login" role="alert">
                                '.$_SESSION['validacao'].'
                            </div>
                            ');
                            unset($_SESSION['validacao']);
                        }
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
                        if(isset($_SESSION['erro_usuario'])){            
                            echo('
                            <div class="alert alert-danger erro-login" role="alert">
                                '.$_SESSION['erro_usuario'].'
                            </div>
                            ');
                            unset($_SESSION['erro_usuario']);
                        }
                        if(isset($_SESSION['sucesso_senha'])){            
                            echo('
                            <div class="alert alert-success erro-login" role="alert">
                                '.$_SESSION['sucesso_senha'].'
                            </div>
                            ');
                            unset($_SESSION['sucesso_senha']);
                        }
                    ?>
                        
                    <div class="row justify-content-between">
                        <div class="col-md-8 botao-esqueceu-senha">
                            <a href="" class="cor-secundaria" id="esqueceu-senha" data-toggle="modal" data-target="#ModalAlterarSenha">Esqueceu a senha?</a>
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-outline-dark cor-secundaria btn-entrar" type="submit">ENTRAR</button>
                        </div>
                    </div>
                    <div class="row botao-cadastro">
                        <a href="" data-toggle="modal" data-target="#ModalCadastro" class="cor-secundaria">Cadastre-se</a>
                    </div>
                </div>
            </form>
        </div>
   </div>

   <!-- Modal Formulário de Cadastro -->
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
                                    <option selected></option>
                                    <?php
                                        foreach ($estados as $sigla => $estado) {
                                            echo('<option value="'.$sigla.'">'.$estado.'</option>');
                                        }
                                    ?>
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

    <!-- MODAL ESQUECEU A SENHA -->
    <div class="modal fade" id="ModalAlterarSenha" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true"><i class="bi bi-x cor-destaque"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-signin" name="formAlterarSenha" method="post" action="../functions/alterar_senha.php">
                    <h1 class="h1 mb-3 alterar-senha">ALTERAR SENHA</h1>
                    <!-- EMAIL -->
                    <div class="input-group">
                        <div class="input-group-prepend bg-cor-secundaria">
                            <i class="bi bi-at icone-input"></i>
                        </div>
                        <input name="email" type="text" class="form-control" id="validationCustomUsername" placeholder="E-mail" aria-describedby="inputGroupPrepend" required>
                    </div>
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