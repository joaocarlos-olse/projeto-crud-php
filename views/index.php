<?php
    if(session_status() != PHP_SESSION_ACTIVE){
        session_start();
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
    <title>Home</title>
</head>

<body>
    <!-- BARRA DE NAVEGAÇÃO -->
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-destaque">
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
                <li class="nav-item active">
                    <a class="nav-link cor-primaria" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link cor-primaria" href="#">Destaques</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link cor-primaria" href="#">Promoções</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link cor-primaria" href="#">Contato</a>
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

    <!-- CARROSSEL -->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="../images/prateleiras.jpg" alt="Primeiro Slide">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Lorem ipsum dolor sit amet</h5>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis aliquam nam sed non modi sit.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="../images/carnes.jpg" alt="Segundo Slide">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Lorem ipsum dolor sit amet</h5>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis aliquam nam sed non modi sit.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="../images/hortifruti.jpg" alt="Terceiro Slide">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Lorem ipsum dolor sit amet</h5>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis aliquam nam sed non modi sit.</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Anterior</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Próximo</span>
        </a>          
    </div>

    <!-- MINI BANNERS -->
    <div class="container-fluid">
        <div class="col-12 col-md-10 offset-md-1" id="mini-banners">
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="card text-center">
                        <i class="bi bi-cart cor-secundaria"></i>
                        <div class="card-body">
                            <h5 class="card-title cor-destaque">Muita Variedade</h5>
                            <p class="card-text cor-secundaria">
                                Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                            </p>
                            <a href="#" class="btn btn-outline-dark cor-secundaria">Saiba Mais</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card text-center">
                        <i class="bi bi-currency-dollar"></i>
                        <div class="card-body">
                            <h5 class="card-title cor-destaque">Preço Justo</h5>
                            <p class="card-text cor-secundaria">
                                Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                            </p>
                            <a href="#" class="btn btn-outline-dark cor-secundaria">Saiba Mais</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card text-center">
                        <i class="bi bi-star cor-secundaria"></i>
                        <div class="card-body">
                            <h5 class="card-title cor-destaque">Qualidade Total</h5>
                            <p class="card-text cor-secundaria">
                                Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                            </p>
                            <a href="#" class="btn btn-outline-dark cor-secundaria">Saiba Mais</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- DEPARTAMENTOS -->
    <div class="container" id="departamentos-container">
        <div class="col-12">
            <h2 class="title cor-destaque">DEPARTAMENTOS</h2>
            <p class="subtitle cor-secundaria">Veja tudo o que temos de melhor para lhe oferecer!</p>
        </div>
        <div class="col-12" id="departamentos-imagens">
            <div class="row g-4">
                <div class="col-12 col-md-4">
                    <img src="../images/prateleiras1.jpg" alt="Mercearia em geral" class="img-fluid"> 
                    <div class="banner-content">
                        <p class="cor-secundaria">Mercearia Geral</p>
                        <h3>Alimentos secos, itens de higiêne e limpeza.</h3>
                    </div>
                </div>
                <div class="col-12 col-md-4">             
                    <img src="../images/hortifruti1.jpg" alt="Hortifruti" class="img-fluid"> 
                    <div class="banner-content">
                        <p class="cor-secundaria">Hortifruti</p>
                        <h3>Frutas, legumes e verduras.</h3>
                    </div>
                </div>
                <div class="col-12 col-md-4">          
                    <img src="../images/carnes1.jpg" alt="Açougue" class="img-fluid"> 
                    <div class="banner-content">
                        <p class="cor-secundaria">Açougue</p>
                        <h3>Grande variedade de carnes.</h3>
                    </div> 
                </div>              
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
</body>
</html>