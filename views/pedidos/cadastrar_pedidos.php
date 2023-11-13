<?php
include("../../common/config.php");
$result_clientes = mysqli_query($conexao, "SELECT * FROM clientes");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form action="./functions/func_criar_pedido.php" method="post">
        <input type='date' placeholder="Data" id="data_pedido" name="data_pedido"><br />
        <!--         <input type="text" id="cliente" name="cliente" placeholder="Nome ou ID do cliente"> -->
        <label for="cliente">Clientes :</label>
        <select name="id_cliente" id="id_cliente">
            <?php
            while ($row = mysqli_fetch_array($result_clientes)) {
                echo "<option value='" . $row['id'] . "'>" . $row['nome'] . "</option>";
            }
            ?>
        </select>

        <br />
        <label for="Observação">Observação :</label>
        <input type='text' placeholder="Observação" id="observacao" name="observacao"><br />
        <!--         <input type="text" id="cond_pagamento" name="cond_pagamento" placeholder="Condição do pagamento"> -->
        <label for="cond_pagamento">Condição do pagamento :</label>

        <select name="cond_pagamento" id="cond_pagamento">
            <option value="À vista">À vista</option>
            <option value="À prazo">À prazo</option>
            <option value="15 dias">15 dias</option>
            <option value="30 dias">30 dias</option>
            <option value="45 dias">45 dias</option>
            <option value="60 dias">60 dias</option>
            <option value="90 prazo">90 prazo</option>
        </select><br />

        <label for="prazo_entrega">Prazo de entrega :</label>
        <select name="prazo_entrega" id="prazo_entrega">
            <option value="10 dias">10 dias</option>
            <option value="15 dias">15 dias</option>
            <option value="30 dias">30 dias</option>
            <option value="45 dias">45 dias</option>
            <option value="60 dias">60 dias</option>
            <option value="90 prazo">90 prazo</option>
        </select><br />
        <button type="submit">Salvar pedido</button>
    </form>


    <a href="./index.php">Voltar</a><br />


</body>

</html>