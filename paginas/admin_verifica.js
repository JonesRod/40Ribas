function validateForm() {
    const arqFoto = document.getElementById('imageInput');
    var uf = document.getElementById('iuf').value;
    var sem_escolha ="Escolha";

    if (arqFoto.files.length === 0) {
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
        document.querySelector('#imgAlerta2').textContent = "";
        //console.log('2');

    // Aqui você pode adicionar mais validações conforme necessário
    return true; // Permite o envio do formulário
}
function handleImageUpload(event) {
    const file = event.target.files[0];

    if (file && (file.type === 'image/png' || file.type === 'image/jpeg')) {
        const reader = new FileReader();
        reader.onload = function() {
            const preview = document.getElementById('preview');
            preview.src = reader.result;
        };
        reader.readAsDataURL(file);
        document.querySelector('#imsgAlerta').textContent = "";
    } else {
        //alert('Por favor, selecione uma imagem PNG ou JPG.');
        document.getElementById('preview').src= "'foto_perfil/9734564-default-avatar-profile-icon-of-social-media-user-vetor.jpg'"
        document.getElementById('imageInput').value = null;
        //document.querySelector('#imgAlerta').textContent = "Por favor, selecione uma imagem PNG ou JPG.";
    }
}  
function formataCNPJ(input) {
    let value = input.value.replace(/\D/g, ''); // Remove todos os caracteres não numéricos
    if (value.length > 14) {
        value = value.substr(0, 14);
    }if (value.length > 12) {
        value = value.replace(/(\d{2})(\d{3})(\d{3})(\d{4})/, '$1.$2.$3/$4-');
    } else if (value.length > 8) {
        value = value.replace(/(\d{2})(\d{3})(\d{3})/, '$1.$2.$3/');
    } else if (value.length > 5) {
        value = value.replace(/(\d{2})(\d{3})/, '$1.$2.');
    } else if (value.length > 2) {
        value = value.replace(/(\d{2})/, '$1.');
    }
    input.value = value;
}
function verificaCnpj() {
    var cnpj = document.getElementById('icnpj').value;

    if(cnpj.length < 18) {
        console.log(cnpj.length);
        document.querySelector('#imsgAlerta').textContent = "CNPJ invalido! Preencha o campo corretamente.";
        document.getElementById('icnpj').focus();
    }else{
        document.querySelector('#imsgAlerta').textContent = "";
    }
      
}         
function formatarCEP(input) {
    let value = input.value.replace(/\D/g, ''); // Remove todos os caracteres não numéricos
    if (value.length > 8) {
        value = value.substr(0, 8);
    }
    if (value.length > 5) {
        value = value.replace(/(\d{5})/, '$1-');
    }
    input.value = value;
}
async function fetchCityByCEP() {
    const cep = document.getElementById('icep').value.replace(/\D/g, ''); // Remove caracteres não numéricos

    if (cep.length !== 8) {
        //alert('CEP inválido.');
        document.querySelector('#imsgAlerta').textContent = "CEP invalido! Preencha o campo corretamente.";
        document.querySelector('#icidade').value = "";
        document.getElementById('icep').focus();
        return;
    }

    const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
    const data = await response.json();
    document.querySelector('#imsgAlerta').textContent = "";

    if (data.erro) {
        //alert('CEP não encontrado.');
        document.querySelector('#imsgAlerta').textContent = "CEP está incorretamente.";
        document.querySelector('#icidade').value = "";
        //document.getElementById('icep').focus();
        return;
    }
    document.querySelector('#imsgAlerta').textContent = "";
    document.getElementById('icidade').value = data.localidade;
}