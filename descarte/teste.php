<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ficha de Inscrição</title>
</head>
<body>
    <h1>Ficha de Inscrição</h1>

    

    <form action="deu_certo.php" method="POST" enctype="multipart/form-data" autocomplete="on" id="idados">
    
        <img height="200" for="img" src="../arquivos/9734564-default-avatar-profile-icon-of-social-media-user-vetor.jpg" alt=""><br>
        <input name="foto" type="file" id="img">
        <br>

        <span id="imgAlerta"></span>

        <p>
            <label for="idata">Data: </label><br>
            <input type="text" id="idata" name="data" oninput="formatarData(this)" onblur="verificaData()"><br><br>

            <label for="icpf">CPF:</label><br>
            <input type="text" id="icpf" oninput="formatCPF(this)" onblur="verificaCpf()">
        </p>
            <script>
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
                    var data =document.getElementById('idata').value;
                    
                    if(data.length < 10){
                        //console.log(data);
                        document.querySelector('#imgAlerta').textContent = "Data invalida! Preencha o campo corretamente.";
                        document.getElementById('idata').focus();
                    }else{
                        document.querySelector('#imgAlerta').textContent = "";
                    }
                    /*if( ano == "" || ano < 1900 || ano > 2023){
                        console.log('Ano invalido');
                        document.querySelector('#imgAlerta').textContent = "Ano Invalido!";

                    }
                    else if(ano > 0 || ano < 2023){
                        document.querySelector('#imgAlerta').textContent = "";
                        if(ano.length == 1){
                            document.getElementById('iano').value='0'+ ano;
                        }
                    }*/
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

            </script>
        <p>
            <input id="solicitar" type="submit" value="Solicitar">
        </p>
    </form>
    <script src="verifica.js"></script>
</body>
</html>