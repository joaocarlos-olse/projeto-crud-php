// Adiciona input para novos produtos
function addProduto(){
    //Cria uma div para os inputs
    var divLinhaProdutos = document.getElementById("linha_produtos");
    var div_prod = document.createElement("div");
    var div_qtde = document.createElement("div");
    div_prod.className = "form-group col-md-8";
    div_qtde.className = "form-group col-md-4";

    //Cria o input e a label para o Produto
    var label_prod = document.createElement("label");
    var select_prod_original = document.getElementById("select-original");

    label_prod.textContent = "Produto";
    var select_prod_novo = select_prod_original.cloneNode(true);
    select_prod_novo.id = "";

    div_prod.appendChild(label_prod);
    div_prod.appendChild(select_prod_novo);
    divLinhaProdutos.appendChild(div_prod);

    //Cria o input e a label para a Quantidade
    var label_qtde = document.createElement("label");
    var input_qtde = document.createElement("input");

    label_qtde.textContent = "Quantidade";
    input_qtde.type = "number";
    input_qtde.name = "quantidades[]";
    input_qtde.min = "1";
    input_qtde.max = "";
    input_qtde.placeholder = "";
    input_qtde.className = "form-control";

    div_qtde.appendChild(label_qtde);
    div_qtde.appendChild(input_qtde);
    divLinhaProdutos.appendChild(div_qtde);
}
