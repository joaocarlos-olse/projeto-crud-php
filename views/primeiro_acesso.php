<?php
    if(session_status() != PHP_SESSION_ACTIVE){
        session_start();
    }

    if(password_verify($_SESSION['cpf_cnpj'], $_SESSION['senha']) == false){
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
    <title>Primeiro Acesso</title>
</head>
   <!-- CONTAINER LOGIN -->
   <div class="container primeiro-acesso-container">
    <div class="col-4 ">
        <form class="form-signin login-form" name="formLogin" method="post" action="../functions/alterar_senha.php">
            <input type="hidden" name="id" value="<?php echo($_SESSION['id_login']);?>">
            <h1 class="h3 mb-5">Olá, <?php echo($_SESSION['nome'])?>!</h1>
            <h1 class="h5 mb-3 alterar-senha">ALTERAR SENHA</h1>
            <!-- NOVA SENHA 1 -->
            <div class="input-group">
                <div class="input-group-prepend bg-cor-secundaria">
                    <i class="bi bi-key icone-input"></i>
                </div>
                <input name="novasenha" type="password" class="form-control" id="validationCustomUsername" placeholder="Nova Senha" aria-describedby="inputGroupPrepend" required>
                <div class="invalid-feedback">
                    Por favor, infomre a nova senha!
                </div>
            </div>
            <!-- NOVA SENHA 2 -->
            <div class="input-group">
                <div class="input-group-prepend bg-cor-secundaria">
                    <i class="bi bi-key icone-input"></i>
                </div>
                <input name="confirmacaosenha" type="password" class="form-control" id="validationCustomPass" placeholder="Repita a senha" aria-describedby="inputGroupPrepend" required>
                <div class="invalid-feedback">
                    Por favor, repita a nova senha!
                </div>
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
</body>
</html>