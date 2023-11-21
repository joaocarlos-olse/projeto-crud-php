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

// Preenche campos dados pessoais do pedido
function setDadosCli(){
    var selecionado = document.getElementById("select_nome_cli");

    var id_selecionado = selecionado.options[selecionado.selectedIndex].getAttribute("value")
    var name_selecionado = selecionado.options[selecionado.selectedIndex].getAttribute("name");

    var dados = name_selecionado.split("&");
    dados.unshift(id_selecionado);

    var id_cliente = document.getElementById("id_cliente");
    var cpf_cnpj = document.getElementById("cpf_cnpj");
    var email = document.getElementById("email");
    var celular = document.getElementById("celular");
    
    id_cliente.value = [0];
    cpf_cnpj.value = dados[1];
    email.value = dados[2];
    celular.value = dados[3];
}

