function formatarData(input) {
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

function verificaData(){
    var data_input = document.getElementById('idata').value;
    //const data = new Date(data_input);
    const data_inicio = '01/01/1900';
    const data_final = new Date(); // Isso pega a data e hora atuais
    const DateParts = data_inicio.split('/'); // Assumindo o formato dd/mm/yyyy
    const data_input_DateParts = data_input.split('/');

    const data_inicio_dia = parseInt(DateParts[0]);
    const data_inicio_mes = parseInt(DateParts[1]);
    const data_inicio_ano = parseInt(DateParts[2]);

    const data_inicio_convertida = new Date(data_inicio_ano, data_inicio_mes - 1, data_inicio_dia); // Mês é baseado em índices (0 a 11)
    
    var data_input_dia = parseInt(data_input_DateParts[0]);
    var data_input_mes = parseInt(data_input_DateParts[1]);
    var data_input_ano = parseInt(data_input_DateParts[2]);

    const data = new Date(data_input_ano, data_input_mes - 1, data_input_dia); // Mês é baseado em índices (0 a 11)

    const ano = new Date();
    const ano_atual = ano.getFullYear();

    //console.log(ano_atual);
    if(data_input != "") {

        if(data_input_dia < 1 || data_input_dia > 31){
            document.querySelector('#imgAlerta').textContent = "Data invalida! Preencha o campo corretamente.";
            document.getElementById('idata').focus();
        }else if(data_input_mes < 1 || data_input_mes >12){
            document.querySelector('#imgAlerta').textContent = "Data invalida! Preencha o campo corretamente.";
            document.getElementById('idata').focus();
        }else if(data_input_ano < 1900 || data_input_ano > ano_atual){
            document.querySelector('#imgAlerta').textContent = "Data invalida! Preencha o campo corretamente.";
            document.getElementById('idata').focus();
        } 

        if(data_input.length < 10){
            document.querySelector('#imgAlerta').textContent = "Data invalida! Preencha o campo corretamente.";
            document.getElementById('idata').focus();
        }
        else if (data_input.length === 10) {
            switch(data_input_mes){
                case 1: case 3: case 5: case 7: 
                case 8: case 10: case 12:
                if(data_input_dia <= 31){
                    if (data < data_inicio_convertida) {
                        document.querySelector('#imgAlerta').textContent = "Data invalida! Preencha o campo corretamente.";
                        document.getElementById('idata').focus();
                        //console.log('1');
                    } else if (data.getTime() > data_final.getTime()) {
                        document.querySelector('#imgAlerta').textContent = "Data invalida! Preencha o campo corretamente.";
                        document.getElementById('idata').focus();
                        //console.log('12');
                    } else {
                        document.querySelector('#imgAlerta').textContent = "";
                        //console.log(data);
                        break ;
                    }
                }else
                document.querySelector('#imgAlerta').textContent = "Data invalida! Preencha o campo corretamente.";
                document.getElementById('idata').focus();
                break ;
                case 4: case 6:
                case 9: case 11:
                if(data_input_dia <= 30){
                    if (data < data_inicio_convertida) {
                        document.querySelector('#imgAlerta').textContent = "Data invalida! Preencha o campo corretamente.";
                        document.getElementById('idata').focus();
                        //console.log('11');
                    } else if (data > data_final) {
                        document.querySelector('#imgAlerta').textContent = "Data invalida! Preencha o campo corretamente.";
                        document.getElementById('idata').focus();
                        //console.log('22');
                    } else {
                        document.querySelector('#imgAlerta').textContent = "";
                        //console.log('23');
                        break ;
                    }
                }else
                    document.querySelector('#imgAlerta').textContent = "Data invalida! Preencha o campo corretamente.";
                    document.getElementById('idata').focus();
                    break ;
                    case 2:
                    if( (data_input_ano%400 == 0) || (data_input_ano%4==0 && data_input_ano%100!=0) )
                    if( data_input_dia <= 29){
                        console.log('111');
                        if (data < data_inicio_convertida) {
                            document.querySelector('#imgAlerta').textContent = "Data invalida! Preencha o campo corretamente.";
                            document.getElementById('idata').focus();
                            //console.log('1122');
                        } else if (data > data_final) {
                            document.querySelector('#imgAlerta').textContent = "Data invalida! Preencha o campo corretamente.";
                            document.getElementById('idata').focus();
                            //console.log('222');
                        } else {
                            document.querySelector('#imgAlerta').textContent = "";
                            //console.log('data');
                            break ;
                        }
                    }else{
                        document.querySelector('#imgAlerta').textContent = "Data invalida! Preencha o campo corretamente.";
                        document.getElementById('idata').focus();
                    }else if( data_input_dia <= 28){
                        if (data < data_inicio_convertida) {
                            document.querySelector('#imgAlerta').textContent = "Data invalida! Preencha o campo corretamente.";
                            document.getElementById('idata').focus();
                            //console.log('11222');
                        } else if (data > data_final) {
                            document.querySelector('#imgAlerta').textContent = "Data invalida! Preencha o campo corretamente.";
                            document.getElementById('idata').focus();
                            //console.log(data);
                        } else {
                            document.querySelector('#imgAlerta').textContent = "";
                            break ;
                        }
                    }else
                        document.querySelector('#imgAlerta').textContent = "Data invalida! Preencha o campo corretamente.";
                        document.getElementById('idata').focus();
            }
        }
    } else if(data_input == "") {
        document.querySelector('#imgAlerta').textContent = "Preencha o campo Data de nascimento.";
    }
}

function formatCPF(input) {
    let value = input.value.replace(/\D/g, ''); // Remove todos os caracteres não numéricos
    if (value.length > 11) {
        value = value.substr(0, 11);
    }
    if (value.length > 9) {
        value = value.replace(/(\d{3})(\d{3})(\d{3})/, '$1.$2.$3-');
    } else if (value.length > 6) {
        value = value.replace(/(\d{3})(\d{3})/, '$1.$2.');
    } else if (value.length > 3) {
        value = value.replace(/(\d{3})/, '$1.');
    }
    input.value = value;
}
function verificaCpf(){
    var cpf =document.getElementById('icpf').value;
    
    if(cpf.length < 14){
        //console.log(cpf);
        document.querySelector('#imgAlerta').textContent = "CPF invalido! Preencha o campo corretamente.";
        document.getElementById('icpf').focus();
    }else{
        document.querySelector('#imgAlerta').textContent = "";
    }
}


