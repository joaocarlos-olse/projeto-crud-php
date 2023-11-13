<?php

$data_inicial = "";
$data_final = "";

$data_inicial = isset($_GET['data_inicial']) ? $_GET['data_inicial'] : "";
$data_final = isset($_GET['data_final']) ? $_GET['data_final'] : "";

$relatorio = isset($_GET['relatorio']) ? $_GET['relatorio'] : false;

if ($data_inicial == "" && $data_final == "") {
    $sql = "SELECT *, pedidos.id as id_ped FROM pedidos INNER JOIN clientes ON pedidos.id_cliente = clientes.id ORDER BY pedidos.data_pedido DESC";
} elseif ($data_inicial != "" && $data_final != "") {
    $sql = "SELECT *, pedidos.id as id_ped FROM pedidos INNER JOIN clientes ON pedidos.id_cliente = clientes.id WHERE pedidos.data_pedido BETWEEN '$data_inicial' AND '$data_final' ORDER BY pedidos.data_pedido DESC";
} elseif ($data_inicial != "" && $data_final == "") {
    $sql = "SELECT *, pedidos.id as id_ped FROM pedidos INNER JOIN clientes ON pedidos.id_cliente = clientes.id WHERE pedidos.data_pedido >= '$data_inicial' ORDER BY pedidos.data_pedido DESC";
} elseif ($data_inicial == "" && $data_final != "") {
    $sql = "SELECT *, pedidos.id as id_ped FROM pedidos INNER JOIN clientes ON pedidos.id_cliente = clientes.id WHERE pedidos.data_pedido <= '$data_final' ORDER BY pedidos.data_pedido DESC";
}


$pedidos = mysqli_query($conexao, $sql) or die(mysqli_connect_error());

if (mysqli_num_rows($pedidos) > 0) {
    $pedidos_array = array();

    while ($ped = mysqli_fetch_assoc($pedidos)) {
        $pedidos_array[] = $ped;
    }
    $_SESSION['pedidos'] = $pedidos_array;
    $_SESSION['relatorio_pedidos'] = $pedidos_array;

    if ($relatorio == true) {
        header("Location: ../common/relatorio_pedidos_render.php");
    } else {
        // header("Location: ../");
    }
} else {
    $_SESSION['erro_select_ped'] = "Não foram localizados dados para o pedido informado!";
    // header("Location: ../");
}

mysqli_close($conexao);
