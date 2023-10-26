<?php
    if(session_status() != PHP_SESSION_ACTIVE){
        session_start();
    }

    if(isset($_SESSION['id_cliente'])){
        header("Location: painel.php");
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
   <div class="container" id="login-container">
        <div class="col12">
            <div class="col-md-auto login-form">
                <form class="form-signin" name="formLogin" method="post" action="../functions/validar_login.php">
                    <div class="col-12 img-login-container">
                        <img class="mb-4 " src="../images/logo.png" alt="">
                        <span>Mercearia<br>5ºCiclo</span>
                     </div>
                    <h1 class="h3 mb-3">ENTRAR</h1>
                    <!-- USUÁRIO -->
                    <div class="input-group">
                        <div class="input-group-prepend bg-cor-secundaria">
                            <i class="bi bi-person"></i>
                        </div>
                        <input name="usuario" type="email" class="form-control" id="validationCustomUsername" placeholder="Usuário" aria-describedby="inputGroupPrepend" required>
                        <div class="invalid-feedback">
                            Por favor, infomre o usuário!
                        </div>
                    </div>
                    <!-- SENHA -->
                    <div class="input-group">
                        <div class="input-group-prepend bg-cor-secundaria">
                            <i class="bi bi-key"></i>
                        </div>
                        <input name="senha" type="password" class="form-control" id="validationCustomPass" placeholder="Senha" aria-describedby="inputGroupPrepend" required>
                        <div class="invalid-feedback">
                            Por favor, infomre a senha!
                        </div>
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
                        ?>
                        <div class="row justify-content-between">
                            <div class="col-md-8 botao-esqueceu-senha">
                                <a href="" class="cor-secundaria" id="esqueceu-senha">Esqueceu a senha?</a>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-outline-dark cor-secundaria btn-entrar" type="submit">ENTRAR</button>
                            </div>
                        </div>
                        <div class="row botao-cadastro">
                            <button class="botao-cadastro" type="button" data-toggle="modal" data-target="#ModalCadastro">Cadastre-se</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
   </div>

   <!-- Modal Formulário de Cadastro -->
    <div class="modal fade" id="ModalCadastro" tabindex="-1" role="dialog" aria-labelledby="TituloModalLongoExemplo" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TituloModalLongoExemplo">Formulário de Cadastro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-secondary" data-dismiss="modal">Limpar</button>
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
            </div>
        </div>
    </div>
</body>
</html>