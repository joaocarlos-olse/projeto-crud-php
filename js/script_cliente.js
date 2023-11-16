// Lista de Chave: Valor, dos estados brasileiros
const estados = [{sigla: "AC", nome: "Acre"}, {sigla: "AL", nome: "Alagoas"}, {sigla: "AP", nome: "Amapá"}, {sigla: "AM", nome: "Amazonas"}, {sigla: "BA", nome: "Bahia"}, {sigla: "CE", nome: "Ceará"}, {sigla: "DF", nome: "Distrito Federal"}, {sigla: "ES", nome: "Espírito Santo"}, {sigla: "GO", nome: "Goiás"}, {sigla: "MA", nome: "Maranhão"}, {sigla: "MT", nome: "Mato Grosso"}, {sigla: "MS", nome: "Mato Grosso do Sul"}, {sigla: "MG", nome: "Minas Gerais"}, {sigla: "PA", nome: "Pará"}, {sigla: "PB", nome: "Paraíba"}, {sigla: "PR", nome: "Paraná"}, {sigla: "PE", nome: "Pernambuco"}, {sigla: "PI", nome: "Piauí"}, {sigla: "RJ", nome: "Rio de Janeiro"}, {sigla: "RN", nome: "Rio Grande do Norte"}, {sigla: "RS", nome: "Rio Grande do Sul"}, {sigla: "RO", nome: "Rondônia"}, {sigla: "RR", nome: "Roraima"}, {sigla: "SC", nome: "Santa Catarina"}, {sigla: "SP", nome: "São Paulo"}, {sigla: "SE", nome: "Sergipe"}, {sigla: "TO", nome: "Tocantins"}];


// Coloca como parametro GET o id do cliente que vai ser excluido
function excluirCliId(id){
    const a = document.querySelector("#linkExcluir");
    a.href = "../functions/excluir_cliente.php?id="+id
    $('#ModalConfirmarExcluir').modal('show');
}

// Preenche os inputs do modal de alteração do cadastro
function alterarCliId(id){
    const a = document.querySelector("#linkRelatorio");
    a.href = "../functions/select_cliente.php?id="+id+"&relatorio=true";

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
        const estado_selecionado = $("td#estado"+id).text();
        estados.forEach(function(estado) {
            if (estado.sigla === estado_selecionado) {
                estado_cli.value = estado.sigla;
            }
        });
    }
    $('#ModalAtualizar').modal('show');
}

// Preenche o select com o estado do cliente comum (não admin)
document.addEventListener("DOMContentLoaded", function (){
    var label_estado_cli = document.getElementById("label_estado_cliente");
    var estado_selecionado = label_estado_cli.getAttribute("name");
    const estado_cliente = document.querySelector("#estado_cliente");

    if(estado_selecionado != "" || estado_selecionado != null){
        estados.forEach(function(estado) {
            if (estado.sigla === estado_selecionado) {
                estado_cliente.value = estado.sigla;
            }
        });
    }    
});
