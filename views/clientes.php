<?php
    if(session_status() != PHP_SESSION_ACTIVE){
        session_start();        
    }

    if(!isset($_SESSION['id_cliente'])){            
        header("Location: login.php");
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
                    <a class="nav-link cor-primaria" href="#">Clientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link cor-primaria" href="#">Pedidos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link cor-primaria" href="#">Produtos</a>
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
            ?>

            <div class="gap-2 d-md-flex justify-content-end">
                <?php
                    if($_SESSION['admin'] == 1){
                        echo('
                        <a href="" data-toggle="modal" data-target="#ModalCadastro" class="btn-tabela bg-destaque cor-primaria">
                            <i class="bi bi-plus-lg "></i>
                            <span>Novo Cadastro</span>
                        </a>
                        ');

                    }
                ?>                
                <a href="login.php" class="btn-tabela bg-cor-secundaria cor-primaria">
                    <i class="bi bi-file-earmark-pdf "></i>
                    <span>Emitir Relatório</span>
                </a>
            </div>

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
                        <?php
                            if($_SESSION['admin'] == 1){
                                include("../common/config.php");
                                $query = "SELECT cli.*, log.admin FROM clientes cli INNER JOIN login_usuarios log ON cli.id = log.id_cliente ORDER BY cli.id";
                                $resu = mysqli_query($conexao, $query) or die (mysqli_connect_error());
                                while($reg = mysqli_fetch_array($resu)){
                                    echo('
                                    <tr>
                                        <th scope="row">'.$reg['id'].'</th>
                                        <td>'.$reg['nome'].'</td>
                                        <td>'.$reg['email'].'</td>
                                        <td>'.$reg['rg'].'</td>
                                        <td>'.$reg['cpf_cnpj'].'</td>
                                        <td>'.$reg['data_nasc'].'</td>
                                        <td>'.$reg['endereco'].'</td>
                                        <td>'.$reg['numero'].'</td>
                                        <td>'.$reg['bairro'].'</td>
                                        <td>'.$reg['cidade'].'</td>
                                        <td>'.$reg['estado'].'</td>
                                        <td>'.$reg['telefone'].'</td>
                                        <td>'.$reg['celular'].'</td>
                                        <td>'.$reg['admin'].'</td>
                                        <td class="td-icone-acoes">
                                            <a href="" class="bi bi-pencil-fill icone-acoes cor-secundaria"></a>
                                        </td>
                                        <td class="td-icone-acoes">
                                            <a href="" class="bi bi-trash-fill icone-acoes cor-destaque"></a>
                                        </td>
                                    </tr>
                                ');                                    
                                }
                                mysqli_close($conexao);
                            }
                            else{
                                echo('
                                    <tr>
                                        <th scope="row">'.$_SESSION['id_cliente'].'</th>
                                        <td>'.$_SESSION['nome'].'</td>
                                        <td>'.$_SESSION['email'].'</td>
                                        <td>'.$_SESSION['rg'].'</td>
                                        <td>'.$_SESSION['cpf_cnpj'].'</td>
                                        <td>'.$_SESSION['data_nasc'].'</td>
                                        <td>'.$_SESSION['endereco'].'</td>
                                        <td>'.$_SESSION['numero'].'</td>
                                        <td>'.$_SESSION['bairro'].'</td>
                                        <td>'.$_SESSION['cidade'].'</td>
                                        <td>'.$_SESSION['estado'].'</td>
                                        <td>'.$_SESSION['telefone'].'</td>
                                        <td>'.$_SESSION['celular'].'</td>
                                        <td>'.$_SESSION['admin'].'</td>
                                        <td>
                                            <a href="" class="bi bi-pencil-fill icone-acoes cor-secundaria"></a>
                                        </td>
                                        <td>
                                            <a href="" class="bi bi-trash-fill icone-acoes cor-destaque"></a>
                                        </td>
                                    </tr>
                                ');
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
                                            <option selected></option>
                                            <option value="AC">Acre</option>
                                            <option value="AL">Alagoas</option>
                                            <option value="AP">Amapá</option>
                                            <option value="AM">Amazonas</option>
                                            <option value="BA">Bahia</option>
                                            <option value="CE">Ceará</option>
                                            <option value="DF">Distrito Federal</option>
                                            <option value="ES">Espírito Santo</option>
                                            <option value="GO">Goiás</option>
                                            <option value="MA">Maranhão</option>
                                            <option value="MT">Mato Grosso</option>
                                            <option value="MS">Mato Grosso do Sul</option>
                                            <option value="MG">Minas Gerais</option>
                                            <option value="PA">Pará</option>
                                            <option value="PB">Paraíba</option>
                                            <option value="PR">Paraná</option>
                                            <option value="PE">Pernambuco</option>
                                            <option value="PI">Piauí</option>
                                            <option value="RJ">Rio de Janeiro</option>
                                            <option value="RN">Rio Grande do Norte</option>
                                            <option value="RS">Rio Grande do Sul</option>
                                            <option value="RO">Rondônia</option>
                                            <option value="RR">Roraima</option>
                                            <option value="SC">Santa Catarina</option>
                                            <option value="SP">São Paulo</option>
                                            <option value="SE">Sergipe</option>
                                            <option value="TO">Tocantins</option>
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
</body>
</html>