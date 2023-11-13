<?php

include("../../common/config.php");

$id = $_GET["id"];

$sql = "SELECT * FROM pedidos WHERE id = $id";
$sql_produtos = "SELECT * FROM produto";
/* fazer um sql com inner join */
$sql_itens_pedidos = "SELECT * FROM itens_pedido INNER JOIN produto ON itens_pedido.id_produto = produto.id WHERE itens_pedido.id_pedido = $id ORDER BY produto.nome";


$result = mysqli_query($conexao, $sql);
$result_produtos = mysqli_query($conexao, $sql_produtos);
$result_itens_pedidos = mysqli_query($conexao, $sql_itens_pedidos);


?>




<!-- Campo para adicionar item ao pedido -->
<div>
    <form action="./functions/func_criar_items_pedidos.php" method="post">
        <input type="hidden" name="id_pedido" value="<?php echo $id; ?>">
        <label for="produto">Produto:</label>
        <!--         <input type="text" id="produto" name="produto" placeholder="Nome ou ID do Produto"> -->
        <select name="select-item" id="select-item">
            <?php
            while ($row = mysqli_fetch_array($result_produtos)) {
                echo "<option value='" . $row['id'] . "'>" . $row['nome'] . "</option>";
            }
            ?>
        </select>

        <label for="quantidade">Quantidade:</label>
        <input type="number" id="quantidade" name="quantidade" value="1">
        <button type="submit">Adicionar Item</button>
    </form>
    <hr>

    <?php
    /* exibir o inner join */
    while ($row = mysqli_fetch_array($result_itens_pedidos)) {
        echo "<p>" . "<a href='./functions/func_apagar_items_pedido.php?id_item=" . $row["id_item"] . "&id_pedido=" . $row["id_pedido"] . "'>" . "X" . "</a>" . $row['nome'] . " - " . $row['qtde'] . " - " . $row['valor_unitario'] . "</p>";
    }
    ?>

    <a href="./index.php">Voltar</a><br />
</div>
</div>