<?php

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

if (!isset($_SESSION['id_cliente'])) {
    header("Location: login.php");
}

include("../../common/config.php");
include("./functions/func_buscar_pedidos.php");

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
    <link rel="stylesheet" href="../../css/style.css">
    <!-- MEU JS -->
    <script src="../../js/controle_modal.js"></script>
    <!-- MEU FAVICON -->
    <link rel="shortcut icon" href="../../images/icons/logo.ico" type="image/x-icon">
    <title>Cadastro de Pedidos</title>

    <style>
        .btn-cadastro {
            background-color: transparent;
            outline: none;
            border: none;
            color: #fff;
            cursor: pointer;
        }

        .btn-cadastro:hover {
            color: #000;
        }
    </style>

    <script>
        function excluirProdId(id) {
            var confirmacao = confirm("Deseja realmente excluir este pedido?");

            if (confirmacao == true) {
                window.location.href = "./functions/func_apagar_pedido.php?id_pedido=" + id;
            }
        }
    </script>
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
                        <a class="nav-link cor-primaria" href="../painel.php">Painel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link cor-primaria" href="../clientes.php">Clientes</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link cor-primaria" href="../pedidos">Pedidos</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link cor-primaria" href="../produtos.php">Produtos</a>
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
            if (isset($_SESSION['erro_cadastro'])) {
                echo ('
                    <div class="alert alert-danger erro-login" role="alert">
                        ' . $_SESSION['erro_cadastro'] . '
                    </div>
                    ');
                unset($_SESSION['erro_cadastro']);
            }
            if (isset($_SESSION['sucesso_cadastro'])) {
                echo ('
                    <div class="alert alert-success erro-login" role="alert">
                        ' . $_SESSION['sucesso_cadastro'] . '
                    </div>
                    ');
                unset($_SESSION['sucesso_cadastro']);
            }
            if (isset($_SESSION['erro_atualizacao'])) {
                echo ('
                    <div class="alert alert-danger erro-login" role="alert">
                        ' . $_SESSION['erro_atualizacao'] . '
                    </div>
                    ');
                unset($_SESSION['erro_atualizacao']);
            }
            if (isset($_SESSION['sucesso_atualizacao'])) {
                echo ('
                    <div class="alert alert-success erro-login" role="alert">
                        ' . $_SESSION['sucesso_atualizacao'] . '
                    </div>
                    ');
                unset($_SESSION['sucesso_atualizacao']);
            }
            if (isset($_SESSION['erro_excluir'])) {
                echo ('
                    <div class="alert alert-danger erro-login" role="alert">
                        ' . $_SESSION['erro_excluir'] . '
                    </div>
                    ');
                unset($_SESSION['erro_excluir']);
            }
            if (isset($_SESSION['sucesso_excluir'])) {
                echo ('
                    <div class="alert alert-success erro-login" role="alert">
                        ' . $_SESSION['sucesso_excluir'] . '
                    </div>
                    ');
                unset($_SESSION['sucesso_excluir']);
            }
            if (isset($_SESSION['erro_select_prod'])) {
                echo ('
                    <div class="alert alert-danger erro-login" role="alert">
                        ' . $_SESSION['erro_select_prod'] . '
                    </div>
                    ');
                unset($_SESSION['erro_select_prod']);
            }
            ?>

            <div class="gap-2 d-md-flex justify-content-end d-flex">
                <a href="" data-toggle="modal" data-target="#ModalConsulta" class="btn-tabela bg-destaque cor-primaria d-flex gap-4 justify-content-center align-items-center">

                    <label class="px-2">Data Inicial</label>
                    <input type="date" name="data_inicial" id="data_inicial" class="form-control" value="<?php echo (isset($_GET['data_inicial']) ? $_GET['data_inicial'] : ""); ?>">

                    <label class="px-2">Data Final</label>
                    <input type="date" name="data_final" id="data_final" class="form-control" value="<?php echo (isset($_GET['data_final']) ? $_GET['data_final'] : ""); ?>">
                </a>

                <a href="" data-toggle="modal" data-target="#ModalConsulta" class="btn-tabela bg-destaque cor-primaria justify-content-center d-flex align-items-center">
                    <i class="bi bi-search "></i>
                    <span onclick="buscarPedidos()">Consultar</span>
                </a>
                <?php
                if ($_SESSION['admin'] == 1) {
                    echo ('
                            <form action="cadastrar_pedidos.php" data-toggle="modal" data-target="#ModalCadastro" class="btn-tabela bg-destaque cor-primaria justify-content-center d-flex align-items-center">
                                <button type="submit" class="btn-cadastro justify-content-center d-flex align-items-center"><i class="bi bi-plus-lg "></i> Novo Cadastro</button>
                            </form>
                        ');
                }
                ?>
                <a href="../common/relatorio_clientes_render.php" target="_blank" class="btn-tabela bg-cor-secundaria cor-primaria justify-content-center d-flex align-items-center">
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
                            if ($_SESSION['admin'] == 1) {
                                echo ('
                                                    <th scope="col">Editar</th>
                                                    <th scope="col">Excuir</th>                                                
                                                ');
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($pedidos as $ped) {
                            echo ('                             
                            <tr>
                                <th scope="row">' . $ped['id_ped'] . '</th>
                                <td id="data_pedido' . $ped['id'] . '">' . $ped['data_pedido'] . '</td>
                                <td id="id_cliente' . $ped['id'] . '">' . $ped['nome'] . '</td>
                                <td id="observacao' . $ped['id'] . '">' . $ped['observacao'] . '</td>
                                <td id="cond_pagamento' . $ped['id'] . '">' . $ped['cond_pagamento'] . '</td>
                                <td id="prazo_entrega' . $ped['id'] . '">' . $ped['prazo_entrega'] . '</td>
                        ');
                            if ($_SESSION['admin'] == 1) {
                                echo ('
                                <td class="td-icone-acoes">
                                    <a href="./cadastrar_item_pedidos.php?id=' . $ped['id_ped'] . '" type="button" class="bi bi-pencil-fill icone-acoes cor-secundaria"></a>
                                </td>
                        
                                <td class="td-icone-acoes">
                                    <button type="button" class="bi bi-trash-fill icone-acoes cor-destaque" onclick="excluirProdId(' . $ped['id_ped'] . ');" ></button>
                                </td>
                            </tr>
                            ');
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- #region 
    
    -->


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
</body>


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

</html>