<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    include("../../cabecalho.php");
    getCabecalho();
    ?>
    <title>Criar Pedido</title>
</head>
 
<body>
    <a href="./painel.php">Voltar</a><br />
    <form action="./functions/func_criar_pedido.php" method="post">
        <input type='date' placeholder="Data" id="data_pedido" name="data_pedido"><br />
        <input type='number' placeholder="Id do cliente" id="id_cliente" name="id_cliente"><br />
        <input type='text' placeholder="Observação" id="observacao" name="observacao"><br />
        <input type='text' placeholder="Condição do pagamento" id="cond_pagto" name="cond_pagto"><br />
        <input type='text' placeholder="Prazo de entrega" id="prazo_entrega" name="prazo_entrega"><br />
 
        <!-- Campos para adicionar itens ao pedido -->
        <label for="produto">Produto:</label>
        <input type="text" id="produto" name="itens_pedido[produto][]" placeholder="Nome ou ID do Produto">
        <label for="quantidade">Quantidade:</label>
        <input type="number" id="quantidade" name="itens_pedido[quantidade][]">
        <button type="button" id="btnAdicionarItem">Adicionar Item</button>
 
        <input type="hidden" name="id_pedido" value="<?php echo $id_pedido; ?>">
 
        <!-- Exibição dos itens adicionados -->
        <div id="itens_adicionados"></div>
 
        <button type="submit">Salvar pedido</button>
    </form>
 
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var btnAdicionarItem = document.getElementById("btnAdicionarItem");
            var itensAdicionados = document.getElementById("itens_adicionados");
 
            btnAdicionarItem.addEventListener("click", function () {
                var produtoInput = document.getElementById("produto");
                var quantidadeInput = document.getElementById("quantidade");
 
                // Verifica se ambos os campos estão preenchidos
                if (produtoInput.value !== "" && quantidadeInput.value !== "") {
                    // Cria elementos de entrada ocultos
                    var produtoHidden = document.createElement("input");
                    produtoHidden.type = "hidden";
                    produtoHidden.name = "itens_pedido[produto][]";
                    produtoHidden.value = produtoInput.value;
 
                    var quantidadeHidden = document.createElement("input");
                    quantidadeHidden.type = "hidden";
                    quantidadeHidden.name = "itens_pedido[quantidade][]";
                    quantidadeHidden.value = quantidadeInput.value;
 
                    // Cria um novo elemento <p> para exibir o item
                    var novoItem = document.createElement("p");
                    novoItem.textContent = "Produto: " + produtoInput.value + ", Quantidade: " + quantidadeInput.value;
 
                    // Adiciona os elementos ocultos à lista
                    itensAdicionados.appendChild(produtoHidden);
                    itensAdicionados.appendChild(quantidadeHidden);
                    // Adiciona o novo item à lista
                    itensAdicionados.appendChild(novoItem);
 
                    // Limpa os campos de entrada
                    produtoInput.value = "";
                    quantidadeInput.value = "";
                }
            });
        });
    </script>
</body>
 
</html>