function excluirCliId(id){
    const a = document.querySelector("#linkExcluir");
    a.href = "../functions/excluir_cliente.php?id="+id
    $('#ModalConfirmarExcluir').modal('show');
}

function alterarCliId(id){
    const id_cli = document.querySelector("#id_cli");
    id_cli.value = id;

    const nome_cli = document.querySelector("#nome_cli");
    nome_cli.value = $("td#nome"+id).text();

    const email_cli = document.querySelector("#email_cli");
    email_cli.value = $("td#email"+id).text();

    const rg_cli = document.querySelector("#rg_cli");
    rg_cli.value = $("td#rg"+id).text();

    const cpf_cnpj_cli = document.querySelector("#cpf_cnpj_cli");
    cpf_cnpj_cli.value = $("td#cpf_cnpj"+id).text();

    const data_nasc_cli = document.querySelector("#data_nasc_cli");
    data_nasc_cli.value = $("td#data_nasc"+id).text();

    const endereco_cli = document.querySelector("#endereco_cli");
    endereco_cli.value = $("td#endereco"+id).text();

    const numero_cli = document.querySelector("#numero_cli");
    numero_cli.value = $("td#numero"+id).text();

    const bairro_cli = document.querySelector("#bairro_cli");
    bairro_cli.value = $("td#bairro"+id).text();

    const cidade_cli = document.querySelector("#cidade_cli");
    cidade_cli.value = $("td#cidade"+id).text();

    const telefone_cli = document.querySelector("#telefone_cli");
    telefone_cli.value = $("td#telefone"+id).text();

    const celular_cli = document.querySelector("#celular_cli");
    celular_cli.value = $("td#celular"+id).text();

    const admin_cli = document.querySelector("#admin_cli");
    if($("td#admin"+id).text() == "1"){
        admin_cli.checked = true;
    }
    else{
        admin_cli.checked = false;
    }

    const estado_cli = document.querySelector("#estado_cli");
    if($("td#estado"+id).text() != ""){
        const estado = $("td#estado"+id).text();
        switch(estado){
            case "AC":
                estado_cli.value = "AC";
                break;
            case "AL":
                estado_cli.value = "AL";
                break;
            case "AP":
                estado_cli.value = "AP";
                break;
            case "AM":
                estado_cli.value = "AM";
                break;
            case "BA":
                estado_cli.value = "BA";
                break;
            case "CE":
                estado_cli.value = "CE";
                break;
            case "DF":
                estado_cli.value = "DF";
                break;
            case "ES":
                estado_cli.value = "ES";
                break;
            case "GO":
                estado_cli.value = "GO";
                break;
            case "MA":
                estado_cli.value = "MA";
                break;
            case "MT":
                estado_cli.value = "MT";
                break;
            case "MS":
                estado_cli.value = "MS";
                break;
            case "MG":
                estado_cli.value = "MG";
                break;
            case "PA":
                estado_cli.value = "PA";
                break;
            case "PB":
                estado_cli.value = "PB";
                break;
            case "PR":
                estado_cli.value = "PR";
                break;
            case "PE":
                estado_cli.value = "PE";
                break;
            case "PI":
                estado_cli.value = "PI";
                break;
            case "RJ":
                estado_cli.value = "RJ";
                break;
            case "RN":
                estado_cli.value = "RN";
                break;
            case "RS":
                estado_cli.value = "RS";
                break;
            case "RO":
                estado_cli.value = "RO";
                break;
            case "RR":
                estado_cli.value = "RR";
                break;
            case "SC":
                estado_cli.value = "SC";
                break;
            case "SP":
                estado_cli.value = "SP";
                break;
            case "SE":
                estado_cli.value = "SE";
                break;
            case "TO":
                estado_cli.value = "TO";
        }
    }
    $('#ModalAtualizar').modal('show');
}

document.addEventListener("DOMContentLoaded", function setEstado(){
    var label_estado_cli = document.getElementById("label_estado_cliente");
    var estado_selecionado = label_estado_cli.getAttribute("name");
    const estado_cliente = document.querySelector("#estado_cliente");

    if(estado_selecionado != "" || estado_selecionado != null){
        switch(estado_selecionado){
            case "AC":
                estado_cliente.value = "AC";
                break;
            case "AL":
                estado_cliente.value = "AL";
                break;
            case "AP":
                estado_cliente.value = "AP";
                break;
            case "AM":
                estado_cliente.value = "AM";
                break;
            case "BA":
                estado_cliente.value = "BA";
                break;
            case "CE":
                estado_cliente.value = "CE";
                break;
            case "DF":
                estado_cliente.value = "DF";
                break;
            case "ES":
                estado_cliente.value = "ES";
                break;
            case "GO":
                estado_cliente.value = "GO";
                break;
            case "MA":
                estado_cliente.value = "MA";
                break;
            case "MT":
                estado_cliente.value = "MT";
                break;
            case "MS":
                estado_cliente.value = "MS";
                break;
            case "MG":
                estado_cliente.value = "MG";
                break;
            case "PA":
                estado_cliente.value = "PA";
                break;
            case "PB":
                estado_cliente.value = "PB";
                break;
            case "PR":
                estado_cliente.value = "PR";
                break;
            case "PE":
                estado_cliente.value = "PE";
                break;
            case "PI":
                estado_cliente.value = "PI";
                break;
            case "RJ":
                estado_cliente.value = "RJ";
                break;
            case "RN":
                estado_cliente.value = "RN";
                break;
            case "RS":
                estado_cliente.value = "RS";
                break;
            case "RO":
                estado_cliente.value = "RO";
                break;
            case "RR":
                estado_cliente.value = "RR";
                break;
            case "SC":
                estado_cliente.value = "SC";
                break;
            case "SP":
                estado_cliente.value = "SP";
                break;
            case "SE":
                estado_cliente.value = "SE";
                break;
            case "TO":
                estado_cliente.value = "TO";
        }
    }    
});
