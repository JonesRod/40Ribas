function validateForm() {
    /*var uf =document.getElementById('iuf').value;
    var ufAtual =document.getElementById('iuf_atual').value;
    var sem_escolha ="Escolha";

    /*if (arqFoto.files.length === 0) {
        //alert('Por favor, preencha todos os campos.');
        document.querySelector('#imgAlerta2').textContent = "Adicione uma foto.";
        return false; // Impede o envio do formulário
    }
    if(uf === sem_escolha){
        document.querySelector('#imgAlerta2').textContent = "Selecione o Estado!";
        document.getElementById('iuf').focus();
        console.log(apelido);

        return false; // Impede o envio do formulário
    }
    if(ufAtual === sem_escolha){
        document.querySelector('#imgAlerta2').textContent = "Selecione seu Estado atual!";
        document.getElementById('iuf_atual').focus();
        return false; // Impede o envio do formulário
    }
        document.querySelector('#imgAlerta2').textContent = "";
        //console.log('2');

    // Aqui você pode adicionar mais validações conforme necessário
    return true; // Permite o envio do formulário*/
}

 
function formatarData_ini(input) {
    let value = input.value.replace(/\D/g, ''); // Remove todos os caracteres não numéricos
    if (value.length > 8) {
        value = value.substr(0, 8);
    }
    if (value.length > 4) {
        value = value.replace(/(\d{2})(\d{2})/, '$1/$2/');
    } else if (value.length > 2) {
        value = value.replace(/(\d{2})/, '$1/');
    } 
    input.value = value;
}
function formatarData_fim(input) {
    let value = input.value.replace(/\D/g, ''); // Remove todos os caracteres não numéricos
    if (value.length > 8) {
        value = value.substr(0, 8);
    }
    if (value.length > 4) {
        value = value.replace(/(\d{2})(\d{2})/, '$1/$2/');
    } else if (value.length > 2) {
        value = value.replace(/(\d{2})/, '$1/');
    } 
    input.value = value;
}
function compararDatas() {
    var data_ini = document.getElementById('idata_ini').value;
    var data_fim = document.getElementById('idata_final').value;

    // Separando o dia, mês e ano e invertendo a ordem para "yyyy-mm-dd"
    var dataInicioParts = data_ini.split("/");
    var dataInicioFormatada = dataInicioParts[2] + "-" + dataInicioParts[1] + "-" + dataInicioParts[0];

    var dataFinalParts = data_fim.split("/");
    var dataFinalFormatada = dataFinalParts[2] + "-" + dataFinalParts[1] + "-" + dataFinalParts[0];

    var dataHoje = new Date();  // Data atual

    var dataInicio = new Date(dataInicioFormatada);
    var dataFinal = new Date(dataFinalFormatada);

    if (dataInicio < dataHoje){
        document.getElementById('idata_ini').focus();
        document.querySelector('#imgAlerta').textContent = "Data inválida! Preencha o campo corretamente.";
    } else if(dataFinal < dataInicio){
        document.getElementById('idata_final').focus();
        document.querySelector('#imgAlerta').textContent = "Data inválida! Preencha o campo corretamente.";
    } else {
        document.querySelector('#imgAlerta').textContent = ""; // Limpa a mensagem se as datas estiverem corretas
    }
}
function formatarHora(input) {
    let value = input.value.replace(/\D/g, ''); // Remove todos os caracteres não numéricos

    if (value.length > 4) {
        value = value.substr(0, 4);
    }
    if (value.length > 3) {
        value = value.replace(/(\d{2})(\d{2})/, '$1:$2');
    }
    if (value.length > 2) {
        value = value.replace(/(\d{1})(\d{2})/, '$1:$2');
    }

    input.value = value;
}
function compararHorarios() {
    var data_ini = document.getElementById('idata_ini').value;
    var data_fim = document.getElementById('idata_final').value;
    
    // Separando o dia, mês e ano e invertendo a ordem para "yyyy-mm-dd"
    var dataInicioParts = data_ini.split("/");
    var dataInicioFormatada = dataInicioParts[2] + "-" + dataInicioParts[1] + "-" + dataInicioParts[0];

    var dataFinalParts = data_fim.split("/");
    var dataFinalFormatada = dataFinalParts[2] + "-" + dataFinalParts[1] + "-" + dataFinalParts[0];
        
    var horaIni = document.getElementById('ihora_ini').value;
    var horaFim = document.getElementById('ihora_final').value;

    var dataIni = new Date(dataInicioFormatada + "T" + horaIni); // Adicionado "T" para separar data e hora
    var dataFim = new Date(dataFinalFormatada + "T" + horaFim);

    if (dataFim <= dataIni) {
        document.getElementById('ihora_final').focus();
        document.querySelector('#imgAlerta').textContent = "Horário inválido! Preencha o campo corretamente.";
    } else {
        document.querySelector('#imgAlerta').textContent = ""; // Limpa a mensagem se os horários estiverem corretos
    }
    console.log("oii");
}




