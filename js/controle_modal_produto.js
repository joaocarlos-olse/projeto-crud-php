// Preenche os inputs do modal de alteração do cadastro de produto
function alterarProdId(id){
    const id_prod = document.querySelector("#id_prod");
    id_prod.value = id;

    const nome_prod = document.querySelector("#nome_prod");
    nome_prod.value = $("td#nome"+id).text();

    const qtde_estoque_prod = document.querySelector("#qtde_estoque_prod");
    qtde_estoque_prod.value = $("td#qtde_estoque"+id).text();

    const valor_unitario_prod = document.querySelector("#valor_unitario_prod");
    valor_unitario_prod.value = $("td#valor_unitario"+id).text();

    const unidade_medida_prod = document.querySelector("#unidade_medida_prod");
    unidade_medida_prod.value = $("td#unidade_medida"+id).text();

    $('#ModalAtualizar').modal('show');
}

// Coloca como parametro GET o id do produto que vai ser excluido
function excluirProdId(id){
    const a = document.querySelector("#linkExcluir");
    a.href = "../functions/excluir_produto.php?id="+id
    $('#ModalConfirmarExcluir').modal('show');
}